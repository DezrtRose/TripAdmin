<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tripslider extends CI_Controller {
    function __construct()
    {
        parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index($offset = '')
    {
        $admin = $this->common_model->get_all('tbl_trip_slider', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/tripslider');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_trip_slider', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/tripslider/index';
        $data['sub_content'] = 'admin/tripslider/_sliders';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            $trip_image = $_FILES['photo'];
            if (!empty($trip_image['name'])) {
                if($id != '') {
                    $trip = $this->common_model->get_where('tbl_trip_slider', array('id' => $id));
                    $url = 'images/trip/'.$trip[0]['image'];
                    if(file_exists($url))
                        unlink($url);
                }
                $files_data = $this->common_library->upload_image('photo', 'images/trip/', 'trip' . time());
                $image_name = $files_data['filename'];
                $post['image'] = $image_name;
            }
            if($id == '') {
                $this->common_model->insert('tbl_trip_slider', $post);
            } else {
                $this->common_model->update('tbl_trip_slider', $post, array('id' => $id));
            }
            set_flash('msg', 'Saved successfully');
            redirect('admin/tripslider');
        } else {
            $data['main_content'] = 'admin/tripslider/index';
            $data['sub_content'] = 'admin/tripslider/_form';
            if($id != '')
                $data['tripslider'] = $this->common_model->get_where('tbl_trip_slider', array('id' => $id));
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
        $id = segment(4);
        $trip = $this->common_model->get_where('tbl_trip_slider', array('id' => $id));
        $url = 'images/trip/'.$trip[0]['image'];
        if(file_exists($url))
            unlink($url);
        $this->common_model->delete_data('tbl_trip_slider', array('id' => $id));
        set_flash('msg', 'Deleted successfully');
        redirect('admin/tripslider');
    }
}