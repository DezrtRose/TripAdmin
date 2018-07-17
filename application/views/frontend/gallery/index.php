<?php
if ( ! isset( $top_detail_data ) ) {
	if(segment(2) == '') {
		$crumbs = [
			'Home'    => base_url(),
			'Gallery' => ''
		];
    } else {
		$crumbs = [
			'Home'    => base_url(),
			'Gallery' => base_url('gallery'),
            $trip_images[0]['name'] => ''
		];
    }
	echo '<div class="height"></div>';
	$this->load->view( 'frontend/include/breadcrumbs', array( 'crumbs' => $crumbs ) );
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<?= $this->load->view($sub_content); ?>
        </div>
    </div>
</div>