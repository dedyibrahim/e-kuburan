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
} 

public function index(){
$this->load->view('umum/V_header');
$this->load->view('perpanjang/V_perpanjang');
}


public function cari_jenazah(){
if($this->input->post()){
$input = $this->input->post();
$data = $this->db->get_where('data_jenazah',array('nik_ahli_waris'=>$input['nik_ahli_waris']));
if($data->num_rows() >0){
echo "<div class='text-center'><h3>Daftar jenazah dengan nik ahli waris <br>".$input['nik_ahli_waris']."</h3></di>";    
echo "<table class='table table-bordered table-sm table-condensed'>"
    . "<tr>"
        . "<td>Nama Jenazah</td>"
        . "<td>Nama Ahli waris</td>"
        . "<td>Tanggal Wafat</td>"
        . "<td>Tanggal Expired</td>"
        . "<td>Aksi</td>"
        . "</tr>";

        foreach ($data->result_array() as $d){
            echo "<tr>"
            . "<td>".$d['nama_jenazah']."</td>"
            . "<td>".$d['nama_ahli_waris']."</td>"
            . "<td>".$d['tanggal_wafat']."</td>"
            . "<td>".$d['tanggal_expired']."</td>"
                    . "<td class='text-center'><button onclick=perpanjang_makam('".$d['nik_jenazah']."'); class='btn btn-success btn-sm '><span class='fa fa-upload'></span> Upload Bukti transfer</td>"
                    . "</tr>";
        }


 echo "</table>";    
}else{
echo "<div class='text-center'><h3>Tidak dapat menemukan jenazah dengan nik ahli waris <br>".$input['nik_ahli_waris']."</h3></di>";    
}
    
}else{
redirect(404);    
}
    
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

$data = array(
'bukti_transfer'           => $this->upload->data('file_name'),    
'nik_jenazah'             => $this->input->post('nik_jenazah'),    
'status'                    =>"Proses"
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


}