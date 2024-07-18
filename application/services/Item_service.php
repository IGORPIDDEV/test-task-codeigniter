<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_service {

    protected $item_model;

    public function __construct($item_model) {
        $this->item_model = $item_model;
    }

    public function get_all_items() {
        return $this->item_model->get_all_items();
    }

	public function get_item($id) {
        return $this->item_model->get_item($id);
    }

    public function add_item($data) {
        return $this->item_model->insert_item($data);
    }

    public function delete_item($id) {
        return $this->item_model->delete_item($id);
    }

    public function update_status($id, $status) {
        return $this->item_model->update_status($id, $status);
    }

    public function filter_items($category_id, $status) {
        return $this->item_model->filter_items($category_id, $status);
    }
}
