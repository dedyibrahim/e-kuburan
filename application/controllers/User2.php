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

if($this->session->userdata('sublevel')  != 'Level 2' ){
redirect(base_url('Menu'));
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
'jenis_client'              => ucwords($data['jenis_client']),    
'nama_client'               => strtoupper($data['badan_hukum']),
'alamat_client'             => ucwords($data['alamat_badan_hukum']),    
'tanggal_daftar'            => date('Y/m/d H:i:s'),    
'pembuat_client'            => $this->session->userdata('nama_lengkap'),    
'no_user'                   => $this->session->userdata('no_user'), 
'nama_folder'               =>"Dok".$no_client,
'contact_person'            => ucwords($data['contact_person']),    
'contact_number'            => ucwords($data['contact_number']),    
);    

$this->db->insert('data_client',$data_client);

$data_r = array(
'no_client'          => "C_".$no_client,    
'status_pekerjaan'      => "Masuk",
'no_pekerjaan'       => $no_pekerjaan,    
'tanggal_dibuat'     => date('Y/m/d H:i:s'),
'no_jenis_perizinan' => $data['id_jenis'],   
'tanggal_antrian'    => date('Y/m/d H:i:s'),
'target_kelar'       => $data['target_kelar'],
'count_up'           => date('Y,m,d H:i:s'),        
'no_user'            => $this->session->userdata('no_user'),    
'pembuat_pekerjaan'  => $this->session->userdata('nama_lengkap'),    
'jenis_perizinan'    => ucwords($data['jenis_akta']),
);
$this->db->insert('data_pekerjaan',$data_r);



foreach ($data_persyaratan->result_array() as $persyaratan){
$syarat = array('no_client'         => "C_".$no_client,    
'no_pekerjaan_syarat'      => $no_pekerjaan,    
'no_nama_dokumen'   => $persyaratan['no_nama_dokumen'],    
'nama_dokumen'      => $persyaratan['nama_dokumen'],
'no_jenis_dokumen'  => $persyaratan['no_jenis_dokumen'], 
);
$this->db->insert('data_persyaratan_pekerjaan',$syarat);
}


if(!file_exists("berkas/"."Dok".$no_client)){
mkdir("berkas/"."Dok".$no_client,0777);
}

$keterangan = $this->session->userdata('nama_lengkap')." Membuat client ".$data['badan_hukum']." dan pekerjaan ".$data['jenis_akta'] ;
$this->histori($keterangan);

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
'no_client'                 => $input['no_client'],    
'no_pekerjaan_syarat'       => $input['no_pekerjaan'],    
'no_nama_dokumen'           => $input['no_nama_dokumen'],    
'nama_dokumen'              => $input['nama_dokumen'],
'no_jenis_dokumen'          => $input['no_jenis_dokumen'], 
);

$this->db->insert('data_persyaratan_pekerjaan',$syarat);

$keterangan = $this->session->userdata('nama_lengkap')." Menambahkan persyaratan ".$input['nama_dokumen'];  
$this->histori($keterangan);

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
$data_persyaratan     = $this->db->get_where('data_persyaratan_pekerjaan',array('no_jenis_dokumen'=> $static['no_jenis_perizinan'],'no_pekerjaan_syarat'=>$static['no_pekerjaan']));
$data_berkas          = $this->db->get_where('data_berkas',array('status_berkas'=>'Persyaratan','no_pekerjaan'=> base64_decode($this->uri->segment(3))));
$minimal_persyaratan = $this->db->get_where('data_persyaratan_pekerjaan',array('no_pekerjaan_syarat'=> base64_decode($this->uri->segment(3))));

$this->load->view('umum/V_header');
$this->load->view('user2/V_proses_berkas',['minimal_persyaratan'=>$minimal_persyaratan,'$data_berkas'=>$data_berkas,'nama_dokumen'=>$nama_dokumen,'data'=>$data,'dokumen_utama'=>$dokumen_utama,'data_persyaratan'=>$data_persyaratan]);    

}else{
redirect(404);    
}
}

public function lengkapi_persyaratan(){    
$minimal_persyaratan = $this->db->get_where('data_persyaratan_pekerjaan',array('no_pekerjaan_syarat'=> base64_decode($this->uri->segment(3))));
$nama_dokumen        = $this->db->get_where('nama_dokumen');
$data_berkas         = $this->db->get_where('data_berkas',array('no_pekerjaan'=> base64_decode($this->uri->segment(3))));
$data                = $this->M_user2->data_pekerjaan_persyaratan(base64_decode($this->uri->segment(3))); 

$this->load->view('umum/V_header');
$this->load->view('user2/V_lengkapi_persyaratan',['data'=>$data,'data_berkas'=>$data_berkas,'minimal_persyaratan'=>$minimal_persyaratan,'nama_dokumen'=>$nama_dokumen]);    
}

public function form_persyaratan(){
if($this->input->post()){
$input     = $this->input->post();
$query     = $this->M_user2->data_form_persyaratan($input['no_pekerjaan'],$input['id_data_persyaratan']);
$static    = $query->row_array();
$data_meta = $this->M_user2->data_meta_where($static['no_nama_dokumen']);


echo "<input type='hidden' id='id_data_persyaratan' class='form-control' value=".$input['id_data_persyaratan'].">";
echo "<input type='hidden' id='no_pekerjaan' class='form-control' value=".$input['no_pekerjaan'].">";
      
if(is_array($data_meta->row_array())){
    $h=1;
    foreach ($data_meta->result_array() as $d){
    
      
      if($d['nama_meta'] == 'Informasi'){
      echo "<label>".$d['nama_meta']."</label>"
         ."<textarea id='informasi' class='form-control informasi'></textarea>";
      }else{
      echo "<label>".$d['nama_meta']."</label>"
         ."<input type='text' id='data_meta".$h++."' name='".$d['nama_meta']."' class='form-control meta' required='' accept='text/plain' >";       
     
      }
      
    }
}

echo "<label> Upload lampiran  ".$static['nama_dokumen']."</label>"
        . "<input type='file' name='file_berkas' id='file_berkas' class='form-control' required >"
        . "<hr>"
        . "<button class='btn btn-success btn-block btn-sm ' onclick='simpan_syarat();' type='button'>Upload dan simpan <span class='fa fa-upload'></span></button>"; 

}else{
redirect(404);    
}
}

public function simpan_persyaratan(){
    
if($this->input->post()){
$input = $this->input->post();
$query     = $this->M_user2->data_form_persyaratan($input['no_pekerjaan'],$input['id_data_persyaratan']);
$static    = $query->row_array();

if(!empty($_FILES['file_berkas'])){
$config['upload_path']          = './berkas/'.$static['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;
$this->upload->initialize($config);    
if (!$this->upload->do_upload('file_berkas')){  
$status = array(
"status"     => "error",
"pesan"      => $this->upload->display_errors()    
);
echo json_encode($status);
}else{
}
}


if(!empty($input['data_informasi'])){
$this->simpan_data_informasi($input,$static,$this->upload->data());
}else if(!empty($input['data_meta'])){
$this->simpan_data_meta($input,$static,$this->upload->data());


}
$status = array(
"status"     => "success",
"pesan"      => "File persyaratan berhasil diupload"    
);
echo json_encode($status);

$keterangan = $this->session->userdata('nama_lengkap')." upload persyaratan ".$this->input->post('Nama_berkas');  
$this->histori($keterangan);

}else{
redirect(404);    
}
    
}

public function simpan_data_meta($input,$static,$lampiran){
$data_berkas = array(
'no_client'         => $static['no_client'],
'no_pekerjaan'      => $static['no_pekerjaan'],
'no_nama_dokumen'   => $static['no_nama_dokumen'],
'pemberi_pekerjaan' => $this->session->userdata('no_user'),
'nama_folder'       => $static['nama_folder'],
'nama_berkas'       => $lampiran['file_name'],
'nama_file'         => $static['nama_dokumen'],    
'status_berkas'     => 'Persyaratan',
'Pengupload'        => $this->session->userdata('nama_lengkap'),
'tanggal_upload'    => date('d/m/Y H:is' ),  
);    
$this->db->insert('data_berkas',$data_berkas);
    
    
 $data_meta = json_decode($input['data_meta']);
foreach ($data_meta as $key=>$value){
$meta = array(
'nama_berkas'    => $lampiran['file_name'],
'no_client'      => $static['no_client'],
'no_pekerjaan'   => $static['no_pekerjaan'],
'no_nama_dokumen'=> $static['no_nama_dokumen'],
'nama_folder'    => $static['nama_folder'],
'nama_meta'      => $key,
'value_meta'     => $value,    
);
$this->db->insert('data_meta_berkas',$meta);
}   
}

public function simpan_data_informasi($input,$static,$lampiran){
$data = array(
'data_informasi'   => $input['data_informasi'],
'no_client'        => $static['no_client'],
'no_pekerjaan'     => $static['no_pekerjaan'],
'nama_informasi'   => $static['nama_dokumen'],    
'nama_folder'      => $static['nama_folder'],
'lampiran'         => $lampiran['file_name']   
);
$this->db->insert('data_informasi_pekerjaan',$data);

}

public function persyaratan_telah_dilampirkan(){
$data_berkas  = $this->db->get_where('data_berkas',array('no_pekerjaan'=>base64_decode($this->uri->segment(3))));
$data_informasi  = $this->db->get_where('data_informasi_pekerjaan',array('no_pekerjaan'=>base64_decode($this->uri->segment(3))));


if($data_berkas->num_rows() != 0){
echo "<div class='card-header text-center' >Data dalam bentuk lampiran</div>";  
foreach ($data_berkas->result_array() as $u){  
$data_meta = $this->db->get_where('data_meta_berkas',array('nama_berkas'=>$u['nama_berkas']));
echo'<div class="card p-2 m-1">
<div class="row">
<div class="col">'.$u['nama_file'].'</div> 
<div class="col-md-4 text-right">
<button class="btn btn-success btn-sm" onclick="download('. $u['id_data_berkas'].')"><span class="fa fa-download"></span></button>
<button onclick="hapus_berkas_persyaratan('.$u['no_pekerjaan'].",".$u['id_data_berkas'].')" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
<button type="button" class="btn btn-sm btn-warning" data-toggle="popover" title="Informasi" data-content="';
foreach($data_meta->result_array() as $m){
echo $m['nama_meta']." : ".$m['value_meta']."<br>";    
}
echo '"><span class="fa fa-eye"></span> </button>
</div>    
</div>
</div>';


}
}else{
echo "<h5 class='text-center mt-5'>Belum terdapat syarat lampiran yang diberikan.<br>"
    . "<span class='fa fa-3x fa-folder-open'></span>"
    . "</h5>";    
}
echo "<hr>";
if($data_informasi->num_rows() != 0){
  
echo "<div class='card-header text-center' >Data dalam bentuk Informasi</div>";  

foreach ($data_informasi->result_array() as $i){  
echo'<div class="card p-2 m-1">
<div class="row">
<div class="col">'.$i['nama_informasi'].'</div> 
<div class="col-md-4 text-right">';
if($i['lampiran'] !=''){
echo '<button class="btn btn-success btn-sm mr-1" onclick="download_berkas_informasi('. $i['id_data_informasi_pekerjaan'].')"><span class="fa fa-download"></span></button>';    
}
echo '<button onclick="hapus_berkas_informasi('.$i['no_pekerjaan'].",".$i['id_data_informasi_pekerjaan'].')" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
<button type="button" class="btn btn-sm btn-warning" data-toggle="popover" title="Informasi" data-content="'.$i['data_informasi'].'"><span class="fa fa-eye"></span> </button>
</div>    
</div>
</div>';
}
  
}else{
echo "<h5 class='text-center mt-5'>Belum terdapat syarat informasi yang diberikan.<br>"
    . "<span class='fa fa-3x fa-folder-open'></span>"
    . "</h5>";      
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

$keterangan = $this->session->userdata('nama_lengkap')." Menambahkan perizinan ".$data['jenis_perizinan'];

$this->histori($keterangan);



}else{
redirect(404);    
}
    
}

public function form_perizinan(){
if($this->input->post()){
$data      = $this->db->get_where('data_berkas',array('no_pekerjaan'=> base64_decode($this->input->post('no_pekerjaan')),'status_berkas'=>'Perizinan'));
$data_user = $this->M_user2->data_user(); 
echo "<div class='row'>"
."<table class='table table-bordered table-sm  table-hover table-striped'>"
."<tr>"
."<th class='text-center'>Nama berkas persyaratan</th>"
."<th class='text-center'>Status file</th>"
."<th class='text-center'>Target selesai</th>"
."<th class='text-center'>Pengurus file </th>"
."<th class='text-center'>Aksi </th>"
."</tr>";
foreach ($data->result_array() as $form){
echo "<tr>";
if($form['status']=='Selesai'){
echo  "<td>".$form['nama_file']." <button onclick=download_berkas('".$form['id_data_berkas']."') class='btn btn-success btn-sm float-right'><span class='fa fa-download'></span></button></td>";
}else{
echo  "<td>".$form['nama_file']."</td>";
}

echo "<td class='text-center'>".$form['status']." </td>"
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
."<option>-- Klik untuk lihat menu --</option>"
."<option value='1'>Hapus Syarat</option>"
."<option value='2'>Alihkan Tugas</option>"
."<option value='3'>Lihat laporan</option>"
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

$data1 = $this->db->get_where('data_berkas',array('id_data_berkas'=>$input['id_data_berkas']))->row_array();
    
$data = array(
    'no_pengurus'        => $input['no_user'],
    'pengurus_perizinan' => $input['nama_user'],
    'pemberi_pekerjaan'  => $this->session->userdata('no_user'),
    'tanggal_tugas'      => date('d/m/Y'),
    'status'             => 'Masuk',
    'status_lihat'       => NULL
);
$this->db->update('data_berkas',$data,array('id_data_berkas'=>$input['id_data_berkas']));

$keterangan = $this->session->userdata('nama_lengkap')." Memberikan tugas perizinan ".$data1['nama_file']."kepada ".$input['nama_user'];

$this->histori($keterangan);


}else{
redirect(404);    
} 
    
}

public function lanjutkan_proses_perizinan(){
if($this->input->post()){
$input  = $this->input->post();
$histori   = $this->M_user2->data_pekerjaan_histori(base64_decode($input['no_pekerjaan']))->row_array();

$data = array(
'status_pekerjaan'=>'Proses',    
'tanggal_proses'=>date('d/m/Y')    
);
$this->db->update('data_pekerjaan',$data,array('no_pekerjaan'=> base64_decode($input['no_pekerjaan'])));

$keterangan = $this->session->userdata('nama_lengkap')." Memproses perizinan ".$histori['jenis_perizinan']." client ". $histori['nama_client'];

$this->histori($keterangan);

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
if($this->input->post()){
$input = $this->input->post();    

$data = $this->db->get_where('data_berkas',array('id_data_berkas'=>$input['id_data_berkas']))->row_array();    

unlink('./berkas/'.$data['nama_folder']."/".$data['nama_berkas']);

$this->db->delete('data_berkas',array('id_data_berkas'=>$this->input->post('id_data_berkas')));    

$status = array(
"status"     => "success",
"no_pekerjaan"  => base64_encode($input['no_pekerjaan']),
"pesan"      => "Data persyaratan dihapus",    
);
echo json_encode($status);

$keterangan = $this->session->userdata('nama_lengkap')." Menghapus File Persyaratan ".$data['nama_file'];  
$this->histori($keterangan);


}else{
redirect(404);    
} 
}
public function hapus_berkas_informasi(){
if($this->input->post()){
$input = $this->input->post();    
$data = $this->db->get_where('data_informasi_pekerjaan',array('id_data_informasi_pekerjaan'=>$input['id_data_informasi_pekerjaan']))->row_array();    

if(!file_exists('./berkas/'.$data['nama_folder']."/".$data['lampiran'])){
unlink('./berkas/'.$data['nama_folder']."/".$data['lampiran']);
}
$this->db->delete('data_informasi_pekerjaan',array('id_data_informasi_pekerjaan'=>$this->input->post('id_data_informasi_pekerjaan')));    

$status = array(
"status"     => "success",
"no_pekerjaan"  => base64_encode($input['no_pekerjaan']),
"pesan"      => "Data Informasi dihapus",    
);
echo json_encode($status);

$keterangan = $this->session->userdata('nama_lengkap')." Menghapus File informasi ".$data['nama_informasi'];  
$this->histori($keterangan);

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

public function cari_file(){
if($this->input->post()){
$input = $this->input->post();
$dalam_bentuk_lampiran  = $this->M_user2->cari_lampiran($input);
$dalam_bentuk_informasi = $this->M_user2->cari_informasi($input);

$this->load->view('umum/V_header');
$this->load->view('user2/V_pencarian',['dalam_bentuk_lampiran'=>$dalam_bentuk_lampiran,'dalam_bentuk_informasi'=>$dalam_bentuk_informasi]);

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
'waktu'        =>date('Y/m/d'),
'jenis'        =>$input['jenis'],    
);

$this->db->insert('data_dokumen_utama',$data);    
    
$keterangan = $this->session->userdata('nama_lengkap')." Mengupload ".$input['jenis'] ." dengan nama ".$input['nama_file'];
$this->histori($keterangan);


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


$keterangan = $this->session->userdata('nama_lengkap')." Menghapus ".$data['nama_berkas'] ;
$this->histori($keterangan);



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

$keterangan = $this->session->userdata('nama_lengkap')." Menghapus File Dokumen ".$data['nama_file'];  

$this->histori($keterangan);



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
'no_pekerjaan_syarat'      => $no_pekerjaan,    
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

public function profil(){
$no_user = $this->session->userdata('no_user');
$data_user = $this->M_user2->data_user_where($no_user);
$this->load->view('umum/V_header');
$this->load->view('user2/V_profil',['data_user'=>$data_user]);

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

public function histori($keterangan){

$data = array(
'no_user'   => $this->session->userdata('no_user'),
'keterangan'=>$keterangan,
'tanggal'   =>date('Y/m/d H:i:s'),
);

$this->db->insert('data_histori_pekerjaan',$data);
}

public function riwayat_pekerjaan(){
$this->load->view('umum/V_header');
$this->load->view('user2/V_riwayat_pekerjaan');
}

public function json_data_riwayat(){
echo $this->M_user2->json_data_riwayat();       
}

public function json_data_berkas_client($no_client){
echo $this->M_user2->json_data_berkas_client($no_client);       
}

public function lihat_berkas_client(){    
    
$data_client = $this->M_user2->data_client_where($this->uri->segment(3));    
    
$this->load->view('umum/V_header');
$this->load->view('user2/V_lihat_berkas_client',['data_client'=>$data_client]);   
}

public function proses_ulang(){
if($this->input->post()){
$data = array(
'status_pekerjaan' =>'Proses'    
);
$this->db->update('data_pekerjaan',$data,array('id_data_pekerjaan'=>$this->input->post('id_data_pekerjaan')));

$status = array(
"status"     => "success",
"pesan"      => "Pekerjaan berhasil dimasukan kedalam tahap proses"    
);
echo json_encode($status);

$d = $this->db->get_where('data_pekerjaan',array('id_data_pekerjaan'=>$this->input->post('id_data_pekerjaan')))->row_array();

$keterangan = $this->session->userdata('nama_lengkap')." Memproses ulang pekerjaan ".$d['jenis_perizinan']  ;
$this->histori($keterangan);

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

