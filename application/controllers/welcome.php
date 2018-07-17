<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('frontend/include/quote');
		//$this->load->view('welcome_message');
	}

    function subscriber()
    {
        if($_POST) {
            $post = $_POST;
            if($this->common_model->get_where('tbl_subscriber', array('email' => $post['email']))) {
                echo 0;die;
            }
            if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                echo 2;die;
            }
            $post['created_date'] = date('m/d/Y');
            $this->common_model->insert('tbl_subscriber', $post);
            echo 1;
        }
    }

    function _404()
    {
        $data['main_content'] = 'frontend/404';
        $this->load->view(FRONTEND, $data);
    }

    function thankyou()
    {
        $data['main_content'] = 'frontend/thankyou';
        $this->load->view(FRONTEND, $data);
    }

    function add_subscriber()
    {
        $post = $_POST;
        $email_check = $this->common_model->get_where('tbl_subscribers', array('email' => $post['email']));
        if(!$email_check) {
            $post['ip'] = $_SERVER['REMOTE_ADDR'];
            $this->common_model->insert('tbl_subscribers', $post);
            $return = '1';
        } else {
            $return = '2';
        }

        echo $return;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */