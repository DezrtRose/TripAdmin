<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function pages($offset = '')
    {
	    ($this->session->userdata('page_data')) ? $this->session->unset_userdata('page_data') : '';
	    $page = $this->common_model->get_all('tbl_pages', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/content/pages');
        $config['total_rows'] = count($page);
        $config['uri_segment'] = '4';
        $config['num_links'] = '1';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['pages'] = $this->common_model->get_pagination('tbl_pages', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/content/index';
        $data['sub_content'] = 'admin/content/_pages';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $page_id = segment(4);
        if($_POST) {
            $post = $_POST;
            if(($page_id == '' && $this->common_model->get_where('tbl_pages', array('slug' => $post['slug']))) || ($this->common_model->get_where('tbl_pages', array('slug' => $post['slug'], 'id !=' => $page_id)))) {
            	$this->session->set_userdata(array('page_data' => $post));
            	set_flash('msg', 'Duplicate slug not allowed.');
	            $page_id == '' ? redirect('admin/content/add-update') : redirect('admin/content/add-update/' . $page_id);
            }
	        $seo_image = $_FILES['seo_image'];
	        $banner_image = $_FILES['banner_image'];
	        $config = array(
                'field' => 'slug',
                'title' => 'name',
                'table' => 'tbl_pages',
                'id' => 'id',
            );
            $this->load->library('Slug', $config);

	        if (!empty($seo_image['name'])) {
		        if($page_id != '') {
			        $page_data = $this->common_model->get_where('tbl_pages', array('id' => $page_id));
			        $url = 'images/page/'.$page_data[0]['seo_image'];
			        if($page_data[0]['seo_image'] != '' && file_exists($url))
				        unlink($url);
		        }

		        $files_data = $this->common_library->upload_image('seo_image', 'images/page/', 'page-seo-image' . time());
		        $image_name = $files_data['filename'];
		        $post['seo_image'] = $image_name;
	        }

	        if (!empty($banner_image['name'])) {
		        if($page_id != '') {
			        $page_data = $this->common_model->get_where('tbl_pages', array('id' => $page_id));
			        if($page_data[0]['banner_image']) {
				        $url = 'images/destination/'.$page_data[0]['banner_image'];
				        if(file_exists($url))
					        unlink($url);
			        }
		        }

		        $files_data = $this->common_library->upload_image('banner_image', 'images/page/', 'page-banner-' . time());
		        $image_name = $files_data['filename'];
		        $post['banner_image'] = $image_name;
	        }

            if($page_id == '') {
                //$post['slug'] = $this->slug->create_uri($post);
                $this->common_model->insert('tbl_pages', $post);
            } else {
                //$post['slug'] = $this->slug->create_uri($post, $page_id);
                $this->common_model->update('tbl_pages', $post, array('id' => $page_id));
            }
            set_flash('msg', 'Page saved');
            redirect('admin/content/pages');
        } else {
            $data = array(
                'main_content' => 'admin/content/index',
                'sub_content' => 'admin/content/_form',
                'pages' => $this->common_model->get_where('tbl_pages', array('parent_page' => 0))
            );
            if($page_id != '') {
                $data['page'] = $this->common_model->get_where('tbl_pages', array('id' => $page_id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete_page()
    {
    	$page_id = segment(4);
    	$page_data = $this->common_model->get_where('tbl_pages', array('id' => $page_id));
    	$url = 'image/page/' . $page_data[0]['seo_image'];
    	if(file_exists($url))
    		unlink($url);
        $this->common_model->delete_data('tbl_pages', array('id' => segment(4)));
        set_flash('msg', 'Page deleted');
        redirect('admin/content/pages');
    }

    function banners($offset = '')
    {
        echo $offset;
        $banner = $this->common_model->get_all('tbl_banners', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/content/banners');
        $config['total_rows'] = count($banner);
        $config['uri_segment'] = '4';
        $config['num_links'] = '1';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['banners'] = $this->common_model->get_pagination('tbl_banners', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/content/index';
        $data['sub_content'] = 'admin/content/_banners';
        $this->load->view(BACKEND, $data);
    }

    function add_update_banner()
    {
        $banner_id = segment(4);
        if($_POST) {
            $banner = $_FILES['banner'];
            $banner_name = '';
            $post = $_POST;
            if (!empty($banner['name'])) {
                if($banner_id != '') {
                    $banner = $this->common_model->get_where('tbl_banners', array('id' => segment(4)));
                    $url = 'images/banner/'.$banner[0]['filename'];
                    if(file_exists($url))
                        unlink($url);
                }
                $files_data = $this->common_library->upload_image('banner', 'images/banner/', 'banner' . time());
                $banner_name = $files_data['filename'];
                $post['filename'] = $banner_name;
            }
            if($banner_id == '')
                $post['filename'] = $banner_name;
            if($banner_id == '') {
                $this->common_model->insert('tbl_banners', $post);
            } else {
                $this->common_model->update('tbl_banners', $post, array('id' => $banner_id));
            }
            set_flash('msg', 'Banner saved');
            redirect('admin/content/banners');
        } else {
            $data = array(
                'main_content' => 'admin/content/index',
                'sub_content' => 'admin/content/_banner_form',
            );
            if($banner_id != '') {
                $data['banner'] = $this->common_model->get_where('tbl_banners', array('id' => $banner_id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete_banner()
    {
        $banner = $this->common_model->get_where('tbl_banners', array('id' => segment(4)));
        $url = 'images/banner/'.$banner[0]['filename'];
        if(file_exists($url))
            unlink($url);
        $this->common_model->delete_data('tbl_banners', array('id' => segment(4)));
        set_flash('msg', 'Banner deleted');
        redirect('admin/content/banners');
    }
}