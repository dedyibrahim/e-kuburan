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
$data_user  = $this->db->get_where('user',array ('sublevel'=>'Level 2'));   
$data_tugas = $this->M_user1->data_tugas('Masuk');    
$this->load->view('umum/V_header');
$this->load->view('user1/V_user1',['data_tugas'=>$data_tugas,'data_user'=>$data_user]);
    
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
public function json_data_pekerjaan_selesai(){
echo $this->M_user1->json_data_pekerjaan_selesai();       
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
            $this->db->select('sublevel');
            $this->db->select('no_user');
            $this->db->select('nama_lengkap');
$karyawan = $this->db->get_where('user',array('Level'=>'User','sublevel !=' =>'Level 1'));    
$this->load->view('umum/V_header');
$this->load->view('user1/V_lihat_karyawan',['karyawan'=>$karyawan]);    
}

public function lihat_pekerjaan(){
$no_user = base64_decode($this->uri->segment(3));
$proses  = base64_decode($this->uri->segment(4));
if($no_user && $proses){
$karyawan = $this->db->get_where('user',array('no_user'=>$no_user));    
$sublevel = $karyawan->row_array();

$this->load->view('umum/V_header');
if($sublevel['sublevel'] == 'Level 2'){
$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('user','user.no_user = data_pekerjaan.no_user');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where(array('data_pekerjaan.status_pekerjaan'=>$proses,'data_pekerjaan.no_user'=>$no_user));
$data = $this->db->get();
$this->load->view('user1/V_lihat_pekerjaan_level2',['data'=>$data]);
}else{    
$this->db->select('*');
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->db->join('user', 'user.no_user = data_berkas.no_pengurus');
$this->db->where(array('data_berkas.status'=>$proses,'data_berkas.no_pengurus'=>$no_user));
$data = $this->db->get();

$this->load->view('user1/V_lihat_pekerjaan_level3',['data'=>$data]);    
}

}else{
redirect(404);    
}
}
public function lihat_status_pekerjaan(){
$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->join('data_berkas', 'data_berkas.no_pekerjaan = data_pekerjaan.no_pekerjaan');
$this->db->where(array('data_berkas.no_pekerjaan'=> base64_decode($this->uri->segment(3)),'data_berkas.status_berkas'=> 'Perizinan'));
$data = $this->db->get();
    
$this->load->view('umum/V_header');
$this->load->view('user1/V_lihat_status_pekerjaan',['data'=>$data]);        
}
public function lihat_laporan(){
if($this->input->post()){
$input = $this->input->post();

$data = $this->db->get_where('data_progress_perizinan',array('id_data_berkas'=>$input['id_data_berkas']));
echo "<table class='table table-striped table-hover table-sm'>"
. "<tr>"
. "<th>Tanggal </th>"
. "<th>laporan</th>"
. "</tr>";
foreach ($data->result_array() as $d){
echo "<tr>"
    . "<td>".$d['waktu']."</td>"
    . "<td>".$d['laporan']."</td>"
    . "</tr>";    
}
echo "</table>";    
}else{
redirect(404);    
}    
}
public function cari_file(){
if($this->input->post()){
$input = $this->input->post();
$this->db->select('*');
$this->db->from('data_meta_berkas');
$this->db->join('data_pekerjaan', 'data_pekerjaan.no_pekerjaan = data_meta_berkas.no_pekerjaan');
$this->db->join('data_berkas', 'data_berkas.nama_berkas = data_meta_berkas.nama_berkas');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta_berkas.no_nama_dokumen');
$array = array('data_meta_berkas.value_meta' => $input['cari_dokumen']);
$this->db->like($array);

$query = $this->db->get();
$this->load->view('umum/V_header');
$this->load->view('user1/V_pencarian',['query'=>$query]);

}else{
redirect(404);    
}    
}

}

