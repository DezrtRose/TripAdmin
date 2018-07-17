<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
    	$this->load->helper('trip');
        $data['main_content'] = 'frontend/home';
        $this->load->view(FRONTEND, $data);
    }
}