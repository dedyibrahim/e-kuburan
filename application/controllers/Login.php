<?php
class Login extends CI_Controller{

public function __construct() {
parent::__construct();
$this->load->library('Session');      
$this->load->model('M_proses_login');


if($this->session->userdata('username')){
redirect(base_url('Menu'));
}


}

public function index(){   
$this->load->view('umum/V_header');    
$this->load->view('V_login');
}

public function proses_login(){
if($this->input->post()){
$data = $this->input->post();
$query = $this->M_proses_login->proses_login($data['username']);

$data_sesi = $query->row_array();
$password   = $this->input->post('password');
$hash       = $data_sesi['password'];
if(password_verify($password,$hash)){

$sesi = array(
'nama_depan'    => $data_sesi['nama_depan'],    
'nama_belakang' => $data_sesi['nama_belakang'],    
'level'         => $data_sesi['level'],
);    
  
$this->session->set_userdata($sesi);

$status = array(
'status'    =>'success',
'message'   =>'Login berhasil'
);

}else{
$status = array(
'status'    =>'error',
'message'   =>'Username atau password salah'
);
}

echo json_encode($status);

/*if($query->num_rows() > 0){

$set_sesi = array(
'no_user'       => $data_sesi['no_user'],
'username'      => $data_sesi['username'],
'nama_lengkap'  => $data_sesi['nama_lengkap'],
'level'         => $data_sesi['level'],
'status'        => $data_sesi['status'],
);
$this->session->set_userdata($set_sesi);

$status = array(
"status"   => "Berhasil",
"level"    => $data_sesi['level'],    
);
echo json_encode($status);


}else{
$status = array(
"status"=>"success",
"message"=>"Login berhasil"    
);
echo json_encode($status);
}*/


}else{
redirect(404);	
}


}

}

