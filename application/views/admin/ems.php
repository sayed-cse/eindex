<style type="text/css">
.entry{background-color:#f9f9f9;border:1px solid #026180;}
input{display:block;margin:0;padding:0;}
input[type="text"]{background-color:#fefefe;}
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
<!--# sidebar #-->
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
	<p class="pad8">EMS</p>
<?php
if($this->session->flashdata('true'))
{
	echo('<p class="true tac fbold">'.$this->session->flashdata('true').'</p>');
}
elseif($this->session->flashdata('false'))
{
	echo('<p class="false tac fbold">'.$this->session->flashdata('false').'</p>');
}
#
$category = array(''=>'','Art and Culture' => 'Art and Culture','Education and Career' => 'Education and Career','Health and Medical'=>'Health and Medical','Travel and Tour'=>'Travel and Tour','News and Media'=>'News and Media','Real Estate'=>'Real Estate','Computer and Internet'=>'Computer and Internet','Food and Beverage'=>'Food and Beverage','Garments and Accessories'=>'Garments and Accessories','Business and Service'=>'Business and Service','Fashion'=>'Fashion','Jewelry'=>'Jewelry','Events and Exhibition'=>'Events and Exhibition','Bank'=>'Bank','Insurance'=>'Insurance','Embassy'=>'Embassy','Emergency'=>'Emergency');
echo(form_open_multipart('admin/ems'));
$data = array('name' => 'ems_message','rows' => '3','cols' => '33');
?>
<dl>
<dt></dt>
<dd class="title">Category</dd>
<dd class="chr">:</dd>
<dd class="input"><?php echo(form_dropdown('category', $category,'')); ?></dd>
</dl>
<dl>
<dt></dt>
<dd class="title">Subject</dd>
<dd class="chr">:</dd>
<dd class="input"><?php echo(form_input('ems_subject','','class="input"'));?></dd>
</dl>
<dl>
<dt></dt>
<dd class="title">From</dd>
<dd class="chr">:</dd>
<dd class="input"><?php echo(form_input('from','','class="input"'));?></dd>
</dl>
<dl>
<dt></dt>
<dd class="title">Message</dd>
<dd class="chr">:</dd>
<dd class="input"><?php echo(form_textarea($data));?></dd>
</dl>  
<?php echo(form_submit('','SEND MAIL'));?><br/>
<?php echo(form_close()); ?>
	</div>
	</article>
	<article class="rc2">
		<div>
<!-- sidebar -->
<ins class="adsbygoogle"style="display:inline-block;width:160px;height:600px"data-ad-client="ca-pub-7081992456266208"data-ad-slot="2312679572"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
		</div>
	</article>	
</section>
