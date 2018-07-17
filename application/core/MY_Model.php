<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
    }

    public function create($myData)
    {
        $this->db->insert($this->table, $myData);

        return $this->db->insert_id();
    }

    public function update($myId, $myData)
    {
        $this->db->where('id', $myId);

        return $this->db->update($this->table, $myData);
    }

    public function delete($myId)
    {
        $this->db->where('id', $myId);

        return $this->db->delete($this->table);
    }

    public function find($field_value, $field_name = 'id')
    {
        return $this->db->select('*')
            ->from($this->table)
            ->where($field_name, $field_value)
            ->get()
            ->row();
    }

    public function first()
    {
        return $this->db->select('*')
            ->from($this->table)
            ->get()
            ->first_row();
    }

    public function all($array = null, $order = null)
    {
        $result = $this->db->from($this->table);

        if($order) {
            $this->db->order_by($order);
        }

        if($array) {
            $result = $result->get()->result_array();
        }else {
            $result = $result->get()->result();
        }
        return $result;
    }

    public function getWhere($condition)
    {
        $this->db->from($this->table);

        if($condition)
            $this->db->where($condition);

        return $this->db->get()->result();
    }

}