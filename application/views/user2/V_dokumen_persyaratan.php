<?php 
$this->db->select('*');
$this->db->from('data_pekerjaan');
$this->db->join('data_persyaratan', 'data_persyaratan.no_jenis_dokumen = data_pekerjaan.no_jenis_perizinan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_pekerjaan.no_pekerjaan', base64_decode($this->uri->segment(3)));
$data5 = $this->db->get();    
$data_berkas1 = $this->db->get_where('data_berkas',array('status_berkas'=>'Persyaratan','no_pekerjaan'=> base64_decode($this->uri->segment(3))));
$nama_dokumen1 = $this->db->get('nama_dokumen');
$static2 = $data5->row_array(); 
?>

<div class="row m-2">

<div class="col-md-6">
<h5 align="center">Data Persyaratan minimal</h5>
<hr>
<table class="table table-sm table-bordered table-striped table-condensed">
<?php
foreach ($data5->result_array() as $d){ ?>
<tr>
<td><?php echo $d['nama_dokumen'] ?></td>    
<td class="text-center"><button class="btn btn-sm btn-success" onclick="tampil_modal_upload('<?php echo $d['id_data_persyaratan'] ?>','<?php echo $d['no_client'] ?>','<?php echo $d['no_pekerjaan'] ?>','<?php echo $d['no_nama_dokumen'] ?>','<?php echo $d['nama_dokumen'] ?>','<?php echo $d['nama_folder'] ?>')"><span class="fa fa-upload"></span></button></td>    
</tr>    
<?php } ?>
<tr>
<th class="text-center" colspan="2">Pilih persyaratan tambahan</th>    
</tr>
<tr>
<td colspan="2">
<select onchange="persyaratan_tambahan('<?php echo $static2['id_data_persyaratan'] ?>','<?php echo $static2['no_client'] ?>','<?php echo $static2['no_pekerjaan'] ?>','<?php echo $static2['nama_folder'] ?>');" class="form-control persyaratan_tambahan">
<option></option>    
<?php foreach ($nama_dokumen1->result_array() as $dok){ ?>
<option value="<?php  echo $dok['no_nama_dokumen']?>"><?php echo $dok['nama_dokumen'] ?></option>
<?php } ?>
</select>
</td>    
</tr>
</table>

</div>

    
<div class="col-md-6">
<h5 align="center">Data Persyaratan yang telah diupload</h5>
<hr>


</div>
    
    
</div>