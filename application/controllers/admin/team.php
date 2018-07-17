<?php

class Team extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		if(!check_user()) {

			redirect('admin/', 'refresh');

		}

	}



	public function index($offset = '')

	{

		$team = $this->common_model->get_all('tbl_team', '', 'id DESC');



		$this->load->library('pagination');



		$config['base_url'] = base_url('team');

		$config['total_rows'] = $team ? count($team) : 0;

		$config['uri_segment'] = '4';

		$config['num_links'] = '1';

		$config['per_page'] = 10;



		$this->pagination->initialize($config);



		$data['teams'] = $this->common_model->get_pagination('tbl_team', $offset, $config['per_page'], 'id DESC');

		$data['pagination'] = $this->pagination->create_links();

		$data['main_content'] = 'admin/team/index';

		$data['sub_content'] = 'admin/team/_teams';

		$this->load->view(BACKEND, $data);

	}



	function add_update()

	{

		$team_id = segment(4);

		if($_POST) {

			$post = $_POST;



			$image = $_FILES['img'];

			if (!empty($image['name'])) {

				if($team_id != '') {

					$team = $this->common_model->get_where('tbl_team', array('id' => $team_id));

					$url = 'images/team/'.$team[0]['image'];

					if(file_exists($url))

						unlink($url);

				}

				$files_data = $this->common_library->upload_image('img', 'images/team/', 'team' . time());

				$image_name = $files_data['filename'];

				$post['image'] = $image_name;

			}



			if($team_id == '') {

				$this->common_model->insert('tbl_team', $post);

			} else {

				$this->common_model->update('tbl_team', $post, array('id' => $team_id));

			}

			set_flash('msg', 'Team saved');

			redirect('admin/team');

		} else {

			$data = array(

				'main_content' => 'admin/team/index',

				'sub_content' => 'admin/team/_form',

			);

			if($team_id != '') {

				$data['team'] = $this->common_model->get_where('tbl_team', array('id' => $team_id));

			}

			$this->load->view(BACKEND, $data);

		}

	}



	function delete_team($id = '')

	{

		$team = $this->common_model->get_where('tbl_team', array('id' => $id));

		$url = 'images/team/'.$team[0]['image'];

		if(file_exists($url))

			unlink($url);



		$this->common_model->delete_data('tbl_team', array('id' => $id));

		set_flash('msg', 'Team deleted');

		redirect('admin/team');

	}



	function team_detail()

	{

		$id = segment(4);

		$data = $this->common_model->get_where('tbl_team', array('id' => $id));

		$modal = $this->load->view('admin/team/_details', $data[0], true);

		echo $modal;

	}



	function approve($id = '')

	{

		$this->common_model->update('tbl_team', array('approved' => 1),array('id' => $id));

		set_flash('msg', 'Team approved');

		redirect('admin/team');

	}



	function disapprove($id = '')

	{

		$this->common_model->update('tbl_team', array('approved' => 0),array('id' => $id));

		set_flash('msg', 'Team disapproved');

		redirect('admin/team');

	}

}