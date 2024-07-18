<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MY_Controller {

    protected $item_service;
    protected $category_service;

    public function __construct() {
        parent::__construct();
        $this->load->library('service_container');
        $this->item_service = $this->service_container->get('item_service');
        $this->category_service = $this->service_container->get('category_service');
    }

    public function index() {
        $data['items'] = $this->item_service->get_all_items();
        $data['categories'] = $this->category_service->get_all_categories();
        $this->load->view('items/index', $data);
    }

    public function add() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'errors' => validation_errors()]);
        } else {
            try {
                $data = [
                    'name' => $this->input->post('name'),
                    'category_id' => $this->input->post('category_id')
                ];
                $item_id = $this->item_service->add_item($data);
				$item = $this->item_service->get_item($item_id);

				$new_item_html = $this->load->view('components/cards/item_card', ['item' => $item], true);
        		echo json_encode(['status' => true, 'new_item_html' => $new_item_html]);
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                echo json_encode(['status' => false, 'message' => 'An error occurred while adding the item.']);
            }
        }
    }

    public function delete($id) {
        try {
            $this->item_service->delete_item($id);
            echo json_encode(['status' => true]);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'An error occurred while deleting the item.']);
        }
    }

    public function update_status($id) {
        $status = $this->input->post('status');

        try {
            $this->item_service->update_status($id, $status);
            echo json_encode(['status' => true]);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            echo json_encode(['status' => false, 'message' => 'An error occurred while updating the status.']);
        }
    }

    public function filter() {
		$category_id = $this->input->post('category_id');
		$status = $this->input->post('status');
	
		try {
			if ($category_id === '' && $status === '') {
				$data['items'] = $this->item_service->get_all_items();
			} else {
				$data['items'] = $this->item_service->filter_items($category_id, $status);
			}
			$items_html = $this->load->view('items/list', $data, true);
			echo $items_html;
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			echo json_encode(['status' => false, 'message' => 'An error occurred while filtering items.']);
		}
	}
}
