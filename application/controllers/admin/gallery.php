<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!check_user()) {
            redirect('admin');
        }
    }

    function index($offset = '')
    {
        $admin = $this->common_model->get_all('tbl_gallery', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/gallery');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_gallery', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/gallery/index';
        $data['sub_content'] = 'admin/gallery/_gallerys';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
            unset($post['gallery-img']);
            if($id == '') {
                $this->common_model->insert('tbl_gallery', $post);
            } else {
                $this->common_model->update('tbl_gallery', $post, array('id' => $id));
            }
            set_flash('msg', 'Gallery saved');
            redirect('admin/gallery');
        } else {
            $data = array(
                'main_content' => 'admin/gallery/index',
                'sub_content' => 'admin/gallery/_form',
            );
            if($id != '') {
                $data['gallery'] = $this->common_model->get_where('tbl_gallery', array('id' => $id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
        $this->common_model->delete_data('tbl_gallery', array('id' => segment(4)));
        set_flash('msg', 'Image deleted');
        redirect('admin/gallery');
    }

}