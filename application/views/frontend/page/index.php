<?php if(isset($page[0]['banner_image']) && $page[0]['banner_image'] != '') { ?>
    <div class="top-detail-banner">
        <?php
        $alt_tag = $page[0]['banner_image_alt'] != '' ? $page[0]['banner_image_alt'] : $page[0]['name'];
        php_thumb_image( './images/page/', $page[0]['banner_image'], 1920, 720, true, '', "alt='".$alt_tag."' title='" . $page[0]['name'] . "'" )
        ?>
        <h1><?= $page[0]['name'] ?></h1>
    </div>
<?php } ?>
<?php
if(isset($page[0])) {
	$crumbs = [
		'Home' => base_url(),
		$page[0]['name'] => ''
	];
	echo (isset($page[0]['banner_image']) && $page[0]['banner_image'] != '') ? '' : '<div class="height"></div>';
	$this->load->view('frontend/include/breadcrumbs', array('crumbs' => $crumbs));
} else {
	$crumbs = [
		'Home' => base_url(),
		ucwords(str_replace('-', ' ', segment(1))) => ''
	];
	echo '<div class="height"></div>';
	$this->load->view('frontend/include/breadcrumbs', array('crumbs' => $crumbs));
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 border">
            <?php $this->load->view($sub_content) ?>
        </div>
        <!-- End col-md-9 -->
    </div><!-- End row -->
</div>