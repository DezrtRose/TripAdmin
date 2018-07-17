<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TripB extends CI_Controller {
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

        $config['base_url'] = base_url('admin/trip');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_trips', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/trip/index';
        $data['sub_content'] = 'admin/trip/_trips';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            $act = $post['act_id'];
            unset($post['act_id']);
            $config = array(
                'field' => 'slug',
                'title' => 'name',
                'table' => 'tbl_trips',
                'id' => 'id',
            );
            if(isset($post['similar']))
                $post['similar'] = implode(',', $post['similar']);
            $this->load->library('Slug', $config);
            if($id == '') {
                $post['slug'] = $this->slug->create_uri($post);
                $id = $this->common_model->insert('tbl_trips', $post, true);
            } else {
                $this->common_model->delete_data('tbl_trip_activity', array('trip_id' => $id));
                $post['slug'] = $this->slug->create_uri($post, $id);
                $this->common_model->update('tbl_trips', $post, array('id' => $id));
            }

            foreach($act as $a) {
                $this->common_model->insert('tbl_trip_activity', array('trip_id' => $id, 'act_id' => $a));
            }

            set_flash('msg', 'Trip saved');
            redirect('admin/trip');
        } else {
            $data = array(
                'main_content' => 'admin/trip/index',
                'sub_content' => 'admin/trip/_form',
            );
            if($id != '') {
                $data['trip'] = $this->common_model->get_where('tbl_trips', array('id' => $id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function change_status()
    {
        $post = explode('_', $_POST['id']);
        $id = $post[0];
        $status = ($post[1] == 0) ? 1 : 0;
        $this->common_model->update('tbl_trips', array('featured' => $status), array('id' => $id));
        echo true;
    }

    function delete()
    {
        $id = segment(4);
        $this->common_model->delete_data('tbl_trips', array('id' => $id));
        $this->common_model->delete_data('tbl_trip_slider', array('trip_id' => $id));
        set_flash('msg', 'Trip deleted');
        redirect('admin/destination');
    }
}