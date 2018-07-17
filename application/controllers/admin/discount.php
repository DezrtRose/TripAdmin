<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount extends MY_Controller
{
    function __construct()
    {
        parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index($offset = '')
    {
        $admin = $this->common_model->get_all('tbl_trip_discount', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/discount');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_trip_discount', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/discount/index';
        $data['sub_content'] = 'admin/discount/_discounts';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            if($id == '') {
                $this->common_model->insert('tbl_trip_discount', $post);
            } else {
                $this->common_model->update('tbl_trip_discount', $post, array('id' => $id));
            }
            set_flash('msg', 'Discount saved');
            redirect('admin/discount');
        } else {
            $data = array(
                'main_content' => 'admin/discount/index',
                'sub_content' => 'admin/discount/_form',
            );
            if($id != '') {
                $data['discount'] = $this->common_model->get_where('tbl_trip_discount', array('id' => $id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
        $this->common_model->delete_data('tbl_trip_discount', array('id' => segment(4)));
        set_flash('msg', 'Discount deleted');
        redirect('admin/discount');
    }
}