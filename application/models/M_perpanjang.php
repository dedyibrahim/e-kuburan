<?php 
class M_perpanjang extends CI_model{

function json_data_jenazah(){
$this->datatables->select('id_jenazah,'
.'data_jenazah.nama_jenazah as nama_jenazah,'
.'data_jenazah.tanggal_wafat as tanggal_wafat,'
.'data_jenazah.tanggal_expired as tanggal_expired,'
.'data_ahli_waris.nama as nama_ahli_waris,'
);

$this->datatables->from('data_jenazah');
$this->datatables->join('data_ahli_waris','data_ahli_waris.id_ahli_waris = data_jenazah.id_ahli_waris');
$this->datatables->where('data_jenazah.id_ahli_waris',$this->session->userdata('id_ahli_waris'));
$this->datatables->add_column('view',"<button class='btn btn-sm btn-success '  onclick=perpanjang_makam('$1'); ><i class='fa fa-upload'></i> upload bukti transfer</button>",'id_jenazah');
return $this->datatables->generate();
}


}
?>