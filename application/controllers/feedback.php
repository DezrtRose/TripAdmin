<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if($_POST) {
            $post = $_POST;
            array_pop($post);
            $this->common_model->insert('tbl_testimonial', $post);
            set_flash('msg', 'Thank you for your feedback.');
            redirect('feedback');
        } else {
            $data = array(
                'sub_content' => 'frontend/feedback/_form',
                'main_content' => 'frontend/feedback/index'
            );
            $this->load->view(FRONTEND, $data);
        }
    }
}