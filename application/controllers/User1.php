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

public function download_berkas(){
$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_berkas']; 
$info = new SplFileInfo($data['nama_berkas']);
force_download($data['nama_file'].".".$info->getExtension(), file_get_contents($file_path));
}

public function download_berkas_informasi(){
$data = $this->db->get_where('data_informasi_pekerjaan',array('id_data_informasi_pekerjaan'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['lampiran']; 
$info = new SplFileInfo($data['lampiran']);
force_download($data['nama_informasi'].".".$info->getExtension(), file_get_contents($file_path));
}

public function download_utama(){
$data = $this->db->get_where('data_dokumen_utama',array('id_data_dokumen_utama'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_file']; 
$info = new SplFileInfo($data['nama_file']);
force_download($data['nama_berkas'].".".$info->getExtension(), file_get_contents($file_path));
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
$data_user  = $this->db->get_where('user',array ('sublevel'=>'Level 2'));   

$this->load->view('user1/V_lihat_pekerjaan_level2',['data'=>$data,'data_user'=>$data_user]);
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
public function berkas_dikerjakan(){
$no_pekerjaan               = base64_decode($this->uri->segment(3));
$data_berkas                = $this->db->get_where('data_berkas',array('no_pekerjaan'=>$no_pekerjaan));
$data_informasi             = $this->db->get_where('data_informasi_pekerjaan',array('no_pekerjaan'=>$no_pekerjaan));
$dokumen_utama              = $this->db->get_where('data_dokumen_utama',array('no_pekerjaan'=>$no_pekerjaan));     
$this->load->view('umum/V_header');
$this->load->view('user1/V_lihat_berkas_dikerjakan',['data_berkas'=>$data_berkas,'data_informasi'=>$data_informasi,'dokumen_utama'=>$dokumen_utama]);        


}

public function lihat_laporan_pekerjaan(){
if($this->input->post()){
$input = $this->input->post();

$data = $this->db->get_where('data_progress_pekerjaan',array('no_pekerjaan'=> base64_decode($input['no_pekerjaan'])));
echo "<table class='table table-striped table-bordered text-center table-hover table-sm'>"
. "<tr>"
. "<th>Tanggal </th>"
. "<th>laporan</th>"
. "</tr>";
foreach ($data->result_array() as $d){
echo "<tr>"
    . "<td>".$d['waktu']."</td>"
    . "<td>".$d['laporan_pekerjaan']."</td>"
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
$dalam_bentuk_lampiran  = $this->M_user1->cari_lampiran($input);
$dalam_bentuk_informasi = $this->M_user1->cari_informasi($input);

$this->load->view('umum/V_header');
$this->load->view('user1/V_pencarian',['dalam_bentuk_lampiran'=>$dalam_bentuk_lampiran,'dalam_bentuk_informasi'=>$dalam_bentuk_informasi]);

}else{
redirect(404);    
}    
}
public function lihat_informasi(){
if($this->input->post()){
$input = $this->input->post();    
$query = $this->db->get_where('data_informasi_pekerjaan',array('id_data_informasi_pekerjaan'=>$input['id_data_informasi_pekerjaan']))->row_array();

echo $query['data_informasi'];


}else{
redirect(404);    
}
}

public function alihkan_pekerjaan(){
if($this->input->post()){
$input = $this->input->post();    
$data = array(
'no_user'           =>$input['no_user'],
'pembuat_pekerjaan' =>$input['pembuat_pekerjaan'],   
);
$this->db->update('data_pekerjaan',$data,array('no_pekerjaan'=> base64_decode($input['no_pekerjaan'])));

$status = array(
'status' =>"success",
'pesan'  =>"Pengalihan tugaske ".$input['pembuat_pekerjaan']." Berhasil"    
);
echo json_encode($status);

}else{
redirect(404);    
}
    
}
public function profil(){
$no_user = $this->session->userdata('no_user');
$data_user = $this->M_user1->data_user_where($no_user);
$this->load->view('umum/V_header');
$this->load->view('user1/V_profil',['data_user'=>$data_user]);

}

public function simpan_profile(){
$foto_lama = $this->db->get_where('user',array('no_user'=>$this->session->userdata('no_user')))->row_array();
if(!file_exists('./uploads/user/'.$foto_lama['foto'])){
    
}else{
if($foto_lama['foto'] != NULL){
unlink('./uploads/user/'.$foto_lama['foto']);    
}   
}

$img =  $this->input->post();
define('UPLOAD_DIR', './uploads/user/');
$image_parts = explode(";base64,", $img['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file_name = uniqid() . '.png';
$file = UPLOAD_DIR .$file_name;
file_put_contents($file, $image_base64);
$data = array(
'foto' =>$file_name,    
);
$this->db->update('user',$data,array('no_user'=>$this->session->userdata('no_user')));
 
$status = array(
"status"     => "success",
"pesan"      => "Foto profil berhasil diperbaharui"    
);
echo json_encode($status);

}


public function update_user(){
if($this->input->post()){
$input= $this->input->post();

$data =array(
'email'         =>$input['email'],
'username'      =>$input['username'],
'nama_lengkap'  =>$input['nama_lengkap'],
'phone'         =>$input['phone']    
);
$this->db->where('no_user',$input['id_user']);
$this->db->update('user',$data);


$status = array(
"status"     => "success",
"pesan"      => "Data profil berhasil diperbaharui"    
);
echo json_encode($status);

}else{
redirect(404);    
}

}
public function update_password(){
if($this->input->post()){
$data = array(
'password' => md5($this->input->post('password'))
);
$this->db->update('user',$data,array('no_user'=>$this->input->post('no_user')));
 
$status = array(
"status"     => "success",
"pesan"      => "Password diperbaharui"    
);
echo json_encode($status);

}else{
redirect(404);    
}    
}
public function riwayat_pekerjaan(){
$this->load->view('umum/V_header');
$this->load->view('user1/V_riwayat_pekerjaan');
}

public function json_data_riwayat(){
echo $this->M_user1->json_data_riwayat();       
}


public function lihat_laporan(){
if($this->input->post()){
$input = $this->input->post();

$data = $this->db->get_where('data_progress_perizinan',array('id_data_berkas'=>$input['id_data_berkas']));
if($data->num_rows() == 0){
echo "<h5 class='text-center'>Belum ada laporan yang dimasukan<br>"
    . "<span class='fa fa-list-alt fa-3x'></span></h5>";
    
}else{echo "<table class='table table-bordered table-striped table-hover table-sm'>"
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

}
}else{
redirect(404);    
}    
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


}

