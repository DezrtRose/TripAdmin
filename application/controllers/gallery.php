<?php if ( ! defined( 'BASEPATH' ) ) { exit( 'No direct script access allowed' ); }

class Gallery extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index($slug = '')
	{
		$data['main_content'] = 'frontend/gallery/index';
		if($slug == '') {
			$trips = $this->common_model->get_where('tbl_trips', array('status' => 1));
			foreach($trips as $trip) {
				$query = 'SELECT * FROM tbl_trip_slider WHERE `trip_id` = '.$trip['id'].' AND (`primary` = 1 OR 1) LIMIT 1';
				$trip_image = $this->common_model->run_query($query);
				$data['gallery_data'][] = array(
					'trip_name' => $trip['name'],
					'trip_slug' => $trip['slug'],
					'alt_tag' => $trip_image[0]['alt'] != '' ? $trip_image[0]['alt'] : $trip['name'],
					'image' => $trip_image[0]['image'],
					'primary' => $trip_image[0]['primary']
				);
			}
			$data['sub_content'] = 'frontend/gallery/_list';
		} else {
			$query = "SELECT ts.*, t.name, t.slug FROM tbl_trips t join tbl_trip_slider ts on ts.trip_id = t.id WHERE t.slug = '$slug' AND t.status = 1";
			$data['trip_images'] = $this->common_model->run_query($query);
			$data['sub_content'] = 'frontend/gallery/_detail';
		}
		$this->load->view(FRONTEND, $data);
	}

}