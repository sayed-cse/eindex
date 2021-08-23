<?php echo(doctype('html5')); ?>
<html lang="en-US">
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="google-site-verification" content="4-1nu_Kwb_m3NB6UWrzxWMeQWbJzQm0bUdCvDT_vA7o"/>
<meta name="description" content="<?php echo($dynadesc); ?>"/>
<meta name="keywords" content="<?php echo($dynakey); ?>"/>
<meta name="distribution" content="global"/>
<meta name="generator" content="gedit 2.30.0 (ubuntu/linux)"/>
<meta name="rating" content="General"/>
<meta name="copyright" content="<?php echo(date('Y')); ?>"/>
<meta http-equiv="pragma" content="no-cache"/>
<meta name="robots" content="index, follow"/>
<meta name="googlebot" content="index, follow"/>
<title><?php echo($page_title); ?></title>
<?php echo(link_tag('images/favicon.gif','shortcut icon', 'image/gif')); ?>
<?php $css_url = 'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css';
// if(is_readable($css_url) == true) {
// 	echo(link_tag('http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css','stylesheet','text/css','style (all)','all'));
// 	echo(link_tag('css/styleb.css?v=a2','stylesheet','text/css','style (all)','all'));
// }
// else{echo(link_tag('css/style.css?v=a2','stylesheet','text/css','style (all)','all'));}
if(@fopen($css_url, "r") == TRUE){echo(link_tag('http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css','stylesheet','text/css','style (all)','all'));echo(link_tag('css/styleb.css?v=a2','stylesheet','text/css','style (all)','all'));}else{echo(link_tag('css/style.css?v=a2','stylesheet','text/css','style (all)','all'));}?>
</head>
<body><main class="main">
<header class="row">
	<article class="rc3">
		<div><a href="<?php echo(site_url()); ?>"><b class="tshadow">eindex</b></a></div>
	</article>
	<article class="rc9">
		<div>
<!--# sidebar #-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- sidebar -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7081992456266208"
     data-ad-slot="2312679572"></ins>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
	</article>
</header>
<section class="row">
	<article class="rc12">
		<div id="search"><?php echo(form_open('welcome/index')); echo(form_input('key','','')); echo(form_submit('txtsearch','Search','class="sbutton"')); echo(form_close()); ?></div>
		<div id="mini">If data not loaded perfectly please reload page until you can view properly...! &nbsp; <a href="javascript:void(0);" id="close">X</a></div>
	</article>
</section>
