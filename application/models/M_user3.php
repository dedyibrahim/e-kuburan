<?php
class M_user3 extends CI_Model{
public function data_tugas($status){

$this->db->select('*');
$this->db->from('data_berkas');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_berkas.no_nama_dokumen');
$this->db->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->db->join('user', 'user.no_user = data_berkas.pemberi_pekerjaan');
$this->db->where('data_berkas.status',$status);
$this->db->where('data_berkas.no_pengurus',$this->session->userdata('no_user'));
$query = $this->db->get();

return $query;
}

function json_data_perizinan_selesai(){
    
$this->datatables->select('id_data_berkas,'
.'data_client.nama_client as nama_client,'
.'data_berkas.nama_file as nama_file,'
.'data_pekerjaan.jenis_perizinan as jenis_perizinan,'
);
$this->datatables->from('data_berkas');
$this->datatables->join('data_client', 'data_client.no_client = data_berkas.no_client');
$this->datatables->join('data_pekerjaan', 'data_pekerjaan.no_pekerjaan = data_berkas.no_pekerjaan');
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=buat_pekerjaan('$1'); >EDIT</button>",'no_client');
$this->datatables->where('data_berkas.status','Selesai');
$this->datatables->where('data_berkas.no_pengurus',$this->session->userdata('no_user'));
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
$this->datatables->where('no_user',$this->session->userdata('no_user'));
return $this->datatables->generate();
}

}
?>
