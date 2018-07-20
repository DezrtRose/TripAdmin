<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends MY_Controller {
    function __construct()
    {
        parent:: __construct();
        if(!check_user()) {
            redirect('admin/');
        }
    }

    function index($offset = '')
    {
	    ($this->session->userdata('trip_data')) ? $this->session->unset_userdata('trip_data') : '';
	    $admin = isset($_GET['query']) && $_GET['query'] != '' ? $this->common_model->get_like('tbl_trips', array('name' => $_GET['query'])) : $this->common_model->get_all('tbl_trips', '', 'id DESC');
	
        $this->load->library('pagination');
	    $per_page = 10;
	    $pagination_query = [];
        if(isset($_GET['per_page'])) {
	        $per_page = $_GET['per_page'];
	        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
	        $config['first_url'] = base_url('admin/trip').'?'.http_build_query($_GET);
	        $pagination_query = array('name' => $_GET['query']);
        }
        $config['base_url'] = base_url('admin/trip');
        $config['total_rows'] = count($admin);
        $config['uri_segment'] = '3';
        $config['num_links'] = '5';
        $config['per_page'] = $per_page;
	    $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);

        $data['admins'] = $this->common_model->get_pagination('tbl_trips', $offset, $config['per_page'], 'id DESC', '', '', '', '', '', $pagination_query);
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/trip/index';
        $data['sub_content'] = 'admin/trip/_trips';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $id = segment(4);
        if($_POST) {
            if(isset($_POST['slider'])) $this->add_slider();
            $post = $_POST;
            $discount_rate = $post['discount'] ? $post['discount'] : false;
	        unset($post['discount']);
	        if(isset($post['slug']) && (($id == '' && $this->common_model->get_where('tbl_trips', array('slug' => $post['slug']))) || ($this->common_model->get_where('tbl_trips', array('slug' => $post['slug'], 'id !=' => $id))))) {
		        $this->session->set_userdata(array('trip_data' => $post));
		        set_flash('msg', 'Duplicate slug not allowed.');
		        $id == '' ? redirect('admin/trip/add_update') : redirect('admin/trip/add_update/' . $id);
	        }
            if(isset($_POST['iti_day'])){
                $itinerary = [];
                foreach ($_POST['iti_day'] as $key => $value) {
                    if($_POST['iti_day'][$key]){
                        $itinerary[$key]['day'] = $_POST['iti_day'][$key];
                        $itinerary[$key]['title'] = $_POST['iti_title'][$key];
                        $itinerary[$key]['description'] = $_POST['iti_description'][$key];
                    }
                }
                unset($post['iti_day']);
                unset($post['iti_title']);
                unset($post['iti_description']);
                $post['itinerary'] = json_encode($itinerary);
            }
            $config = array(
                'field' => 'slug',
                'title' => 'name',
                'table' => 'tbl_trips',
                'id' => 'id',
            );

            //print_r($_FILES);

            if(isset($_FILES['img'])){
                $image = $_FILES['img'];
                if (!empty($image['name'])) {
                    if($id != '') {
                        $map_img = $this->common_model->get_where('tbl_trips', array('id' => $id));
                        $url = 'images/maps/'.$map_img[0]['image'];
                        if(file_exists($url))
                            unlink($url);
                    }
                    $files_data = $this->common_library->upload_image('img', 'images/maps/', 'map' . time());
                    $image_name = $files_data['filename'];
                    $post['map'] = $image_name;
                }
            }

            if(isset($_FILES['pdf_file'])){
                $pdf_file = $_FILES['pdf_file'];
                if (!empty($pdf_file['name'])) {
                    if($id != '') {
                        $pdf = $this->common_model->get_where('tbl_trips', array('id' => $id));
                        $url = 'pdf/'.$pdf[0]['pdf_file'];
                        if(file_exists($url))
                            unlink($url);
                    }
                    $files_data = $this->common_library->upload_image('pdf_file', 'pdf/', 'pdf-itinerary-' . time());
                    $pdf_name = $files_data['filename'];
                    $post['pdf_file'] = $pdf_name;
                }
            }

            if(isset($post['similar']))
                $post['similar'] = implode(',', $post['similar']);
            $this->load->library('Slug', $config);

            if($id == '') {
                $post['slug'] = $this->slug->create_uri($post);

                if(isset($post['act_id'])){                
                    if($temp_act_ids = $post['act_id']){
                        unset($post['act_id']);
                    }
                }

                $id = $this->common_model->insert('tbl_trips', $post, true);

                if(isset($temp_act_ids) && $temp_act_ids){
                        $this->common_model->delete_data('tbl_trip_activity', array('trip_id' => $id));
                        foreach ($temp_act_ids as $act_id) {
                            $this->common_model->insert('tbl_trip_activity',array("trip_id"=>$id, 'act_id'=>$act_id));
                        }
                }

            } else {

                if(isset($post['act_id'])){
                    if($temp_act_ids = $post['act_id']){
                        unset($post['act_id']);
                    }
                }

                $this->common_model->update('tbl_trips', $post,array('id'=>$id));

                if(isset($temp_act_ids) && $temp_act_ids){

                        $this->common_model->delete_data('tbl_trip_activity', array('trip_id' => $id));
                        foreach ($temp_act_ids as $act_id) {
                            $this->common_model->insert('tbl_trip_activity',array("trip_id"=>$id, 'act_id'=>$act_id));
                        }
                }
            }

            if($discount_rate) {
		        $old_discount = $this->common_model->getWhere('tbl_trip_discount', array('trip_id' => $id));
		        if($old_discount) {
			        $discount_data = array(
				        'discount' => $discount_rate
			        );
			        $this->common_model->update('tbl_trip_discount', $discount_data, array('id' => $id));
		        } else {
			        $discount_data = array(
				        'trip_id' => $id,
				        'discount' => $discount_rate
			        );
			        $this->common_model->insert('tbl_trip_discount', $discount_data);
		        }
	        }
	        
            set_flash('msg', 'Trip saved');
            redirect("admin/trip/add_update/$id");
        } else {
            $data = array(
                'main_content' => 'admin/trip/index',
                'sub_content' => 'admin/trip/_form',
            );

            if($id != '') {
                $data['trip'] = $this->common_model->get_where('tbl_trips', array('id' => $id));
            }

            $this->load->view(BACKEND, $data);

        }

    }



    function add_slider(){

        $post = $_POST;
        $tripId = $post['trip_id'];
        $trip_image = $_FILES['photo'];
        // in case we need to update slider
        $id = $post['slider_id'];
        unset($post['slider_id']);

        $trip_data = $this->common_model->get_where('tbl_trips', array('id' => $tripId));
        if (!empty($trip_image['name'])) {
            if($id != '') {
                $trip = $this->common_model->get_where('tbl_trip_slider', array('id' => $id));
                $url = 'images/trip/'.$trip[0]['image'];
                if(file_exists($url))
                    unlink($url);
            }

            $files_data = $this->common_library->upload_image('photo', 'images/trip/', url_title($trip_data[0]['name'], '-', true) . '-' . time());
            $image_name = $files_data['filename'];
            $post['image'] = $image_name;
        }

        if($id == '') {
            $this->common_model->insert('tbl_trip_slider', $post, true);
        } else {
            $this->common_model->update('tbl_trip_slider', $post, array('id' => $id));
        }
        set_flash('msg', 'Saved successfully');
        redirect("admin/trip/add_update/{$tripId}");
    }

    function delete_slider()
    {
        $id = segment(4);
        $trip = $this->common_model->get_where('tbl_trip_slider', array('id' => $id));
        $url = 'images/trip/'.$trip[0]['image'];
        if(file_exists($url))
            unlink($url);
        $this->common_model->delete_data('tbl_trip_slider', array('id' => $id));
        set_flash('msg', 'Deleted successfully');

        $tripId = $trip[0]['trip_id'];

        redirect("admin/trip/add_update/{$tripId}");
    }

    function edit_slider()
    {
        $id = segment(4);
        $trip_slider = $this->common_model->get_where('tbl_trip_slider', array('id' => $id));
        echo json_encode($trip_slider[0]);
    }



    function make_primary()

    {
        $post = explode('_', $_POST['id']);
        $trip_id = $_POST['trip_id'];
        $id = $post[0];
        $status = ($post[1] == 0) ? 1 : 0;
        $this->common_model->update('tbl_trip_slider', array('primary' => 0), array('trip_id' => $trip_id));
        $this->common_model->update('tbl_trip_slider', array('primary' => $status), array('id' => $id));
        echo true;
    }



    function change_status()

    {
        $post = explode('_', $_POST['id']);
        $id = $post[0];
        $status = ($post[1] == 0) ? 1 : 0;
        $this->common_model->update('tbl_trips', array('featured' => $status), array('id' => $id));
        echo true;
    }



    function delete()

    {
        $id = segment(4);
        $this->common_model->delete_data('tbl_trips', array('id' => $id));
        $this->common_model->delete_data('tbl_trip_slider', array('trip_id' => $id));
        set_flash('msg', 'Trip deleted');
        redirect('admin/trip');
    }

    function status()
    {
    	$trip_id = segment(4);
	    $trip = $this->common_model->get_where('tbl_trips', array('id' => $trip_id), '', '', true);
	    $status = ($trip->status) ? array('status' => 0) : array('status' => 1);
	    $this->common_model->update('tbl_trips', $status, array('id' => $trip_id));
	    set_flash('msg', 'Trip status changed');
	    redirect('admin/trip');
    }

}