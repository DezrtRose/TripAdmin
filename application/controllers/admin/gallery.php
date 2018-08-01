<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends MY_Controller
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
		if($_FILES) {
			$post = $_POST;
			$image = $_FILES['img'];
			if($id == '') {
				$id = $this->common_model->insert('tbl_gallery', $post, true);
			} else {
				$this->common_model->update('tbl_gallery', $post, array('id' => $id));
			}
			if (!empty($image['name']) && $image['name'][0] != '') {
				$this->upload_images($id, $image);
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

	public function upload_images($gallery_id, $images)
	{
		foreach($images['name'] as $key => $image) {
			$target_dir = "images/gallery/";
			$file_ext = explode('.', $image)[1];
			$images_name = 'gallery-' . time() . $key . '.' . $file_ext;
			$target_file = $target_dir . $images_name;
			if(move_uploaded_file($images["tmp_name"][$key], $target_file)) {
				$this->common_model->insert('tbl_gallery_image', ['gallery_id' => $gallery_id, 'image' => $images_name]);
			}
		}
	}

	function delete()
	{
		$id = segment(4);
		$gallery_images = $this->common_model->get_where('tbl_gallery_image', array('gallery_id' => $id));
		if($gallery_images && is_array($gallery_images)) {
			foreach ($gallery_images as $image) {
				$url = 'images/gallery/'.$image['image'];
				if(file_exists($url))
					unlink($url);
			}
		}

		$this->common_model->delete_data('tbl_gallery', array('id' => $id));
		set_flash('msg', 'Gallery deleted');
		redirect('admin/gallery');
	}

	function delete_image()
	{
		$id = segment(4);
		$back_url = $_GET['back'];
		$gallery_image = $this->common_model->get_where('tbl_gallery_image', array('id' => $id));
		$url = 'images/gallery/'.$gallery_image[0]['image'];
		if(file_exists($url))
			unlink($url);
		$this->common_model->delete_data('tbl_gallery_image', array('id' => $id));
		redirect($back_url);
	}

	function feature_image()
	{
		$id = segment(4);
		$back_url = $_GET['back'];
		$gallery_image = $this->common_model->get_where('tbl_gallery_image', array('id' => $id));
		$featured = !$gallery_image[0]['featured'] ? 1 : 0;
		$this->common_model->update('tbl_gallery_image', array('featured' => $featured), array('id' => $id));
		redirect($back_url);
	}

}