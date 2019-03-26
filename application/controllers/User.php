<?php
class user extends CI_Controller{
    
public function __construct() {
    parent::__construct();
$this->load->helper('download');
$this->load->library('session');
$this->load->model('M_dashboard');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');

if($this->session->userdata('username') == NULL && $this->session->userdata('status') == NULL  && $this->session->userdata('level') == NULL && $this->session->userdata('nama_lengkap') == NULL && $this->session->userdata('username') == NULL){
redirect(base_url('Login'));
}else if($this->session->userdata('status') != 'Aktif' &&  $this->session->userdata('level') != 'User'){
redirect(base_url('Login'));
}    
    
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('user/V_user');
    
}
 
public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}

    
}

