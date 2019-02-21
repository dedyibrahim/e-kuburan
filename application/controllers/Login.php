<?php
class Login extends CI_Controller{

public function __construct() {
parent::__construct();
$this->load->library('Session');      
$this->load->model('M_proses_login');

if($this->session->userdata('username') != NULL && $this->session->userdata('status') != NULL  && $this->session->userdata('level') != NULL && $this->session->userdata('nama_lengkap') != NULL && $this->session->userdata('username') != NULL){
redirect(base_url('Dashboard'));
}

}

public function index(){
$this->load->view('umum/V_header');    
$this->load->view('V_login');
}

public function proses_login(){
if($this->input->post()){
$data = $this->input->post();
$query = $this->M_proses_login->proses_login($data['username'],$data['password']);

$data_sesi = $query->row_array();

if($query->num_rows() > 0){

$set_sesi = array(
'username'      => $data_sesi['username'],
'nama_lengkap'  => $data_sesi['nama_lengkap'],
'level'         => $data_sesi['level'],
'status'        => $data_sesi['status'],
);
$this->session->set_userdata($set_sesi);

$status = array(
"status"=>"Berhasil"
);
echo json_encode($status);
}else{
$status = array(
"status"=>"Gagal"
);
echo json_encode($status);
}



}else{
redirect(404);	
}


}

}

