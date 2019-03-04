<?php 
class Dashboard extends CI_Controller{
    public function __construct() {
        parent::__construct();
$this->load->library('session');
$this->load->model('M_dashboard');
$this->load->library('Datatables');
$this->load->library('form_validation');
if($this->session->userdata('username') == NULL && $this->session->userdata('status') == NULL  && $this->session->userdata('level') == NULL && $this->session->userdata('nama_lengkap') == NULL && $this->session->userdata('username') == NULL){
redirect(base_url('Login'));
}else if($this->session->userdata('status') != 'Aktif'){
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
$user           = $this->M_dashboard->data_user();
$nama_dokumen   = $this->M_dashboard->data_nama_dokumen();
$nama_jenis   = $this->M_dashboard->data_jenis();

$this->load->view('umum/V_header');
$this->load->view('dashboard/V_setting',['user'=>$user,'nama_dokumen'=>$nama_dokumen,'nama_jenis'=>$nama_jenis]);
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

public function simpan_syarat(){
if($this->input->post()){
  
$data = array(
    'no_jenis_dokumen' => $this->input->post('no_jenis_dokumen'),
    'no_nama_dokumen'  => $this->input->post('no_nama_dokumen'),
    'nama_syarat'      => $this->input->post('nama_syarat'),
    'status_syarat'    => $this->input->post('status_syarat'),
    'pembuat_syarat'  => $this->session->userdata('nama_lengkap'),
    );

$this->M_dashboard->simpan_syarat($data);

$status = array(
"status"=>"Berhasil"
 );
echo json_encode($status);
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
$data = $this->input->post();

$h_berkas = $this->M_dashboard->hitung_berkas()->num_rows();
$no_berkas= str_pad($h_berkas,8 ,"0",STR_PAD_LEFT);

$id_berkas =  date("Ymd")."/".$this->session->userdata('no_user')."/".$no_berkas; 

$data_r = array(
'id_berkas'          => $id_berkas,
'no_berkas'          => $no_berkas,    
'folder_berkas'      => $no_berkas,    
'status_berkas'      => "Proses",    
'tanggal_dibuat'     => date('d/m/Y'),    
'no_user'            => $this->session->userdata('no_user'),    
'jenis_client'       => $data['data'][0]['jenis_client'],    
'jenis_perizinan'    => $data['data'][1]['jenis_akta'],
'id_jenis'           => $data['data'][2]['id_jenis'],
'nama'               => $data['data'][3]['badan_hukum'],
'alamat'             => $data['data'][4]['alamat_badan_hukum'],
);

$this->db->insert('data_berkas',$data_r);

$b = count($data['data'][5]);
for($i=0; $i<$b; $i++){
$data_perorangan = array(
'no_berkas_perorangan'           => $no_berkas,    
'nama_identitas'                 => $data['data'][5][$i]['nama_identitas'],   
'no_identitas'                   => $data['data'][5][$i]['no_identitas'],   
'status'                         => $data['data'][5][$i]['status'],   
'jenis_identitas'                => $data['data'][5][$i]['jenis_identitas']
 );
$this->db->insert('data_perorangan',$data_perorangan);
}
mkdir("berkas/".$no_berkas);
$status = array(
"status"     =>"Berhasil",
"no_berkas"  => base64_encode($no_berkas) 
 );
echo json_encode($status);
     
}else{
redirect(404);    
}
    
}


}
