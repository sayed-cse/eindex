<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->output->set_content_type('text/html', 'UTF-8');
		#$this->output->set_header('Content-Type: text/html; charset=utf-8');
		//$this->load->library('javascript');
		//$this->load->library('javascript/jquery');
		$this->load->model('Crudmodel','',TRUE);
	}
	public function index()
	{
		$data=array();	
		$data['dynadesc'] = 'Dynamic Description';
		$data['dynakey'] = 'Dynamic Keywords';
		$data['page_title'] = ucfirst('eindex:: Global informations in a single door.');
		$match = $this->input->post('key');
		$data['view']=$this->Crudmodel->searchtxt($match);		
		$this->load->view('header', $data);
		$this->load->view('display', $data, 'TRUE');
		$this->load->view('footer');
	}
	public function insert_data()
	{
		$this->Crudmodel->create();
	}
	public function edit_data()
	{
		$this->Crudmodel->update();
	}
	public function erase()
	{
		$this->Crudmodel->delete();
	}
	public function focus()
	{
		$this->Crudmodel->retrieve_one();
	}
	public function feedback()
	{
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
		$this->load->library('email');
		$this->email->initialize($config);	

		$from = trim(htmlspecialchars($this->input->post('feedmail')));
		$to = trim(htmlspecialchars('2munax@gmail.com'));
		$subject = trim(htmlspecialchars($this->input->post('feedsub')));
		$msg = trim(htmlspecialchars($this->input->post('feedmsg')));
		$this->email->from($from, $subject);
		$this->email->reply_to($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		$this->email->set_alt_message('This message sent via eindex. Continuous impression from service to service.');
		if(!empty($from) && !empty($subject) && !empty($msg))
		{
		    if($this->email->send() == TRUE)
			{
		        #echo($this->email->print_debugger().'<br/>Done!');
		        #return true;
		        redirect($this->index());
		    }
		    else
		    {
		        #echo(show_error($this->email->print_debugger().'<br/>Failed'));
		        #return false;
		        redirect($this->index());
		    }
		}
		else
		{
			echo('Required Fields Missing!<br/>');
		}						
	}
	public function cmail()
	{
		// $config=array();
		// $config['useragent'] = "eindex";
		// $config['send_multipart'] = FALSE;
		// $config['protocol'] = 'mail';
		// $config['mailtype'] = 'html';
		// $config['wordwrap'] = TRUE;
		// $config['charset']  = 'utf-8';
		// $config['priority'] = '3';
		// $config['newline'] = '\r\n';
		// $config['crlf'] = '\r\n';
		// $this->load->library('email');
		// $this->email->initialize($config);	

		// $from = trim(htmlspecialchars($this->input->post('cmail')));
		// $to = trim(htmlspecialchars($this->input->post('to')));
		// $subject = trim(htmlspecialchars($this->input->post('cname')));
		// $msg = trim(htmlspecialchars($this->input->post('cmsg')));
		// $this->email->from($from, $subject);
		// $this->email->reply_to($from);
		// $this->email->to($to);
		// $this->email->subject($subject);
		// $this->email->message($msg);
		// $this->email->set_alt_message('This message sent via eindex. Continuous impression from service to service.');
		// if(!empty($from) && !empty($subject) && !empty($msg))
		// {
		//     if($this->email->send() == TRUE)
		// 	{
		//         #echo($this->email->print_debugger().'<br/>Done!');
		//         #return true;
		//         redirect($this->index());
		//     }
		//     else
		//     {
		//         #echo(show_error($this->email->print_debugger().'<br/>Failed'));
		//         #return false;
		//         redirect($this->index());
		//     }
		// }
		// else
		// {
		// 	echo('Required Fields Missing!<br/>');
		// }
//[WORKING - SMTP METHOD]		
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'anikamachinery@gmail.com', // change it to yours
		  'smtp_pass' => '1234anika', // change it to yours
		  'mailtype' => 'html',
		  'priority' => 3,
		  'charset' => 'utf-8',
		  'wordwrap' => TRUE
		);
		$from = trim(htmlspecialchars($this->input->post('sender')));
		$to = trim(htmlspecialchars($this->input->post('to')));
		$mailerName = trim(htmlspecialchars($this->input->post('cname')));;
		$msg = trim(htmlspecialchars($this->input->post('cmsg')));
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($from, $mailerName); // change it to yours
		$this->email->to($to);// change it to yours
		$this->email->subject(trim(htmlspecialchars($this->input->post('cname'))));
		$this->email->message($msg.'<br/> - '.$mailerName);
		if($this->email->send() == TRUE)
		{
			return true;
		}
		else
		{
			//show_error($this->email->print_debugger());
			return false;
		}		
	}	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */	
}

