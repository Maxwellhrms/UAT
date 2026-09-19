<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Common.php';
class Terms_and_conditions extends Common
{
    protected $imglink = 'uploads/';
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->load->view('termsandconditions');
    }
    
}
