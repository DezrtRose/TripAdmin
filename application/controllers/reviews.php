<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if($_POST) {
            $post = $_POST;
            $this->common_model->insert('tbl_testimonial', $post);
            set_flash('msg', 'Thank you for your feedback.');
            redirect('reviews');
        } else {
            $data = array(
                'sub_content' => 'frontend/reviews/_reviews',
                'main_content' => 'frontend/reviews/index'
            );
            $this->load->view(FRONTEND, $data);
        }
    }
}