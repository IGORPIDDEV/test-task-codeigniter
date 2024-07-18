<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_container {

    protected $services = [];
    protected $services_list = [
        'item_service' => ['model' => 'Item_model', 'class' => 'Item_service'],
        'category_service' => ['model' => 'Category_model', 'class' => 'Category_service'],
    ];

    public function get($service) {
        if (!isset($this->services[$service])) {
            $this->services[$service] = $this->create_service($service);
        }
        return $this->services[$service];
    }

    protected function create_service($service) {
        if (!isset($this->services_list[$service])) {
            throw new Exception("Service not found: " . $service);
        }

        $ci =& get_instance();
        $service_config = $this->services_list[$service];

        $ci->load->model($service_config['model']);
        $ci->load->library('service_container');
        require_once(APPPATH . 'services/' . $service_config['class'] . '.php');
        return new $service_config['class']($ci->{$service_config['model']});
    }
}
