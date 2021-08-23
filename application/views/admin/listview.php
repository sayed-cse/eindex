<section class="row">
	<article class="rc2">
		<div>
<!-- sidebar -->
<ins class="adsbygoogle"style="display:inline-block;width:160px;height:600px"data-ad-client="ca-pub-7081992456266208"data-ad-slot="2312679572"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
	</article>
<article class="rc8">
<div class="entry">
<!--# #-->	
<?php echo($this->pagination->create_links()); ?>	
	<?php foreach($view as $row): ?>
	<div class="trow">
		<span class="tcell tag namecell"><?php echo($row->lnk); ?></span>
		<span class="tcell tag"><?php echo(anchor("admin/update_level/$row->id",'EDIT','class="anchor"'));?></span>
	</div>
	<?php endforeach; ?>
<!--# #-->
</div>
</article>
	<article class="rc2">
		<div>
<!-- sidebar -->
<ins class="adsbygoogle"style="display:inline-block;width:160px;height:600px"data-ad-client="ca-pub-7081992456266208"data-ad-slot="2312679572"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
	</article>
</section>