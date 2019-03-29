<?php 
class M_admin extends CI_model{
function json_data_client(){
    
$this->datatables->select('id_data_client,'
.'data_client.no_client as no_client,'
.'data_client.pembuat_client as pembuat_client,'
.'data_client.jenis_client as jenis_client,'
.'data_client.nama_client as nama_client,'
);
$this->datatables->from('data_client');
$this->datatables->where('no_user',$this->session->userdata('no_user'));
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=buat_pekerjaan('$1'); > Tambah pekerjaan <i class='fa fa-plus'></i></button>",'no_client');
return $this->datatables->generate();
}
public function simpan_syarat($data){
$this->db->insert('data_syarat_jenis_dokumen',$data);    
}

public function cari_jenis_dokumen($term){
$this->db->from("data_jenis_dokumen");
$this->db->limit(15);
$array = array('nama_jenis' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}
public function hitung_berkas(){
$query = $this->db->get('data_berkas');
return $query;
}
public function data_client(){
$query = $this->db->get('data_client');  
 
return $query;
    
}

function json_data_perorangan(){
    
$this->datatables->select('id_perorangan,'
.'data_perorangan.id_perorangan as id_perorangan,'
.'data_perorangan.no_nama_perorangan as no_nama_perorangan,'
.'data_perorangan.nama_identitas as nama_identitas,'
.'data_perorangan.no_identitas as no_identitas,'
.'data_perorangan.jenis_identitas as jenis_identitas,'
.'data_perorangan.status_jabatan as status_jabatan,'
);
$this->datatables->from('data_perorangan');
//$this->datatables->where('no_user',$this->session->userdata('no_user'));
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=download_lampiran('$1'); > Download lampiran <i class='fa fa-download'></i></button>",'id_perorangan');
return $this->datatables->generate();
}

public function data_berkas($param){
$this->db->select('*');
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->db->where('data_berkas.status_berkas',$param);
$this->db->where('data_berkas.no_user',$this->session->userdata('no_user'),FALSE);
$query = $this->db->get();

return $query;
}

public function data_dokumen_utama($no_berkas){
 $query = $this->db->get_where('data_dokumen_utama',array('no_berkas'=> base64_decode($no_berkas)));
 return $query;
    
}

public function  data_form_perorangan($no_berkas){
         $this->db->order_by('id_data_syarat_perorangan',"DESC");
$query = $this->db->get_where('data_syarat_perorangan',array('no_berkas'=> base64_decode($no_berkas)));    
    
return $query;    
}

public function data_user(){
$query = $this->db->get('user');   
return $query;    
}
public function  data_form_perizinan($no_berkas){

$this->db->order_by('id_syarat_dokumen',"DESC");
$query = $this->db->get_where('data_syarat_jenis_dokumen',array('no_berkas'=> base64_decode($no_berkas)));    
    
return $query;    
}
public function data_berkas_proses($id){
$this->db->select('*');
$this->db->where('data_berkas.no_berkas', base64_decode($id));
$this->db->from('data_berkas');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$query = $this->db->get();  
 
return $query;
}

public function data_perorangan(){
$query = $this->db->get('data_perorangan');    
    
return $query;    
    
}

public function simpan_data_perorangan($data){
$this->db->insert('data_perorangan',$data);    
}

public function simpan_syarat_perorangan($data){
$this->db->insert('data_syarat_perorangan',$data);    
}
public function ambil_data_syarat_perorangan($id_syarat){
 $query = $this->db->get_where('data_syarat_perorangan',array('id_data_syarat_perorangan'=>$id_syarat));
 return $query;
    
    
}
public function ambil_data_perorangan($id_perorangan){
 $query = $this->db->get_where('data_perorangan',array('id_perorangan'=>$id_perorangan));
 return $query;
    
    
}
public function hapus_data_syarat_perorangan($id_data_syarat_perorangan){
$this->db->delete('data_syarat_perorangan',array('id_data_syarat_perorangan'=>$id_data_syarat_perorangan));    
}
public function hapus_syarat_dokumen($id_syarat_dokumen){
$this->db->delete('data_syarat_jenis_dokumen',array('id_syarat_dokumen'=>$id_syarat_dokumen));    
}

public function cari_data_perorangan($term){
$this->db->from("data_perorangan");
$this->db->limit(15);
$array = array('nama_identitas' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}

}
?>