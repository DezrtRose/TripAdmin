<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(check_user('current_user') && segment(2) != 'logout') {
            redirect('admin/dashboard');
        }
    }

    function index()
    {
        $this->load->view('admin/login');
    }

    function logout()
    {
        $this->session->unset_userdata(array('current_user' => '', 'username' => '', 'account_type' => ''));
        redirect('admin');
    }

    function login()
    {
        if($_POST) {
            $post = $_POST;
            if(strpos($post['username'], 'DRIVER') !== false) {
                redirect('driver/account/login?username='.$post['username'].'&password='.$post['password']);
            }
            $user = $this->common_model->get_where('tbl_admin', array('username' => $post['username'], 'password' => MD5($post['password'])));
            if($user) {
                $this->session->set_userdata(array(
                    'current_user' => $user[0]['id'],
                    'username' => $user[0]['username'],
                    'account_type' => $user[0]['type']
                ));
                redirect('admin/dashboard');
            } else {
                set_flash('msg', 'Incorrect username or password');
                redirect('admin');
            }
        }
    }
}