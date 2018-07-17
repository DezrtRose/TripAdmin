<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends CI_Controller {

	function __construct() {
		parent:: __construct();
		if ( ! check_user() ) {
			redirect( 'admin/' );
		}
	}

	function save()
	{
		if($_POST) {
			$seo_data = $_POST;
			$seo_image = $_FILES['og_image'];
			if (!empty($seo_image['name'])) {
				$seo = $this->common_model->get_where('seo', array('id' => 1));
				if($seo[0]['og_image']) {
					$url = 'images/seo/'.$seo[0]['og_image'];
					if(file_exists($url))
						unlink($url);
				}

				$files_data = $this->common_library->upload_image('og_image', 'images/seo/', 'seo-og-image' . time());
				$image_name = $files_data['filename'];
				$seo_data['og_image'] = $image_name;
			}

			$this->common_model->update('seo', $seo_data, array('id' => 1));
			set_flash('SEO data saved.', 'msg');
			redirect('admin/seo');
		} else {
			$data['seo_data'] = $this->common_model->get_where('seo', array('id' => 1));
			$data['main_content'] = 'admin/seo/index';
			$data['sub_content'] = 'admin/seo/_seo';
			$this->load->view(BACKEND, $data);
		}
	}

}