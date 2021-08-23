<style type="text/css">
.entry{background-color:#f9f9f9;border:1px solid #026180;}
input{display:block;margin:0;padding:0;}
input[type="text"]{background-color:#fefefe;}
textarea{resize:none;max-width:80%;}
dl,dt,dd{margin:0;padding:0;}
dl{border:0px solid #f9f9f9;}
dt,dd{display:inline-block;}
.chr{width:2%;color:#f00;}
.title{width:20%;font-size:small;}
.input{width:70%;max-width:70%;}
.mid{margin:0 auto;text-align:center}
input[disabled]{background-color:#eee;}
</style>
<section class="row">
<article class="rc12">
<div class="mid">
<!-- sidebar -->
<ins class="adsbygoogle"style="display:inline-block;width:728px;height:90px"data-ad-client="ca-pub-7081992456266208"data-ad-slot="2312679572"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
</article>
</section>
<section class="row">
	<article class="rc2">
		<div>
<!-- sidebar -->
<ins class="adsbygoogle"style="display:inline-block;width:160px;height:600px"data-ad-client="ca-pub-7081992456266208"data-ad-slot="2312679572"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>			
		</div>
	</article>
	<article class="rc8">
	<div class="entry">
<?php
if($update_mode == true && $insert_mode == false)
{
	foreach($focus as $row): 
	$id = $this->uri->segment(3);
	$lnk = $row->lnk;
	$company = $row->company;
	$category = array($row->category => $row->category);
	$country = array($row->country => $row->country);
	$city = array($row->city => $row->city);
	$latitude = $row->latitude;
	$longitude = $row->longitude;
	$services = $row->services;
	$keyword = $row->keywords;
	$phone = $row->phone;
	$email = $row->email;
	$weburl = $row->weburl;
	$fax = $row->fax;
	$description = $row->description;
	$address = $row->address;
	$logo = realpath('upload/'.$row->logo);		
	endforeach; 
	$user = $this->session->userdata('uname');
}
elseif($insert_mode == true && $update_mode == false) 
{	
	$id = '';
	$city = array('Dhaka'=>'Dhaka','Khulna'=>'Khulna','Chittagong'=>'Chittagong','Sylhet'=>'Sylhet','Barisal'=>'Barisal','Rajshahi'=>'Rajshahi','Rangpur'=>'Rangpur');
	$category = array('Art and Culture' => 'Art and Culture','Education and Career' => 'Education and Career','Health and Medical'=>'Health and Medical','Travel and Tour'=>'Travel and Tour','News and Media'=>'News and Media','Real Estate'=>'Real Estate','Computer and Internet'=>'Computer and Internet','Food and Beverage'=>'Food and Beverage','Garments and Accessories'=>'Garments and Accessories','Business and Service'=>'Business and Service','Fashion'=>'Fashion','Jewelry'=>'Jewelry','Events and Exhibition'=>'Events and Exhibition','Bank'=>'Bank','Insurance'=>'Insurance','Embassy'=>'Embassy','Emergency'=>'Emergency');
	$country = array('Bangladesh'=>'Bangladesh');	
	$lnk = '';
	$company = '';
	$latitude = '23.684994';
	$longitude = '90.356331';
	$services = '';
	$keyword = '';	
	$phone = '';
	$email = '';
	$weburl = '';
	$fax = '';
	$description = '';
	$address = '';
	$logo = '';
	$user = $this->session->userdata('uname');
} 
#echo('<div class="false">'.validation_errors().'</div>');
if($insert_mode){echo('<p class="pad8">Entry Mode Activated</p>');}elseif($update_mode){echo('<p class="pad8">Advanced Mode Activated</p>');} 
#
if($this->session->flashdata('true'))
{
	echo('<p class="true tac fbold">'.$this->session->flashdata('true').'</p>');
}
elseif($this->session->flashdata('false'))
{
	echo('<p class="false tac fbold">'.$this->session->flashdata('false').'</p>');
}
?>
<?php 
$data = array('name' => 'description','rows' => '3','cols' => '39');
echo(form_open_multipart($action));
echo('
<dl>
	<dt></dt>
	<dd>'.form_hidden('id', $id).'</dd>
	<dd>'.form_hidden('user', $user).'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Category</dd>
	<dd class="chr">:</dd>
	<dd>'.form_dropdown('category', $category,'').'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Country</dd>
	<dd class="chr">:</dd>
	<dd>'.form_dropdown('country', $country, '').'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Division</dd>
	<dd class="chr">:</dd>
	<dd>'.form_dropdown('city',$city, '').'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">HyperTag</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('lnk', $lnk).'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Company Name</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('company', $company).'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Services</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('services', $services).'</dd>
</dl>
<dl>
	<dt class="chr"></dt>
	<dd class="title">Keywords</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('keywords', $keyword,'disabled').'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Address</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('address', $address).'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Phone</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('phone', $phone).'</dd>
</dl>
<dl>
	<dt class="chr"></dt>
	<dd class="title">Fax</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('fax', $fax).'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Email</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('email', $email).'</dd>
</dl>
<dl>
	<dt class="chr"></dt>
	<dd class="title">Website</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('weburl', $weburl).'</dd>
</dl>
<dl>
	<dt class="chr"></dt>
	<dd class="title">Description</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_textarea($data, $description).'</dd>
</dl>
<dl>
	<dt class="chr"></dt>
	<dd class="title">Latitude</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('latitude', $latitude).'</dd>
</dl>
<dl>
	<dt class="chr"></dt>
	<dd class="title">Longitude</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_input('longitude', $longitude).'</dd>
</dl>
<dl>
	<dt class="chr">*</dt>
	<dd class="title">Logo</dd>
	<dd class="chr">:</dd>
	<dd class="input">'.form_upload('userfile', $logo).'</dd>
</dl>');
?>
<?php if(isset($img)){echo('<dl><dd>'.$img.'</dd></dl>');} ?>
<?php echo('
<dl>
	<dt>&nbsp;&nbsp;</dt>
	<dd>'.form_submit('','ENTER').'</dd>
</dl>
	');
echo(form_close()); ?>
	</div>
	</article>
	<article class="rc2">
		<div>
<!-- sidebar -->
<ins class="adsbygoogle"style="display:inline-block;width:160px;height:600px"data-ad-client="ca-pub-7081992456266208"data-ad-slot="2312679572"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
		</div>
	</article>	
</section>


