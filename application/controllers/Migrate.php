<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Migrate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        is_cli()
        or exit("Execute via command line: php index.php migrate");

        $this->load->library('migration');
    }

    public function index()
    {
        if(!$this->migration->latest())
        {
            show_error($this->migration->error_string());
        }
    }
}
