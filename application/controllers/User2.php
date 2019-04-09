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

           $this->db->group_by('no_user_pengurus');
$asisten = $this->db->get_where('data_syarat_jenis_dokumen',array('no_user'=>$this->session->userdata('no_user')));
        
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

$no_client= str_pad($h_client,6 ,"0",STR_PAD_LEFT);
$no_pekerjaan= str_pad($h_berkas,6 ,"0",STR_PAD_LEFT);


$data_client = array(
'no_client'                 => "C_".$no_client,    
'jenis_client'              => $data['jenis_client'],    
'nama_client'               => $data['badan_hukum'],
'alamat_client'             => $data['alamat_badan_hukum'],    
'tanggal_daftar'            => date('d/m/Y H:i:s'),    
'pembuat_client'            => $this->session->userdata('nama_lengkap'),    
'no_user'                   => $this->session->userdata('no_user'), 
'nama_folder'               =>"Dok".$no_client,
);    

$this->db->insert('data_client',$data_client);

$data_r = array(
'no_client'          => "C_".$no_client,    
'status_pekerjaan'      => "Masuk",
'no_pekerjaan'       => $no_pekerjaan,    
'tanggal_dibuat'     => date('d/m/Y H:i:s'),
'tanggal_antrian'    => date('d/m/Y H:i:s'),
'target_kelar'       => $data['target_kelar'],
'count_up'           => date('M,d,Y, H:i:s'),        
'no_user'            => $this->session->userdata('no_user'),    
'pembuat_pekerjaan'  => $this->session->userdata('nama_lengkap'),    
'jenis_perizinan'    => $data['jenis_akta'],
);
$this->db->insert('data_pekerjaan',$data_r);



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

public function data_perorangan(){
$this->load->view('umum/V_header');
$this->load->view('user2/V_data_perorangan');

}
public function json_data_perorangan(){
echo $this->M_user2->json_data_perorangan();       
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
$data           = $this->M_user2->data_pekerjaan_proses($this->uri->segment(3));    
$this->load->view('umum/V_header');
$this->load->view('user2/V_proses_berkas',['data'=>$data]);    
}else{
redirect(404);    
}
}

public function lengkapi_persyaratan(){
$data_upload    = $this->M_user2->data_persyaratan_upload($this->uri->segment(3));
$data           = $this->M_user2->data_pekerjaan_proses($this->uri->segment(3));

$this->load->view('umum/V_header');
$this->load->view('user2/V_lengkapi_persyaratan',['data'=>$data,'data_upload'=>$data_upload]);    
}

public function form_persyaratan(){
if($this->input->post()){
$this->db->select('*');
$this->db->from('data_meta');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta.no_nama_dokumen');
$this->db->where('data_meta.no_nama_dokumen',$this->input->post('no_nama_dokumen'));
$data = $this->db->get();
$static = $data->row_array();
echo "<div class='card p-2 '>"
 . "<label>Nama Dokumen</label>"
 . "<input type='text' value='".$static['nama_dokumen']."'   name='Nama_berkas' class='form-control' required='' accept='text/plain' >";

foreach ($data->result_array() as $d){
echo "<label>".$d['nama_meta']."</label>"
    . "<input type='text' placeholder='".$d['nama_meta']."' name='".$d['nama_meta']."' class='form-control' required='' accept='text/plain'>";
}
echo "<label>Upload ".$d['nama_dokumen']."</label>"
        . "<input type='hidden'  name='no_nama_dokumen' value='".$d['no_nama_dokumen']."'  class='form-control' required='' accept='text/plain'>"
        . "<input type='file' name='file_berkas' class='form-control' required >"
        . "<hr>"
        . "<button class='btn btn-success btn-block btn-sm' type='submit'>Upload <span class='fa fa-upload'></span></button>";    

echo  "</div>";
}else{
redirect(404);    
}
}

public function simpan_persyaratan(){
if($this->input->post()){
$input = $this->input->post();
$config['upload_path']          = './berkas/'.$input['nama_folder'];
$config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|xlxs|';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);
if (!$this->upload->do_upload('file_berkas')){
$error = array('error' => $this->upload->display_errors());
echo print_r($error);
}else{
$data_berkas = array(
'no_client'      => $input['no_client'],
'no_pekerjaan'   => $input['no_pekerjaan'],
'no_nama_dokumen'=> $input['no_nama_dokumen'],
'nama_folder'    => $input['nama_folder'],
'nama_berkas'    => $this->upload->data('file_name'),
);    
$this->db->insert('data_berkas',$data_berkas);

foreach ($_POST as $key => $value){
if($value == $input['no_client'] || $value == $input['no_pekerjaan'] || $value == $input['no_nama_dokumen'] || $value == $input['nama_folder'] ){
    
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
}else{
redirect(404);    
}    
}
}

