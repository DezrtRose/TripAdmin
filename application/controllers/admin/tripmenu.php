<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tripmenu extends CI_Controller {
    function __construct()
    {
        parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index($offset = '')
    {
        $admin = $this->common_model->get_all('tbl_tripmenu', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/tripmenu');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_tripmenu', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/tripmenu/index';
        $data['sub_content'] = 'admin/tripmenu/_menus';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            if($id == '')
                $this->common_model->insert('tbl_tripmenu', $post);
            else
                $this->common_model->update('tbl_tripmenu', $post, array('id' => $id));
            set_flash('msg', 'Saved successfully');
            redirect('admin/tripmenu');
        } else {
            $data['main_content'] = 'admin/tripmenu/index';
            $data['sub_content'] = 'admin/tripmenu/_form';
            if($id != '')
                $data['tripmenu'] = $this->common_model->get_where('tbl_tripmenu', array('id' => $id));
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
        $id = segment(4);
        $this->common_model->delete_data('tbl_tripmenu', array('id' => $id));
        set_flash('msg', 'Deleted successfully');
        redirect('admin/tripmenu');
    }
}