<?php
class Category_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAll() {
        $query = $this->db->get('category');
        return $query->result_array();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('category');
    }

    public function update($id, $name) {
        $data = array('category' => $name);
        $this->db->where('id', $id);
        return $this->db->update('category', $data);
    }
}
