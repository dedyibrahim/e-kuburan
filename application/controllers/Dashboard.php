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
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_new_client');
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
$no_jenis            = str_pad($jumlah_jenis,4 ,"0",STR_PAD_LEFT);


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

public function simpan_syarat(){
if($this->input->post()){

$this->db->select('no_client');
$no_client = $this->db->get_where('data_berkas',array('no_berkas' => base64_decode($this->input->post('no_berkas'))))->row_array();


$cek_array = array('no_client' => $no_client['no_client'], 'no_nama_dokumen' => $this->input->post('no_nama_dokumen'));
$hasil_cek = $this->db->get_where('data_dokumen',$cek_array);



if($hasil_cek->num_rows() == 0){
    
$cek_array2 = array('no_berkas' => base64_decode($this->input->post('no_berkas')), 'no_nama_dokumen' => $this->input->post('no_nama_dokumen'));
$hasil_cek2 = $this->db->get_where('data_syarat_jenis_dokumen',$cek_array2);
 
if($hasil_cek2->num_rows() == 0){

$data = array(
'no_nama_dokumen'  => $this->input->post('no_nama_dokumen'),
'nama_dokumen'     => $this->input->post('nama_dokumen'),
'no_berkas'        => base64_decode($this->input->post('no_berkas')),
'no_client'        => $no_client['no_client'],
'file_berkas'      => "file_".base64_decode($this->input->post('no_berkas')),
'lampiran'         => NULL,
);
$this->M_dashboard->simpan_syarat($data);
    
$status = array(
"status"=>"Berhasil"
);
echo json_encode($status);
    
}else{    
$status = array(
"status"=>"Gagal",
'pesan'=>"Dokumen sudah ditambahkan"   
);
echo json_encode($status);
}
    

}else{
    
$status = array(
"status"=> "Ganda",
"pesan" => "Anda tidak dapat mengupload jenis dokumen ini,silahkan klik menu dokumen sebelumnya untuk melihat dokumen tersebut"    
);
echo json_encode($status);

}

}else{
redirect(404);    
}
}
public function json_data_jenis_dokumen(){
echo $this->M_dashboard->json_data_jenis_dokumen();       
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
public function hapus_syarat(){
if($this->input->post()){
$this->M_dashboard->hapus_syarat_dokumen($this->input->post('id_syarat_dokumen'));    
}else{
redirect(404);    
}
}
public function hapus_data_syarat_perorangan(){
if($this->input->post()){
$this->M_dashboard->hapus_data_syarat_perorangan($this->input->post('id_data_syarat_perorangan'));    
}else{
redirect(404);    
}
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

public function form_perizinan(){
if($this->input->post()){
$data      = $this->M_dashboard->data_form_perizinan($this->input->post('no_berkas'));
$data_user = $this->M_dashboard->data_user(); 

echo "<div class='row'>";
foreach ($data->result_array() as $form){
 
if($form['perizinan'] == NULL){
    
echo "<div class='col-md-4 mx-auto m-3  p-2 '>";
echo "<div class='card p-2' id='syarat".$form['id_syarat_dokumen']."'> "
."<h6 align='center'>".$form['nama_dokumen']."</h6>"
."<hr>"
."<label>Pengurus perizinan </label>"
."<select class='form-control tentukan_user".$form['id_syarat_dokumen']."'>"
."<option value =''></option>";
foreach ($data_user->result_array() as $user){
echo "<option value='".$user['no_user']."'>".$user['nama_lengkap']."</option>";
}

echo "<select>"
. "<hr>"
. "<button onclick=tentukan_user('".$form['id_syarat_dokumen']."'); class='btn btn-block btn-success'>Simpan pengurus pekerjaan <i class='fa fa-save'></i></button>"
. "<br>"
. "<button class='btn  btn-danger m-2 btn_hapus_syarat".$form['id_syarat_dokumen']."' onclick='hapus_syarat(".$form['id_syarat_dokumen'].")'>Hapus syarat <i class='fa fa-trash'></i></button>";
echo "</div>";
echo "</div>";
}else{    
    
    
if($form['lampiran'] == NULL){    
echo "<div class='col-md-4 mx-auto m-2  p-2 '>"
. "<div class='card p-2' id='syarat".$form['id_syarat_dokumen']."'>"
."<h6 align='center'>".$form['nama_dokumen']."</h6>"
."<hr>"        
."<label>Upload dokumen </label>"
."<input type='file' id='dokumen_perizinan".$form['id_syarat_dokumen']."' class='form-control mb-2'>"

."<div style='display:none;' class='progress upload_perizinan".$form['id_syarat_dokumen']."'>"
."<div id='upload_perizinan_progress".$form['id_syarat_dokumen']."' class='bg-success progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:0%'></div>"
."</div>"

. "<hr>"
."<button class='btn  btn-success m-2 btn_upload_syarat".$form['id_syarat_dokumen']."' onclick='upload_syarat(".$form['id_syarat_dokumen'].")'>Upload syarat <i class='fa fa-upload'></i></button>"
. "<button class='btn  btn-danger m-2 btn_hapus_syarat".$form['id_syarat_dokumen']."' onclick='hapus_syarat(".$form['id_syarat_dokumen'].")'>Hapus syarat <i class='fa fa-trash'></i></button>"
. "<hr>"
   
."</div>"    
."</div>";


}else{

echo "<div class='col-md-4 mx-auto m-2  p-2 '>"
."<div class='card p-2' id='syarat".$form['id_syarat_dokumen']."'>"
."<button class='btn btn-sm  btn-success' onclick=download_perizinan('".$form['no_client']."','".$form['no_nama_dokumen']."'); >Download ".$form['nama_dokumen']."  <i class='fa fa-download'></i></button>"
. "</div>"
."</div>";


}
}
}
echo "</div>";    

}else{
redirect(404);    
}
}
public function form_perorangan(){
if($this->input->post()){
$data = $this->M_dashboard->data_form_perorangan($this->input->post('no_berkas'));


foreach ($data->result_array() as $form){
if($form['lampiran'] == NULL){    
echo "<div class='row m-2' id='syarat_perorangan".$form['id_data_syarat_perorangan']."'>"
. "<div class='col-md-4 card p-3'>"
. "Nama Identitas: ".$form['nama_identitas']."<br>"
. "No Identitas : ".$form['no_identitas']."<br>"
. "Jenis Identitas : ".$form['jenis_identitas']."<br>"
. "Status Jabatan : ".$form['status_jabatan']."<br>"
. "</div>"
. "<div class='col-md-5'>"
. "<label>Upload KTP/PASSPOR ".$form['nama_identitas']."</label>"
. "<input type='file' name='file_perorangan' id='file_perorangan".$form['id_data_syarat_perorangan']."' class='form-control'>"
."<hr>
<div style='display:none;' class='progress loading_perorangan".$form['id_data_syarat_perorangan']."'>
<div id='progress_file".$form['id_data_syarat_perorangan']."' class=' bg-success progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width: 0%'></div>
</div>"

. "</div>"
. "<div class='col'>" 
. "<button class='btn btn-danger m-2 btn-block' onclick='hapus_perorangan(".$form['id_data_syarat_perorangan'].")'>Hapus perorangan <i class='fa fa-trash'></i></button>"
. "<button class='btn btn-success m-2 btn-block' onclick='upload_perorangan(".$form['id_data_syarat_perorangan'].")'>Upload perorangan <i class='fa fa-upload'></i></button>"
. "</div>"
. "</div>";    

}else{
echo "<div class='row m-2' id='syarat_perorangan".$form['id_data_syarat_perorangan']."'>"
. "<div class='col-md-4 card p-3'>"
. "Nama Identitas: ".$form['nama_identitas']."<br>"
. "No Identitas : ".$form['no_identitas']."<br>"
. "Jenis Identitas : ".$form['jenis_identitas']."<br>"
. "Status Jabatan : ".$form['status_jabatan']."<br>"
. "</div>"
. "<div class='col-md-5'>"
. "<img style='width:auto; height:150px;' class='img-thumbnail mx-auto' src='".base_url('berkas/'.$form['file_berkas'].'/'.$form['lampiran'])."'>"
. "</div>"
. "<div class='col'>"
. "<button class='btn btn-danger btn-block m-2' onclick='hapus_perorangan(".$form['id_data_syarat_perorangan'].")'>Hapus perorangan <i class='fa fa-trash'></i></button>"
. "<button class='btn btn-warning btn-block m-2' onclick='update_foto(".$form['id_data_syarat_perorangan'].")'>Update Foto <i class='fa fa-edit'></i></button>"
. "</div>"
. "</div>"; 
    
}

}
}else{
redirect(404);    
}

}


public function create_perorangan(){
if($this->input->post()){
$data = $this->input->post();
$h_identitas = $this->M_admin->data_perorangan()->num_rows()+1;
$no_identitas="I_".str_pad($h_identitas,6 ,"0",STR_PAD_LEFT);

$cek_perorangan = $this->db->get_where('data_perorangan',array('no_identitas'=>$data['no_identitas']));

if($cek_perorangan->num_rows() >0){

$status = array(
"status"=>"Gagal",
"pesan" => "No Identitas sudah tersedia "
);
echo json_encode($status);



}else{
$config['upload_path']          = './berkas/file_'.base64_decode($data['file_berkas']).'/';
$config['allowed_types']        = 'gif|jpg|png';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);

if (!$this->upload->do_upload('file_perorangan')){

$status = array(
"status"=>"Gagal",
"pesan" => $this->upload->display_errors()
);
echo json_encode($status);


}else{
$data_perorangan = array(
'no_nama_perorangan' => $no_identitas,
'nama_identitas'     => $data['nama_identitas'],
'no_identitas'       => $data['no_identitas'],
'jenis_identitas'    => $data['jenis_identitas'],       
'file_berkas'        => "file_".base64_decode($data['file_berkas']),       
'status_jabatan'     => $data['status_jabatan'],
'lampiran'           => $this->upload->data('file_name')    
);

$this->M_dashboard->simpan_data_perorangan($data_perorangan);


$data2 = array(
'no_berkas'             => base64_decode($data['file_berkas']),
'no_nama_perorangan'    =>$no_identitas,
'nama_identitas'        =>$data['nama_identitas'],
'no_identitas'          =>$data['no_identitas'],
'jenis_identitas'       =>$data['jenis_identitas'],
'file_berkas'           =>"file_".base64_decode($data['file_berkas']),   
'lampiran'              =>$this->upload->data('file_name') ,
'status_jabatan'        =>$data['status_jabatan'],
);    

$this->M_dashboard->simpan_syarat_perorangan($data2);    


$status = array(
"status"=>"Berhasil",
"pesan" => "Data Perorangan berhasil disimpan"
);
echo json_encode($status);
}
    

}




}else{
redirect(404);    
}

}

public function simpan_syarat_perorangan(){
if($this->input->post()){
$input = $this->input->post();    

$cek_syarat_perorangan = $this->db->get_where('data_syarat_perorangan',array('no_berkas'=>base64_decode($input['no_berkas']),'no_nama_perorangan'=>$input['no_nama_perorangan']));    


if($cek_syarat_perorangan->num_rows() >0 ){

$status = array(
"status"=>"Gagal",
"pesan" => "Data perorangan sudah tersedia "
);
echo json_encode($status);
}else{
$data = array(
'no_berkas'             => base64_decode($input['no_berkas']),
'no_nama_perorangan'    =>$input['no_nama_perorangan'],
'nama_identitas'        =>$input['nama_identitas'],
'no_identitas'          =>$input['no_identitas'],
'jenis_identitas'       =>$input['jenis_identitas'],
'file_berkas'           =>$input['file_berkas'],   
'lampiran'              =>$input['file_lampiran'],
'status_jabatan'        =>$input['status_jabatan'],
);    

$this->M_dashboard->simpan_syarat_perorangan($data);    
$status = array(
"status"=>"Berhasil",
"pesan" => "Data Perorangan berhasil tambahkan "
);
echo json_encode($status);

}

}else{
redirect(404);    
}
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

public function simpan_data_berkas(){
if($this->input->post()){

$h_berkas = $this->M_dashboard->hitung_berkas()->num_rows()+1;

$no_berkas= str_pad($h_berkas,6 ,"0",STR_PAD_LEFT);

$id_berkas =  date("Ymd")."/".$this->session->userdata('no_user')."/".$no_berkas; 

if($this->session->userdata('level') == "User"){    
$status = array(
"status"     =>"error",
"pesan"  => "Anda tidak memiliki akses untuk membuat pekerjaan" 
);
echo json_encode($status);
}else if($this->session->userdata('perizinan') == NULL){
$status = array(
"status"     =>"error",
"pesan"  => "Tunjuk salah satu orang untuk mengurus perizinan" 
);
echo json_encode($status);

}else{ 
if(file_exists("berkas/".$no_berkas)){
$status = array(
"status"     =>"Gagal",
"pesan"     =>"File direktori sudah dibuat"   
);
echo json_encode($status);    

}else{
$data_r = array(
'no_client'          => $this->input->post('no_client'),    
'id_berkas'          => $id_berkas,
'no_berkas'          => $no_berkas,    
'folder_berkas'      => "file_".$no_berkas,    
'status_berkas'      => "Proses",    
'tanggal_dibuat'     => date('Y/m/d'),
'count_up'           => date('M,d,Y,H:i:s'),    
'no_user'            => $this->session->userdata('no_user'),    
'pembuat_berkas'     => $this->session->userdata('nama_lengkap'),    
'jenis_perizinan'    => $this->input->post('jenis_akta'),
'id_jenis'           =>$this->input->post('id_jenis_akta'),
);

$this->db->insert('data_berkas',$data_r);


$data_utama = array(
'no_client'          => $this->input->post('no_client'),    
'no_berkas'          => $no_berkas,    
'file_berkas'        => "file_".$no_berkas,    
'draft'              => NULL,
'minuta'             => NULL,
'salinan'             => NULL,
);

$this->db->insert('data_dokumen_utama',$data_utama);

$data3 = $this->session->userdata('perizinan');
$ht = count($data3);
foreach ($data3 as $s=>$ht){
$dt = array(
'no_berkas'     =>$no_berkas,
'no_user'       =>$data3[$s]['no_user'],
'nama_lengkap'  =>$data3[$s]['nama_lengkap'],
'email'         =>$data3[$s]['email'],
);
$this->db->insert('data_perizinan',$dt);  
}


unset($_SESSION['perizinan']);    

mkdir("berkas/"."file_".$no_berkas,0755);

$status = array(
"status"     =>"Berhasil",
"no_berkas"  => base64_encode($no_berkas) 
);

echo json_encode($status);

}
}        
}else{
redirect(404);    
}


}

public function data_perorangan(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_data_perorangan');

}
public function simpan_file_perorangan(){
if($this->input->post()){

    
    $query = $this->M_dashboard->ambil_data_syarat_perorangan($this->input->post('id_data_perorangan'))->row_array();

$config['upload_path']          = './berkas/'.$query['file_berkas'].'/';
$config['allowed_types']        = 'gif|jpg|png';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);
if (!$this->upload->do_upload('file_perorangan')){
$error = array('error' => $this->upload->display_errors());
echo print_r($error);
}else{
$data = array(
'lampiran' => $this->upload->data('file_name')
);
$where = array('no_nama_perorangan'=>$query['no_nama_perorangan']);
$this->db->update('data_perorangan',$data,$where);
$this->db->update('data_syarat_perorangan',$data,$where);
    
}
}else{
redirect(404);    
}

}
public function hapus_lampiran(){
if($this->input->post()){
$query = $this->M_dashboard->ambil_data_syarat_perorangan($this->input->post('id_data_perorangan'))->row_array();
unlink('./berkas/'.$query['file_berkas']."/".$query['lampiran']);
$data = array(
'lampiran' => NULL
);
$where = array('no_nama_perorangan'=>$query['no_nama_perorangan']);
$this->db->update('data_perorangan',$data,$where);
$this->db->update('data_syarat_perorangan',$data,$where);
}else{
redirect(404);       
}   
}

public function download_lampiran_perorangan(){
$query = $this->M_dashboard->ambil_data_perorangan($this->uri->segment(3))->row_array();
  
force_download('./berkas/'.$query['file_berkas'].'/'.$query['lampiran'], NULL);

/*    
if($this->input->post()){
$query = $this->M_dashboard->ambil_data_perorangan($this->input->post('id_perorangan'))->row_array();

$cek_file = FCPATH.'berkas/'.$query['file_berkas'].'/'.$query['lampiran'];

if(file_exists($cek_file)){
$data =array(
'status'     =>"Berhasil",   
'file_berkas'=>$query['file_berkas'],    
'lampiran'   =>$query['lampiran'],
'pesan'      =>'File berhasil di download',    
);


}else{
$data =array(
'status'     =>"Gagal",   
'pesan'      =>'File download tidak tersedia',
);    
}
echo json_encode($data);

}else{
redirect(404);    
}*/

}

public function simpan_file_perizinan(){
if($this->input->post()){
$get_syarat = $this->db->get_where('data_syarat_jenis_dokumen',array('id_syarat_dokumen'=>$this->input->post('id_syarat_dokumen')))->row_array();

$config['upload_path']          = './berkas/'.$get_syarat['file_berkas'].'/';
$config['allowed_types']        = 'jpg|png|pdf|docx|doc|xls|xlsx|';
$config['encrypt_name']         = TRUE;
$this->upload->initialize($config);

if (!$this->upload->do_upload('dokumen_perizinan')){

$status = array(
"status"=>"Gagal",
"pesan" => $this->upload->display_errors()
);
echo json_encode($status);
}else{

$data2 = array(
'file_berkas' => $get_syarat['file_berkas'],
'lampiran'    => $this->upload->data('file_name')
);
$this->db->update('data_syarat_jenis_dokumen',$data2,array('id_syarat_dokumen'=>$this->input->post('id_syarat_dokumen')));

$data_dokumen = array(
'no_nama_dokumen'  => $get_syarat['no_nama_dokumen'],
'nama_dokumen'     => $get_syarat['nama_dokumen'],
'no_berkas'        => $get_syarat['no_berkas'],
'no_client'        => $get_syarat['no_client'],
'file_berkas'      => $get_syarat['file_berkas'],
'lampiran'         => $this->upload->data('file_name'),
'pengupload'       => $this->session->userdata('nama_lengkap'),
'no_user'          => $this->session->userdata('no_user'),
);    
$this->db->insert('data_dokumen',$data_dokumen);    
   




$status = array(
"status"=>"Berhasil",
"pesan" =>"File ".$get_syarat['nama_dokumen']." Berhasil di upload",
);
echo json_encode($status);
    
}
}else{
redirect(404);    
}    
}


public function form_utama(){
if($this->input->post()){
    
$data = $this->M_dashboard->data_dokumen_utama($this->input->post('no_berkas'))->row_array();
if($data['draft'] == NULL){
echo ""
. "<div class='col'>"
."<label>Upload Draft</label>"
."<input type='file' id='file_draft' name='file_draft' class='form-control mb-2'>"
."<div style='display:none;' class='progress upload_utama_draft'>"
."<div id='progress_upload_utama_draft' class='bg-success progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:0%'></div>"
."</div>"        
."<hr>"
."<button onclick=upload_utama('".$data['no_berkas']."','draft'); class='btn btn-block btn-success upload_draft'>Upload Draft <i class='fa fa-upload'></i></button>"
."</div>";
}else{
echo "<div class='col'>"
. "<button class='btn btn-success btn-block' onclick=download_utama('".$data['no_berkas']."','draft');> Download Draft <span class='fa fa-download'></span></button>"
. "<button class='btn btn-warning btn-block' onclick=update_utama('".$data['no_berkas']."','draft');> Ganti Draft <span class='fa fa-edit'></span></button>"
. ""
. "</div>";  
}

if($data['minuta'] == NULL){
echo "<div class='col'>"
."<label>Upload Minuta</label>"
."<input type='file' id='file_minuta' name='file_minuta' class='form-control mb-2'>"
."<div style='display:none;' class='progress upload_utama_minuta'>"
."<div id='progress_upload_utama_minuta' class='bg-success progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:0%'></div>"
."</div>"        
."<hr>"
."<button onclick=upload_utama('".$data['no_berkas']."','minuta'); class='btn btn-block btn-success upload_minuta'>Upload Minuta <i class='fa fa-upload'></i></button>"
."</div>";
}else{
echo "<div class='col'>"
. "<button class='btn btn-success btn-block ' onclick=download_utama('".$data['no_berkas']."','minuta');> Download Minuta <span class='fa fa-download'></span></button>"
. "<button class='btn btn-warning btn-block' onclick=update_utama('".$data['no_berkas']."','minuta');> Ganti Minuta <span class='fa fa-edit'></span></button>"
. ""
. "</div>";   
}

if($data['salinan'] == NULL){
echo "<div class='col'>"
."<label>Upload Salinan</label>"
."<input type='file' id='file_salinan' name='file_salinan' class='form-control mb-2'>"
."<div style='display:none;' class='progress upload_utama_salinan'>"
."<div id='progress_upload_utama_salinan' class='bg-success progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:0%'></div>"
."</div>"        
."<hr>"
."<button onclick=upload_utama('".$data['no_berkas']."','salinan'); class='btn btn-block btn-success upload_salinan'>Upload Salinan <i class='fa fa-upload'></i></button>"
."</div>";
}else{
echo "<div class='col'>"
. "<button class='btn btn-success btn-block' onclick=download_utama('".$data['no_berkas']."','salinan');> Download Salinan <span class='fa fa-download'></span></button>"
. "<button class='btn btn-warning btn-block' onclick=update_utama('".$data['no_berkas']."','salinan');> Ganti Salinan <span class='fa fa-edit'></span></button>"
. ""
. "</div>";   
}

echo "";

}else{
redirect(404);    
}

}

public function simpan_utama(){
if($this->input->post()){

$input = $this->input->post();    
$config['upload_path']          = './berkas/file_'.$input['no_berkas'].'/';
$config['allowed_types']        = 'pdf|jpg|png|excel|xlsx|xsls|docx|doc|';
$config['encrypt_name']         = TRUE;

$this->upload->initialize($config);

if (!$this->upload->do_upload('file_utama')){

$status = array(
"status"=>"Gagal",
"pesan" => $this->upload->display_errors()
);
echo json_encode($status);
}else{   

if($input['file_jenis'] == 'draft'){
$data = array(
'draft' => $this->upload->data('file_name')    
);
    
}else if($input['file_jenis'] == 'minuta'){
$data = array(
'minuta' => $this->upload->data('file_name')    
);
    
}else if($input['file_jenis'] == 'salinan'){
$data = array(
'salinan' => $this->upload->data('file_name')    
);
}

$this->db->update('data_dokumen_utama',$data,array('no_berkas'=>$input['no_berkas']));
    
    
$status = array(
"status"=>"Berhasil",
"pesan" =>"Dokumen berhasil di upload"
);
echo json_encode($status);
    
}
}else{
redirect(404);    
}

}
public function dokumen_sebelumnya(){
if($this->input->post()){
$this->db->select('no_client');
$no_client = $this->db->get_where('data_berkas',array('no_berkas' => base64_decode($this->input->post('no_berkas'))))->row_array();

$data_dokumen = $this->db->get_where('data_dokumen',array('no_client'=>$no_client['no_client']));


if($data_dokumen->num_rows() > 0){
$h =1;
 echo "<table class='table table-sm table-bordered table-condensed table-striped table-hover'>"
. "<tr>"
. "<th>No</th>"
. "<th>Nama dokumen</th>"
. "<th>Uploader</th>"
. "<th>Aksi</th>"
. "</tr>";

foreach ($data_dokumen->result_array() as $data){
echo "<tr>"
        . "<td>".$h++."</td>"
        . "<td>".$data['nama_dokumen']."</td>"
        . "<td>".$data['pengupload']."</td>"
        ."<td  align='center'>"
        . "<button class='btn btn-success btn-sm' onclick=download_perizinan('".$data['no_client']."','".$data['no_nama_dokumen']."'); >Download <span class='fa fa-download'></span></button> || "
        . "<button class='btn btn-success btn-sm' onclick='perbaharui(".$data['id_data_dokumen'].")'>Perbaharui <span class='fa fa-edit'></span></button>"
        . "</td>"
     . "<tr>";
}
echo "</table>"; 
    


}else{
echo ""
    . "<h4 align='center'>Tidak ada dokumen sebelumnya yang di upload</h4>"
     . "";    
    
}

}else{
redirect(404);    
}    
}

public function perbaharui(){
if($this->input->post()){
$data_seblm = $this->db->get_where('data_dokumen',array('id_data_dokumen' => $this->input->post('id_data_dokumen')))->row_array();

$data = array(
'no_nama_dokumen'  => $data_seblm['no_nama_dokumen'],
'nama_dokumen'     => $data_seblm['nama_dokumen'],
'no_berkas'        => base64_decode($this->input->post('no_berkas')),
'no_client'        => $data_seblm['no_client'],
'file_berkas'      => "file_".base64_decode($this->input->post('no_berkas')),
'lampiran'         => NULL,
);
$this->db->update('data_syarat_jenis_dokumen',$data,array('no_nama_dokumen'=>$data_seblm['no_nama_dokumen'],'no_client'=>$data_seblm['no_client']));
$this->db->delete('data_dokumen',array('id_data_dokumen'=>$this->input->post('id_data_dokumen')));

unlink('./berkas/'.$data_seblm['file_berkas']."/".$data_seblm['lampiran']);
}else{
redirect(404);    
}    
}

public function perbaharui_utama(){
if($this->input->post()){
$h = $this->db->get_where('data_dokumen_utama',array('no_berkas'=>$this->input->post('no_berkas')))->row_array();

$jenis_utama = $this->input->post('jenis_utama');

if($jenis_utama == "draft"){
unlink('./berkas/'.$h['file_berkas']."/".$h['draft']);
$data = array(
'draft'=>NULL    
);    
}elseif($jenis_utama == "minuta"){
unlink('./berkas/'.$h['file_berkas']."/".$h['minuta']);
$data = array(
'minuta'=>NULL    
);    
    
}elseif ($jenis_utama =="salinan"){
unlink('./berkas/'.$h['file_berkas']."/".$h['salinan']);    
$data = array(
'salinan'=>NULL    
);    
}
    
$this->db->update('data_dokumen_utama',$data,array('no_berkas'=>$h['no_berkas']));    
    
}else{
redirect(404);    
} 
}
public function download_utama($no_berkas,$jenis){
$query = $this->db->get_where('data_dokumen_utama',array('no_berkas'=>$no_berkas))->row_array();

if($jenis== "draft"){
force_download('./berkas/'.$query['file_berkas'].'/'.$query['draft'], NULL);    
}elseif($jenis == "minuta"){
force_download('./berkas/'.$query['file_berkas'].'/'.$query['minuta'], NULL);
}elseif ($jenis =="salinan"){
force_download('./berkas/'.$query['file_berkas'].'/'.$query['salinan'], NULL);

}

}
public function download_perizinan($no_client,$no_nama_dokumen){
$query = $this->db->get_where('data_dokumen',array('no_client'=>$no_client,'no_nama_dokumen'=>$no_nama_dokumen))->row_array();
force_download('./berkas/'.$query['file_berkas'].'/'.$query['lampiran'], NULL);    
}

/*
public function set_client_perizinan(){
if($this->input->post()){
$input = $this->input->post();

if($this->session->userdata('perizinan') == NULL){
$data["perizinan"][] = [
'no_user'      => $input['no_user'],
'email'        => $input['email'],
'nama_lengkap' => $input['nama_lengkap'],  
];    
$this->session->set_userdata($data);
echo print_r($this->session->userdata());
}else{
$data_perizinan_lama = $this->session->userdata('perizinan');
$data = array(
'no_user'      => $input['no_user'],
'email'        => $input['email'],
'nama_lengkap' => $input['nama_lengkap'],  
);    
array_push($data_perizinan_lama,$data);
$this->session->set_userdata('perizinan',$data_perizinan_lama);
echo print_r($this->session->userdata());

}
}else{
redirect(404);    
}
}*/

public function data_perizinan_sementara(){
$data = $this->session->userdata('perizinan');
if(is_array($data) || is_object($data)){
$ht = count($data);
$z = 1 ;
foreach ($data as $s=>$ht){
echo "<div class='row  m-1 perizinan".$s."'>"
    . "<div class='col-xs-2'>".$z++."</div>"
    . "<div class='col-md-9'>".$data[$s]['nama_lengkap']."</div>"
    . "<div class='col'><button type='button' onclick=hapus_perizinan(".$s."); class='btn btn-danger'><span class='fa fa-trash float-right'></span></button></div>"
    . "</div>";

}
}
}
public function  hapus_data_perizinan_sementara(){
$id_hapus = $this->input->post('id');
unset($_SESSION['perizinan'][$id_hapus]);    
    
}
public function cari_dokumen(){
if($this->input->post()){
 
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_hasil_cari');    
    
}else{
redirect(404);     
} 
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



}


