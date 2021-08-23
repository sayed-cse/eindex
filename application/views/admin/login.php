<section class="row">
<article class="rc12"><?php
if($this->session->flashdata('true'))
{
	echo('<p class="true tac fbold">'.$this->session->flashdata('true').'</p>');
}
elseif($this->session->flashdata('false'))
{
	echo('<p class="false tac fbold">'.$this->session->flashdata('false').'</p>');
}
?></article>
	<article id="login" class="rc12">
		<div class="rc4">
		<form action="<?php echo(base_url('admin/login')); ?>" method="post">
			<dl class="dl">
				<dt class="dt">Login</dt>
				<dd><?php if(isset($msg)){echo('<div class="false"> '.$msg.'</div>');} ?></dd>
				<dd class="iname">User</dd>
				<dd><?php echo(form_error('login', '<div class="false">', '</div>')); ?><input type="text" name="login"></dd>
				<dd class="iname">Password</dd>
				<dd><?php echo(form_error('passwd', '<div class="false">', '</div>')); ?><input type="password" name="passwd"></dd>
				<dd><input class="logged" type="submit" name="send" value="Login"></dd>
			</dl>
			</form>
		</div>
	</article>
	<article class="rc12">
		<div>&nbsp;</div>
	</article>	
</section>
