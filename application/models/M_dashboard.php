<?php 
class M_dashboard extends CI_model{

public function simpan_user($data){
$query = $this->db->insert('user',$data);   
return $query;    
}
public function data_user(){
$query = $this->db->get('user');   
return $query;    
}
public function ambil_user($id_user){
$query = $this->db->get_where('user',array('id_user'=>base64_decode($id_user)));
return $query;

}
public function update_user($data,$id_user){
$this->db->update('user',$data,array('id_user'=>$id_user));                                                                                                                                                                                                                                                                                                                                                                             }

public function data_nama_dokumen(){
$query = $this->db->get('nama_dokumen');
return $query;        
}
public function simpan_nama_dokumen($data){
$this->db->insert('nama_dokumen',$data);    
}
public function data_jenis(){
$query = $this->db->get('data_jenis_dokumen');
return $query;            
}

public function simpan_jenis($data){
$this->db->insert('data_jenis_dokumen',$data);    
}
public function getJenis($id_jenis){
$query = $this->db->get_where('data_jenis_dokumen',array('id_jenis_dokumen'=>$id_jenis));
return $query;
    
}

public function cari_nama_dokumen($term){
$this->db->from("nama_dokumen");
$this->db->limit(15);
$array = array('nama_dokumen' => $term);
$this->db->like($array);
$query = $this->db->get();
if($query->num_rows() >0 ){
return $query->result();
}
}

public function simpan_syarat($data){
$this->db->insert('data_syarat_jenis_dokumen',$data);    
}

function json_data_jenis_dokumen(){
$this->datatables->select('id_jenis_dokumen,'
. 'data_jenis_dokumen.id_jenis_dokumen as id_jenis_dokumen,'
. 'data_jenis_dokumen.no_jenis_dokumen as no_jenis_dokumen,'
. 'data_jenis_dokumen.pekerjaan as pekerjaan,'
. 'data_jenis_dokumen.nama_jenis as nama_jenis,'
);

$this->datatables->from('data_jenis_dokumen');
$this->datatables->add_column('view','<button class="btn btn-sm btn-success "  onclick="buat_syarat($1);" data-toggle="modal" data-target="#tambah_syarat"> Syarat <i class="fa fa-plus"></i></button>', 'id_jenis_dokumen');
return $this->datatables->generate();
}
function json_data_nama_dokumen(){
$this->datatables->select('id_nama_dokumen,'
. 'nama_dokumen.id_nama_dokumen as id_nama_dokumen,'
. 'nama_dokumen.no_nama_dokumen as no_nama_dokumen,'
. 'nama_dokumen.nama_dokumen as nama_dokumen,'
);

$this->datatables->from('nama_dokumen');
$this->datatables->add_column('view','<button class="btn btn-sm btn-success "  onclick="buat_syarat($1);" data-toggle="modal" data-target="#tambah_syarat"> Syarat <i class="fa fa-plus"></i></button>', 'id_nama_dokumen');
return $this->datatables->generate();
}

}
?>