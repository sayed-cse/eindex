<section class="row">
	<article class="rc2">
		<div class="ads1" style="background:transparent"><img alt="Borno Prokash Publisher" title="publisher" src="<?php echo(site_url('images/Borno.png')); ?>" style="width:90%;height:90%"/></div>
		<div class="ads1">&nbsp;</div>
		<div class="ads1">&nbsp;</div>
		<div class="ads1">&nbsp;</div>
		<div class="ads1">&nbsp;</div>
	</article>
	<article class="rc8">
	<?php echo($this->pagination->create_links()); ?>
	<div class="display">
	<?php if($view == true){ ?>
		<?php foreach($view as $row): ?>
			<a title="<?php echo($row->lnk); ?>" id="<?php echo($row->id); ?>" href="javascript:void(0);" class="anchor"><div class="rc35 tag"><?php echo($row->lnk); ?></div></a>
		<?php endforeach; ?>
	<?php } else {echo('<em class="false">No Data Found</em>'); }?>
		<div id="lights" class="rc10">
			<div id="data"></div>
			<a class="exit" href="javascript:void(0);"><div class="x"></div></a>
		</div>		
	</div>
	<?php echo($this->pagination->create_links()); ?>
	</article>
	<article class="rc2">
		<div class="ads1" style="background:transparent"><a href='https://secure.payza.com/?VFM5M9S45vrVk4zMj0oNNgrGzw1E%2fVOQDNNIz%2f3vJpc%3d'><img src='https://secure.payza.com/images/banners/en/payza-online-payments.png' border='0'></a></div>
		<div class="ads1">&nbsp;</div>
		<div class="ads1">&nbsp;</div>
		<div class="ads1">&nbsp;</div>
		<div class="ads1">&nbsp;</div>
	</article>	
<!--# social #-->	
	<div class="scico">
		<div class="soc" style="background-color:#444"><span>&nbsp;</span></div>
		<div class="soc" style="background-color:#666"><span>&nbsp;</span></div>
		<div class="soc" style="background-color:#444"><span>&nbsp;</span></div>
		<div class="soc" style="background-color:#666"><span>&nbsp;</span></div>
		<div class="soc" style="background-color:#444"><span>&nbsp;</span></div>
	</div>
</section>
