<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

Class Statutory_controller extends Common{
    public function __construct() {
        parent::__construct();
        $this->load->model('Adminmodel');
        $this->load->model('Statutory_model');
    }
}
?>