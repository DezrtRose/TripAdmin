<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller 
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
        $admin = $this->common_model->get_all('tbl_reviews', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/review');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_reviews', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/review/index';
        $data['sub_content'] = 'admin/review/_reviews';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
	        $form_data = $_POST;
	        $form_data['status'] = 1;
	        $trip_id = $_POST['trip_id'];
	        unset($form_data['trip_id']);
	        if($id == '') {
		        $id = $this->common_model->insert( 'tbl_reviews', $form_data, true );
	        } else {
	        	$this->common_model->delete_data('tbl_trip_review', array('review_id' => $id));
		        $this->common_model->update('tbl_reviews', $form_data, array('id' => $id));
	        }
	        $this->common_model->insert( 'tbl_trip_review', array( 'trip_id' => $trip_id, 'review_id' => $id ) );

            set_flash('msg', 'Review saved');
            redirect('admin/review');
        } else {
            $data = array(
                'main_content' => 'admin/review/index',
                'sub_content' => 'admin/review/_form',
            );
            if($id != '') {
                $data['review'] = $this->common_model->get_where('tbl_reviews', array('id' => $id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete()
    {
        $this->common_model->delete_data('tbl_reviews', array('id' => segment(4)));
        set_flash('msg', 'Review deleted');
        redirect('admin/review');
    }

    function status()
    {
	    $review_id = segment(4);
    	$trip_review = $this->common_model->get_where('tbl_reviews', array('id' => $review_id), '', '', true);
	    $status = ($trip_review->status) ? array('status' => 0) : array('status' => 1);
	    set_flash('msg', 'Review status changed');
	    $this->common_model->update('tbl_reviews', $status, array('id' => $review_id));
	    redirect('admin/review');
    }
}