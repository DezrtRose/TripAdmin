<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {
    function __construct()
    {
        parent::__construct();
	    $this->load->library('form_validation');
    }

    function _remap($method)
    {
        $param_offset = 2;

        // Default to index
        if (!method_exists($this, $method)) {
            // We need one more param
            $param_offset = 1;
            $method = 'index';
        }

        // Since all we get is $method, load up everything else in the URI
        $params = array_slice($this->uri->rsegment_array(), $param_offset);

        // Call the determined method with all params
        call_user_func_array(array($this, $method), $params);
    }

    function index()
    {
        $slug = segment(1);
        $data['page'] = $this->common_model->get_where('tbl_pages', array('slug' => $slug));
        $data['sub_content'] = 'frontend/page/_detail';
        if($data['page'] || $slug == 'contact-us' || $slug == 'our-team') {
            $data['main_content'] = 'frontend/page/index';
            if($slug == 'contact-us') {
                $data['sub_content'] = 'frontend/page/contact_us';
            } elseif($slug == 'our-team') {
	            $data['members'] = $this->common_model->get_all('tbl_team', '', 'order asc');
	            $data['sub_content'] = 'frontend/page/our_team';
            } else {
	            $data['metatitle'] = $data['page'][0]['seo_title'] != '' ? $data['page'][0]['seo_title'] : $data['page'][0]['name'];
	            $data['metadescription'] = $data['page'][0]['seo_description'];
	            $data['metakeyword'] = $data['page'][0]['seo_keyword'];
	            $data['og_image'] = $data['page'][0]['seo_image'] != '' ? base_url($data['page'][0]['seo_image']) : '';
	            $data['canonical_url']   = $data['page'][0]['canonical_url'];
            }
            $this->load->view(FRONTEND, $data);
        } else {
            $data['main_content'] = 'frontend/404';
            $this->load->view(FRONTEND, $data);
        }
    }

    function contact()
    {
        if($_POST) {
            $post = $_POST;
	        $config = array(
		        array(
			        'field' => 'first_name',
			        'label' => 'First Name',
			        'rules' => 'required'
		        ),
		        array(
			        'field' => 'email',
			        'label' => 'Email',
			        'rules' => 'required|valid_email'
		        ),
		        array(
			        'field' => 'message',
			        'label' => 'Message',
			        'rules' => 'required'
		        ),
	        );
	        $this->form_validation->set_rules($config);
	        $recaptcha_verification = verify_captcha($post['g-recaptcha-response']);
	        if($this->form_validation->run() == FALSE || !$recaptcha_verification['success']) {
		        if(!$recaptcha_verification['success']) set_flash('msg', 'Captcha error. Please try again.');
	        	$data['main_content'] = 'frontend/page/index';
		        $data['sub_content'] = 'frontend/page/contact_us';
		        $this->load->view(FRONTEND, $data);
	        } else {
		        $msgadmin = $this->load->view('email/admin_contact', $post, true);
		        $msgcust = $this->load->view('email/cust_confirm', $post, true);
		        $param = array(
			        'from' => array($post['email'] => $post['first_name']),
			        'subject' => 'Enquiry Received',
			        'reply' => array($post['email'] => $post['first_name']),
			        'recipients' => array(SITE_EMAIL),
			        'msg' => $msgadmin
		        );
		        if(swiftsend($param)) {
			        $param = array(
				        'from' => array(SITE_REPLY_TO_EMAIL => SITE_NAME),
				        'subject' => 'Enquiry Received',
				        'reply' => array(SITE_REPLY_TO_EMAIL => SITE_NAME),
				        'recipients' => array($post['email']),
				        'msg' => $msgcust
			        );
			        swiftsend($param);
		        }
		        set_flash('msg', 'Thank you for contacting. We will get back to you soon.');
		        redirect('contact-us');
	        }
        }
    }

    function ask_expert()
    {
	    $post = $_POST;
	    $config = array(
		    array(
			    'field' => 'first_name',
			    'label' => 'First Name',
			    'rules' => 'required'
		    ),
		    array(
			    'field' => 'last_name',
			    'label' => 'Last Name',
			    'rules' => 'required'
		    ),
		    array(
			    'field' => 'email',
			    'label' => 'Email',
			    'rules' => 'required|valid_email'
		    ),
		    array(
			    'field' => 'msg',
			    'label' => 'Message',
			    'rules' => 'required'
		    ),
	    );
	    $this->form_validation->set_rules($config);
	    $recaptcha_verification = verify_captcha($post['g-recaptcha-response']);
	    if($this->form_validation->run() == FALSE || !$recaptcha_verification['success']) {
		    echo (!$recaptcha_verification['success']) ? json_encode(array('status' => 'error', 'msg' => 'Captcha error. Please try again.')) : json_encode(array('status' => 'error', 'msg' => validation_errors()));
	    } else {
		    $msgadmin = $this->load->view('email/admin_ask_expert', $post, true);
		    $msgcust = $this->load->view('email/cust_confirm', $post, true);
		    $param = array(
			    'from' => array($post['email'] => $post['first_name']),
			    'subject' => 'Enquiry Received',
			    'reply' => array($post['email'] => $post['first_name']),
//			    'recipients' => array('satshanker.01@gmail.com'),
			    'recipients' => array(SITE_EMAIL),
			    'msg' => $msgadmin
		    );
		    if(swiftsend($param)) {
			    $param = array(
				    'from' => array(SITE_REPLY_TO_EMAIL => SITE_NAME),
				    'subject' => 'Enquiry Received',
				    'reply' => array(SITE_REPLY_TO_EMAIL => SITE_NAME),
//				    'recipients' => array('satshanker.01@gmail.com'),
				    'recipients' => array($post['email']),
				    'msg' => $msgcust
			    );
			    swiftsend($param);
		    }
		    echo json_encode(array('status' => 'success', 'msg' => 'Thank you for contacting us. We will get back to you soon.'));
	    }
    }

    function send_to_friend()
    {
	    $post = $_POST;
	    $config = array(
		    array(
			    'field' => 'sender_name',
			    'label' => 'Your name',
			    'rules' => 'required'
		    ),
		    array(
			    'field' => 'sender_email',
			    'label' => 'Your email address',
			    'rules' => 'required|valid_email'
		    ),
		    array(
			    'field' => 'receiver_name',
			    'label' => 'Friend\'s name',
			    'rules' => 'required'
		    ),
		    array(
			    'field' => 'receiver_email',
			    'label' => 'Friend\'s email',
			    'rules' => 'required|valid_email'
		    ),
		    array(
			    'field' => 'subject',
			    'label' => 'Subject',
			    'rules' => 'required'
		    ),
		    array(
			    'field' => 'personal_msg',
			    'label' => 'Message',
			    'rules' => 'required'
		    ),
	    );
	    $this->form_validation->set_rules($config);
	    $recaptcha_verification = verify_captcha($post['g-recaptcha-response']);
	    if($this->form_validation->run() == FALSE || !$recaptcha_verification['success']) {
		    echo (!$recaptcha_verification['success']) ? json_encode(array('status' => 'error', 'msg' => 'Captcha error. Please try again.')) : json_encode(array('status' => 'error', 'msg' => validation_errors()));
	    } else {
		    $msg = $this->load->view('email/send_to_friend', $post, true);
		    $param = array(
			    'from' => array($post['sender_email'] => $post['sender_name']),
			    'subject' => $post['subject'],
			    'reply' => array($post['sender_email'] => $post['sender_name']),
//			    'recipients' => array('satshanker.01@gmail.com'),
			    'recipients' => array($post['receiver_email']),
			    'msg' => $msg
		    );
		    swiftsend($param);
		    echo json_encode(array('status' => 'success', 'msg' => 'Message has been sent to your friend.'));
	    }
    }
}