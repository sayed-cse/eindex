<?php echo(doctype('html5')); ?>
<html lang="en-US">
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="google-site-verification" content="rPy0ANTu27iSCeD7lycHvzUkEGgI9fASsyb2R8pDdOc" />
<meta name="distribution" content="global"/>
<meta name="generator" content="gedit 2.30.0 (ubuntu/linux)"/>
<meta name="rating" content="General"/>
<meta name="copyright" content="<?php echo(date('Y')); ?>"/>
<meta http-equiv="pragma" content="no-cache"/>
<meta name="robots" content="noindex, nofollow"/>
<meta name="googlebot" content="noindex, nofollow"/>
<title><?php echo($page_title); ?></title>
<?php echo(link_tag('images/favicon.gif','shortcut icon', 'image/gif')); ?>
<style type="text/css">
.true,.false{padding:8px;}
.true{color:#057C03}.false{color:#f00}
#login{}
#login > .rc4{float:none;margin:0 auto;}
#login .dl{margin:0 auto;border:1px solid #666;}
#login .dt{background-color:#666;padding:4px;color:#eee;font-weight:bold}
textarea{border:1px solid #eee;resize:none;}
#login input[type="text"],#login input[type="password"]{display:block;background-color:#eee;color:#111;border:1px solid #ccc;padding:0;height:24px}
#login input[type="text"],#login input[type="password"]{width:100%;}
#login .iname{font-size:small;}
.logged{background-color:#666;font-weight:bold;color:#eee;padding:4px;border:1px solid #eee;}
.bar{height:30px;background-color:#333;color:#eee;margin:0;padding:0;font-size:small;}
#bar_l{float:left;background-color:#666;}
#bar_r{float:right}
#bar_r li:last-child,#bar_l li:last-child{border-right:0px}
#bar_r li{position:relative;float:left;display:inline;display:inline-block !important;border-right:1px solid #444;padding:7px}
#bar_l li{display:inline-block;float:left;padding:7px}
#bar_l li a,#bar_l li:hover,#bar_l li a:hover{background-color:#79911E;color:#fff;}
#bar_r li:hover{background-color:#444;color:#fff}
#bar_r li ul{position:absolute;text-align:left;visibility:hidden;min-width:140px;max-width:180px;left:auto;right:0;height:auto;display:none;}
#bar_r li li{display:block;background-color:#444;margin:0px;padding:4px;z-index:9999;position:relative;width:100%;float:right;}
#bar_r li:hover > ul{display:block;visibility:visible;}
#bar_r li li a{display:block;color:#eee;}
#bar_r li li:hover,#bar_r li li a:hover{background-color:#666;}
#bar_r .menu{vertical-align:middle;padding:1px}
.pad8{padding:8px;background-color:#666;color:#fff;font-size:small;}
</style>
<?php echo(link_tag('css/style.css','stylesheet', 'text/css')); ?>
</head>
<body><main class="main">
<section class="row">
	<article class="rc12">
			 <?php if($this->session->userdata('level') !=0){ echo('<div class="bar">'); ?>
		<ul id="bar_l">
			<li>
				<?php 
				$this->db->where('user',$this->session->userdata('uname')); 
			 	$query = $this->db->count_all_results('idata');
				echo('Entry : '.$query.' / '.$this->db->count_all_results('idata'));
				?>
			</li>
		</ul>	
		<ul id="bar_r">
			<li><?php echo($this->session->userdata('uname')); ?></li>
			<li style="padding:7px 7px 3px 7px"><img src="data:image/png;base64,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">
			<?php if($this->session->userdata('level') == 1) { ?>
				<ul>
					<li><?php echo(anchor(base_url('admin/entry_level'),'Entry')); ?></li>
					<li><?php echo(anchor(base_url('admin/update_view'),'Update')); ?></li>
					<li><?php echo(anchor(base_url('admin/register'),'Register')); ?></li>
					<li><?php echo(anchor(base_url('admin/ems_view'),'EMS')); ?></li>
					<li><?php echo(anchor(base_url('admin/key_update'),'Keyword')); ?></li>
					<li><?php echo(anchor('admin/logout', 'Logout')); ?></li>
				</ul>
				<?php } elseif($this->session->userdata('level') == 2) { ?>
				<ul>
					<li><?php echo(anchor(base_url('admin/entry_level'),'Entry')); ?></li>
					<li><?php echo(anchor(base_url('admin/update_view'),'Update')); ?></li>
					<li><?php echo(anchor(base_url('admin/register'),'Register')); ?></li>
					<li><?php echo(anchor('admin/logout', 'Logout')); ?></li>
				</ul>
				<?php } elseif($this->session->userdata('level') == 3) { ?>
				<ul>
					<!-- <li><?php #echo(anchor(base_url('admin/entry_level'),'Entry')); ?></li> //-->
					<li><?php echo(anchor('admin/logout', 'Logout')); ?></li>
				</ul>
			<?php } ?>			
			</li>
		</ul>
		<?php echo('</div>'); } ?>  
	</article>
</section><script src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" defer></script>
