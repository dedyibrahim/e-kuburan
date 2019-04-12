<?php
class M_user extends CI_Model{
public function data_tugas($status){

$this->db->select('*');
$this->db->from('data_syarat_jenis_dokumen');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_syarat_jenis_dokumen.no_nama_dokumen');
$this->db->join('data_berkas', 'data_berkas.no_berkas = data_syarat_jenis_dokumen.no_berkas');
$this->db->join('data_client', 'data_client.no_client = data_syarat_jenis_dokumen.no_client');
$this->db->where('data_syarat_jenis_dokumen.status_berkas',$status);
$this->db->where('data_syarat_jenis_dokumen.no_user',$this->session->userdata('no_user'));
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
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=buat_pekerjaan('$1'); > Tambah pekerjaan <i class='fa fa-plus'></i></button>",'no_client');
$this->datatables->where('data_dokumen.status_dokumen','Selesai');
$this->datatables->where('data_dokumen.no_user',$this->session->userdata('no_user'));
return $this->datatables->generate();
}

}
?>
