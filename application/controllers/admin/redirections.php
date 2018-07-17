<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

class Redirections extends MY_Controller {

	function __construct() {
		parent:: __construct();
		if ( ! check_user() ) {
			redirect( 'admin/' );
		}
	}

	function index($offset = '') {
		$all_redirections = $this->common_model->get_all('tbl_redirections', '', 'id DESC');

		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/redirections');
		$config['total_rows'] = count($all_redirections);
		$config['uri_segment'] = '3';
		$config['num_links'] = '5';
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		$data['redirections'] = $this->common_model->get_pagination('tbl_redirections', $offset, $config['per_page'], 'id DESC');
		$data['pagination'] = $this->pagination->create_links();
		$data['main_content'] = 'admin/redirections/index';
		$data['sub_content']  = 'admin/redirections/_list';
		$this->load->view( BACKEND, $data );
	}

	function addUpdate() {
		if ( $_POST ) {
			if ( $this->input->post( 'id' ) != null ) {
				$this->common_model->updateN( 'tbl_redirections', $_POST, array( 'id' => $this->input->post( 'id' ) ) );
				set_flash( 'msg', 'Data updated' );
				redirect( 'admin/redirections' );
			} else {
				$post = $_POST;
				$this->common_model->insert( 'tbl_redirections', $_POST );
				set_flash( 'msg', 'Data saved' );
				redirect( 'admin/redirections' );
			}
		}
		$data['main_content'] = 'admin/redirections/index';
		$data['sub_content']  = 'admin/redirections/_form';
		$this->load->view( BACKEND, $data );
	}

	function delete( $id ) {
		$this->common_model->delete_data( 'tbl_redirections', array( 'id' => $id ) );
		set_flash( 'msg', 'Data deleted' );
		redirect( 'admin/redirections' );
	}

	function edit( $id ) {
		$data["dataToEdit"]   = $this->common_model->getWhere( 'tbl_redirections', array( 'id' => $id ) );
		$data['sub_content']  = 'admin/redirections/_form';
		$data['main_content'] = 'admin/redirections/index';
		$this->load->view( BACKEND, $data );
	}
}