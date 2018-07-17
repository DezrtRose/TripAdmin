<div class="height"></div>
<?php
$crumbs = [
	'Home' => base_url(),
	'Activities' => ''
];
$this->load->view('frontend/include/breadcrumbs', array('crumbs' => $crumbs));
?>
<h1 class="text-center">
	<strong>Our Activities</strong>
</h1>
<div class="container">
	<div class="row">
		<?php foreach($activities as $activity) { ?>
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="package-wrap">
					<div class="package-thumb">
						<a href="<?= base_url('activities/' . $activity['slug']) ?>" class="bdex-btn">View</a>
						<a href="<?= base_url('activities/' . $activity['slug']) ?>">
							<?php
							$img = $activity['banner_image'] != '' ? $activity['banner_image'] : '';
							$alt_tag = $activity['alt'] != '' ? $activity['alt'] : $activity['activity'];
							php_thumb_image('./images/activity/', $img, 335, 250, true, '', "alt='".$alt_tag."' title='" . $activity['activity'] . "'" )
							?>
						</a>
					</div>
					<div class="package-detail">
						<div class="content"><a href="<?= base_url('activities/' . $activity['slug']) ?>"><?php echo $activity['activity'] ?></a>
							<p>
								<?php echo substr(strip_tags($activity['description']), 0, 120) ?>....
							</p>
							<p>
								<a href="<?= base_url('activities/' . $activity['slug']) ?>" class="btn-transparent">View <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>