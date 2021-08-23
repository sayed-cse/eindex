<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crudmodel extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
		$this->db->query("SET NAMES 'utf8'");
		$this->load->library(array('pagination','form_validation'));
	}
	public function get_ems()
	{
		$this->form_validation->set_rules('category', 'Category', 'trim|required|strtolower');
		$this->form_validation->set_rules('from', 'From', 'trim|required|strtolower');
		$this->form_validation->set_rules('ems_subject', 'Ems_subject', 'trim|required|strtolower');
		$this->form_validation->set_rules('ems_message', 'Ems_message', 'trim|required|strtolower');
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata( 'false', 'Fields Going Empty!');
			redirect('admin/ems_view');
		}
		else
		{
			$query = $this->db->get_where('idata', array('category' => trim($this->input->post('category'))));
			if($query->num_rows > 0) 
			{			
	            foreach($query->result() as $row)
	            {
	            	$sendto = array();
	            	$sendto = $row->email;
					$from = trim($this->input->post('from'));
					$reply_to =  trim($this->input->post('from'));
					$alt_msg = 'Alter Message';
					$this->load->library('email');
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
			    	$this->email->from($from,'');
			 		$this->email->reply_to($from,'');
			    	$this->email->to($sendto); //$from
			    	#$this->email->cc($sendto);
					$this->email->subject(trim(htmlspecialchars($this->input->post('ems_subject'))));
				    $this->email->message(trim(htmlspecialchars($this->input->post('ems_message')))); 
					$this->email->set_alt_message(trim(htmlspecialchars($alt_msg)));    
			    	if(!empty($sendto))
			    	{
			    		if($this->email->send() == TRUE)
						{
							//echo($this->email->print_debugger().'<br/><b class="true">Done!</b>'.$sendto.'<br/>');
							$this->session->set_flashdata( 'true', 'Mail Sent Successfully!');
							redirect('admin/ems_view');
						}
						else
						{
							//echo(show_error($this->email->print_debugger().'<br/><b class="false">Transmission Failed!</b><br/>'));
							$this->session->set_flashdata( 'false', 'Transmission Failed!');
							redirect('admin/ems_view');
						}
			    	}
			    	else
			    	{
			    		$this->session->set_flashdata( 'false', 'Recipient Empty');
						redirect('admin/ems_view');
			    	}			
				}
			}
			else
			{
				$this->session->set_flashdata( 'false', 'No Data Found!');
				redirect('admin/ems_view');
			}
		}
	}
	public function keyupdate()
	{
		$this->form_validation->set_rules('category', 'Category', 'trim|required|strtolower');
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required|strtolower');
		if($this->form_validation->run() == FALSE)
		{
			$this->db->close();	
			$this->session->set_flashdata( 'false', 'Fields Going Empty!');
			redirect('admin/key_update');
		}
		else
		{
			$data=array('keywords'=>$this->input->post('keyword'));
			$category = $this->input->post('category');
			$this->db->where('category', $category);
			if($this->db->update('idata', $data) == TRUE)
			{
				$this->db->close();
				$this->session->set_flashdata( 'true', 'Update Success' );
				redirect('admin/key_update');			
			}
			else
			{
				$this->db->close();
				$this->session->set_flashdata( 'false', 'Update Failed' );
				redirect('admin/key_update');			
			}
		}		
	}
	public function pre_store($rnd_id)
	{
		$data=array(
		'uname'=>trim($this->input->post('uname')),
		'umail'=>trim($this->input->post('reg_email')),
		'passwd'=>trim(md5($this->input->post('reg_dpass'))),
		'salt'=>$rnd_id);
		return $this->db->insert('eilogin',$data);
	}
	public function ulogin()
	{
		$this->form_validation->set_rules('login', 'User', 'trim|required');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data=array();
			$data['page_title'] = ucfirst('Global informations Admin Panel.');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/login');
			$this->load->view('admin/footer');
			//$this->session->set_flashdata( 'false', 'Required Fields Going Empty!');
			//redirect('admin/index');
		}
		else
		{
			$uname = trim(htmlspecialchars($this->input->post('login', TRUE)));
			$passwd = trim(md5($this->input->post('passwd', TRUE)));
			$this->db->limit(1);
			$query = $this->db->get_where('eilogin',array('passwd'=>$passwd, 'uname'=>$uname));
			if($query->num_rows() == 1)
			{
				$row = $query->row();
				$uid = $row->id;
				$name = $row->uname;
				$pass = $row->passwd;
				$ustatus = $row->status;
				$ulevel = $row->level;
				if($pass == $passwd && $name == $uname && $ustatus !=0 && $ulevel !=0)
				{
					$data = array('id' => $row->id,'uname' => $row->uname,'status' => $row->status,'level' => $row->level);
					$this->session->set_userdata($data);
					redirect('admin/entry_level');
				}
				else
				{
					$this->db->close();
					$this->session->set_flashdata( 'false', 'Invalid username or password' );
					redirect('admin/login');
				}				
			}
			else
			{	
				$this->db->close();
				$this->session->set_flashdata( 'false', 'You are not registered / activated' );
				redirect('admin/login');			
			}		
		}
	}
	public function do_uploads()
	{
		$config = array();
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '';
		$config['max_width'] = '';
		$config['max_height'] = '';
		$config['remove_space'] = TRUE;
		$config['encrypt_name'] = TRUE;
		$config['overwrite'] = FALSE;
		$config['xss_clean'] = TRUE;
		if(!is_dir($config['upload_path'])) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
		$this->load->library('upload');
		$this->upload->initialize($config);
		#Continue and resize the image
		if(!$this->upload->do_upload())	
		{
			$data['img'] = $this->upload->display_errors('<div class="false">', '</div>');
		}
	}	
	public function create()
	{
#Image upload
		$this->do_uploads();		
		$finfo = $this->upload->data();
		$fname = $finfo['file_name'];

#Resize Image
$config['image_library'] = 'GD2';
$config['source_image'] = './upload/'.$fname;
$config['maintain_ratio'] = TRUE;
$config['width']     = 200;
$config['height']   = 200;
$this->load->library('image_lib');
$this->image_lib->initialize($config); 
if(!$this->image_lib->resize())
{
echo($this->image_lib->display_errors());
}
$this->image_lib->clear();

		$data=array(
			'user'=>$this->input->post('user'),
			'logo'=>$fname,
			'category'=>$this->input->post('category'),
			'country'=>$this->input->post('country'),
			'lnk'=>$this->input->post('lnk'),
			'company'=>$this->input->post('company'),
			'services'=>$this->input->post('services'),
			'keywords'=>$this->input->post('keywords'),
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'email'=>$this->input->post('email'),
			'phone'=>$this->input->post('phone'),
			'weburl'=>$this->input->post('weburl'),
			'latitude'=>$this->input->post('latitude'),
			'longitude'=>$this->input->post('longitude'),
			'description'=>$this->input->post('description'),
			'fax'=>$this->input->post('fax')			
		);
#Form validation rules				
	$this->form_validation->set_rules('lnk', 'HyperTag', 'trim|required|strtolower');
	$this->form_validation->set_rules('category', 'Category', 'trim|required|strtolower');
    $this->form_validation->set_rules('company', 'Company', 'trim|required|strtolower');
    $this->form_validation->set_rules('services', 'Services', 'trim|required|strtolower');
    #$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required|strtolower|xss_clean');
    $this->form_validation->set_rules('country', 'Country', 'trim|required|strtolower');
    $this->form_validation->set_rules('address', 'Address', 'trim|required|strtolower');
    $this->form_validation->set_rules('email', 'Email', 'trim|strtolower|required|valid_emails|is_unique[idata.email]');
    $this->form_validation->set_rules('city', 'Division', 'trim|strtolower');
    $this->form_validation->set_rules('description', 'Description', 'trim|strtolower');
    $this->form_validation->set_rules('weburl', 'Weburl', 'trim|strtolower');
    $this->form_validation->set_rules('phone', 'Phone', 'trim|strtolower|is_unique[idata.phone]');
	$this->form_validation->set_rules('logo', 'Logo', 'trim|strtolower');	
		if($this->form_validation->run() == FALSE)
		{
			$this->db->close();	
			$this->session->set_flashdata( 'false', 'One/More Required Fields Missing');
			redirect('admin/entry_level');
			// $data=array();
			// $data['img'] = $this->upload->display_errors('<div class="false">', '</div>');
			// $data['insert_mode'] = true;
			// $data['update_mode'] = false;
			// $data['action'] = base_url('admin/insert_data');			
			// $data['page_title'] = ucfirst('Global informations Entry.');				
			// $this->load->view('admin/header',$data);
			// $this->load->view('admin/entry',$data);
			// $this->load->view('admin/footer');			
		}
		else
		{
			if($this->db->insert('idata', $data) == TRUE)
			{
				$this->db->close();
				$this->session->set_flashdata( 'true', 'Entry Success' );
				redirect('admin/entry_level');
			}
			else
			{				
				$this->db->close();
				$this->session->set_flashdata( 'false', 'Entry Failed' );
				redirect('admin/entry_level');
			}			
		}
	}
	public function retrieve_all()
	{
/*--# Pagination Configuration Start #--*/
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 1)
		{$config['base_url'] = base_url().'admin/update_view/';}
		else
		{$config['base_url'] = base_url().'welcome/admin_view/';}
		$config['total_rows'] = $this->db->count_all_results('idata');
		$config['per_page'] = 25;
		$config['uri_segment'] = 3;
		$config['num_links'] = 10;
		#$choice = $config['total_rows']/$config['per_page'];
		#$config['num_links'] = round($choice);
		$config['cur_tag_open'] = '<b class="cg"> [ ';
		$config['cur_tag_close'] = ' ] </b>';
		$config['use_page_numbers'] = FALSE;
		$config['full_tag_open'] = '<div class="paginbar">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = '&laquo;';
		$config['first_tag_open'] = '|';
		$config['first_tag_close'] = '';
		$config['last_link'] = '&raquo;';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '|';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$this->pagination->initialize($config);
/*--# Pagination Configuration Close #--*/
		$this->db->order_by("lnk", "asc");
		$query = $this->db->get('idata', $config['per_page'], $this->uri->segment(3));
		//if($query->num_rows > 0) 
		//{
            return $query->result();
        //}
	}
	public function retrieve_one()
	{
		$id = trim($this->input->post('id'));
		$query = $this->db->get_where('idata', array('id' => $id));			
            foreach($query->result() as $row)
            {
        	echo('<div class="rc9">
				<dl>            		            		            		  
					<dt><h3>'.$row->company.'</h3></dt>
					<dd><span class="update">Last Updated On: '.$row->datetime.'</span></dd><br/>
				</dl>
				<dl>
					<dt><span class="headtag">Product &amp; Services:</span></dt>
					<dd>'.$row->services.'</dd><br/>
				</dl>			
				<dl>
					<dt><span class="headtag">Contact:</span></dt>
					<dd><b>Address:</b> '.$row->address.'</dd>
					<dd><b>Country:</b> '.$row->country.'</dd>
					<dd><b>City:</b> '.$row->city.'</dd>
					<dd><b>Phone:</b> '.$row->phone.'</dd>
					<dd><b>Fax:</b> '.$row->fax.'</dd>
					<dd><b>Email:</b> '.$row->email.'</dd>
					<dd><b>Website:</b> '.$row->weburl.'</dd><br/>
					<dd class="social">
					<a href="'.$row->sc_fb.'"><span class="sc_fb"></span></a>
					<a href="'.$row->sc_tw.'"><span class="sc_tw"></span></a>
					<a href="'.$row->sc_gp.'"><span class="sc_gp"></span></a>
					<a href="'.$row->sc_ln.'"><span class="sc_ln"></span></a>
					<a href="'.$row->sc_yb.'"><span class="sc_yb"></span></a></dd>
				</dl>
				<dl>
					<dt>&nbsp;</dt>
					<dd class="newsfeed">'.$row->feed.'</dd>
					<dd>&nbsp;</dd>
				</dl>
				<dl>
					<dt><span class="headtag">Description:</span></dt>
					<dd>'.$row->description.'</dd>
				</dl></div>');
//DataUri				
$dataUri = 'data:image/'.pathinfo($row->logo, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents(base_url().'upload/'.$row->logo));
//DataUri
	#echo('<script>var map = new GMaps({el: "#gmap",lat: '.$row->latitude.',lng: '.$row->longitude.'});</script>
	echo('<script>var map = new GMaps({el: "#gmap",lat: 23.684994,lng: 90.356331});</script>	
<script>
GMaps.geocode({
  address: "'.$row->address.','.$row->city.'",
  callback: function(results, status) {
    if (status == "OK") {
      var latlng = results[0].geometry.location;
      map.setCenter(latlng.lat(), latlng.lng());
      map.addMarker({ lat: latlng.lat(),lng: latlng.lng() });
    }
  }
});
</script>'
);
echo('<div class="rc3">
		<dl>
			<dt class="logo"><img alt="Logo - '.$row->company.'" src="'.$dataUri.'"/></dt>
			<dd id="gmap"></dd>				
		</dl>
		<dl id="cmailbox" style="margin:0 auto;margin-top:4px;width:90%">
			<dt id="flip">Click to Email Us:</dt>
			<dd id="fpanel">
			<form id="omail" action="" method="post">
				<input id="to" type="hidden" name="to" value="'.$row->email.'">
				Company: <input style="width:99.8%;background-color:#f5f5f5;border:1px solid #777" type="text" id="cname" name="cname" value="">
				Email: <input style="width:99.8%;background-color:#f5f5f5;border:1px solid #777" type="text" id="sender" name="sender" value="">
				Message: <textarea style="width:99.8%;background-color:#f5f5f5;border:1px solid #777" id="cmsg" name="cmsg"></textarea>
				<input id="cpost" style="background-color:#777;color:#eee;padding:4px;border:1px solid #fff" type="submit" name="cpost" value="SEND">
			</form>
			</dd>
		</dl>				          	
	</div>');
echo('
<script>
$(document).ready(function(){
	$("#cpost").click(function(e){
		e.preventDefault();
		var base_url = "http://localhost/306/";
		var sender = $("#sender").val();	
		var to = $("#to").val();
		var cname = $("#cname").val();
		var cmsg = $("#cmsg").val();
		$("#fpanel").html("<img src=http://localhost/306/images/loading.gif><em class=false>Sending...</em>");
		if(sender != "" && cmsg != "" && cname != ""){
			var jqXHR = $.post(base_url+"welcome/cmail",{"cmail":sender,"to":to,"cname":cname,"cmsg":cmsg},function(){
			})
			.done(function(){
				$("#fpanel").html("<em class=true>Message Sent!</em>");
			})
			.fail(function(){
				$("#fpanel").html("<em class=false>Transmission Failed!</em>");
			});			
		}
		else
		{
			$("#fpanel").html("<em class=false>Required Fields Missing!</em>");
		}
	});
//Fliper
	$("#fpanel").hide();
	$("#flip").click(function(e){
	e.preventDefault();
	$("#fpanel").slideToggle(400);
	});	
//End	
});
</script>
');
        }
	}	
	public function request_one()
	{
		//$this->db->where('id', $this->uri->segment(3));
		$focus = $this->db->get_where('idata', array('id'=>$this->uri->segment(3)));
		return $focus->result();		
	}
	public function update()
	{
	# Image Upload		
		$this->do_uploads();	
		$finfo = $this->upload->data();
    	$fname = $finfo['file_name'];
#Resize Image
$config['image_library'] = 'GD2';
$config['source_image'] = './upload/'.$fname;
$config['maintain_ratio'] = TRUE;
$config['width']     = 200;
$config['height']   = 200;
$this->load->library('image_lib');
$this->image_lib->initialize($config);

if(!$this->image_lib->resize())
{
echo($this->image_lib->display_errors());
}
$this->image_lib->clear(); 
	# If new image not upload but only data
    	if(!$fname)
		{
			$data=array(
			'user'=>$this->input->post('user'),	
			'category'=>$this->input->post('category'),
			'company'=>$this->input->post('company'),
			'lnk'=>$this->input->post('lnk'),
			'services'=>$this->input->post('services'),
			'keywords'=>$this->input->post('keywords'),
			'city'=>$this->input->post('city'),
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'fax'=>$this->input->post('fax'),
			'weburl'=>$this->input->post('weburl'),
			'country'=>$this->input->post('country'),
			'address'=>$this->input->post('address'),
			'latitude'=>$this->input->post('latitude'),
			'longitude'=>$this->input->post('longitude'),
			'description'=>$this->input->post('description')
			#'logo'=>$fname
			);				
		}
		else
		{
# If new image upload with data then remove prev-image			
			$row = $this->db->where('id', $this->input->post('id'))->get('idata')->row();
			if(file_exists($images = realpath('upload/'.$row->logo)))
			{if(isset($images) && ($fname != $images)){@unlink($images);}}
			$data=array(
			'user'=>$this->input->post('user'),	
			'category'=>$this->input->post('category'),
			'company'=>$this->input->post('company'),
			'lnk'=>$this->input->post('lnk'),
			'services'=>$this->input->post('services'),
			'keywords'=>$this->input->post('keywords'),
			'city'=>$this->input->post('city'),
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'fax'=>$this->input->post('fax'),
			'weburl'=>$this->input->post('weburl'),
			'country'=>$this->input->post('country'),
			'address'=>$this->input->post('address'),
			'latitude'=>$this->input->post('latitude'),
			'longitude'=>$this->input->post('longitude'),
			'description'=>$this->input->post('description'),
			'logo'=>$fname
			);
		}
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('idata', $data);
		$this->db->close();
		redirect('admin/update_view');
	}	
	public function delete()
	{
		$id = trim($this->input->post('id'));
		$row = $this->db->where('id', $id)->get('idata')->row();
		$image = realpath('upload/'.$row->logo);
		if(file_exists($image)){ @unlink($image); }
		$this->db->where('id', $id);
		$this->db->delete('idata');
		$this->db->close();
        redirect($this->retrieve_all());
	}
	public function searchtxt($match)
	{
/*--# Pagination Configuration Start #--*/
		$config['base_url'] = base_url().'welcome/index/';
		$config['total_rows'] = $this->db->count_all_results('idata');
		$config['per_page'] = 96;
		$config['uri_segment'] = 3;
		$config['num_links'] = 10;
		#$choice = $config['total_rows']/$config['per_page'];
		#$config['num_links'] = round($choice);
		$config['cur_tag_open'] = '<b class="cg"> [ ';
		$config['cur_tag_close'] = ' ] </b>';
		$config['use_page_numbers'] = FALSE;
		$config['full_tag_open'] = '<div class="paginbar">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = '&laquo;';
		$config['first_tag_open'] = '|';
		$config['first_tag_close'] = '';
		$config['last_link'] = '&raquo;';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '|';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$this->pagination->initialize($config);
/*--# Pagination Configuration Close #--*/		
		$matchs = explode(" ", $match);
		foreach($matchs as $match)
		{
		$this->db->or_like('lnk',$match,'both');
  		$this->db->or_like('keywords', $match,'both');
  		$this->db->or_like('company', $match,'both');
 		$this->db->or_like('services', $match,'both');
 		$this->db->or_like('country', $match,'both');
 		$this->db->or_like('city', $match,'both');
 		$this->db->or_like('category', $match,'both');
		}
		$this->db->order_by("lnk", "ASC");
		$query = $this->db->get('idata', $config['per_page'], $this->uri->segment(3));
//$rowcount = $query->num_rows();
		return $query->result();
	}	
 
/* End of file crudmodel.php */
/* Location: ./application/models/crudmodel.php */
}
?>
