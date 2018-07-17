<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller 
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
	    ($this->session->userdata('activity_data')) ? $this->session->unset_userdata('activity_data') : '';
	    $admin = $this->common_model->get_all('tbl_activities', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/activity');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_activities', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/activity/index';
        $data['sub_content'] = 'admin/activity/_activities';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            $post = $_POST;
	        if(($id == '' && $this->common_model->get_where('tbl_activities', array('slug' => $post['slug']))) || ($this->common_model->get_where('tbl_activities', array('slug' => $post['slug'], 'id !=' => $id)))) {
		        $this->session->set_userdata(array('activity_data' => $post));
		        set_flash('msg', 'Duplicate slug not allowed.');
		        $id == '' ? redirect('admin/activity/add_update') : redirect('admin/activity/add_update/' . $id);
	        }
	        $banner_image = $_FILES['banner_image'];
	        $seo_image = $_FILES['seo_image'];
            $config = array(
                'field' => 'slug',
                'title' => 'activity',
                'table' => 'tbl_activities',
                'id' => 'id',
            );
            $act = $post['destination'];
            unset($post['destination']);
            $this->load->library('Slug', $config);

	        if (!empty($banner_image['name'])) {
		        if($id != '') {
			        $activity_data = $this->common_model->get_where('tbl_activities', array('id' => $id));
			        if($activity_data[0]['banner_image']) {
				        $url = 'images/activity/'.$activity_data[0]['banner_image'];
				        if($activity_data[0]['banner_image'] != '' && file_exists($url))
					        unlink($url);
			        }
		        }

		        $files_data = $this->common_library->upload_image('banner_image', 'images/activity/', 'activity-banner' . time());
		        $image_name = $files_data['filename'];
		        $post['banner_image'] = $image_name;
	        }

	        if (!empty($seo_image['name'])) {
		        if($id != '') {
			        $activity_data = $this->common_model->get_where('tbl_activities', array('id' => $id));
			        $url = 'images/activity/'.$activity_data[0]['seo_image'];
			        if($activity_data[0]['seo_image'] != '' && file_exists($url))
				        unlink($url);
		        }

		        $files_data = $this->common_library->upload_image('seo_image', 'images/activity/', 'activity-seo-image' . time());
		        $image_name = $files_data['filename'];
		        $post['seo_image'] = $image_name;
	        }
            if($id == '') {
                $post['slug'] = $this->slug->create_uri($post);
                $id = $this->common_model->insert('tbl_activities', $post, true);
            } else {
                $this->common_model->delete_data('tbl_act_dest', array('act_id' => $id));
                $post['slug'] = $this->slug->create_uri($post, $id);
                $this->common_model->update('tbl_activities', $post, array('id' => $id));
            }

            foreach($act as $a) {
                $this->common_model->insert('tbl_act_dest', array('act_id' => $id, 'dest_id' => $a));
            }

            set_flash('msg', 'activity saved');
            redirect('admin/activity');
        } else {
            $data = array(
                'main_content' => 'admin/activity/index',
                'sub_content' => 'admin/activity/_form',
            );
            if($id != '') {
                $data['activity'] = $this->common_model->get_where('tbl_activities', array('id' => $id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
	    $id = segment(4);
	    $activity = $this->common_model->get_where('tbl_activities', array('id' => $id));
	    $url = 'images/activity/'.$activity[0]['banner_image'];
	    if(file_exists($url))
		    unlink($url);
	    $url = 'images/activity/'.$activity[0]['seo_image'];
	    if(file_exists($url))
		    unlink($url);
        $this->common_model->delete_data('tbl_activities', array('id' => segment(4)));
        set_flash('msg', 'Activity deleted');
        redirect('admin/activity');
    }
}