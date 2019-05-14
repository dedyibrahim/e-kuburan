<?php
class user3 extends CI_Controller{
    
public function __construct() {
parent::__construct();
$this->load->helper('download');
$this->load->library('session');
$this->load->model('M_user3');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');
}

public function index(){
$data_tugas = $this->M_user3->data_tugas('Masuk');    
$this->load->view('umum/V_header');
$this->load->view('user3/V_user3',['data_tugas'=>$data_tugas]);
}
 
public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}


public function proses_tugas(){
if($this->input->post()){
$data1 = $this->db->get_where('data_berkas',array('id_data_berkas'=>$this->input->post('id_data_berkas')))->row_array();

 $data = array(
'tanggal_proses_tugas'   =>date('d/m/Y'),
'target_kelar_perizinan' =>$this->input->post('target_kelar'),
'status'                 =>'Proses'    
);
$this->db->update('data_berkas',$data,array('id_data_berkas'=>$this->input->post('id_data_berkas')));

$keterangan  = $this->session->userdata('nama_lengkap')." Memproses tugas ".$data1['nama_file']; 
$this->histori($keterangan);

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
$data_tugas = $this->M_user3->data_tugas('Proses');    
$this->load->view('umum/V_header');
$this->load->view('user3/V_halaman_proses',['data_tugas'=>$data_tugas]);
}



public function halaman_selesai(){
$data_tugas = $this->M_user3->data_tugas('Selesai');    
    
$this->load->view('umum/V_header');
$this->load->view('user3/V_halaman_selesai',['data_tugas'=>$data_tugas]);
    
}
public function json_data_perizinan_selesai(){
echo $this->M_user3->json_data_perizinan_selesai();       
}



public function lihat_persyaratan(){
if($this->input->post()){
$input = $this->input->post();
$data = $this->db->get_where('data_berkas',array('no_pekerjaan'=>$input['no_pekerjaan'],'status_berkas'=>'Persyaratan'));

foreach ($data->result_array() as $d){
 echo "<button onclick=download('".$d['id_data_berkas']."'); class='btn btn-light btn-block p-2 m-2' >".$d['nama_file']." <span class='fa float-right fa-download'></button>";  
}
}else{
redirect(404);    
}
}
public function download_berkas(){
$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_berkas']; 
$info = new SplFileInfo($data['nama_berkas']);
force_download($data['nama_file'].".".$info->getExtension(), file_get_contents($file_path));
}

public function form_upload_berkas(){
if($this->input->post()){
$input = $this->input->post();    
$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$input['id_data_berkas']))->row_array();

$data_meta = $this->db->get_where('data_meta',array('no_nama_dokumen'=>$data['no_nama_dokumen']));
echo "<form action='".base_url('User3/simpan_berkas')."' method='post' enctype='multipart/form-data'>"
. "<input type='hidden' name='".$this->security->get_csrf_token_name()."' value='".$this->security->get_csrf_hash()."'>"
. "<input type='hidden' name='id_data_berkas' value='".$input['id_data_berkas']."'>";

echo "<label>Nama Berkas</label>"
. "<input type='text' class='form-control' name='Nama_berkas' value='".$data['nama_file']."'>";
foreach ($data_meta->result_array() as $m){
echo "<label>".$m['nama_meta']."</label>"
."<input type='text' class='form-control' required name='".$m['nama_meta']."'>";    
}

echo "<label>Upload ".$data['nama_file']."</label>"
. "<input type='file' class='form-control' name='file_berkas' required >"
. "<hr>"
. "<button class='btn btn-success btn-block'>Upload <span class='fa fa-upload'></span></butto>"
. "</form>";

}else{
redirect(404);    
}    
}
public function simpan_berkas(){
    
if($this->input->post()){
$input = $this->input->post();

$this->db->select('*');
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->db->where('data_berkas.id_data_berkas',$input['id_data_berkas']);
$data_static = $this->db->get()->row_array();


$config['upload_path']          = './berkas/'.$data_static['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);
if (!$this->upload->do_upload('file_berkas')){
$error = array('error' => $this->upload->display_errors());
echo print_r($error);
}else{
$data_berkas = array(
'no_client'         => $data_static['no_client'],
'no_pekerjaan'      => $data_static['no_pekerjaan'],
'no_nama_dokumen'   => $data_static['no_nama_dokumen'],
'nama_folder'       => $data_static['nama_folder'],
'nama_berkas'       => $this->upload->data('file_name'),
'nama_file'         => $this->input->post('Nama_berkas'),    
'Pengupload'        => $this->session->userdata('nama_lengkap'),
'status'            =>'Selesai',    
'tanggal_upload'    => date('d/m/Y H:is' ),  
   
);    
$this->db->update('data_berkas',$data_berkas,array('id_data_berkas'=>$input['id_data_berkas']));

$keterangan  = $this->session->userdata('nama_lengkap')." Mengupload file berkas ".$this->input->post('Nama_berkas');
$this->histori($keterangan);



foreach ($_POST as $key => $value){
if($value == $input['id_data_berkas'] ){
}else{
$data_meta = array(
'nama_berkas'    =>$this->upload->data('file_name'),
'no_client'      => $data_static['no_client'],
'no_pekerjaan'   => $data_static['no_pekerjaan'],
'no_nama_dokumen'=> $data_static['no_nama_dokumen'],
'nama_folder'    => $data_static['nama_folder'],
'nama_meta'      => $key,
'value_meta'     =>$value,    
);
$this->db->insert('data_meta_berkas',$data_meta);
}    
    
}

redirect(base_url('User3/halaman_proses'));
}
}else{
redirect(404);    
}
}

public function simpan_laporan(){
if($this->input->post()){
$input = $this->input->post();
$data = array(
'id_data_berkas'    =>$input['id_data_berkas'],
'no_pekerjaan'      =>$input['no_pekerjaan'],
'no_user'           =>$this->session->userdata('no_user'),
'laporan'           =>$input['laporan'],
'waktu'             =>date('d/m/Y H:i:s')    
);
$this->db->insert('data_progress_perizinan',$data);

$status = array(
"status"=>"success",
"pesan" =>"laporan berhasil tersimpan",
);
echo json_encode($status);
   
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
$this->load->view('user3/V_pencarian',['query'=>$query]);

}else{
redirect(404);    
}    
}

public function tolak_tugas(){
if($this->input->post()){
$input = $this->input->post();    
$data = array(
'id_data_berkas'    =>$input['id_data_berkas'],
'no_pekerjaan'      =>$input['no_pekerjaan'],
'no_user'           =>$this->session->userdata('no_user'),
'laporan'           =>$this->session->userdata('nama_lengkap')." Menolak Tugas ".$input['nama_tugas']." dengan alasan ".$input['alasan_penolakan'],
'waktu'             =>date('d/m/Y H:i:s')    
);
$this->db->insert('data_progress_perizinan',$data);
  
$keterangan  = $this->session->userdata('nama_lengkap')." Menolak tugas ".$input['nama_tugas']." dengan alasan ".$input['alasan_penolakan']; 

$this->histori($keterangan);

$update = array(
'status' => 'Ditolak',    
);
$this->db->update('data_berkas',$update,array('id_data_berkas'=>$input['id_data_berkas']));


$status = array(
"status"=>"success",
"pesan" =>"Penolakan tugas berhasil",
);
echo json_encode($status);
  
}else{
redirect(404);    
}
    
}
public function profil(){
$no_user = $this->session->userdata('no_user');
$data_user = $this->M_user3->data_user_where($no_user);
$this->load->view('umum/V_header');
$this->load->view('user3/V_profil',['data_user'=>$data_user]);

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
$this->load->view('user3/V_riwayat_pekerjaan');
}

public function json_data_riwayat(){
echo $this->M_user3->json_data_riwayat();       
}

public function histori($keterangan){
$data = array(
'no_user'   => $this->session->userdata('no_user'),
'keterangan'=>$keterangan,
'tanggal'   =>date('Y/m/d H:i:s'),
);

$this->db->insert('data_histori_pekerjaan',$data);
}

}
