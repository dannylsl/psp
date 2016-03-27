<?php
class Pagenavi_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function category2url($category) {
        $base = "index.php/display/category/".$category;
        return $base;
    }

    public function add($data) {
        if($data['type'] == 'category') {
            $data['url'] = $this->category2url($data['category']);
        }
        if($this->db->insert('navibar',$data)) {
            $data['ret'] = $this->db->insert_id();
        } else {
            $data['ret'] = 0;
        };
        return $data;
    }

    public function update($data) {

        if($data['type'] == 'category') {
            $data['url'] = $this->category2url($data['category']);
        }

        $this->db->where("id",$data['id']);
        if($this->db->update('navibar', $data)) {
            $data['ret'] = $this->db->affected_rows();
        }else{
            $data['ret'] = 0;
        }

        return $data;
    }

    public function getAll() {
        $query = $this->db->get('navibar');
        return $query->result_array();
    }

    public function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('navibar');
        return $query->row();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('navibar');
    }

}
