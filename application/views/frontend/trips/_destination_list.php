<div class="height"></div>
<?php
$crumbs = [
	'Home' => base_url(),
	'Destinations' => ''
];
$this->load->view('frontend/include/breadcrumbs', array('crumbs' => $crumbs));
?>
<h1 class="text-center">
	<strong>Our Destinations</strong>
</h1>
<div class="container">
	<div class="row">
		<?php foreach($destinations as $destination) { ?>
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="package-wrap">
					<div class="package-thumb">
						<a href="<?= base_url('destinations/' . $destination['slug']) ?>" class="bdex-btn">View</a>
						<a href="<?= base_url('destinations/' . $destination['slug']) ?>">
							<?php
							$img = $destination['banner_image'] != '' ? $destination['banner_image'] : '';
							$alt_tag = $destination['alt'] != '' ? $destination['alt'] : $destination['destination'];
							php_thumb_image('./images/destination/', $img, 335, 250, true, '', "alt='".$alt_tag."' title='" . $destination['destination'] . "'" )
							?>
						</a>
					</div>
					<div class="package-detail">
						<div class="content"><a href="<?= base_url('destinations/' . $destination['slug']) ?>"><?php echo $destination['destination'] ?></a>
							<p>
								<?php echo substr(strip_tags($destination['description']), 0, 120) ?>....
							</p>
							<p>
								<a href="<?= base_url('destinations/' . $destination['slug']) ?>" class="btn-transparent">View <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>