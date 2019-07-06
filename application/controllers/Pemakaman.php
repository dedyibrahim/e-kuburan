<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pemakaman extends CI_Controller {

public function __construct() {
parent::__construct();
require_once (APPPATH.'third_party/dompdf/dompdf_config.inc.php');
$this->load->helper('download');
$this->load->library('session');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');
$this->load->library('recaptcha');
} 


public function index(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_beranda');
$this->load->view('umum/V_footer_depan');

}
public function layanan(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_layanan');
$this->load->view('umum/V_footer_depan');	

}
public function kontak(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_kontak');
$this->load->view('umum/V_footer_depan');	

}
public function tentang_kami(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_tentang_kami');
$this->load->view('umum/V_footer_depan');	

}
public function perpanjang(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_perpanjang');
$this->load->view('umum/V_footer_depan');	

}
public function pemesanan(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_pemesanan');
$this->load->view('umum/V_footer_depan');	

}
public function pendaftaran(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_pendaftaran');
$this->load->view('umum/V_footer_depan');	

}


public function makam(){
$this->load->view('umum/V_header_depan');
$this->load->view('depan/V_makam');
$this->load->view('umum/V_footer_depan');	

}

public function login_perpanjang(){
$data = array(
'action'         => site_url('Pemakaman/proses_login'),
'username'       => set_value('username'),
'password'       => set_value('password'),
'captcha'        => $this->recaptcha->getWidget(), 
'script_captcha' => $this->recaptcha->getScriptTag(),
);    

$this->load->view('umum/V_header');
$this->load->view('perpanjang/V_login',$data);

}

public function proses_login(){
$input = $this->input->post();
$this->form_validation->set_rules('username', ' ', 'trim|required');
$this->form_validation->set_rules('password', ' ', 'trim|required');
$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
$recaptcha = $this->input->post('g-recaptcha-response');
$response = $this->recaptcha->verifyResponse($recaptcha);
if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
$this->session->set_flashdata('status_login', 'Anda belum memasukan username atau password');
redirect(base_url('Pemakaman/login_perpanjang'));
} else {
$data = $this->db->get_where('data_ahli_waris',array('nik_ahli_waris'=>$input['username']))->row_array();
$password   = $this->input->post('password');
$hash       = $data['password'];
if(password_verify($password,$hash)){

$sesi = array(
'id_ahli_waris'     => $data['id_ahli_waris'],    
'nik_ahli_waris'    => $data['nik_ahli_waris'],    
'email'             => $data['email'],    
'nama'              => $data['nama'],
'no_tlp'            => $data['no_tlp'],
);    
$this->session->set_userdata($sesi);   

redirect(base_url('Perpanjang'));
}else{
$this->session->set_flashdata('status_login', 'Username atau password yang dimasukan salah');
redirect(base_url('Pemakaman/login_perpanjang'));
}   
}    
}

}
