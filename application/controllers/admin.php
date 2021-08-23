<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start();
class Admin extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->load->library('session');
		$this->load->model('Crudmodel','',TRUE);
	}
	public function index()
	{	
		$data=array();
		$data['page_title'] = ucfirst('Global informations Admin Panel.');
		$this->load->view('admin/header', $data);
		$this->load->view('admin/login','TRUE');
		$this->load->view('admin/footer');
	}	
	public function register()
	{
		if($this->session->userdata('level') != 0 && $this->session->userdata('level') != 3)
		{
		$data=array();		
		$data['page_title'] = ucfirst('Global informations User Registration.');
		$this->load->view('admin/header', $data);
		$this->load->view('admin/register');
		$this->load->view('admin/footer');
		}
		else{$this->index();}		
	}
	public function login()
	{
		$this->Crudmodel->ulogin();
	}
	public function logout()  
	{  
		if($this->session->userdata('uname') == TRUE)
		{		
		$data = array('id' => '','uname' => '','status' => '','level' => '');
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();  
		$this->index(); 
		} 
		else{$this->index();}
	}	
	public function insert_data()
	{
		$this->Crudmodel->create();
	}
	public function entry_level()
	{
		if($this->session->userdata('level') != 0)
		{
		$data=array(); 
		$data['page_title'] = ucfirst('Global informations Entry.');
		$this->load->view('admin/header', $data, $this->session->all_userdata());
		$data['insert_mode'] = TRUE;
		$data['update_mode'] = FALSE;
		$data['action'] = base_url('admin/insert_data');
		$this->load->view('admin/entry', $data, 'TRUE');
		$this->load->view('admin/footer');
		}
		else{$this->index();}
	}
	public function update_level()
	{
		if($this->session->userdata('level') != 0 && $this->session->userdata('level') != 3)
		{		
		$data=array();
		$data['page_title'] = ucfirst('Global informations Update.');
		$this->load->view('admin/header', $data, $this->session->all_userdata());
		$data['insert_mode'] = FALSE;
		$data['update_mode'] = TRUE;
		$data['action'] = base_url('welcome/edit_data');
		$data['focus'] = $this->Crudmodel->request_one();
		$this->load->view('admin/entry', $data, 'TRUE');
		$this->load->view('admin/footer');
		}
		else{$this->index();}		
	}	
	public function update_view()
	{
		if($this->session->userdata('level') != 0 && $this->session->userdata('level') != 3)
		{		
		$data=array();
		$data['page_title'] = ucfirst('Global informations Admin Panel.');
		$this->load->view('admin/header', $data, $this->session->all_userdata());
		$data['view']=$this->Crudmodel->retrieve_all();
		$this->load->view('admin/listview', $data);
		$this->load->view('admin/footer');
		}
		else{$this->index();}		
	}
	public function doreg()
	{
		if($this->session->userdata('level') != 0 && $this->session->userdata('level') != 3)
		{		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('uname', 'Name', 'trim|required');
			$this->form_validation->set_rules('reg_email', 'Email', 'trim|required|valid_email|is_unique[eilogin.umail]');
			$this->form_validation->set_rules('reg_dpass', 'Password', 'trim|required');
			$this->form_validation->set_rules('reg_cpass', 'Confirm Password', 'trim|required|matches[reg_dpass]');
			if($this->form_validation->run() == FALSE)
			{
				$data=array();
				$data['page_title'] = ucfirst('Global informations Admin Panel.');
				$this->load->view('admin/header',$data);
				$this->load->view('admin/register');
				$this->load->view('admin/footer');
			}	
			else
			{    
		    $this->load->library('email');
	    	$umail = trim(htmlspecialchars($this->input->post('reg_email')));
			$class=date('Y');
			$random_id_length = 10;
			$rnd_id = md5(crypt(uniqid($class.rand(),1)));
			$rnd_id = strip_tags(stripslashes($rnd_id));
			$rnd_id = str_replace(".","",$rnd_id);
			$rnd_id = strrev(str_replace("/","",$rnd_id));
			$rnd_id = substr($rnd_id,0,$random_id_length);
			$this->Crudmodel->pre_store($rnd_id);
			$config=array();
			$config['useragent'] = "eindex";
			$config['send_multipart'] = FALSE;
			$config['protocol'] = 'mail';
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;
			$config['charset']  = 'utf-8';
			$config['priority'] = '3';
			$config['newline'] = '\r\n';
			$config['crlf'] = '\r\n';
			//$this->email->set_newline("\r\n");
	    	$this->email->initialize($config);
	        $this->email->from('webmaster@eindex.info', 'webmaster');
	 		$this->email->reply_to('webmaster@eindex.info', 'webmaster');
	    	$this->email->to($umail);       
			$this->email->subject('Registration Verification: Continuous Impression');
		    $this->email->message('<b style="color:#026180">Thanks for signing up!</b><br/>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
		<br/>------------------------<br/>Login : '.trim($this->input->post('uname')).'<br/>Password : '.trim($this->input->post('reg_dpass')).'<br/>------------------------<br/>
		Please click this link to activate your account <a href='.site_url('admin/uverify').'?umail='.$umail.'&salt='.$rnd_id.'>Click Here</a><br/>Best regards,<br/><a href="www.eindex.info">eindex</a><br/>webmaster'); 
			$this->email->set_alt_message(trim(htmlspecialchars('This message sent via eindex for Registration Verification. If you are unable to read your login and password please! Register again. Thank`s<br/> webmaster<br/>eindex')));    
			    if($this->email->send() == TRUE)
				{
			        #echo($this->email->print_debugger().'<br/>Done!');
			        $this->session->set_flashdata( 'TRUE', 'Registration Success' );
			        redirect('admin/register');
			    }
			    else
			    {
			        #echo(show_error($this->email->print_debugger().'<br/>Failed'));
			        $this->session->set_flashdata( 'FALSE', 'Registration Failed' );
			        redirect('admin/register');
			    }
		    }
	    }		
	}  
	public function uverify()
	{
		$email = trim(htmlspecialchars($this->input->get('umail', TRUE)));
		$rand = trim(htmlspecialchars($this->input->get('salt', TRUE)));
		$data_array=array('umail'=>$email,'salt'=>$rand,'status'=>0,'level'=>0);
		$this->db->where($data_array);
#$this->db->where('umail'=>'$email');
#$this->db->where('salt'=>'$rand');
		$data = array('status' => 1,'level' => 3);
		$this->db->update('eilogin', $data);
		$this->login();
	}
	public function ems_view()
	{
		if($this->session->userdata('level') != 0 && $this->session->userdata('level') != 2 && $this->session->userdata('level') != 3)
		{
		$data=array();		
		$data['page_title'] = ucfirst('Global informations Admin Panel.');
		$this->load->view('admin/header', $data, $this->session->all_userdata());
		$this->load->view('admin/ems');
		$this->load->view('admin/footer');
		}
		else{$this->index();}
	}
	public function ems()
	{
		$this->Crudmodel->get_ems();	
	}
	public function key_update()
	{
		if($this->session->userdata('level') != 0 && $this->session->userdata('level') != 2 && $this->session->userdata('level') != 3)
		{
		$data=array();		
		$data['page_title'] = ucfirst('Global informations Admin Panel.');
		$this->load->view('admin/header', $data, $this->session->all_userdata());
		$this->load->view('admin/keyload',$data);
		$this->load->view('admin/footer');
		}
		else{$this->index();}
	}
	public function keyload()
	{
		$this->Crudmodel->keyupdate();
	}
	// public function retrieve_comment()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('blog');
	// 	$this->db->join('comments', 'comments.entry_id = blog.id');
	// 	$com = $this->db->get();
	// 	return $com->result();
	// }
/* End of file admin.php */
}
