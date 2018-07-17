<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $slug = segment(2);
        if($slug == '') {
            $data['news'] = $this->common_model->get_all('tbl_news');
            $data['sub_content'] = 'frontend/news/_list';
        } else {
            $data['news'] = $this->common_model->get_where('tbl_news', array('slug' => $slug));
	        $data['metatitle'] = $data['news'][0]['seo_title'] != '' ? $data['news'][0]['seo_title'] : $data['news'][0]['name'];
	        $data['metadescription'] = $data['news'][0]['seo_description'];
	        $data['metakeyword'] = $data['news'][0]['seo_keyword'];
	        $data['og_image'] = $data['news'][0]['seo_image'] != '' ? base_url('images/news/' . $data['news'][0]['seo_image']) : '';
	        $data['canonical_url']   = $data['news'][0]['canonical_url'];
	        $data['sub_content'] = 'frontend/news/_detail';
        }
        if($data['news']) {
            $data['main_content'] = 'frontend/news/index';
            $this->load->view(FRONTEND, $data);
        } else {
            $data['main_content'] = 'frontend/404';
            $this->load->view(FRONTEND, $data);
        }
    }
}