<?php 
class M_dashboard extends CI_model{

public function simpan_user($data){
$query = $this->db->insert('data_user',$data);   
return $query;    
}

public function cek_user($data){
$query = $this->db->get_where('data_user',$data);   
return $query;    
}


function json_data_user(){
    
$this->datatables->select('id_data_user,'
.'data_user.nama_lengkap as nama_lengkap,'
.'data_user.level as level,'
.'data_user.username as username,'
.'data_user.username as username,'
);
$this->datatables->from('data_user');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-danger '  onclick=hapus_user('$1'); ><i class='fa fa-trash'></i></button>",'id_data_user');
return $this->datatables->generate();
}

function json_data_perpanjang(){
$this->datatables->select('id_data_perpanjang,'
.'data_perpanjang.status as status,'
.'data_jenazah.nama_jenazah as nama_jenazah,'
.'data_jenazah.nik_jenazah as nik_jenazah,'
.'data_jenazah.nama_ahli_waris as nama_ahli_waris,'
.'data_jenazah.nik_ahli_waris as nik_ahli_waris,'
.'data_jenazah.tanggal_expired as tanggal_expired,'
);

$this->datatables->from('data_perpanjang');
$this->datatables->join('data_jenazah', 'data_jenazah.nik_jenazah = data_perpanjang.nik_jenazah');
$this->datatables->add_column('view',""
        . "<button class='btn btn-sm btn-danger '  onclick=proses('Tolak','$2'); >Tolak</button> || "
        . "<button class='btn btn-sm btn-success ' onclick=proses('Berhasil','$2'); >Berhasil</button> || "
        . "<button class='btn btn-sm btn-primary ' onclick=download('$2'); >Download</button>"
        . "",'id_data_perpanjang,nik_jenazah');
return $this->datatables->generate();
}

function json_data_jenazah(){
    
$this->datatables->select('id_data_jenazah,'
.'data_jenazah.nama_jenazah as nama_jenazah,'
.'data_jenazah.nik_jenazah as nik_jenazah,'
.'data_jenazah.nama_ahli_waris as nama_ahli_waris,'
.'data_jenazah.nik_ahli_waris as nik_ahli_waris,'
.'data_jenazah.nama_makam as nama_makam,'
.'data_jenazah.blok_agama as blok_agama,'
.'data_jenazah.jenis_kelamin as jenis_kelamin,'
.'data_jenazah.tanggal_wafat as tanggal_wafat,'
.'data_jenazah.tanggal_expired as tanggal_expired,'
);
$this->datatables->from('data_jenazah');
$this->datatables->add_column('view',"<a href='". base_url('Dashboard/print_invoices/$1')."'><button class='btn btn-sm btn-success'   ><i class='fa fa-print'></i> Invoices </button></a>",'id_data_jenazah');
return $this->datatables->generate();
}


function json_data_blok(){
    
$this->datatables->select('id_data_blok,'
.'data_blok.nama_blok as nama_blok,'
.'data_blok.jumlah_makam as jumlah_makam,'
.'data_blok.nama_agama as nama_agama,'
);
$this->datatables->from('data_blok');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-danger '  onclick=hapus_blok('$1'); ><i class='fa fa-trash'></i></button>",'id_data_blok');
return $this->datatables->generate();
}
function json_data_ahli_waris(){
    
$this->datatables->select('id_data_ahli_waris,'
.'data_ahli_waris.nik as nik,'
.'data_ahli_waris.nama as nama,'
.'data_ahli_waris.alamat as alamat,'
.'data_ahli_waris.no_tlp as no_tlp,'
.'data_ahli_waris.status_berkas as status_berkas,'
.'data_ahli_waris.hubungan_keluarga as hubungan_keluarga,'
);
$this->datatables->from('data_ahli_waris');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=lengkapi_berkas('$1'); >Upload KTP <i class='fa fa-upload'></i></button> <button class='btn btn-sm btn-danger'  onclick=hapus_berkas('$1'); > <i class='fa fa-trash'></i></button>",'id_data_ahli_waris');
return $this->datatables->generate();
}


function simpan_blok($data){

$this->db->insert('data_blok',$data);    
}

function  simpan_ahli_waris($data){
$this->db->insert('data_ahli_waris',$data);    
}

function simpan_file_ktp($data,$param){

$this->db->update('data_ahli_waris',$data,array('id_data_ahli_waris'=>$param));    
}


function  data_ahli_waris_where($param){
$query = $this->db->get_where('data_ahli_waris',$param);

return $query;
    
}
function data_blok_makam($agama){
$query = $this->db->get_where('data_blok',array('nama_agama'=>$agama));
 
return $query;
}
public function simpan_jenazah($data){
$this->db->insert('data_jenazah',$data);    
}

public function tarik_data_jenazah_where($array){

$query = $this->db->get_where('data_jenazah',$array);

return $query;
}

public function input_biaya($biaya){
$this->db->insert('data_biaya',$biaya);    
}

}
?>