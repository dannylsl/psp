<?php
class Article_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    private function data_check($data) {
        $list_no_empty = array( 'title'=>1,
            'source' => '本站发布',
            'category' => 1,
            'content' => 1,
            'author' => 1,
            'date' => 1,
            'time' => 1,
            'status' => 1
        );

        foreach($list_no_empty as $k=>$v) {
            if(1 == $v) {
                if(true == empty($data[$k])) {
                    return false;
                }
            }else{
                $data[$k] = $v;
            }
        }
        return $data;
    }

    public function add($data) {
        $data == $this->data_check($data);

        if(false == $data) {
            return false;
        }

        if($this->db->insert('articles',$data)) {
            return true;
        }else{
            return false;
        }
    }
}
