<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index($offset = '')
    {
	    ($this->session->userdata('news_data')) ? $this->session->unset_userdata('news_data') : '';
        $news = $this->common_model->get_all('tbl_news', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/news');
        $config['total_rows'] = count($news);
        $config['uri_segment'] = '4';
        $config['num_links'] = '1';
        $config['per_news'] = 10;

        $this->pagination->initialize($config);

        $data['news'] = $this->common_model->get_pagination('tbl_news', $offset, $config['per_news'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/news/index';
        $data['sub_content'] = 'admin/news/_news';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $news_id = segment(4);
        if($_POST) {
            $post = $_POST;
	        if(($news_id == '' && $this->common_model->get_where('tbl_news', array('slug' => $post['slug']))) || ($this->common_model->get_where('tbl_news', array('slug' => $post['slug'], 'id !=' => $news_id)))) {
		        $this->session->set_userdata(array('news_data' => $post));
		        set_flash('msg', 'Duplicate slug not allowed.');
		        $news_id == '' ? redirect('admin/news/add_update') : redirect('admin/news/add_update/' . $news_id);
	        }
            $config = array(
                'field' => 'slug',
                'title' => 'name',
                'table' => 'tbl_news',
                'id' => 'id',
            );
            $image = $_FILES['img'];
	        $seo_image = $_FILES['seo_image'];
            if (!empty($image['name'])) {
                if($news_id != '') {
                    $news = $this->common_model->get_where('tbl_news', array('id' => $news_id));
                    $url = 'images/news/'.$news[0]['image'];
                    if($news[0]['image'] != '' && file_exists($url))
                        unlink($url);
                }
                $files_data = $this->common_library->upload_image('img', 'images/news/', 'trip' . time());
                $image_name = $files_data['filename'];
                $post['image'] = $image_name;
            }

	        if (!empty($seo_image['name'])) {
		        if($news_id != '') {
			        $news_data = $this->common_model->get_where('tbl_news', array('id' => $news_id));
			        $url = 'images/news/'.$news_data[0]['seo_image'];
			        if($news_data[0]['seo_image'] != '' && file_exists($url))
				        unlink($url);
		        }

		        $files_data = $this->common_library->upload_image('seo_image', 'images/news/', 'blog-seo-image' . time());
		        $image_name = $files_data['filename'];
		        $post['seo_image'] = $image_name;
	        }
            $this->load->library('Slug', $config);
            if($news_id == '') {
                $post['date'] = time();
                $post['slug'] = $this->slug->create_uri($post);
                $this->common_model->insert('tbl_news', $post);
            } else {
                $post['slug'] = $this->slug->create_uri($post, $news_id);
                $this->common_model->update('tbl_news', $post, array('id' => $news_id));
            }
            set_flash('msg', 'News saved');
            redirect('admin/news');
        } else {
            $data = array(
                'main_content' => 'admin/news/index',
                'sub_content' => 'admin/news/_form',
            );
            if($news_id != '') {
                $data['news'] = $this->common_model->get_where('tbl_news', array('id' => $news_id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
        $this->common_model->delete_data('tbl_news', array('id' => segment(4)));
        set_flash('msg', 'News deleted');
        redirect('admin/news');
    }
}