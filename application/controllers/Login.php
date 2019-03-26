<?php
class Login extends CI_Controller{

public function __construct() {
parent::__construct();
$this->load->library('Session');      
$this->load->model('M_proses_login');

if($this->session->userdata('level' == "User")){
redirect(base_url('User'));
}elseif ($this->session->userdata('level') == "Admin" || $this->session->userdata('level') == "Super Admin") {
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
'no_user'       => $data_sesi['no_user'],
'username'      => $data_sesi['username'],
'nama_lengkap'  => $data_sesi['nama_lengkap'],
'level'         => $data_sesi['level'],
'status'        => $data_sesi['status'],
);
$this->session->set_userdata($set_sesi);

$status = array(
"status"=>"Berhasil",
"level" => $data_sesi['level'],    
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

