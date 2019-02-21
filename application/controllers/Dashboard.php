<?php 
class Dashboard extends CI_Controller{
    public function __construct() {
        parent::__construct();
$this->load->library('session');
$this->load->model('M_dashboard');

if($this->session->userdata('username') == NULL && $this->session->userdata('status') == NULL  && $this->session->userdata('level') == NULL && $this->session->userdata('nama_lengkap') == NULL && $this->session->userdata('username') == NULL){
redirect(base_url('Login'));
}else if($this->session->userdata('status') != 'Aktif'){
redirect(base_url('Login'));
}
        
} 


public function index(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_new_client');
} 

public function keluar(){
    $this->session->sess_destroy();
redirect (base_url('Login'));
}

public function setting(){
$user = $this->M_dashboard->data_user();

$this->load->view('umum/V_header');
$this->load->view('dashboard/V_setting',['user'=>$user]);
}

public function simpan_jenis_dokumen(){
if($this->input->post()){

echo print_r($this->input->post());

}else{
redirect(404);    
}
}

public function simpan_user(){
if($this->input->post()){
$input = $this->input->post();

    
$jumlah_user        = $this->M_dashboard->data_user()->num_rows()+1;
$angka              = 4;
$no_user            = str_pad($jumlah_user, $angka ,"0",STR_PAD_LEFT);

$data = array(
'no_user'      => $no_user,  
'username'     => $input['username'],  
'nama_lengkap' => $input['nama_lengkap'],
'level'        => $input['level'],
'status'       => $input['status'],
'password'     => md5($input['password'])
);
$this->M_dashboard->simpan_user($data);

$status = array(
"status"=>"Berhasil"
);
echo json_encode($status);
}else{
redirect(404);    
}
}
public function getUser(){
if($this->input->post()){
$query = $this->M_dashboard->ambil_user($this->input->post('id_user'))->row_array();


echo json_encode($query);
}else{
redirect(404);    
}   
}

public function update_user(){
if($this->input->post()){
$input = $this->input->post();

$data = array(
'username'      => $input['username'],
'nama_lengkap'  => $input['nama_lengkap'],
'level'         => $input['level'],
'status'        => $input['status'],        
);

$this->M_dashboard->update_user($data,$this->input->post('id_user'));
$status = array(
"status"=>"Berhasil"
 );
echo json_encode($status);
}else{
redirect(404);    
}
}
    
}
