<?php 
class Dashboard extends CI_Controller{
public function __construct() {
parent::__construct();
require_once (APPPATH.'third_party/dompdf/dompdf_config.inc.php');
        
$this->load->library('email');
$this->load->helper('download');
$this->load->library('session');
$this->load->model('M_dashboard');
$this->load->library('Datatables');
$this->load->library('form_validation');
$this->load->library('upload');
if(!$this->session->userdata('nama_depan') ){
redirect(base_url('Login'));
}

} 

public function index(){
$this->input_ahli_waris();
    
} 
public function perpanjang_makam(){
    
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_perpanjang_makam');
}

public function user(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_user');
}

public function  simpan_user(){
if($this->input->post()){
$input = $this->input->post();
$hasil_cek = $this->M_dashboard->cek_user(array('username'=>$input['username']));

if($hasil_cek->num_rows() == 1){
$status = array(
'status'    =>'error',
'message'   =>'Username sudah digunakan'
);   
}elseif($input['password'] != $input['ulangi_password']){

$status = array(
'status'    =>'error',
'message'   =>'Password yang dimasukan tidak sama'
);    
}else{
 $id_user    = "USR".str_pad($this->db->get('data_user')->num_rows()+1,4,"0",STR_PAD_LEFT);
   
$data = array(
'id_data_user'  => $id_user,    
'nama_depan'    => $input['nama_depan'],
'nama_belakang' => $input['nama_belakang'],
'nama_lengkap'  => $input['nama_depan']." ".$input['nama_belakang'],
'level'         => $input['level'],   
'username'      => $input['username'],
'password'      => password_hash($input['password'],PASSWORD_DEFAULT),    
);
$status = array(
'status'    =>'success',
'message'   =>'User baru berhasil ditambahkan'
);
$this->M_dashboard->simpan_user($data);
}
echo json_encode($status);

}else{
redirect(404);    
}
}
public function hapus_user(){
if($this->input->post()){
    
    
$this->db->delete('data_user',array('id_data_user'=>$this->input->post('id_data_user')));    
}else{
redirect(404);    
}    
}
public function hapus_blok(){
if($this->input->post()){   
$this->db->delete('data_blok',array('id_blok'=>$this->input->post('id_blok')));    
}else{
redirect(404);    
}    
}

public function json_data_user(){
echo $this->M_dashboard->json_data_user();       
}

public function json_data_perpanjang(){
echo $this->M_dashboard->json_data_perpanjang();       
}

public function json_data_jenazah(){
echo $this->M_dashboard->json_data_jenazah();       
}

public function json_data_blok(){
echo $this->M_dashboard->json_data_blok();       
}

public function json_data_ahli_waris(){
echo $this->M_dashboard->json_data_ahli_waris();       
}

public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
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

public function pengaturan_blok(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_pengaturan_blok');
    
}
public function input_ahli_waris(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_input_ahli_waris');
    
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


public function simpan_ahli_waris(){
if($this->input->post()){
$input = $this->input->post();

$id_ahli_waris    = "AW".str_pad($this->db->get('data_ahli_waris')->num_rows()+1,4,"0",STR_PAD_LEFT);

$cek_nik = $this->db->get_where('data_ahli_waris',array('nik_ahli_waris'=> $input['nik']));
if($cek_nik->num_rows() == 1){

$status = array(
'status'    =>'error',
'message'   =>'Nik ahli waris sudah terdaftar'
);
echo json_encode($status);
    
    
}else{
$password_random =  $this->randomPassword();

$config = Array(
'protocol'  => 'smtp',
'smtp_host' => 'ssl://smtp.googlemail.com',
'smtp_port' => 465,
'smtp_user' => 'sintamasnah@gmail.com',
'smtp_pass' => 'admin@112233',
'mailtype'  => 'html',
'charset'   => 'iso-8859-1',
'wordwrap'  => TRUE
);

$this->email->initialize($config);
$this->email->set_newline("\r\n");
$this->email->from("sintamasnah@gmail.com");
$this->email->to($input['email']);
$this->email->subject('Konfirmasi akun E-TPU');

$data_kirim  ="<h3>Terimakasih anda telah melakukan pendaftaran di E-TPU</h3><br>";
$data_kirim .="<p>data pemesanan makam dapat anda lihat dihalaman ".base_url()." "
            . "dengan cara memasukan nik dan password dibawah ini</p>";
$data_kirim .="<p>NIK : ".$input['nik']."<br>"
        . "Password : ".$password_random."</p>";
$data_kirim .="<p>Jangan beritahukan password ini kepada siapapun kecuali orang yang anda tunjuk sebagai ahli waris "
        . "berikutnya. <br>"
        . "Atas perhatian dan kerjasamanya kami ucapkan terimakasih.</p>";

$this->email->message($data_kirim);
if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
$data = array(
'id_ahli_waris'     => $id_ahli_waris,    
'nik_ahli_waris'    => $input['nik'],
'password'          => password_hash($password_random,PASSWORD_DEFAULT),   
'nama'              => $input['nama'],
'email'             => $input['email'],
'alamat'            => $input['alamat'],
'no_tlp'            => $input['no_tlp'],
'hubungan_keluarga' => $input['hubungan_keluarga']    
);

$this->M_dashboard->simpan_ahli_waris($data);

$status = array(
'status'    =>'success',
'message'   =>'Ahli waris berhasil ditambahkan'
);
echo json_encode($status);

    
} 
    
}

}else{
redirect(404);    
}
    
}

public function simpan_blok(){
if($this->input->post()){
$input = $this->input->post();
$nama_blok    = str_pad($this->db->get('data_blok')->num_rows()+1,2,"0",STR_PAD_LEFT);

$data= array(
'id_blok'       => "BLOK".$nama_blok,
'nama_blok'     => $input['nama_blok'],
'jumlah_makam'  => $input['jumlah_makam'],
'nama_agama'    => $input['nama_agama'] 
);

$this->M_dashboard->simpan_blok($data);

$status = array(
'status' =>'success',
'message' =>'Blok Makam berhasil disimpan'    
);

echo json_encode($status);

}else{
redirect(404);    
}       
}
public function simpan_ktp_waris(){
if($this->input->post()){
$config['upload_path']          = './uploads/ktp_ahli_waris';
$config['allowed_types']        = 'gif|jpg|png';
$config['encrypt_name']        = TRUE;

$this->upload->initialize($config);

if (!$this->upload->do_upload('ktp')){  
$status = array(
'status' =>"error",
'message' =>$this->upload->display_error(),   
);

}else{
$data = array(
'file_ktp'           => $this->upload->data('file_name'),    
'status_berkas' => "Terupload"    
);

$this->M_dashboard->simpan_file_ktp($data,$this->input->post('id_ahli_waris'));    

$status = array(
'status' =>'success',
'message' =>'File KTP brhasil Dilampirkan'    
);
}
echo json_encode($status);

}else{
redirect(404);    
}

}
public function hapus_berkas(){
if($this->input->post('id_ahli_waris')){
$query = $this->M_dashboard->data_ahli_waris_where(array('id_ahli_waris'=>$this->input->post('id_ahli_waris')))->row_array();

if(file_exists('./uploads/ktp_ahli_waris/'.$query['file_ktp'])){
unlink('./uploads/ktp_ahli_waris/'.$query['file_ktp']);    
}
$this->db->delete('data_ahli_waris',array('id_ahli_waris'=>$query['id_ahli_waris']));
    
}else{
redirect(404);    
}
}

public function input_identitas_jenazah(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_input_identitas_jenazah');
    
}
public function data_blok_makam(){
if($this->input->post()){
    
$query = $this->M_dashboard->data_blok_makam($this->input->post('agama'));

echo "<option></option>";
foreach ($query->result_array() as $data){
echo "<option value='".$data['id_blok']."'>".$data['nama_blok']."</option>" ;   
}
}else{
redirect(404);    
}
    
}

public function tampilkan_makam(){
if($this->input->post()){

$query = $this->db->get_where('data_blok',array('id_blok'=>$this->input->post('id_blok')))->row_array();
echo "<div class='row'>";
for($i=1; $i<$query['jumlah_makam']; $i++){
echo '<div class="col-md-1 m-2"><div class="custom-control custom-radio">
<input
';
$cek_makam = $this->db->get_where('detail_pemesanan',array('no_blok'=>$query['nama_blok']."".$i));        
if($cek_makam->num_rows() == 1){
 echo "disabled=''";    
}        
echo 'onclick="isi_makam(\''.$query['nama_blok'].$i.'\');" type="radio" id="customRadio'.$i.'" name="customRadio" class="custom-control-input">
<label class="custom-control-label" for="customRadio'.$i.'">'.$query['nama_blok'].$i.'</label>
</div></div>';    
}
echo "</div>";

}else{
redirect(404);    
}

}

public function cari_ahli_waris(){
if($this->input->post()){
$input = $this->input->post();

$query = $this->M_dashboard->data_ahli_waris_where(array('nik_ahli_waris'=>$input['nik']));
if($query->num_rows() > 0){
$d = $query->row_array();

$data = array(
'status'          =>"success",   
'nama_ahli_waris' => $d['nama'],    
'id_ahli_waris' => $d['id_ahli_waris']    
);
   
}else{
$data = array(
'status'          =>NULL,   
'nama_ahli_waris' => "Tidak Ditemukan"    
);
   
    
}
echo json_encode($data);

}else{
redirect(404);    
}       
}

public function email_pemesanan($param){
$this->db->select('*');
$this->db->from('data_jenazah');
$this->db->join('data_ahli_waris', 'data_ahli_waris.id_ahli_waris = data_jenazah.id_ahli_waris');
$this->db->join('detail_pemesanan', 'detail_pemesanan.id_jenazah = data_jenazah.id_jenazah');
$this->db->where('data_jenazah.id_jenazah',$param);
$query = $this->db->get()->row_array();



$str  ="<p align='center' style='font-size:20px' >DATA PEMESANAN MAKAM</p>";

$str .= "<table align='center' style='width:80%' border ='1' cellpading ='0' cellspacing='0'>"
        . "<tr>"
        . "<td colspan='2'>Invoices No.".$query['tanggal_wafat']."/".$query['id_jenazah']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nama Jenazah</td>"
        . "<td>".$query['nama_jenazah']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nik Jenazah</td>"
        . "<td>".$query['nik_jenazah']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Jenis Kelamin</td>"
        . "<td>".$query['jenis_kelamin']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>tanggal wafat</td>"
        . "<td>".$query['tanggal_wafat']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Expired Makam</td>"
        . "<td>".$query['tanggal_expired']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nama Ahli waris</td>"
        . "<td>".$query['nama']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nik ahli waris</td>"
        . "<td>".$query['nik_ahli_waris']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nama Makam</td>"
        . "<td>".$query['no_blok']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td colspan='2'>Rincian Biaya yang harus dibayarkan</td>"
        . "</tr>";
        
$data_biaya = $this->db->get_where('data_pembayaran',array('id_detail_pemesanan'=>$query['id_detail_pemesanan']));
$total =0;
foreach ($data_biaya->result_array() as $d){
$str .= "</tr>"
. "<tr>"
. "<td >".$d['jenis_biaya']."</td>"
. "<td >Rp.".number_format($d['jumlah_biaya'])."</td>"
. "</tr>";
$total +=$d['jumlah_biaya'];
}   

$str .="<tr>"
. "<td colspan='2'>Total yang harus dibayarkan</td>"
. "</tr>"
. "<tr>"
. "<td  colspan='2'><b>Rp.".number_format($total)."</b></td>"
. "</tr>";

        
        $str .="</table>";
    

$config = Array(
'protocol'  => 'smtp',
'smtp_host' => 'ssl://smtp.googlemail.com',
'smtp_port' => 465,
'smtp_user' => 'sintamasnah@gmail.com',
'smtp_pass' => 'admin@112233',
'mailtype'  => 'html',
'charset'   => 'iso-8859-1',
'wordwrap'  => TRUE
);

$this->email->initialize($config);
$this->email->set_newline("\r\n");
$this->email->from("sintamasnah@gmail.com");
$this->email->to($query['email']);
$this->email->subject('Detail pemesanan makam');

$this->email->message($str);
if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{        
return "berhasil";
    
}       
        
}

public function simpan_jenazah(){
if($this->input->post()){
$input= $this->input->post();

$id_jenazah = "JNZ".str_pad($this->db->get('data_jenazah')->num_rows()+1,4,"0",STR_PAD_LEFT);

$data_jenazah = array(
'id_jenazah'        => $id_jenazah,    
'id_ahli_waris'     => $input['id_ahli_waris']       ,
'tanggal_lahir'     => $input['tanggal_lahir'],
'tanggal_wafat'     => $input['tanggal_wafat'],
'tanggal_expired'   => date('Y/m/d',strtotime("+5 years")),
'nik_jenazah'       => $input['nik_jenazah'],
'nama_jenazah'      => $input['nama_jenazah'],
'jenis_kelamin'     => $input['jenis_kelamin'],
);

$this->M_dashboard->simpan_jenazah($data_jenazah);    

$id_detail_pemesanan = "IDP".str_pad($this->db->get('data_jenazah')->num_rows()+1,4,"0",STR_PAD_LEFT);


$detail_pemesanan =array(
'id_detail_pemesanan'=> $id_detail_pemesanan,
'id_jenazah'         => $id_jenazah,
'id_blok'            => $input['blok_makam'],
'no_blok'            => $input['nama_makam'],
);

$this->db->insert('detail_pemesanan',$detail_pemesanan);



$config['upload_path']          = './uploads/berkas_jenazah';
$config['allowed_types']        = 'gif|jpg|png';
$config['encrypt_name']        = TRUE;

$this->upload->initialize($config);

$id_berkas_jenazah = "BJ".str_pad($this->db->get('data_berkas_jenazah')->num_rows()+1,4,"0",STR_PAD_LEFT);        
//upload ktp jenazah
if(!$this->upload->do_upload('ktp_jenazah')){  
$status = array(
'status' =>"error",
'message' =>$this->upload->display_errors(),   
);
}else{
$data = array(
'nama_berkas'         => 'KTP Jenazah',
'file'                => $this->upload->data('file_name'),
'id_berkas_jenazah'   => $id_berkas_jenazah,
'id_jenazah'          => $id_jenazah  
);
$this->db->insert('data_berkas_jenazah',$data);

}


$id_berkas_jenazah = "BJ".str_pad($this->db->get('data_berkas_jenazah')->num_rows()+1,4,"0",STR_PAD_LEFT);

//upload pengantar rt rw//
if (!$this->upload->do_upload('pengantar_rt_rw')){  
$status = array(
'status' =>"error",
'message' =>$this->upload->display_errors(),   
);
}else{
$data = array(    
'nama_berkas'         => 'Surat pengantar RT RW',
'file'                => $this->upload->data('file_name'),
'id_berkas_jenazah'   => $id_berkas_jenazah,
'id_jenazah'          => $id_jenazah  
);

$this->db->insert('data_berkas_jenazah',$data);
}
$id_berkas_jenazah = "BJ".str_pad($this->db->get('data_berkas_jenazah')->num_rows()+1,4,"0",STR_PAD_LEFT);

//upload pengantar rumah sakit//
if (!$this->upload->do_upload('pengantar_rumah_sakit')){  
$status = array(
'status' =>"error",
'message' =>$this->upload->display_errors(),   
);
}else{
$data = array(
'nama_berkas'         => 'Surat pengantar rumah sakit',
'file'                => $this->upload->data('file_name'),
'id_berkas_jenazah'   => $id_berkas_jenazah,
'id_jenazah'          => $id_jenazah  
);    
$this->db->insert('data_berkas_jenazah',$data);
}
$id_berkas_jenazah = "BJ".str_pad($this->db->get('data_berkas_jenazah')->num_rows()+1,4,"0",STR_PAD_LEFT);

//upload KK//
if (!$this->upload->do_upload('kartu_kk')){  
$status = array(
'status' =>"error",
'message' =>$this->upload->display_errors(),   
);
}else{
$data = array(
'nama_berkas'         => 'Kartu Keluarga',
'file'                => $this->upload->data('file_name'),
'id_berkas_jenazah'   => $id_berkas_jenazah,
'id_jenazah'          => $id_jenazah  
);    
$this->db->insert('data_berkas_jenazah',$data);
}


$id_pembayaran = "INV".str_pad($this->db->get('data_pembayaran')->num_rows()+1,4,"0",STR_PAD_LEFT);

if($this->session->userdata('pemesanan_makam')) {

$data_pembayaran = array(
'id_pembayaran'         => $id_pembayaran,
'tanggal_pembayaran'    => date('Y/m/d'),
'jenis_biaya'           => 'Pemesanan makam',
'jumlah_biaya'          => '800000',    
'id_detail_pemesanan'     => $id_detail_pemesanan
);

$this->M_dashboard->input_biaya($data_pembayaran);    
}
$id_pembayaran = "INV".str_pad($this->db->get('data_pembayaran')->num_rows()+1,4,"0",STR_PAD_LEFT);

if($this->session->userdata('batu_nisan')) {
$data_pembayaran = array(
'id_pembayaran'         => $id_pembayaran,
'tanggal_pembayaran'    => date('Y/m/d'),
'jenis_biaya'           =>'Batu nisan',
'jumlah_biaya'          =>'300000',    
'id_detail_pemesanan'     => $id_detail_pemesanan
);

$this->M_dashboard->input_biaya($data_pembayaran);    
}
$id_pembayaran = "INV".str_pad($this->db->get('data_pembayaran')->num_rows()+1,4,"0",STR_PAD_LEFT);

if($this->session->userdata('perpanjang')) {
$data_pembayaran = array(
'id_pembayaran'         => $id_pembayaran,
'tanggal_pembayaran'    => date('Y/m/d'),
'jenis_biaya'           =>'Perpanjang',
'jumlah_biaya'          =>'100000',    
'id_detail_pemesanan'     => $id_detail_pemesanan
);


$this->M_dashboard->input_biaya($data_pembayaran);    
}

$cek = $this->email_pemesanan($id_jenazah);

if($cek == 'berhasil'){
$status = array(
'status' =>'success',
'message' =>'Data Jenazah berhasil dimasukan'    
);

echo json_encode($status);
}

unset($_SESSION['pemesanan_makam']);   
unset($_SESSION['perpanjang']);   
unset($_SESSION['batu_nisan']);   


}else{
redirect(404);    
}

    
}

public function data_jenazah(){
$this->load->view('umum/V_header');
$this->load->view('dashboard/V_data_jenazah');
    
}

public function buat_laporan(){
if($this->input->post()){
$input = $this->input->post();
$tanggal =  explode(" - ", $input['tanggal']);
$awal   = $tanggal[0];
$akhir  = $tanggal[1];     

$this->db->select('*');
$this->db->from('data_jenazah');
$this->db->join('data_ahli_waris', 'data_ahli_waris.id_ahli_waris = data_jenazah.id_ahli_waris');
$this->db->join('detail_pemesanan', 'detail_pemesanan.id_jenazah = data_jenazah.id_jenazah');
$this->db->join('data_blok', 'data_blok.id_blok =  detail_pemesanan.id_blok');
$this->db->where('data_jenazah.tanggal_wafat >=',$awal);
$this->db->where('data_jenazah.tanggal_wafat <=',$akhir);
$query = $this->db->get();

$str  ="<p align='center' style='font-size:20px' >LAPORAN DATA MAKAM PERTANGGAL <br>".$awal." - ".$akhir."</p>";
$str .= "<table style ='border: 1px solid #ddd; width:100%;'>";
$str .="<tr style ='background:#1ABB9C; font-size:15px; '  >"
. "<td>No</td>"
. "<td  align='center'>Nama Jenazah</td>"
. "<td align='center' >Nik Jenazah</td>"
. "<td align='center' >Jenis Kelamin</td>"
. "<td align='center' >Agama</td>"
. "<td align='center' >Nama Ahli waris</td>"
. "<td align='center' >Nik Ahli Waris</td>"
. "<td align='center' >Blok Makam</td>"
. "<td align='center' >Tanggal Wafat</td>"
. "<td align='center' >Expired Makam</td></tr>";

$no =1;
foreach ($query->result_array() as $d){
$str .="<tr>"
. "<td>".$no++."</td>"
. "<td>".$d['nama_jenazah']."</td>"
. "<td>".$d['nik_jenazah']."</td>"
. "<td>".$d['jenis_kelamin']."</td>"
. "<td>".$d['nama_agama']."</td>"
. "<td>".$d['nama']."</td>"
. "<td>".$d['nik_ahli_waris']."</td>"
. "<td>".$d['no_blok']."</td>"
. "<td>".$d['tanggal_wafat']."</td>"
. "<td>".$d['tanggal_expired']."</td>"
. "</tr>";   
}



$dompdf = new DOMPDF();
$dompdf->load_html($str);
$dompdf->set_paper("A4","landscape");
$dompdf->render();
$dompdf->stream('laporan'.'.pdf', array('Attachment'=>0)); 

}else{
    
}
    
}

public function hitung_biaya(){
if($this->input->post()){
$input = $this->input->post();


if($input['jenis_biaya'] == 'pemesanan_makam'){
if(!$this->session->userdata('pemesanan_makam')) {
$this->session->set_userdata(array('pemesanan_makam'=>'800000'));    
}else{
unset($_SESSION['pemesanan_makam']);   
}
}


if($input['jenis_biaya'] == 'batu_nisan'){
if(!$this->session->userdata('batu_nisan')) {
$this->session->set_userdata(array('batu_nisan'=>'300000'));    
}else{
unset($_SESSION['batu_nisan']);   
}
}

if($input['jenis_biaya'] == 'perpanjang'){
if(!$this->session->userdata('perpanjang')) {
$this->session->set_userdata(array('perpanjang'=>'100000'));    
}else{
unset($_SESSION['perpanjang']);   
}
}

$total = 0 + $this->session->userdata('pemesanan_makam') +$this->session->userdata('batu_nisan') + $this->session->userdata('perpanjang');
echo "RP. ".number_format($total);    
}else{
redirect(404);    
}
    
}

public function print_invoices(){
$param = $this->uri->segment(3);    
$this->db->select('*');
$this->db->from('data_jenazah');
$this->db->join('data_ahli_waris', 'data_ahli_waris.id_ahli_waris = data_jenazah.id_ahli_waris');
$this->db->join('detail_pemesanan', 'detail_pemesanan.id_jenazah = data_jenazah.id_jenazah');
$this->db->where('data_jenazah.id_jenazah',$param);
$query = $this->db->get()->row_array();



$str  ="<p align='center' style='font-size:20px' >DATA PEMESANAN MAKAM</p>";

$str .= "<table align='center' style='width:80%' border ='1' cellpading ='0' cellspacing='0'>"
        . "<tr>"
        . "<td colspan='2'>Invoices No.".$query['tanggal_wafat']."/".$query['id_jenazah']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nama Jenazah</td>"
        . "<td>".$query['nama_jenazah']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nik Jenazah</td>"
        . "<td>".$query['nik_jenazah']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Jenis Kelamin</td>"
        . "<td>".$query['jenis_kelamin']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>tanggal wafat</td>"
        . "<td>".$query['tanggal_wafat']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Expired Makam</td>"
        . "<td>".$query['tanggal_expired']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nama Ahli waris</td>"
        . "<td>".$query['nama']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nik ahli waris</td>"
        . "<td>".$query['nik_ahli_waris']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td>Nama Makam</td>"
        . "<td>".$query['no_blok']."</td>"
        . "</tr>"
        . "<tr>"
        . "<td colspan='2'>Rincian Biaya yang harus dibayarkan</td>"
        . "</tr>";
        
$data_biaya = $this->db->get_where('data_pembayaran',array('id_detail_pemesanan'=>$query['id_detail_pemesanan']));
$total =0;
foreach ($data_biaya->result_array() as $d){
$str .= "</tr>"
. "<tr>"
. "<td >".$d['jenis_biaya']."</td>"
. "<td >Rp.".number_format($d['jumlah_biaya'])."</td>"
. "</tr>";
$total +=$d['jumlah_biaya'];
}   

$str .="<tr>"
. "<td colspan='2'>Total yang harus dibayarkan</td>"
. "</tr>"
. "<tr>"
. "<td  colspan='2'><b>Rp.".number_format($total)."</b></td>"
. "</tr>";

        
        $str .="</table>";


$dompdf = new DOMPDF();
$dompdf->load_html($str);
$dompdf->set_paper("A4");
$dompdf->render();
$dompdf->stream('laporan'.'.pdf', array('Attachment'=>0)); 
}

public function proses_perpanjang(){
if($this->input->post()){
$input = $this->input->post();
if($input['status'] == "Berhasil"){

$update_expired = array(
'tanggal_expired'   => date('Y/m/d',strtotime("+5 years")),
);
$this->db->update('data_jenazah',$update_expired,array('id_jenazah'=>$input['id_jenazah']));
$this->db->update('data_perpanjang',array('status'=>$input['status']),array('id_jenazah'=>$input['id_jenazah']));


}else if($input['status'] == "Tolak"){
$this->db->update('data_perpanjang',array('status'=>$input['status']),array('id_jenazah'=>$input['id_jenazah']));  
}

}else{
redirect(404);    
}
    
}

public function download($nik_jenazah){
    
$data = $this->db->get_where('data_perpanjang',array('id_perpanjang'=>$nik_jenazah))->row_array();

force_download('./uploads/bukti_transfer/'.$data['bukti_transfer'], NULL);    


}

}


