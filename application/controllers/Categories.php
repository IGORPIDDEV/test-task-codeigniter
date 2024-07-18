<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

    protected $category_service;

    public function __construct() {
        parent::__construct();
        $this->load->library('service_container');
        $this->category_service = $this->service_container->get('category_service');
    }

    public function index() {
        $data['categories'] = $this->category_service->get_all_categories();
        $this->load->view('categories/index', $data);
    }

    public function add() {
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'errors' => validation_errors()]);
        } else {
            try {
                $category_name = $this->input->post('category_name');
                $category_id = $this->category_service->add_category([
					'name' => $category_name
				]);
				
                echo json_encode(['status' => true, 'category' => ['id' => $category_id, 'name' => $category_name]]);
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                echo json_encode(['status' => false, 'message' => 'An error occurred while adding the category.']);
            }
        }
    }

    public function delete($id) {
        try {
            $this->category_service->delete_category($id);
            echo json_encode(['status' => true]);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'An error occurred while deleting the category.']);
        }
    }

    public function update($id) {
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'errors' => validation_errors()]);
        } else {
            try {
                $category_name = $this->input->post('category_name');
                $this->category_service->update_category($id, $category_name);

                echo json_encode(['status' => true]);
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                echo json_encode(['status' => false, 'message' => 'An error occurred while updating the category.']);
            }
        }
    }
}
