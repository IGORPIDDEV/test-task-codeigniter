<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_service {

    protected $category_model;

    public function __construct($category_model) {
        $this->category_model = $category_model;
    }

    public function get_all_categories() {
        return $this->category_model->get_all_categories();
    }

    public function get_category($id) {
        return $this->category_model->get_category($id);
    }

    public function add_category($data) {
        return $this->category_model->insert_category($data);
    }

    public function update_category($id, $data) {
        return $this->category_model->update_category($id, $data);
    }

    public function delete_category($id) {
        return $this->category_model->delete_category($id);
    }
}
