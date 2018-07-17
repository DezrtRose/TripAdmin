<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

	public function __construct(){
		parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
	}

    function index($offset = '')
    {
        $admin = $this->common_model->get_all('tbl_admin', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/admin');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '4';
        $config['num_links'] = '1';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_admin', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/config/index';
        $data['sub_content'] = 'admin/config/_users';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $admin_id = segment(4);
        if($_POST) {
            $post = $_POST;
	        $post['password'] = MD5($post['password']);
            if($admin_id == '') {
                $this->common_model->insert('tbl_admin', $post);
            } else {
                $this->common_model->update('tbl_admin', $post, array('id' => $admin_id));
            }
            set_flash('msg', 'Fleet saved');
            redirect('admin/config');
        } else {
            $data = array(
                'main_content' => 'admin/config/index',
                'sub_content' => 'admin/config/_form',
            );
            if($admin_id != '') {
                $data['admin'] = $this->common_model->get_where('tbl_admin', array('id' => $admin_id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete($id = '')
    {
        $this->common_model->delete_data('tbl_admin', array('id' => $id));
        $this->session->set_flashdata('msg', 'Deleted successfully');
        redirect('admin/admin');
    }
}