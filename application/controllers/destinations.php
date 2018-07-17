<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

class Destinations extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	function index() {
		$slug = segment( 2 );
		if($slug != '') {
			if ( isset( $_GET['dest'] ) && $_GET['dest'] != '' ) {
				$slug = $_GET['dest'];
			}
			$desti = $this->common_model->get_where( 'tbl_destinations', array( 'slug' => $slug ) );

			$data['destination_data'] = $desti[0];
			$data['metatitle']        = $desti[0]['seo_title'] != '' ? $desti[0]['seo_title'] : $desti[0]['destination'];
			$data['metadescription']  = $desti[0]['seo_description'];
			$data['metakeyword']      = $desti[0]['seo_keyword'];
			$data['og_image']         = $desti[0]['seo_image'] != '' ? base_url( 'images/destination/' . $desti[0]['seo_image'] ) : '';
			$data['canonical_url']    = $desti[0]['canonical_url'];

			$admin = $this->common_model->get_where( 'tbl_trips', array( 'dest_id' => $desti[0]['id'] ), 'id DESC' );
			if ( segment( 3 ) != '' || isset( $_GET['act'] ) ) {
				if ( isset( $_GET['act'] ) && $_GET['act'] != '' ) {
					$act = $this->common_model->get_where( 'tbl_activities', array( 'slug' => $_GET['act'] ) );;
				} else {
					$act = $this->common_model->get_where( 'tbl_activities', array( 'slug' => segment( 3 ) ) );
				}
				$act    = $this->common_model->get_where( 'tbl_trip_activity', array( 'act_id' => $act[0]['id'] ), 'id DESC' );
				$acts[] = - 1;
				if ( $act ) {
					foreach ( $act as $a ) {
						$acts[] = $a['trip_id'];
					}
				}
				$admin = $this->common_model->get_where_in( 'tbl_trips', 'id', $acts );
			}

			$this->load->library( 'pagination' );

			$config['base_url']    = base_url( 'destinations/' . $slug );
			$config['total_rows']  = count( $admin );
			$config['uri_segment'] = '3';
			$config['num_links']   = '5';
			$config['per_page']    = 9999;

			$this->pagination->initialize( $config );

			$data['trip'] = $this->common_model->get_pagination( 'tbl_trips', segment( 3 ), $config['per_page'], 'id DESC', array(
				'dest_id' => $desti[0]['id'],
				'status'  => 1
			) );
			if ( segment( 3 ) != '' || ( isset( $_GET['act'] ) && $_GET['act'] != '' ) ) {
				$data['trip'] = $this->common_model->get_pagination( 'tbl_trips', segment( 3 ), $config['per_page'], 'id DESC', array( 'dest_id' => $desti[0]['id'] ), true, 'id', $acts );
			}
			$data['pagination']   = $this->pagination->create_links();
			$data['sub_content']  = 'frontend/trips/_list';
			$data['main_content'] = 'frontend/trips/index';
		} else {
			$data['destinations'] = $this->common_model->get_all('tbl_destinations', '', 'id asc');
			$data['main_content'] = 'frontend/trips/index';
			$data['sub_content']  = 'frontend/trips/_destination_list';
		}
		$this->load->view( FRONTEND, $data );
	}
}