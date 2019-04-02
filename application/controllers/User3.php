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
$data = array(
'tanggal_proses_tugas'  =>date('Y/m/d H:i:s'),
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
$data_tugas = $this->M_user3->data_tugas('Proses');    
$this->load->view('umum/V_header');
$this->load->view('user3/V_halaman_proses',['data_tugas'=>$data_tugas]);
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
'file_berkas'      => $get_syarat['file_berkas'],
'lampiran'         => $this->upload->data('file_name'),
'status_berkas'    => "Selesai",
'tanggal_selesai'  => date('Y/m/d H:i:s'),  
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
'status_dokumen'   => 'Selesai',
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

public function halaman_selesai(){
$data_tugas = $this->M_user3->data_tugas('Selesai');    
    
$this->load->view('umum/V_header');
$this->load->view('user3/V_halaman_selesai',['data_tugas'=>$data_tugas]);
    
}
public function json_data_perizinan_selesai(){
echo $this->M_user3->json_data_perizinan_selesai();       
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

}

