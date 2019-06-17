<?php

class Menu extends CI_Controller{
function __construct() {
parent::__construct();

if($this->session->userdata('username') == NULL && $this->session->userdata('status') == NULL  && $this->session->userdata('level') == NULL && $this->session->userdata('nama_lengkap') == NULL && $this->session->userdata('username') == NULL){
redirect(base_url('Login'));
}
}

public function index(){
$this->load->view('umum/V_header');    
$this->load->view('V_menu');    
}

public function check_akses(){
    
}


    
}
