<?php
class Subscriber extends MY_Controller
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
        $subscriber = $this->common_model->get_all('tbl_subscribers', '', 'id DESC');

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/subscriber');
        $config['total_rows'] = count($subscriber);
        $config['uri_segment'] = '3';
        $config['num_links'] = '1';
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['subscribers'] = $this->common_model->get_pagination('tbl_subscribers', $offset, $config['per_page'], 'id DESC');
        $data['pagination'] = $this->pagination->create_links();
        $data['main_content'] = 'admin/subscriber/index';
        $data['sub_content'] = 'admin/subscriber/_subscribers';
        $this->load->view(BACKEND, $data);
    }
    
    function delete_subscriber($id = '')
    {
        $this->common_model->delete_data('tbl_subscribers', array('id' => $id));
        set_flash('msg', 'Subscriber deleted');
        redirect('admin/subscriber');
    }
}