<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of whyTravelWithUs
 *
 * @author dinesubedi
 */
class whyTravelWithUs extends CI_Controller {
    
    function __construct()
    {
        parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }
    
    function index() {
	
	$data['whyUsList'] = $this->common_model->get_all('tbl_why_us', '', 'id DESC');
	
	$data['main_content'] = 'admin/whyUs/index';
        $data['sub_content'] = 'admin/whyUs/_list';
        $this->load->view(BACKEND, $data);
    }
    
    function addUpdate() {
	
	if($_POST){
	    
	    if($this->input->post('id')!=NULL){
		
		$this->common_model->updateN('tbl_why_us', $_POST, array('id'=>$this->input->post('id')));
		set_flash('msg', 'Why Us updated');
		redirect('admin/why-travel-with-us');
		
	    } else {
	
		$post = $_POST;
		$this->common_model->insert('tbl_why_us', $_POST);
		set_flash('msg', 'Why Us saved');
		redirect('admin/why-travel-with-us');
	    }
	}
	
	$data['main_content'] = 'admin/whyUs/index';
        $data['sub_content'] = 'admin/whyUs/_form';
        $this->load->view(BACKEND, $data);
    }
    
    function delete($id) {
	
	$this->common_model->delete_data('tbl_why_us', array('id' => $id));
        set_flash('msg', 'Why Us Data deleted');
        redirect('admin/why-travel-with-us');
    }
    
    function edit($id) {
	
	$data["dataToEdit"] = $this->common_model->getWhere('tbl_why_us',array('id' => $id));
        $data['sub_content'] = 'admin/whyUs/_form';
        $data['main_content'] = 'admin/whyUs/index';
        $this->load->view(BACKEND, $data);
	
	
//	$this->common_model->delete_data('tbl_why_us', array('id' => $id));
//        set_flash('msg', 'Trip deleted');
//        redirect('admin/why-travel-with-us');
    }
    
    
    
}
