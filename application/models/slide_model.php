<?php
class Slide_model extends CI_Model {

    private $table_name = 'slides';

    public function __construct() {
        $this->load->database();
    }

    private function data_check($data) {
        $list_no_empty = array( 'path'=>1,
            'text' => 0,
            'thumbnail' => 1,
            'url' => 0,
            'timestamp' => 0,
            'status' => 1
        );

        foreach($list_no_empty as $k=>$v) {
            if(1 == $v) {
                if(true == empty($data[$k])) {
                    return false;
                }
            }
        }
        return $data;
    }

    public function add($data) {
        $data = $this->data_check($data); 
        if($data == false) {
            return false;
        }

        if($this->db->insert($this->table_name,$data)) {
            return true;
        }else{
            return false;
        }
    }


    public function del($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_name);
    }

    public function getAll() {
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
}
