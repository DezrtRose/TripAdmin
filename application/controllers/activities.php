<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activities extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $slug = segment(2);
        if($slug != '') {
	        $desti = $this->common_model->get_where('tbl_activities', array('slug' => $slug));
	        $act = $this->common_model->get_where('tbl_trip_activity', array('act_id' => $desti[0]['id']), 'id DESC');

	        $data['activity_data'] = $desti[0];
	        $data['metatitle'] = $desti[0]['seo_title'] != '' ? $desti[0]['seo_title'] : $desti[0]['activity'];
	        $data['metadescription'] = $desti[0]['seo_description'];
	        $data['metakeyword'] = $desti[0]['seo_keyword'];
	        $data['og_image'] = $desti[0]['seo_image'] != '' ? base_url('images/activity/' . $desti[0]['seo_image']) : '';
	        $data['canonical_url'] = $desti[0]['canonical_url'];

	        $acts[] = -1;
	        if($act) {
		        foreach($act as $a) {
			        $acts[] = $a['trip_id'];
		        }
	        }

	        $admin = $this->common_model->get_where_in('tbl_trips', 'id', $acts);

	        $this->load->library('pagination');

	        $config['base_url'] = base_url('activities/'.$slug);
	        $config['total_rows'] = count($admin);
	        $config['uri_segment'] = '3';
	        $config['num_links'] = '5';
	        $config['per_page'] = 9;

	        $this->pagination->initialize($config);

	        $data['trip'] = $this->common_model->get_pagination('tbl_trips', segment(3), $config['per_page'], 'id DESC', array('status' => 1), true, 'id', $acts);
	        $data['pagination'] = $this->pagination->create_links();
	        $data['sub_content'] = 'frontend/trips/_list';
	        $data['main_content'] = 'frontend/trips/index';
        } else {
        	$data['activities'] = $this->common_model->get_all('tbl_activities', '', 'id asc');
        	$data['sub_content'] = 'frontend/trips/_activity_list';
        	$data['main_content'] = 'frontend/trips/index';
        }
        $this->load->view(FRONTEND, $data);
    }
}