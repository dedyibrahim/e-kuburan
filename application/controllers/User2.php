<?php
class user2 extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('download');
$this->load->library('session');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');
$this->load->model('M_user2');
if($this->session->userdata('User') != 'User' && $this->session->userdata('sublevel') != 'Level 2'){
redirect(base_url('Login'));    
}  
       
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('user2/V_buat_pekerjaan');
}
 
public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}

public function asisten(){
    
$this->db->from('data_berkas');
$this->db->join('user', 'user.no_user = data_berkas.no_pengurus');
$this->db->group_by('user.no_user');
$this->db->where(array('pemberi_pekerjaan'=>$this->session->userdata('no_user'),'status_berkas'=>'Perizinan'));
$asisten = $this->db->get();


$this->load->view('umum/V_header');
$this->load->view('user2/V_data_asisten',['asisten'=>$asisten]);    
}

public function data_client(){
$this->load->view('umum/V_header');
$this->load->view('user2/V_data_client');

}

public function json_data_client(){
echo $this->M_user2->json_data_client();       
}
public function cari_jenis_dokumen(){
$term = strtolower($this->input->get('term'));    
$query = $this->M_user2->cari_jenis_dokumen($term);

foreach ($query as $d) {
$json[]= array(
'label'                    => $d->nama_jenis,   
'no_jenis_dokumen'         => $d->no_jenis_dokumen,
);   
}
echo json_encode($json);
}


public function create_client(){
if($this->input->post()){
$data = $this->input->post();

$h_berkas = $this->M_user2->hitung_pekerjaan()->num_rows()+1;
$h_client = $this->M_user2->data_client()->num_rows()+1;

$data_persyaratan = $this->db->get_where('data_persyaratan',array('no_jenis_dokumen' => $data['id_jenis']));

$no_client    = str_pad($h_client,6 ,"0",STR_PAD_LEFT);
$no_pekerjaan = str_pad($h_berkas,6 ,"0",STR_PAD_LEFT);


$data_client = array(
'no_client'                 => "C_".$no_client,    
'jenis_client'              => $data['jenis_client'],    
'nama_client'               => $data['badan_hukum'],
'alamat_client'             => $data['alamat_badan_hukum'],    
'tanggal_daftar'            => date('d/m/Y H:i:s'),    
'pembuat_client'            => $this->session->userdata('nama_lengkap'),    
'no_user'                   => $this->session->userdata('no_user'), 
'nama_folder'               =>"Dok".$no_client,
'contact_person'            =>$data['contact_person'],    
'contact_number'            =>$data['contact_number'],    
);    

$this->db->insert('data_client',$data_client);

$data_r = array(
'no_client'          => "C_".$no_client,    
'status_pekerjaan'      => "Masuk",
'no_pekerjaan'       => $no_pekerjaan,    
'tanggal_dibuat'     => date('d/m/Y H:i:s'),
'no_jenis_perizinan' => $data['id_jenis'],   
'tanggal_antrian'    => date('d/m/Y H:i:s'),
'target_kelar'       => $data['target_kelar'],
'count_up'           => date('M,d,Y, H:i:s'),        
'no_user'            => $this->session->userdata('no_user'),    
'pembuat_pekerjaan'  => $this->session->userdata('nama_lengkap'),    
'jenis_perizinan'    => $data['jenis_akta'],
);
$this->db->insert('data_pekerjaan',$data_r);



foreach ($data_persyaratan->result_array() as $persyaratan){
$syarat = array('no_client'         => "C_".$no_client,    
'no_pekerjaan'      => $no_pekerjaan,    
'no_nama_dokumen'   => $persyaratan['no_nama_dokumen'],    
'nama_dokumen'      => $persyaratan['nama_dokumen'],
'no_jenis_dokumen'  => $persyaratan['no_jenis_dokumen'], 
);
$this->db->insert('data_persyaratan_pekerjaan',$syarat);
}


mkdir("berkas/"."Dok".$no_client,0777);

$status = array(
"status"     => "success",
"no_client"  => base64_encode($no_client),
"pesan"      => "Telah dimasukan kedalam agenda kerja"    
);
echo json_encode($status);

}else{
redirect(404);    

}
}


public function tambah_persyaratan(){
if($this->input->post()){
$input = $this->input->post();   
$syarat = array(
'no_client'         => $input['no_client'],    
'no_pekerjaan'      => $input['no_pekerjaan'],    
'no_nama_dokumen'   => $input['no_nama_dokumen'],    
'nama_dokumen'      => $input['nama_dokumen'],
'no_jenis_dokumen'  => $input['no_jenis_dokumen'], 
);

$this->db->insert('data_persyaratan_pekerjaan',$syarat);

$status = array(
"status"     => "success",
"no_pekerjaan"  => base64_encode($input['no_pekerjaan']),
"pesan"      => "Persyaratan berhasil ditambahkan",    
);

echo json_encode($status);

}else{
redirect(404);    
}   
}
public function hapus_persyaratan_pekerjaan(){
if($this->input->post()){
$input = $this->input->post();   
$this->db->delete('data_persyaratan_pekerjaan',array('id_data_persyaratan_pekerjaan'=>$input['id_data_persyaratan_pekerjaan']));

$status = array(
"status"     => "success",
"no_pekerjaan"  => base64_encode($input['no_pekerjaan']),
"pesan"      => "Persyaratan berhasil ditambahkan",    
);

echo json_encode($status);

}else{
redirect(404);    
}   
}

public function json_data_pekerjaan_selesai(){
echo $this->M_user2->json_data_pekerjaan_selesai();       
}

public function pekerjaan_baru(){
$query = $this->M_user2->data_berkas('Baru');
    
$this->load->view('umum/V_header');
$this->load->view('user2/V_pekerjaan_baru',['query' =>$query]);
    
}
public function pekerjaan_antrian(){
$query = $this->M_user2->data_pekerjaan('Masuk');
    
$this->load->view('umum/V_header');
$this->load->view('user2/V_antrian',['query' =>$query]);
    
}
public function pekerjaan_proses(){
$query = $this->M_user2->data_pekerjaan('Proses');
    
$this->load->view('umum/V_header');
$this->load->view('user2/V_pekerjaan_proses',['query' =>$query]);
    
}public function pekerjaan_selesai(){
    
$this->load->view('umum/V_header');
$this->load->view('user2/V_pekerjaan_selesai');
    
}

public function tambahkan_kedalam_antrian(){
if($this->input->post()){

$data = array(
'status_berkas'   => 'Masuk',    
'tanggal_antrian' => date('Y/m/d H:i:s')    
);
$this->db->update('data_berkas',$data,array('no_berkas'=>$this->input->post('no_berkas')));

$status = array(
"status"=>"success",
'pesan'=>"Dokumen berhasil dimasukan kedalam antrian"   
);
echo json_encode($status);
}else{
redirect(404);    
}
    
}
public function tambahkan_kedalam_proses(){
if($this->input->post()){

$data = array(
'status_berkas'   => 'Proses',    
'tanggal_proses' => date('d/m/Y H:i:s')    
);
$this->db->update('data_berkas',$data,array('no_berkas'=>$this->input->post('no_berkas')));

$status = array(
"status"=>"success",
'pesan'=>"Dokumen berhasil dimasukan kedalam proses"   
);
echo json_encode($status);
}else{
redirect(404);    
}
}

public function proses_pekerjaan(){
if(!empty($this->uri->segment(3))){
$data                 = $this->M_user2->data_pekerjaan_proses($this->uri->segment(3));    

$static               = $data->row_array();

$dokumen_utama        = $this->db->get_where('data_dokumen_utama',array('no_pekerjaan'=> base64_decode($this->uri->segment(3))));

$nama_dokumen         = $this->db->get_where('nama_dokumen');

$data_persyaratan     = $this->db->get_where('data_persyaratan_pekerjaan',array('no_jenis_dokumen'=> $static['no_jenis_perizinan'],'no_pekerjaan'=>$static['no_pekerjaan']));

$data_berkas = $this->db->get_where('data_berkas',array('status_berkas'=>'Persyaratan','no_pekerjaan'=> base64_decode($this->uri->segment(3))));


$this->load->view('umum/V_header');
$this->load->view('user2/V_proses_berkas',['data_berkas'=>$data_berkas,'nama_dokumen'=>$nama_dokumen,'data'=>$data,'dokumen_utama'=>$dokumen_utama,'data_persyaratan'=>$data_persyaratan]);    

}else{
redirect(404);    
}
}

public function lengkapi_persyaratan(){    
$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_persyaratan_pekerjaan', 'data_persyaratan_pekerjaan.no_jenis_dokumen = data_pekerjaan.no_jenis_perizinan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.no_pekerjaan', base64_decode($this->uri->segment(3)));
$data = $this->db->get();    
$data_berkas = $this->db->get_where('data_berkas',array('status_berkas'=>'Persyaratan','no_pekerjaan'=> base64_decode($this->uri->segment(3))));
$nama_dokumen = $this->db->get('nama_dokumen');



$this->load->view('umum/V_header');
$this->load->view('user2/V_lengkapi_persyaratan',['data'=>$data,'data_berkas'=>$data_berkas,'nama_dokumen'=>$nama_dokumen]);    
}

public function form_persyaratan(){
if($this->input->post()){
$input = $this->input->post();
if($input['no_nama_dokumen']){    

$this->db->select('*');
$this->db->from('data_meta');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta.no_nama_dokumen');
$this->db->where('data_meta.no_nama_dokumen',$this->input->post('no_nama_dokumen'));
$data = $this->db->get();
$static = $data->row_array();
echo "<div class=''>"
 . "<label>".$input['nama_persyaratan']."</label>"
 . "<input type='hidden'  placeholder='' value='".$input['no_client']."'  name='no_client' class='form-control' required='' accept='text/plain' >"
 . "<input type='hidden'  placeholder='' value='".$input['nama_folder']."'  name='nama_folder' class='form-control' required='' accept='text/plain' >"
 . "<input type='hidden'  placeholder='' value='".$input['no_pekerjaan']."'  name='no_pekerjaan' class='form-control' required='' accept='text/plain' >"
 . "<input type='hidden'  placeholder='' value='".$this->security->get_csrf_hash()."'  name='token' class='form-control' required='' accept='text/plain' >"
 . "<input type='hidden'  placeholder='' value='".$input['nama_persyaratan']."'  name='key_persyaratan' class='form-control' required='' accept='text/plain' >"
 . "<input type='hidden'  name='no_nama_dokumen' value='".$input['no_nama_dokumen']."'  class='form-control' required='' accept='text/plain'>"
        .  "<input type='text'  placeholder='".$input['nama_persyaratan']."'  name='value_persyaratan' class='form-control' required='' accept='text/plain' >"
 . "<label>Nama Dokumen</label>"
 . "<input type='text' value='".$static['nama_dokumen']."'   name='Nama_berkas' class='form-control' required='' accept='text/plain' >";

if(is_array($data->result_array())){
foreach ($data->result_array() as $d){
echo "<label>".$d['nama_meta']."</label>"
    . "<input type='text' placeholder='".$d['nama_meta']."' name='".$d['nama_meta']."' class='form-control' required='' accept='text/plain'>";
}
}
echo "<label>Upload ".$static['nama_dokumen']."</label>"
        . "<input type='file' name='file_berkas' class='form-control' required >"
        . "<hr>"
        . "<button class='btn btn-success btn-block btn-sm' type='submit'>Upload & simpan <span class='fa fa-upload'></span></button>";    

echo  "</div>";

}else{
echo  "<label>".$input['nama_persyaratan']."</label>"
 . "<input type='hidden'  placeholder='' value='".$input['nama_persyaratan']."'  name='key_persyaratan' class='form-control' required='' accept='text/plain' >"
.  "<input type='text'  placeholder='".$input['nama_persyaratan']."'  name='value_persyaratan' class='form-control' required='' accept='text/plain' >"
. "<hr>"
. "<button class='btn btn-success btn-block btn-sm' type='submit'>Simpan <span class='fa fa-upload'></span></button>";    

    
}
}else{
redirect(404);    
}
}

public function simpan_persyaratan2(){
if($this->input->post()){
$input = $this->input->post();

if(empty($_FILES['file_berkas'])){

    
$data_persyaratan = array(
'no_pekerjaan'   => $input['no_pekerjaan'],
'key_syarat' => $input['key_persyaratan'],
'value_syarat'=> $input['value_persyaratan'],    
); 
$this->db->insert('data_persyaratan',$data_persyaratan);    
redirect(base_url('User2/lengkapi_persyaratan/'.base64_encode($input['no_pekerjaan'])));

    
}else{

$config['upload_path']          = './berkas/'.$input['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);

if (!$this->upload->do_upload('file_berkas')){
$error = array('error' => $this->upload->display_errors());
echo print_r($error);
}else{
$data_berkas = array(
'no_client'         => $input['no_client'],
'no_pekerjaan'      => $input['no_pekerjaan'],
'no_nama_dokumen'   => $input['no_nama_dokumen'],
'pemberi_pekerjaan' => $this->session->userdata('no_user'),
'nama_folder'       => $input['nama_folder'],
'nama_berkas'       => $this->upload->data('file_name'),
'nama_file'         => $this->input->post('Nama_berkas'),    
'status_berkas'     => 'Persyaratan',
'Pengupload'        => $this->session->userdata('nama_lengkap'),
'tanggal_upload'    => date('d/m/Y H:is' ),  
);    
$this->db->insert('data_berkas',$data_berkas);

foreach ($_POST as $key => $value){
if($value == $input['no_client'] || $value == $input['no_pekerjaan'] || $value == $input['no_nama_dokumen'] || $value == $input['nama_folder'] || $key == "key_persyaratan" || $key == "value_persyaratan" ){

}else{
$data_meta = array(
'nama_berkas'    =>$this->upload->data('file_name'),
'no_client'      => $input['no_client'],
'no_pekerjaan'   => $input['no_pekerjaan'],
'no_nama_dokumen'=> $input['no_nama_dokumen'],
'nama_folder'    => $input['nama_folder'],
'nama_meta'      => $key,
'value_meta'     =>$value,    
);
$this->db->insert('data_meta_berkas',$data_meta);
}
}
redirect(base_url('User2/proses_pekerjaan/'.base64_encode($input['no_pekerjaan'])));
}
}
}else{
redirect(404);    
}
}

public function simpan_persyaratan(){
if($this->input->post()){
$input = $this->input->post();

if(empty($_FILES['file_berkas'])){

    
$data_persyaratan = array(
'no_pekerjaan'   => $input['no_pekerjaan'],
'key_syarat' => $input['key_persyaratan'],
'value_syarat'=> $input['value_persyaratan'],    
); 
$this->db->insert('data_persyaratan',$data_persyaratan);    
redirect(base_url('User2/lengkapi_persyaratan/'.base64_encode($input['no_pekerjaan'])));

    
}else{

$config['upload_path']          = './berkas/'.$input['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);

if (!$this->upload->do_upload('file_berkas')){
$error = array('error' => $this->upload->display_errors());
echo print_r($error);
}else{
$data_berkas = array(
'no_client'         => $input['no_client'],
'no_pekerjaan'      => $input['no_pekerjaan'],
'no_nama_dokumen'   => $input['no_nama_dokumen'],
'pemberi_pekerjaan' => $this->session->userdata('no_user'),
'nama_folder'       => $input['nama_folder'],
'nama_berkas'       => $this->upload->data('file_name'),
'nama_file'         => $this->input->post('Nama_berkas'),    
'status_berkas'     => 'Persyaratan',
'Pengupload'        => $this->session->userdata('nama_lengkap'),
'tanggal_upload'    => date('d/m/Y H:is' ),  
);    
$this->db->insert('data_berkas',$data_berkas);

foreach ($_POST as $key => $value){
if($value == $input['no_client'] || $value == $input['no_pekerjaan'] || $value == $input['no_nama_dokumen'] || $value == $input['nama_folder'] || $key == "key_persyaratan" || $key == "value_persyaratan" ){

}else{
$data_meta = array(
'nama_berkas'    =>$this->upload->data('file_name'),
'no_client'      => $input['no_client'],
'no_pekerjaan'   => $input['no_pekerjaan'],
'no_nama_dokumen'=> $input['no_nama_dokumen'],
'nama_folder'    => $input['nama_folder'],
'nama_meta'      => $key,
'value_meta'     =>$value,    
);
$this->db->insert('data_meta_berkas',$data_meta);
}


}
redirect(base_url('User2/lengkapi_persyaratan/'.base64_encode($input['no_pekerjaan'])));

}
}
}else{
redirect(404);    
}
}
public function simpan_perizinan(){
if($this->input->post()){
$input = $this->input->post();

$data = $this->db->get_where('data_pekerjaan',array('no_pekerjaan'=> base64_decode($input['no_pekerjaan'])))->row_array();
$data_berkas = array(
'no_client'         => $data['no_client'],
'no_pekerjaan'      => $data['no_pekerjaan'],
'no_nama_dokumen'   => $input['no_nama_dokumen'],
'pemberi_pekerjaan' => $this->session->userdata('no_user'),
'status_berkas'     => 'Perizinan',
'nama_file'         => $input['nama_dokumen'],
);    
$this->db->insert('data_berkas',$data_berkas);
    
}else{
redirect(404);    
}
    
}

public function form_perizinan(){
if($this->input->post()){
$data      = $this->db->get_where('data_berkas',array('no_pekerjaan'=> base64_decode($this->input->post('no_pekerjaan')),'status_berkas'=>'Perizinan'));
$data_user = $this->M_user2->data_user(); 
echo "<div class='row'>"
."<table class='table table-hover table-striped'>"
."<tr>"
."<td>Nama file</td>"
."<td>Status file</td>"
."<td>Target selesai</td>"
."<td>Pengurus file </td>"
."<td>Aksi </td>"
."</tr>";
foreach ($data->result_array() as $form){
echo "<tr>";
if($form['status']=='Selesai'){
echo  "<td>".$form['nama_file']." <button onclick=download_berkas('".$form['id_data_berkas']."') class='btn btn-success btn-sm float-right'><span class='fa fa-download'></span></button></td>";
}else{
echo  "<td>".$form['nama_file']."</td>";
}

echo "<td>".$form['status']." <button onclick=lihat_progress_perizinan('".$form['id_data_berkas']."') class='btn btn-success btn-sm float-right'><span class='fa fa-eye'></span></button></td>"
. "<td>".$form['target_kelar_perizinan']."</td>"
. "<td>"
."<select onchange='tentukan_pengurus(".$form['id_data_berkas'].");' disabled class='form-control tentukan_pengurus".$form['id_data_berkas']."'>"
."<option>".$form['pengurus_perizinan']."</option>"
."<option value =''></option>";
foreach ($data_user->result_array() as $user){
echo "<option value='".$user['no_user']."'>".$user['nama_lengkap']."</option>";
}
echo "<select></td>";

echo "<td>"
."<select onchange='option_aksi(".$form['id_data_berkas'].")' class='form-control option_aksi".$form['id_data_berkas']." '>"
."<option></option>"
."<option value='1'>Hapus Syarat</option>"
."<option value='2'>Alihkan Tugas</option>"
."<select></td>"

. "<tr>";
}
echo "</div>";    
 }else{
redirect(404);    
}
}

public function hapus_syarat(){
if($this->input->post()){
$this->db->delete('data_berkas',array('id_data_berkas'=>$this->input->post('id_data_berkas')));    
}else{
redirect(404);    
}    
}

public function simpan_pekerjaan_user(){
if($this->input->post()){
$input = $this->input->post();    
$data = array(
    'no_pengurus'        => $input['no_user'],
    'pengurus_perizinan' => $input['nama_user'],
    'pemberi_pekerjaan'  => $this->session->userdata('no_user'),
    'tanggal_tugas'      => date('d/m/Y'),
    'status'             => 'Masuk'
);
$this->db->update('data_berkas',$data,array('id_data_berkas'=>$input['id_data_berkas']));    
}else{
redirect(404);    
} 
    
}

public function lanjutkan_proses_perizinan(){
if($this->input->post()){
$input = $this->input->post();

$data = array(
'status_pekerjaan'=>'Proses',    
'tanggal_proses'=>date('d/m/Y')    
);
$this->db->update('data_pekerjaan',$data,array('no_pekerjaan'=> base64_decode($input['no_pekerjaan'])));


$status = array(
"status"     => "success",
"pesan"      => "Perizinan berhasil diproses"    
);
echo json_encode($status);

}else{
redirect(404);    
}
}
public function update_selesaikan_pekerjaan(){
if($this->input->post()){
$input = $this->input->post();

$data = array(
'status_pekerjaan'  =>'Selesai',    
'tanggal_selesai'    =>date('d/m/Y')    
);
$this->db->update('data_pekerjaan',$data,array('no_pekerjaan'=> base64_decode($input['no_pekerjaan'])));


$status = array(
"status"     => "success",
"pesan"      => "Perizinan berhasil diproses"    
);
echo json_encode($status);

}else{
redirect(404);    
}
}


public function hapus_berkas_persyaratan(){
$param1 = $this->uri->segment(3);
$param2 = $this->uri->segment(4);
$this->db->delete('data_berkas',array('id_data_berkas'=>$param2));
redirect(base_url('User2/lengkapi_persyaratan/'.base64_encode($param1)));

}
public function download_berkas(){
$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_berkas']; 
$info = new SplFileInfo($data['nama_berkas']);
force_download($data['nama_file'].".".$info->getExtension(), file_get_contents($file_path));
}
public function download_utama(){
$data = $this->db->get_where('data_dokumen_utama',array('id_data_dokumen_utama'=>$this->uri->segment(3)))->row_array();    
$file_path = "./berkas/".$data['nama_folder']."/".$data['nama_file']; 
$info = new SplFileInfo($data['nama_file']);
force_download($data['nama_berkas'].".".$info->getExtension(), file_get_contents($file_path));
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
$this->load->view('user2/V_pencarian',['query'=>$query]);

}else{
redirect(404);    
}    
}
public function lihat_pekerjaan_asisten(){
$proses = base64_decode($this->uri->segment(4));    
$no_user = base64_decode($this->uri->segment(3));
$this->db->select('*');
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
//$this->db->join('user', 'user.no_user = data_berkas.no_pengurus');
$this->db->where(array('data_berkas.status'=>$proses,'data_berkas.no_pengurus'=>$no_user));
$data = $this->db->get();
$this->load->view('umum/V_header');

$this->load->view('user2/V_lihat_pekerjaan_level3',['data'=>$data]);    
    
}

public function simpan_progress_pekerjaan(){
if($this->input->post()){
$input = $this->input->post();    

$data = array(
'laporan_pekerjaan'       => $input['laporan'],
'no_pekerjaan'            => base64_decode($input['no_pekerjaan']),
'no_user'                 => $this->session->userdata('no_user'),
'waktu'                   => date('d/m/Y H:i:s')    
);
$this->db->insert('data_progress_pekerjaan',$data);
$status = array(
"status"     => "success",
"pesan"      => "Laporan berhasil dibuat"    
);
echo json_encode($status);

}else{
redirect(404);    
}    
}


public function upload_utama(){
if($this->input->post()){
$input = $this->input->post();    

$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.no_pekerjaan', base64_decode($input['no_pekerjaan']));
$data_pekerjaan = $this->db->get()->row_array();

$config['upload_path']          = './berkas/'.$data_pekerjaan['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;
$this->upload->initialize($config);


if (!$this->upload->do_upload('file')){
$error = array('error' => $this->upload->display_errors());
echo print_r($error);
}else{

$data = array(
'nama_file'    =>$this->upload->data('file_name'),
'nama_berkas'  =>$input['nama_file'],
'no_pekerjaan' =>$data_pekerjaan['no_pekerjaan'],
'nama_folder'  =>$data_pekerjaan['nama_folder'],
'no_client'    =>$data_pekerjaan['no_client'],
'waktu'        =>date('Y/m/d  H:i:s'),
'jenis'        =>$input['jenis'],    
);

$this->db->insert('data_dokumen_utama',$data);    
    
}

redirect(base_url('User2/proses_pekerjaan/'.base64_encode($data_pekerjaan['no_pekerjaan'])));
}else{
redirect(404);    
}
}

public function hapus_file_utama(){
if($this->input->post()){
$data = $this->db->get_where('data_dokumen_utama',array('id_data_dokumen_utama'=>$this->input->post('id_data_dokumen_utama')))->row_array();    

unlink('./berkas/'.$data['nama_folder']."/".$data['nama_file']);

$this->db->delete('data_dokumen_utama',array('id_data_dokumen_utama'=>$this->input->post('id_data_dokumen_utama')));    

}else{
redirect(404);    
}    
}

public function hapus_data_berkas(){
if($this->input->post()){
$input = $this->input->post();    
$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$this->input->post('id_data_berkas')))->row_array();    

unlink('./berkas/'.$data['nama_folder']."/".$data['nama_berkas']);

$this->db->delete('data_berkas',array('id_data_berkas'=>$this->input->post('id_data_berkas')));    
$status = array(
"status"     => "success",
"no_pekerjaan"  => base64_encode($input['no_pekerjaan']),
"pesan"      => "Persyaratan berhasil ditambahkan",    
);

echo json_encode($status);

}else{
redirect(404);    
}    
}



public function buat_pekerjaan_baru(){

if($this->input->post()){    

$input = $this->input->post();
$h_berkas = $this->M_user2->hitung_pekerjaan()->num_rows()+1;
$no_pekerjaan= str_pad($h_berkas,6 ,"0",STR_PAD_LEFT);

$data_persyaratan = $this->db->get_where('data_persyaratan',array('no_jenis_dokumen' => $input['id_jenis']));
   

$data_r = array(
'no_client'          => base64_decode($input['no_client']),    
'status_pekerjaan'   => "Masuk",
'no_pekerjaan'       => $no_pekerjaan,    
'tanggal_dibuat'     => date('d/m/Y H:i:s'),
'no_jenis_perizinan' => $input['id_jenis'],   
'tanggal_antrian'    => date('d/m/Y H:i:s'),
'target_kelar'       => $input['target_kelar'],
'count_up'           => date('M,d,Y, H:i:s'),        
'no_user'            => $this->session->userdata('no_user'),    
'pembuat_pekerjaan'  => $this->session->userdata('nama_lengkap'),    
'jenis_perizinan'    => $input['jenis_akta'],
);
$this->db->insert('data_pekerjaan',$data_r);


foreach ($data_persyaratan->result_array() as $persyaratan){
$syarat = array(
'no_client'         => base64_decode($input['no_client']),    
'no_pekerjaan'      => $no_pekerjaan,    
'no_nama_dokumen'   => $persyaratan['no_nama_dokumen'],    
'nama_dokumen'      => $persyaratan['nama_dokumen'],
'no_jenis_dokumen'  => $persyaratan['no_jenis_dokumen'], 
);
$this->db->insert('data_persyaratan_pekerjaan',$syarat);
}


$status = array(
"status"     => "success",
"no_client"  => base64_decode($input['no_client']),
"pesan"      => "Telah dimasukan kedalam agenda kerja"    
);
echo json_encode($status);

}else{
redirect(404);    
}    
}

}

