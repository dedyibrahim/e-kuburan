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

$this->db->select('*');
$this->db->from('data_ahli_waris');
$this->db->join('data_jenazah', 'data_jenazah.id_ahli_waris = data_ahli_waris.id_ahli_waris');
$this->db->where('data_ahli_waris.nik_ahli_waris',$input['nik_ahli_waris']);
$data = $this->db->get();
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
            . "<td>".$d['nama']."</td>"
            . "<td>".$d['tanggal_wafat']."</td>"
            . "<td>".$d['tanggal_expired']."</td>"
                    . "<td class='text-center'><button onclick=perpanjang_makam('".$d['id_jenazah']."'); class='btn btn-success btn-sm '><span class='fa fa-upload'></span> Upload Bukti transfer</td>"
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


}