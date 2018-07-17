<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of TripController
 *
 * @author dinesubedi
 */
class TripController extends CI_Controller {
    
    
    function __construct() {

        parent::__construct();

        $this->load->model('Itinerary_model');

    }
    
    
    function allTrip() {
	
	$seg2 = segment(2);
	
	if(($seg2=='name-asc')){
	    $data['trip'] = $this->common_model->get_all('tbl_trips', '', 'name ASC');
	} elseif (($seg2=='name-desc')) {
	    $data['trip'] = $this->common_model->get_all('tbl_trips', '', 'name DESC');
	} elseif (($seg2=='price-asc')) {
	    $data['trip'] = $this->common_model->get_all('tbl_trips', '', 'cost ASC');
	} elseif (($seg2=='price-desc')) {
	    $data['trip'] = $this->common_model->get_all('tbl_trips', '', 'cost DESC');
	} elseif (($seg2=='duration-max')) {
	    $data['trip'] = $this->common_model->get_all('tbl_trips', '', 'duration DESC');
	} elseif (($seg2=='duration-min')) {
	    $data['trip'] = $this->common_model->get_all('tbl_trips', '', 'duration ASC');
	} else {
	    $data['trip'] = $this->common_model->get_all('tbl_trips', '', 'id DESC');
	}
	
	$data['main_content'] = 'frontend/trips/index';
	$data['sub_content'] = 'frontend/trips/_list';
	$this->load->view(FRONTEND, $data);
	
    }
    
    
    function destination() {
	
	$seg2 = segment(2);
	$seg3 = segment(3);
	
	$desti = $this->common_model->get_where('tbl_destinations', array('slug' => $seg2));
	
	if($seg3!=NULL){
	    
	    if(($seg3=='name-asc')){
		$data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'name ASC');
	    } elseif (($seg3=='name-desc')) {
		$data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'name DESC');
	    } elseif (($seg3=='price-asc')) {
		$data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'cost ASC');
	    } elseif (($seg3=='price-desc')) {
		$data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'cost DESC');
	    } elseif (($seg3=='duration-max')) {
		$data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'duration DESC');
	    } elseif (($seg3=='duration-min')) {
		$data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'duration ASC');
	    } else {
		$data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'id DESC');
	    }
	    
	} else {
	    $data['trip'] = $this->common_model->get_where('tbl_trips', array('dest_id' => $desti[0]['id']), 'id DESC');
	}
	
	$data['main_content'] = 'frontend/trips/index';
	$data['sub_content'] = 'frontend/trips/_list';
	$this->load->view(FRONTEND, $data);
    }
    
    
    function activity() {
	
	$seg3 = segment(3);
	$seg2 = segment(2);
	
	
	$acti = $this->common_model->getWhere('tbl_activities', array('slug' => $seg2));
	$act = $this->common_model->get_where('tbl_trip_activity', array('act_id' => $acti->id));
	
	$acts[] = -1;
	if($act) {
	    foreach($act as $a) {
		$acts[] = $a['trip_id'];
	    }
	}
	$admin = $this->common_model->get_where_in('tbl_trips', 'id', $acts);
	$trips[] = -1;
	foreach ($admin as $t) {
	    $trips[] = $t['id'];
	}
	
	
	if($seg3=='name-asc'){
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'name ASC');
	}elseif ($seg3=='name-desc') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'name DESC');
	}elseif ($seg3=='price-asc') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'cost ASC');
	}elseif ($seg3=='price-desc') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'cost DESC');
	}elseif ($seg3=='duration-max') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'duration DESC');
	}elseif ($seg3=='duration-min') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'duration ASC');
	} else {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'id DESC');
	}
	
	
	$data['main_content'] = 'frontend/trips/index';
	$data['sub_content'] = 'frontend/trips/_list';
	$this->load->view(FRONTEND, $data);
	
    }
    
    
    function destinationActivity() {
	
	$seg4 = segment(4);
	$activity = segment(3);
	$destination = segment(2);
	
	$desti = $this->common_model->get_where('tbl_destinations', array('slug' => $destination));
	$actts = $this->common_model->get_where('tbl_activities', array('slug' => $activity));
	$act = $this->common_model->get_where('tbl_trip_activity', array('act_id' => $actts[0]['id']), 'id DESC');
	$acts[] = -1;
	if($act) {
	    foreach($act as $a) {
		$acts[] = $a['trip_id'];
	    }
	}
	$admin = $this->common_model->get_where_in('tbl_trips', 'id', $acts);
	$trips[] = -1;
	foreach ($admin as $t) {
	    if(($t['dest_id']) == ($desti[0]['id']) ){
		$trips[] = $t['id'];
	    }
	}
	
	if($seg4=='name-asc'){
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'name ASC');
	}elseif ($seg4=='name-desc') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'name DESC');
	}elseif ($seg4=='price-asc') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'cost ASC');
	}elseif ($seg4=='price-desc') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'cost DESC');
	}elseif ($seg4=='duration-max') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'duration DESC');
	}elseif ($seg4=='duration-min') {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'duration ASC');
	} else {
	    $data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'id DESC');
	}
	
	//$data['trip'] = $this->common_model->getWhereInOrder('tbl_trips', 'id', $trips, 'id DESC');

	//var_dump($data);
	
	$data['sub_content'] = 'frontend/trips/_list';
        $data['main_content'] = 'frontend/trips/index';
        $this->load->view(FRONTEND, $data);
	
	
	
	
    }
    
    
}
