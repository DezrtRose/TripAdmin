<h1 class="text-center"><strong><?= $trip_images[0]['name'] ?></strong></h1>
<hr class="hr-underline">
<ul class="gallery">
	<?php foreach($trip_images as $image) {
		$alt_tag = $image['alt'] != '' ? $image['alt'] : $image['name'] ?>
		<li>
			<a class="fancybox" rel="images-gallery" href="<?= base_url('images/trip/' . $image['image']) ?>">
				<div class="gallery-wrap">
					<img alt="<?= $alt_tag ?>" title="<?= $image['name'] ?>" src="<?= php_thumb_image('./images/trip/', $image['image'], 350, 250, true, '', '', true) ?>"/>
					<div class="overlay"></div>
				</div>
			</a>
		</li>
	<?php } ?>
</ul>
<script>
	$('.gallery .fancybox').fancybox();
</script>