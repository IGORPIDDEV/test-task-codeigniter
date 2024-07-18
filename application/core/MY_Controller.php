<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $di;

    public function __construct() {
        parent::__construct();
        $this->di = $this->load->library('service_container');
    }
}
