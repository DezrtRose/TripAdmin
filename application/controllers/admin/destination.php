<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destination extends MY_Controller {
    function __construct()
    {
        parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index($offset = '')
    {
	    ($this->session->userdata('destination_data')) ? $this->session->unset_userdata('destination_data') : '';
	    $admin = $this->common_model->get_all('tbl_destinations', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/destination');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_destinations', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/destination/index';
        $data['sub_content'] = 'admin/destination/_destinations';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
	        if(($id == '' && $this->common_model->get_where('tbl_destinations', array('slug' => $post['slug']))) || ($this->common_model->get_where('tbl_destinations', array('slug' => $post['slug'], 'id !=' => $id)))) {
		        $this->session->set_userdata(array('destination_data' => $post));
		        set_flash('msg', 'Duplicate slug not allowed.');
		        $id == '' ? redirect('admin/destination/add_update') : redirect('admin/destination/add_update/' . $id);
	        }
            $banner_image = $_FILES['banner_image'];
            $seo_image = $_FILES['seo_image'];
            $config = array(
                'field' => 'slug',
                'title' => 'destination',
                'table' => 'tbl_destinations',
                'id' => 'id',
            );
            $this->load->library('Slug', $config);

	        if (!empty($banner_image['name'])) {
		        if($id != '') {
			        $destination_data = $this->common_model->get_where('tbl_destinations', array('id' => $id));
			        if($destination_data[0]['banner_image']) {
				        $url = 'images/destination/'.$destination_data[0]['banner_image'];
				        if($destination_data[0]['banner_image'] != '' && file_exists($url))
					        unlink($url);
			        }
		        }

		        $files_data = $this->common_library->upload_image('banner_image', 'images/destination/', 'destination-banner' . time());
		        $image_name = $files_data['filename'];
		        $post['banner_image'] = $image_name;
	        }

	        if (!empty($seo_image['name'])) {
		        if($id != '') {
			        $destination_data = $this->common_model->get_where('tbl_destinations', array('id' => $id));
			        $url = 'images/destination/'.$destination_data[0]['seo_image'];
			        if($destination_data[0]['seo_image'] != '' && file_exists($url))
				        unlink($url);
		        }

		        $files_data = $this->common_library->upload_image('seo_image', 'images/destination/', 'destination-seo-image' . time());
		        $image_name = $files_data['filename'];
		        $post['seo_image'] = $image_name;
	        }

            if($id == '') {
                $post['slug'] = $this->slug->create_uri($post);
                $this->common_model->insert('tbl_destinations', $post);
            } else {
                $post['slug'] = $this->slug->create_uri($post, $id);
                $this->common_model->update('tbl_destinations', $post, array('id' => $id));
            }
            set_flash('msg', 'Destination saved');
            redirect('admin/destination');
        } else {
            $data = array(
                'main_content' => 'admin/destination/index',
                'sub_content' => 'admin/destination/_form',
            );
            if($id != '') {
                $data['destination'] = $this->common_model->get_where('tbl_destinations', array('id' => $id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
	    $id = segment(4);
	    $destination = $this->common_model->get_where('tbl_destinations', array('id' => $id));
	    $url = 'images/destination/'.$destination[0]['banner_image'];
	    if(file_exists($url))
		    unlink($url);
	    $url = 'images/destination/'.$destination[0]['seo_image'];
	    if(file_exists($url))
		    unlink($url);
        $this->common_model->delete_data('tbl_destinations', array('id' => segment(4)));
        set_flash('msg', 'Destination deleted');
        redirect('admin/destination');
    }
}