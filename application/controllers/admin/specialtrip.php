<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specialtrip extends CI_Controller {
    function __construct()
    {
        parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index($offset = '')
    {
        $admin = $this->common_model->get_all('tbl_trips', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('trip/trips');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '4';
        $config['num_links'] = '1';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_trips', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/trip/index';
        $data['sub_content'] = 'admin/trip/_trips';
        $this->load->view(BACKEND, $data);
    }
}