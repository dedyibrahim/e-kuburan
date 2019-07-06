<?php
class Perpanjang extends CI_Controller{
public function __construct() {
parent::__construct();
require_once (APPPATH.'third_party/dompdf/dompdf_config.inc.php');
$this->load->helper('download');
$this->load->library('session');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');
$this->load->model('M_perpanjang');
$this->load->library('recaptcha');

if(!$this->session->userdata('nik_ahli_waris')){
redirect(base_url('Pemakaman'));
}
} 

public function index(){
$this->load->view('umum/V_header');    
$this->load->view('perpanjang/V_perpanjang');
}




public function json_data_perpanjang(){
echo $this->M_perpanjang->json_data_jenazah();       
}

public function simpan_bukti_perpanjang(){
if($this->input->post()){
$config['upload_path']          = './uploads/bukti_transfer';
$config['allowed_types']        = 'gif|jpg|png';
$config['encrypt_name']        = TRUE;

$this->upload->initialize($config);

if (!$this->upload->do_upload('bukti_transfer')){  
$status = array(
'status' =>"error",
'message' =>$this->upload->display_error(),   
);

}else{

$id_perpanajang    = "PPJM".str_pad($this->db->get('data_perpanjang')->num_rows()+1,4,"0",STR_PAD_LEFT);
    
    
$data = array(
'id_perpanjang'            => $id_perpanajang,    
'bukti_transfer'           => $this->upload->data('file_name'),    
'id_jenazah'               => $this->input->post('id_jenazah'),    
'status'                   =>"Proses"
);

$this->db->insert('data_perpanjang',$data);

$status = array(
'status' =>'success',
'message' =>'Bukti transfer berhasil dilampirkan dan akan di proses'    
);
}
echo json_encode($status);

}else{
redirect(404);    
}

}
public function logout(){
$this->session->sess_destroy();
redirect (base_url('Pemakaman'));
}


}