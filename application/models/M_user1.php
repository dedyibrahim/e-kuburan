<?php
class M_user1 extends CI_Model{
public function data_tugas($status){

$this->db->select('*');
$this->db->order_by('data_pekerjaan.target_kelar','ASC');
$this->db->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.status_pekerjaan',$status);
$query = $this->db->get();

return $query;
}


function data_persyaratan_pekerjaan_where($no_pekerjaan){
$this->db->select('*');
$this->db->from('data_persyaratan_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_persyaratan_pekerjaan.no_client');
$this->db->where('data_persyaratan_pekerjaan.no_pekerjaan_syarat',$no_pekerjaan);
$query = $this->db->get();    

return $query;
}


function json_data_pekerjaan_selesai(){
    
$this->datatables->select('id_data_pekerjaan,'
.'data_pekerjaan.no_pekerjaan as no_pekerjaan,'
.'data_pekerjaan.jenis_perizinan as jenis_perizinan,'
.'data_pekerjaan.pembuat_pekerjaan as pembuat_pekerjaan,'
.'data_pekerjaan.tanggal_selesai as tanggal_selesai,'
.'data_client.nama_client as nama_client,'
);
$this->datatables->from('data_pekerjaan');
$this->datatables->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=buat_pekerjaan('$1'); >Lihat detail <i class='fa fa-plus'></i></button>",'no_client');
$this->datatables->where('data_pekerjaan.status_pekerjaan','Selesai');
return $this->datatables->generate();
}
public function data_user_where($no_user){

$query = $this->db->get_where('user',array('no_user'=>$no_user));

return $query;
}
function json_data_riwayat(){
    
$this->datatables->select('id_data_histori_pekerjaan,'
.'data_histori_pekerjaan.keterangan as keterangan,'
.'data_histori_pekerjaan.tanggal as tanggal,'
);
$this->datatables->from('data_histori_pekerjaan');
return $this->datatables->generate();
}


public function cari_lampiran($input){
$this->db->select('*');
$this->db->from('data_meta_berkas');
$this->db->join('data_pekerjaan', 'data_pekerjaan.no_pekerjaan = data_meta_berkas.no_pekerjaan');
$this->db->join('data_berkas', 'data_berkas.nama_berkas = data_meta_berkas.nama_berkas');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta_berkas.no_nama_dokumen');
$array = array('data_meta_berkas.value_meta' => $input['cari_dokumen']);
$this->db->like($array);

$query = $this->db->get();
return $query;
}
public function cari_informasi($input){
$this->db->select('*');
$this->db->from('data_informasi_pekerjaan');
$array = array('data_informasi_pekerjaan.data_informasi' => $input['cari_dokumen']);
$this->db->like($array);

$query = $this->db->get();
return $query;
}

}
?>
