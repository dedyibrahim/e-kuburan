<?php 
class Dashboard extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('download');
$this->load->library('session');
$this->load->model('M_dashboard');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');

if($this->session->userdata('username') == NULL && $this->session->userdata('status') == NULL  && $this->session->userdata('level') == NULL && $this->session->userdata('nama_lengkap') == NULL && $this->session->userdata('username') == NULL){
redirect(base_url('Login'));
}else if($this->session->userdata('status') != 'Aktif' && $this->session->userdata('level') != 'Admin' || $this->session->userdata('level') != 'Super Admin' ){
redirect(base_url('Login'));
}

} 


public function index(){

$this->setting();    
} 

public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}

public function setting(){
if($this->session->userdata('level') == "Super Admin"){    
$user           = $this->M_dashboard->data_user();
$nama_dokumen   = $this->M_dashboard->data_nama_dokumen();
$nama_jenis     = $this->M_dashboard->data_jenis();

$this->load->view('umum/V_header');
$this->load->view('dashboard/V_setting',['user'=>$user,'nama_dokumen'=>$nama_dokumen,'nama_jenis'=>$nama_jenis]);
}else{
redirect(404);    
}

}

public function simpan_jenis_dokumen(){
if($this->input->post()){

$jumlah_jenis        = $this->M_dashboard->data_jenis()->num_rows()+1;
$no_jenis            = str_pad($jumlah_jenis,4,"0",STR_PAD_LEFT);


$data = array(
'no_jenis_dokumen' =>"J_".$no_jenis,
'pekerjaan'        =>$this->input->post('pekerjaan'),
'nama_jenis'       =>$this->input->post('jenis_dokumen'),
'pembuat_jenis'    => $this->session->userdata('nama_lengkap'),  
);    
$this->M_dashboard->simpan_jenis($data);

$status = array(
"status"=>"Berhasil"
);
echo json_encode($status);

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
'sublevel'     => $input['sublevel'],
'status'       => $input['status'],
'email'        => $input['email'],
'phone'        => $input['phone'],
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
'sublevel'      => $input['sublevel'],
'status'        => $input['status'],        
'email'         => $input['email'],        
'phone'         => $input['phone'],        
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


public function simpan_nama_dokumen(){
if($this->input->post()){

$jumlah_nama_dokumen        = $this->M_dashboard->data_nama_dokumen()->num_rows()+1;
$no_nama_dokumen            = str_pad($jumlah_nama_dokumen,4 ,"0",STR_PAD_LEFT);


$data = array(
'no_nama_dokumen'   => "N_".$no_nama_dokumen,
'nama_dokumen'      => $this->input->post('nama_dokumen'),
'pembuat'           => $this->session->userdata('nama_lengkap'),   
);
$this->M_dashboard->simpan_nama_dokumen($data);

$status = array(
"status"=>"Berhasil"
);
echo json_encode($status);

}else{    
redirect(404);    
}    

}
public function getJenis(){
if($this->input->post()){
$data_jenis = $this->M_dashboard->getJenis($this->input->post('id_jenis_dokumen'))->row_array();

$data = array(
'id_jenis_dokumen' => $data_jenis['id_jenis_dokumen'],    
'no_jenis_dokumen' => $data_jenis['no_jenis_dokumen'],
'nama_jenis'       => $data_jenis['nama_jenis'],   
);
echo json_encode($data);

}else{
redirect(404);    
}
}
public function getSyarat(){
if($this->input->post()){
$query= $this->M_dashboard->getSyarat($this->input->post('no_jenis_dokumen'));

if($query->num_rows() > 0){

foreach ($query->result_array() as $data_jenis){
$data[] = array(
'id_syarat_dokumen' => $data_jenis['id_syarat_dokumen'],    
'no_jenis_dokumen'  => $data_jenis['no_jenis_dokumen'],
'no_nama_dokumen'   => $data_jenis['no_nama_dokumen'],
'nama_syarat'       => $data_jenis['nama_syarat'],   
'status_syarat'     => $data_jenis['status_syarat'],   
);
}
echo json_encode($data);
}else{
$status = array(
"status"=>"null"
);
echo json_encode($status);   

}
}else{
redirect(404);    
}

}
public function cari_nama_dokumen(){
$term = strtolower($this->input->get('term'));    
$query = $this->M_dashboard->cari_nama_dokumen($term);

foreach ($query as $d) {
$json[]= array(
'label'                    => $d->nama_dokumen,   
'id_nama_dokumen'          => $d->id_nama_dokumen,
'no_nama_dokumen'          => $d->no_nama_dokumen,
'nama_dokumen'             => $d->nama_dokumen,
);   
}
echo json_encode($json);
}
public function cari_nama_klien(){
$term = strtolower($this->input->get('term'));

$query = $this->M_dashboard->cari_nama_klien($term);
foreach ($query as $d) {
$json[]= array(
'label'                    => $d->nama_client,   
'no_client'                => $d->no_client,
);   
}

echo json_encode($json);
}




public function cari_data_perorangan(){
$term = strtolower($this->input->get('term'));    
$query = $this->M_dashboard->cari_data_perorangan($term);

foreach ($query as $d) {
$json[]= array(
'label'                             => $d->nama_identitas,   
'nama_identitas'                    => $d->nama_identitas,
'no_nama_perorangan'                => $d->no_nama_perorangan,
'no_identitas'                      => $d->no_identitas,
'jenis_identitas'                   => $d->jenis_identitas,
'file_berkas'                       => $d->file_berkas,
'file_lampiran'                     => $d->lampiran,
'status_jabatan'                   => $d->status_jabatan,
);   
}

echo json_encode($json);
}

public function cari_jenis_dokumen(){
$term = strtolower($this->input->get('term'));    
$query = $this->M_dashboard->cari_jenis_dokumen($term);

foreach ($query as $d) {
$json[]= array(
'label'                    => $d->nama_jenis,   
'no_jenis_dokumen'         => $d->no_jenis_dokumen,
);   
}
echo json_encode($json);
}
public function cari_user(){
$term = strtolower($this->input->get('term'));    
$query = $this->M_dashboard->cari_user($term);

foreach ($query as $d) {
$json[]= array(
'label'                    => $d->nama_lengkap,   
'nama_lengkap'             => $d->nama_lengkap,
'no_user'                  => $d->no_user,    
'email'                    => $d->email    
);   
}
echo json_encode($json);
}

public function json_data_jenis_dokumen(){
echo $this->M_dashboard->json_data_jenis_dokumen();       
}
public function json_data_daftar_persyaratan(){
echo $this->M_dashboard->json_data_daftar_persyaratan();       
}

public function json_data_user(){
echo $this->M_dashboard->json_data_user();       
}
public function json_data_jenis(){
echo $this->M_dashboard->json_data_jenis();       
}

public function json_data_client(){
echo $this->M_dashboard->json_data_client();       
}
public function json_data_perorangan(){
echo $this->M_dashboard->json_data_perorangan();       
}

public function json_dokumen_proses(){
echo $this->M_dashboard->json_dokumen_proses();       
}

public function json_data_nama_dokumen(){
echo $this->M_dashboard->json_data_nama_dokumen();       
}



public function jenis_dokumen(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_jenis_dokumen');
}

public function nama_dokumen(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_nama_dokumen');

}

public function create_client(){
if($this->input->post()){
if($this->session->userdata('level') == "User"){    
$status = array(
"status"     =>"error",
"pesan"  => "Anda tidak memiliki akses untuk membuat pekerjaan" 
);
echo json_encode($status);
}else{   
$data = $this->input->post();

$h_berkas = $this->M_dashboard->hitung_berkas()->num_rows()+1;
$h_client = $this->M_dashboard->data_client()->num_rows()+1;

$no_client= str_pad($h_client,6 ,"0",STR_PAD_LEFT);
$no_berkas= str_pad($h_berkas,6 ,"0",STR_PAD_LEFT);

$id_berkas =  date("Ymd")."/".$this->session->userdata('no_user')."/".$no_berkas; 
if(file_exists("berkas/".$no_berkas)){
$status = array(
"status"     =>"Gagal",
"pesan"     =>"File direktori sudah dibuat"   
);
echo json_encode($status);    


}else{

$data_client = array(
'no_client'                 => "C_".$no_client,    
'jenis_client'              => $data['data'][0]['jenis_client'],    
'nama_client'               => $data['data'][3]['badan_hukum'],
'alamat_client'             => $data['data'][4]['alamat_badan_hukum'],    
'tanggal_daftar'            => date('Y/m/d'),    
'pembuat_client'            => $this->session->userdata('nama_lengkap'),    
'no_user'                   => $this->session->userdata('no_user'),    
);    

$this->db->insert('data_client',$data_client);


$data_r = array(
'no_client'          => "C_".$no_client,    
'id_berkas'          => $id_berkas,
'no_berkas'          => $no_berkas,    
'folder_berkas'      => "file_".$no_berkas,    
'status_berkas'      => "Proses",    
'tanggal_dibuat'     => date('Y/m/d'),
'count_up'           => date('M,d,Y,H:i:s'),        
'no_user'            => $this->session->userdata('no_user'),    
'pembuat_berkas'     => $this->session->userdata('nama_lengkap'),    
'jenis_perizinan'    => $data['data'][1]['jenis_akta'],
'id_jenis'           => $data['data'][2]['id_jenis'],
);

$this->db->insert('data_berkas',$data_r);


$data_utama = array(
'no_client'          => "C_".$no_client,    
'no_berkas'          => $no_berkas,    
'file_berkas'        => "file_".$no_berkas,    
'draft'              => NULL,
'minuta'             => NULL,
'salinan'             => NULL,
);

$this->db->insert('data_dokumen_utama',$data_utama);



}

mkdir("berkas/"."file_".$no_berkas,0755);

$status = array(
"status"     =>"Berhasil",
"no_berkas"  => base64_encode($no_berkas) 
);
echo json_encode($status);
}

}else{
redirect(404);    
}

}

public function proses_berkas(){
$data           = $this->M_dashboard->data_berkas($this->uri->segment(3));    

$this->load->view('umum/V_header');
$this->load->view('dashboard/V_proses_berkas',['data'=>$data]);
}

public function dokumen_proses(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_dokumen_proses');
}




public function data_client(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_data_client');

}


public function getCLient(){
if($this->input->post()){
$query = $this->M_dashboard->cari_client($this->input->post('no_client'))->row_array();

$data = array(
'no_client'         =>  $query['no_client'],
'nama_client'       =>  $query['nama_client'],
'alamat_client'     =>  $query['alamat_client'],    
);

echo json_encode($data);
}else{
redirect(404);
}    
}


public function data_perorangan(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_data_perorangan');

}




public function simpan_pekerjaan_user(){
if($this->input->post()){
$input = $this->input->post();

$data_syarat = $this->db->get_where('data_syarat_jenis_dokumen',array('id_syarat_dokumen'=>$input['id_syarat_dokumen']))->row_array();    

$data = array (
'perizinan' =>$input['nama_user'],
'no_user'   =>$input['no_user']        
);
$this->db->update('data_syarat_jenis_dokumen',$data,array('id_syarat_dokumen'=>$input['id_syarat_dokumen']));

$data2 = array(
'nama_lengkap'      => $input['nama_user'],
'no_user'           => $input['no_user'],
'no_nama_dokumen'   => $data_syarat['no_nama_dokumen'],
'no_berkas'         => $data_syarat['no_berkas'],
);
$this->db->insert('data_pengurus_perizinan',$data2);


}else{
redirect(404);    
}
}

public function simpan_meta(){
if($this->input->post()){
$input = $this->input->post();
$data = array(
'no_nama_dokumen' =>$input['no_nama_dokumen'],
'nama_meta'       =>$input['nama_meta'], 
);
$this->db->insert('data_meta',$data);    
$status = array(
"status"      =>"success",
"pesan"       =>"Meta dokumen berhasil ditambahkan" 
);
echo json_encode($status);    
}else{
redirect(404);    
}       
}

public function lihat_data_meta(){
if($this->input->post()){
$data = $this->db->get_where('data_meta',array('no_nama_dokumen'=>$this->input->post('no_nama_dokumen')));
if($data->num_rows() >0){
echo "<table class='table table-sm  table-striped table-hover'>"
        . "<tr>"
        . "<th>No</th>"
        . "<th>Nama meta</th>"
        . "<th>Aksi</th>"
        . "</tr>";

$h =1;
foreach ($data->result_array() as $d){
echo "<tr>"
    . "<td>".$h++."</td>"
    . "<td>".$d['nama_meta']."</td>"
    . "<td><button class='btn btn-danger btn-sm' onclick=hapus_meta('".$d['id_data_meta']."')><span class='fa fa-trash'></span></button></td>"
    . "</tr>";
}
echo "</table>";
}else{
echo "<h3 align='center'>Tidak ada data meta yang bisa ditampilkan</h3>";    
}   
    
}else{
redirect(404);    
}    
}

public function hapus_data_meta(){
if($this->input->post()){
$this->db->delete('data_meta',array('id_data_meta'=>$this->input->post('id_data_meta')));    
}else{
redirect(404);    
}    
}
public function simpan_persyaratan(){
if($this->input->post()){
$input = $this->input->post();
$no_daftar_persyaratan= str_pad($this->db->get_where('data_daftar_persyaratan')->num_rows()+1,3 ,"0",STR_PAD_LEFT);

$data = array(
'no_daftar_persyaratan' =>"S_".$no_daftar_persyaratan,
'nama_persyaratan'      =>$input['nama_persyaratan'],
'no_nama_dokumen'       =>$input['no_nama_dokumen'],    
'nama_lampiran'         =>$input['nama_lampiran']    
);
$this->db->insert('data_daftar_persyaratan',$data);

$status = array(
"status"      =>"success",
"pesan"       =>"Daftar persyaratan berhasil ditambahkan" 
);
echo json_encode($status); 

}else{
redirect(404);    
} 
    
}


}


