<?php



class Common_Model extends CI_Model

{

    public function get_parent_pages(){

        $this->db->select('*');
        $q=$this->db->get_where('tbl_page_config',array('is_active' => 1, 'parent_id' => 0));
        return $q->result_array();
    }



    public function insert($table_name, $data, $return_id = false) {   

        $q = $this->db->insert($table_name, $data);
        if($return_id)
            return $this->db->insert_id();
        return $q ? true : false;
    }



    public function get_all($table_name, $select_active = '', $order = '', $limit = '', $condition = '') {

        if($order != '') {
            $this->db->order_by($order);
        } else {
            $this->db->order_by('id', 'DESC');
        }
        if($limit != '') {
            $this->db->limit($limit);
        }
        if($select_active != '') {
            $this->db->where('is_active', '1');
        }
        if($condition != '')
            $this->db->where($condition);

        $q = $this->db->get($table_name);
        return ($q->num_rows() > 0) ? $q->result_array() : '';

    }

    public function get_PrimaryImg($table_name, $select_active = '', $condition = '', $order = '', $limit = '') {

        if($order != '') {
            $this->db->order_by($order);
        } else {
            $this->db->order_by('id', 'DESC');
        }
        if($limit != '') {
            $this->db->limit($limit);
        }
        if($select_active != '') {
            $this->db->where('primary', '1');
        }
        if($condition != '')
            $this->db->where($condition);

        $q = $this->db->get($table_name);
        return ($q->num_rows() > 0) ? $q->result_array() : '';

    }


    public function get_where($table_name, $condition, $order = '', $limit = '', $single = false) {

        if($order != '')
            $this->db->order_by($order);
        if($limit != '') {
            $this->db->limit($limit);
        }
        $q = $single ? $this->db->get_where($table_name, $condition)->row() : $this->db->get_where($table_name, $condition)->result_array();
        return (count($q) > 0) ? $q : '';
    }

    public function update($table_name, $data, $condition) {

        $this->db->where($condition);
        $q = $this->db->update($table_name, $data);
        return $q ? true : false;
    }


    
    public function updateN($tbl_name, $data, $id_update) {
        
        $this->load->database();
        
            $this->db->where($id_update);
        $this->db->update($tbl_name, $data);
    }

    public function delete_data($table_name, $condition) {

        $q = $this->db->delete($table_name, $condition);
        return $q ? true : false;
    }

    public function set_is_active($table_name, $id, $value) {

        $data = array(
            'is_active' => ($value == 0) ? 1 : 0
        );
        $this->db->where('id', $id);
        $this->db->update($table_name, $data);
        return;
    }

    function get_count($table_name, $condition = array()) {

        if(!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get($table_name)->num_rows();
    }
    
    function verify_email($table_name, $condition1 = array(), $condition2 = array()) {

        if(!empty($condition2)){
            $q = $this->db->get_where($table_name, $condition1)->num_rows();
            if($q == 0) {
                $q = $this->db->get_where($table_name, $condition2)->num_rows();
                $return = ($q == 0) ? 1 : 0;
            } else {
                $return = 1;
            }
        } else {
            $q = $this->db->get_where($table_name, $condition1)->num_rows();
            $return = ($q == 0) ? 1 : 0;
        }
        return $return;
    }
    
    function confirm_email($table_name, $hash) {

        $q = $this->db->get_where($table_name, array('SHA1(email)' => $hash));
        return $q->num_rows() == 1 ? $q->result_array() : false;
    }
    
    public function getAdminEmails(){

        $sql = "select contact_email1, contact_email2,contact_email3,contact_email4,contact_email5 from tbl_website_config where enable_notifications = 1";

        $query = $this->db->query($sql);

        $res = $query->result_array();

        return $res;

    }



    public function getCountries(){

        $sql = "select * from tbl_countries";

        $query = $this->db->query($sql);

        $res = $query->result_array();

        return $res;   

    }



    public function getCareType(){

        $sql = "select * from tbl_care";

        $query = $this->db->query($sql);

        $res = $query->result_array();

        return $res;

    }



    public function create_slug($fname,$mname,$lname){

        if(isset($mname) && $mname!=''){

            $uri = strtolower($fname).'-'.strtolower($mname).'-'.strtolower($lname);

            $sql = "select uri from tbl_user where uri = '$uri'";

            $q = $this->db->query($sql);

            $res = $q->num_rows();

            if($res > 1){  

                $uri = $uri.'-'.rand();

                return $uri;

            }else{

                return $uri;

            }

        }else{

            $uri = strtolower($fname).'-'.strtolower($lname);  

            $sql = "select uri from tbl_user where uri = '$uri'";

            $q = $this->db->query($sql);

            $res = $q->num_rows();

            if($res >= 1){

                $uri = $uri.'-'.rand();

                return $uri;

            }else{

                return $uri;

            }         

        }

    }



    public function getAllUserLogs($offset,$limit){

        $sql = "select * from tbl_user_logs limit $offset,$limit";

        $query = $this->db->query($sql);

        $res = $query->result_array();

        if($res) return $res;

        else return false;

    }



//    public function sendemail($email,$subject,$message){
//
//        $this->load->library('email');      
//
//        $this->email->from('info@frumcare.com', 'FRUMCARE');
//
//        $this->email->to($email);
//
//        $this->email->subject($subject);
//
//        $this->email->message($message);
//
//        $this->email->send();
//
//        
//
//        echo $this->email->print_debugger();
//
//    }



    public function getNextRecord($table_name,$cur_id){

        $sql = "SELECT id FROM $table_name WHERE id > $cur_id ORDER BY id LIMIT 1";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        if($res) return $res;

        else return false;

    }



      public function getPreviousRecord($table_name,$cur_id){

        $sql = "SELECT id FROM $table_name WHERE id < $cur_id ORDER BY id DESC LIMIT 1;";

        $query = $this->db->query($sql);

        $res = $query->row_array();

        if($res) return $res;

        else return false;

    }



    function get_pagination($table_name, $offset, $limit, $order = '', $condition = '', $where_in = false, $column = '', $list = '', $between = array(), $like = array())

    {

        if($order != '') {

            $this->db->order_by($order);

        }

        

        if($between){

            foreach ($between as $value) {

                $this->db->where($value);

            }

        }

        

        if($condition != '')

            $this->db->where($condition);

        if($where_in) {

            $this->db->where_in($column, $list);

        }

        if(!empty($like)) {
        	$this->db->like($like);
        }

        if($limit) {

            $this->db->offset($offset);

            $this->db->limit($limit);

        }

        return $this->db->get($table_name)->result_array();

    }



    function get_pagination_obj($table_name, $offset, $limit, $order = '', $condition = '', $where_in = false, $column = '', $list = '', $group = false)

    {

        if($order != '') {

            $this->db->order_by($order);

        }

        if($condition != '')

            $this->db->where($condition);

        if($where_in) {

            $this->db->where_in($column, $list);

        }

        $this->db->offset($offset);

        $this->db->limit($limit);

        if($group) {

            $this->db->group_by($group);

        }

        return $this->db->get($table_name)->result();

    }



    function get_where_in($table_name, $column, $list, $condition = '')

    {

        $this->db->where_in($column, $list);

        if($condition != '')

            $q = $this->db->get_where($table_name, $condition);

        else

            $q = $this->db->get($table_name);

        $r = $q->result_array();

        return $r ? $r : '';

    }



    function run_query($sql)

    {

        $q = $this->db->query($sql);

        return ($q->num_rows() > 0) ? $q->result_array() : '';

    }

    
    public function getWhere($tbl_name, $id) {
        $this->load->database();
        
            $this->db->where($id);
        $q = $this->db->get($tbl_name);
        $Res = $q->row();
        return $Res ;
    }
    
    
    function getWhereInOrder($table_name, $column, $list, $order = '') {

            if($order != '') {
                $this->db->order_by($order);
            }
            $this->db->where_in($column, $list);
        $q = $this->db->get($table_name);
        $Res = $q->result_array();
        return $Res ;
    }

    function get_like($table, $like)
    {
    	$this->db->like($like);
	    return $this->db->get($table)->result_array();
    }
    
    
}

