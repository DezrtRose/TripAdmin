<h1 class="text-center"><strong>GALLERY</strong></h1>
<hr class="hr-underline">
<ul class="gallery">
	<?php foreach($gallery_data as $image) { ?>
		<li>
			<a href="<?= base_url('gallery/' . $image['trip_slug']) ?>">
				<div class="gallery-wrap">
					<img alt="<?= $image['alt_tag'] ?>" title="<?= $image['trip_name'] ?>" src="<?= php_thumb_image('./images/trip/', $image['image'], 350, 250, true, '', '', true) ?>"/>
					<div class="overlay"></div>
					<div class="title"><?= $image['trip_name'] ?></div>
				</div>
			</a>
		</li>
	<?php } ?>
</ul>