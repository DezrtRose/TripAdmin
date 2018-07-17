<?php
class Testimonial extends CI_Controller
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
        $testimonial = $this->common_model->get_all('tbl_testimonial', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/testimonial');
        $config['total_rows'] = count($testimonial);
        $config['uri_segment'] = '3';
        $config['num_links'] = '1';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['testimonials'] = $this->common_model->get_pagination('tbl_testimonial', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/testimonial/index';
        $data['sub_content'] = 'admin/testimonial/_testimonials';
        $this->load->view(BACKEND, $data);
    }

    function add_update()
    {
        $testimonial_id = segment(4);
        if($_POST) {
            $post = $_POST;
            if($testimonial_id == '') {
                $this->common_model->insert('tbl_testimonial', $post);
            } else {
                $this->common_model->update('tbl_testimonial', $post, array('id' => $testimonial_id));
            }
            set_flash('msg', 'Testimonial saved');
            redirect('admin/testimonial');
        } else {
            $data = array(
                'main_content' => 'admin/testimonial/index',
                'sub_content' => 'admin/testimonial/_form',
            );
            if($testimonial_id != '') {
                $data['testimonial'] = $this->common_model->get_where('tbl_testimonial', array('id' => $testimonial_id));
            }
            $this->load->view(BACKEND, $data);
        }
    }

    function delete_testimonial($id = '')
    {
        $this->common_model->delete_data('tbl_testimonial', array('id' => $id));
        set_flash('msg', 'Testimonial deleted');
        redirect('admin/testimonial');
    }

    function testimonial_detail()
    {
        $id = segment(4);
        $data = $this->common_model->get_where('tbl_testimonial', array('id' => $id));
        $modal = $this->load->view('admin/testimonial/_details', $data[0], true);
        echo $modal;
    }

    function approve($id = '')
    {
        $this->common_model->update('tbl_testimonial', array('approved' => 1),array('id' => $id));
        set_flash('msg', 'Testimonial approved');
        redirect('admin/testimonial');
    }

    function disapprove($id = '')
    {
        $this->common_model->update('tbl_testimonial', array('approved' => 0),array('id' => $id));
        set_flash('msg', 'Testimonial disapproved');
        redirect('admin/testimonial');
    }
}