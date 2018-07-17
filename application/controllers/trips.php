<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

class Trips extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	function index() {
		$data['main_content']    = 'frontend/trips/index';
		if(!$this->common_model->get_where('tbl_activities', array('slug' => segment(1)))) {
			$data['sub_content'] = 'frontend/404';
		} else {
			$slug                    = segment( 2 );
			$data['trip']            = $this->common_model->get_where( 'tbl_trips', array( 'slug' => $slug ) );
			$data['metatitle']       = $data['trip'] ? $data['trip'][0]['seo_meta_title'] : SITE_NAME;
			$data['metakeyword']     = $data['trip'] ? $data['trip'][0]['seo_meta_keywords'] : SITE_NAME;
			$data['metadescription'] = $data['trip'] ? $data['trip'][0]['seo_meta_description'] : SITE_NAME;
			$data['canonical_url']   = $data['trip'][0]['canonical_url'];
			if ( $slug != '' && ! is_numeric( $slug ) ) {
				if ( $data['trip'] ) {
					$data['sub_content'] = 'frontend/trips/_detail';
				} else {
					$data['sub_content'] = 'frontend/404';
				}
			} else {
				$data['trip'] = $this->common_model->get_where( 'tbl_trips', array( 'status' => 1 ) );

				$data['sub_content'] = 'frontend/trips/_list';
			}
		}
		$this->load->view( FRONTEND, $data );
	}

	function search() {
		if ( ! empty( $_GET ) ) {
			if ( isset( $_GET['query'] ) ) {
				$query = $_GET['query'];
				$trips = $this->common_model->run_query( "SELECT * FROM (`tbl_trips`) WHERE `name` LIKE '%{$query}%' AND `status` = 1 ORDER BY `id` DESC" );
			} else {
				$destination = $_GET['dest'];
				$activity    = $_GET['act'];
				$price       = $_GET['price'];
				$duration    = $_GET['duration'];

				$sql = "SELECT T.* FROM `tbl_trips` T
                        LEFT JOIN `tbl_destinations` D ON T.`dest_id` = D.`id`
                        LEFT JOIN `tbl_trip_activity` TA ON T.`id` = TA.`trip_id`
                        LEFT JOIN `tbl_activities` A ON TA.`act_id` = A.`id`";

				if ( $destination != '' ) {
					$array = array_map( 'intval', explode( ',', $destination ) );
					$array = implode( "','", $array );
					$sql   .= " WHERE D.`id` IN ('{$array}')";
				}
				if ( $activity != '' ) {
					$array = array_map( 'intval', explode( ',', $activity ) );
					$array = implode( "','", $array );
					$sql   .= " AND A.`id` IN ('{$array}')";
				}
				if ( $price != '' ) {
					$price = explode( '.', $price );
					$min   = $price[0];
					$max   = is_numeric( $price[1] ) ? $price[1] : 99999;
					$sql   .= " AND (T.`cost` >= {$min} AND T.`cost` <= {$max})";
				}
				if ( $duration != '' ) {
					$duration = explode( '.', $duration );
					$min      = $duration[0];
					$max      = is_numeric( $duration[1] ) ? $duration[1] : 99999;
					$sql      .= " AND (T.`duration` >= {$min} AND T.`duration` <= {$max})";
				}
				$sql .= " AND `status` = 1 GROUP BY T.id ORDER BY T.`id` DESC";

				$trips = $this->common_model->run_query( $sql );
			}
		}
		$data['main_content'] = 'frontend/trips/index';
		$data['trip']         = $trips;
		$data['sub_content']  = 'frontend/trips/_list';
		$this->load->view( FRONTEND, $data );
	}

	function booking() {
		if ( $_POST ) {
			$config = array(
				array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'required'
				),
				array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'required'
				),
				array(
					'field' => 'phone',
					'label' => 'Phone',
					'rules' => 'required'
				),
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email'
				),
				array(
					'field' => 'age',
					'label' => 'Age',
					'rules' => 'required'
				),
				array(
					'field' => 'country',
					'label' => 'Country',
					'rules' => 'required'
				),
				array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'required'
				),
				array(
					'field' => 'passport',
					'label' => 'Passport',
					'rules' => 'required'
				),
				array(
					'field' => 'issue_date',
					'label' => 'Issued Date',
					'rules' => 'required'
				),
				array(
					'field' => 'exp_date',
					'label' => 'Expiry Date',
					'rules' => 'required'
				),
				array(
					'field' => 'date',
					'label' => 'Preferred Date',
					'rules' => 'required'
				),
				array(
					'field' => 'pax',
					'label' => 'Number of People',
					'rules' => 'required'
				),
			);
			$post  = $_POST;
			$this->form_validation->set_rules($config);
			$recaptcha_verification = verify_captcha($post['g-recaptcha-response']);
			if($this->form_validation->run() == FALSE || !$recaptcha_verification['success']) {
				if(!$recaptcha_verification['success']) set_flash('msg', 'Captcha error. Please try again.');
				$data['main_content'] = 'frontend/trips/index';
				$data['sub_content']  = 'frontend/trips/_booking_form';
				$data['trip_detail']  = $this->common_model->get_where( 'tbl_trips', array( 'slug' => segment( 3 ) ) );
				$this->load->view( 'frontend/include/template', $data );
			} else {
				$admin = $this->load->view( 'email/booking_email_admin', $post, true );
				$cust  = $this->load->view( 'email/booking_email_cust', $post, true );
				$param = array(
					'from'       => array( $post['email'] => $post['first_name'] ),
					'subject'    => 'Booking Received',
					'reply'      => array( $post['email'] => $post['first_name'] ),
					'recipients' => array( SITE_EMAIL ),
					'msg'        => $admin
				);
				if(swiftsend( $param )) {
					$param = array(
						'from'       => array( SITE_REPLY_TO_EMAIL => SITE_NAME ),
						'subject'    => 'Booking Received',
						'reply'      => array( SITE_REPLY_TO_EMAIL => SITE_NAME ),
						'recipients' => array( $post['email'] ),
						'msg'        => $cust
					);
					swiftsend( $param );
				}
				redirect( 'thank-you' );
			}
		}
		$data['main_content'] = 'frontend/trips/index';
		$data['sub_content']  = 'frontend/trips/_booking_form';
		$data['trip_detail']  = $this->common_model->get_where( 'tbl_trips', array( 'slug' => segment( 3 ) ) );
		$this->load->view( 'frontend/include/template', $data );
	}

	function print_trip() {
		$slug         = segment( 2 );
		$main_content = 'frontend/trips/_print';
		$data['trip'] = $this->common_model->get_where( 'tbl_trips', array( 'slug' => $slug ) );
		if ( $data['trip'] ) {
			$this->load->view( $main_content, $data );
		} else {
			$data['main_content'] = 'frontend/404';
			$this->load->view( FRONTEND, $data );
		}
	}


	function asyncTripSearch() {

		$items = $this->common_model->run_query( "select name from tbl_trips where name like '%{$_GET['term']}%' limit 0,10" );

		$data = [];

		foreach ( $items as $item ) {
			array_push( $data, $item['name'] );
		}

		header( 'Content-Type: application/json' );

		echo json_encode( $data );

	}

	function review() {
		if ( $_POST ) {
			$config = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				),
				array(
					'field' => 'country',
					'label' => 'Country',
					'rules' => 'required'
				),
				array(
					'field' => 'review',
					'label' => 'Review',
					'rules' => 'required'
				),
				array(
					'field' => 'rating',
					'label' => 'Rating',
					'rules' => 'required'
				),
			);
			if(segment( 3 ) == '') {
				$config = array_merge($config, array(
					array(
					'field' => 'trip_id',
					'label' => 'Trip',
					'rules' => 'required'
				)));
			}
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE) {
				echo json_encode(array('status' => 'error', 'msg' => validation_errors()));
			} else {
				$form_data = $_POST;
				if(segment( 3 ) == '') {
					$trip_id = $_POST['trip_id'];
					unset($form_data['trip_id']);
				} else {
					$trip_id = segment(3);
				}
				$review_id = $this->common_model->insert( 'tbl_reviews', $form_data, true );
				$this->common_model->insert( 'tbl_trip_review', array( 'trip_id' => $trip_id, 'review_id' => $review_id ) );
				echo json_encode(array('status' => 'success'));
			}
		} else {
			echo false;
		}
	}

}