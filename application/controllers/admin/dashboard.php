<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index()
    {
        $data['main_content'] = 'admin/dashboard';
        $this->load->view(BACKEND, $data);
    }
}