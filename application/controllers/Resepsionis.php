<?php 
class Resepsionis extends CI_Controller{
public function __construct() {
    parent::__construct();

  $this->load->helper('download');
$this->load->library('session');
$this->load->model('M_resepsionis');
$this->load->library('Datatables');
$this->load->library('upload');
if($this->session->userdata('sublevel') != 'Level 4'){
redirect(base_url('Menu'));
}  
}
public function riwayat_pekerjaan(){
$this->load->view('umum/V_header');
$this->load->view('resepsionis/V_riwayat_pekerjaan');
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('resepsionis/V_resepsionis');
    
}

public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}

public function profil(){
$no_user = $this->session->userdata('no_user');
$data_user = $this->M_resepsionis->data_user_where($no_user);
$this->load->view('umum/V_header');
$this->load->view('resepsionis/V_profil',['data_user'=>$data_user]);

}
public function set_toggled(){
if(!$this->session->userdata('toggled')){
$array = array(
'toggled' => 'Aktif',    
);
$this->session->set_userdata($array);    
}else{
unset($_SESSION['toggled']);   
}
echo print_r($this->session->userdata());
}

public function buku_tamu(){
$data_karyawan = $this->M_resepsionis->data_karyawan();    
$this->load->view('umum/V_header');
$this->load->view('resepsionis/V_buku_tamu',['data_karyawan'=>$data_karyawan]);
}
public function notaris_rekanan(){
$data_karyawan = $this->M_resepsionis->data_karyawan();    
$this->load->view('umum/V_header');
$this->load->view('resepsionis/V_notaris_rekanan',['data_karyawan'=>$data_karyawan]);
}

public function simpan_tamu(){
if($this->input->post()){
$input = $this->input->post();

$data = array(
'keperluan_dengan'  => $input['keperluan_dengan'],
'nomor_telepon'     => $input['nomor_telepon'],
'nama_klien'        => $input['nama_klien'],
'alasan_keperluan'  => $input['alasan_keperluan'],
'tanggal'           => date('Y/m/d H:i:s'),
'penginput'         => $this->session->userdata('nama_lengkap'),
'no_user_penginput'  => $this->session->userdata('no_user') 
);

$this->db->insert('data_buku_tamu',$data);


$status = array(
"status" => "success",
'pesan'  => 'Data Tamu berhasil disimpan'    
);

echo json_encode($status);

}else{
redirect(404);    
}    
    
}

public function simpan_notaris_rekanan(){
if($this->input->post()){
$input = $this->input->post();

$data = array(
'no_telpon'             => $input['no_telpon'],
'nama_notaris'          => $input['nama_notaris'],
'alamat'                => $input['alamat'],
'tanggal_input'         => date('Y/m/d H:i:s'),
'penginput'             => $this->session->userdata('nama_lengkap'),
'no_user_penginput'     => $this->session->userdata('no_user') 
);


$this->db->insert('data_notaris_rekanan',$data);


$status = array(
"status" => "success",
'pesan'  => 'Data Tamu berhasil disimpan'    
);

echo json_encode($status);

}else{
redirect(404);    
}    
    
}

public function json_data_tamu(){
echo $this->M_resepsionis->json_data_tamu();       
}

public function json_data_notaris_rekanan(){
echo $this->M_resepsionis->json_data_notaris_rekanan();       
}
    
}
