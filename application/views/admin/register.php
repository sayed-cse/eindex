<section class="row">
	<article class="rc12">
<?php
if($this->session->flashdata('true'))
{
	echo('<p class="true tac fbold">'.$this->session->flashdata('true').'</p>');
}
elseif($this->session->flashdata('false'))
{
	echo('<p class="false tac fbold">'.$this->session->flashdata('false').'</p>');
}
?>		
	</article>
	<article id="login" class="rc12">
		<div class="rc4">
		<form action="<?php echo(base_url('admin/doreg')); ?>" method="post">
			<dl class="dl">
				<dt class="dt">Register</dt>
				<dd class="iname">Name</dd>
				<dd><?php echo(form_error('uname', '<div class="false">', '</div>')); ?><input type="text" name="uname"></dd>
				<dd class="iname">Email</dd>
				<dd><?php echo(form_error('reg_email', '<div class="false">', '</div>')); ?><input type="text" name="reg_email"></dd>
				<dd class="iname">Password</dd>
				<dd><?php echo(form_error('reg_dpass', '<div class="false">', '</div>')); ?><input type="password" name="reg_dpass"></dd>
				<dd class="iname">Confirm Password</dd>
				<dd><?php echo(form_error('reg_cpass', '<div class="false">', '</div>')); ?><input type="password" name="reg_cpass"></dd>
				<dd><input class="logged" type="submit" name="signup" value="Register"></dd>
			</dl>
		</form>
		</div>
	</srticle>
</section>