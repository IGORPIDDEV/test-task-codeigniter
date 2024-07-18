<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

    public function get_all_items() {
		$this->db->select('items.*, categories.name as category_name');
        $this->db->from('items');
        $this->db->join('categories', 'categories.id = items.category_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

	public function get_item($id) {
        $this->db->select('items.*, categories.name as category_name');
        $this->db->from('items');
        $this->db->join('categories', 'categories.id = items.category_id', 'left');
        $this->db->where('items.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_item($data) {
        $this->db->insert('items', $data);
		return $this->db->insert_id();
    }

    public function delete_item($id) {
        return $this->db->delete('items', array('id' => $id));
    }

    public function update_status($id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        return $this->db->update('items');
    }

    public function filter_items($category_id, $status) {
		$this->db->select('items.*, categories.name as category_name');
		$this->db->from('items');
		$this->db->join('categories', 'categories.id = items.category_id', 'left');
	
		if ($category_id) {
			$this->db->where('items.category_id', $category_id);
		}
		if ($status !== '') {
			$this->db->where('items.status', $status);
		}
	
		$query = $this->db->get();
		return $query->result();
	}
}
