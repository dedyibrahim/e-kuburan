<?php
class User1 extends CI_Controller{
    
public function __construct() {
    parent::__construct();
$this->load->helper('download');
$this->load->library('session');
$this->load->model('M_user1');
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
$data_tugas = $this->M_user1->data_tugas('Masuk');    
    
$this->load->view('umum/V_header');
$this->load->view('user1/V_user1',['data_tugas'=>$data_tugas]);
    
}
 
public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}


public function proses_tugas(){
if($this->input->post()){
$data = array(
'tanggal_proses_tugas'  =>date('d/m/Y H:i:s'),
'target_kelar_perizinan' =>$this->input->post('target_kelar'),
'status_berkas'        =>'Proses'    
);
$this->db->update('data_syarat_jenis_dokumen',$data,array('id_syarat_dokumen'=>$this->input->post('id_syarat_dokumen')));

$status = array(
'status' =>"success",
'pesan'  =>"Dokumen masuk kedalam proses perizinan"    
);
echo json_encode($status);

}else{
redirect(404);    
}

}
public function halaman_proses(){
$data_tugas = $this->M_user1->data_tugas('Proses');    
$this->load->view('umum/V_header');
$this->load->view('user1/V_halaman_proses',['data_tugas'=>$data_tugas]);
}

public function halaman_selesai(){
$data_tugas = $this->M_user1->data_tugas('Selesai');    
    
$this->load->view('umum/V_header');
$this->load->view('user1/V_halaman_selesai',['data_tugas'=>$data_tugas]);
    
}
public function json_data_perizinan_selesai(){
echo $this->M_user1->json_data_perizinan_selesai();       
}

public function tampilkan_modal(){
if($this->input->post()){
    
$input = $this->input->post();

if($input['jenis_modal'] == 'tolak'){
echo "tolak";        
}else if($input['jenis_modal'] == 'alihkan'){
echo "alihkan";    
}
    
}else{
redirect(404);    
}
}

public function lihat_karyawan(){
$karyawan = $this->db->get_where('user',array('Level'=>'User','sublevel !=' =>'Level 1'));    
$this->load->view('umum/V_header');
$this->load->view('user1/V_lihat_karyawan',['karyawan'=>$karyawan]);    
}

public function lihat_pekerjaan(){
$no_user = base64_decode($this->uri->segment(3));
$sublevel = base64_decode($this->uri->segment(4));
if($no_user && $sublevel){
$karyawan = $this->db->get_where('user',array('no_user'=>$no_user));    
$this->load->view('umum/V_header');

if($sublevel == 'Level 2'){
$this->load->view('user1/V_lihat_pekerjaan_level2',['karyawan'=>$karyawan]);
}else{
$this->load->view('user1/V_lihat_pekerjaan_level3',['karyawan'=>$karyawan]);    
}

}else{
redirect(404);    
}
}

}

