<?php
class M_user1 extends CI_Model{
public function data_tugas($status){

$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.status_pekerjaan',$status);
$query = $this->db->get();

return $query;
}

function json_data_perizinan_selesai(){
    
$this->datatables->select('id_data_dokumen,'
.'data_dokumen.nama_dokumen as nama_dokumen,'
.'data_berkas.jenis_perizinan as jenis_perizinan,'
.'data_client.nama_client as nama_client,'
);
$this->datatables->from('data_dokumen');
$this->datatables->join('data_berkas', 'data_berkas.no_berkas = data_dokumen.no_berkas');
$this->datatables->join('data_client', 'data_client.no_client = data_dokumen.no_client');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=buat_pekerjaan('$1'); >Lihat detail <i class='fa fa-plus'></i></button>",'no_client');
$this->datatables->where('data_dokumen.status_dokumen','Selesai');
return $this->datatables->generate();
}

}
?>
