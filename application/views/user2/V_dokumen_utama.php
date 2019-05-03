
<div class="container">    
<div class="row m-2">
<div class="col"><h4 align="center">Upload dokumen utama</h4>    
</div>
</div> 
<div class="row m-2">
<div class="col">
<form action="<?php  echo base_url('User2/upload_utama')?>" method="post" enctype="multipart/form-data">
<label>Upload file</label>
<input type="hidden" value="<?php echo $this->uri->segment(3) ?>" name="no_pekerjaan">
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" name="token">
<input type="file" required="" name="file" class="form-control">
</div>

<div class="col">
<label>Nama file</label>
<input type="text" required="" name="nama_file" class="form-control">
</div>

<div class="col">
<label>Jenis Utama</label>
<select name="jenis" class="form-control">
<option value="Draft">Draft</option>    
<option value="Minuta">Minuta</option>    
<option value="Salinan">Salinan</option>    
</select>
</div>

<div class="col">
<label>&nbsp;</label>    
<button type="submit" class="btn btn-block btn-sm btn-success">Upload File</button>
</form>

</div>

</div>
<hr>

<div class="row">
<div class="col-md-12">    
<h4 align="center">Dokumen utama yang telah diupload</h4>    
<hr>
<table class="table table-sm table-striped table-hover">
<tr>
<th>Nama file</th>
<th>Jenis</th>
<th>Tanggal upload</th>
<th>Aksi</th>
</tr>
<?php foreach ($dokumen_utama->result_array() as $u){ ?>
<tr>
<td><?php echo $u['nama_berkas'] ?></td>   
<td><?php echo $u['jenis'] ?></td>   
<td><?php echo $u['waktu'] ?></td>   
<td>
<select class="form-control data_aksi<?php echo $u['id_data_dokumen_utama'] ?>"  onchange="aksi_utama('<?php echo $u['id_data_dokumen_utama'] ?>','<?php echo $u['id_data_dokumen_utama'] ?>');">
<option></option>   
<option value="1">Hapus</option>   
<option value="2">Download</option>   
</select>    
</td>   
</tr>
<?php } ?>
</table>
</div>
</div>
</div>
<script type="text/javascript">
function aksi_utama(id_data_dokumen_utama){
var val = $(".data_aksi"+id_data_dokumen_utama+" option:selected").val(); 
if (val == 1){
hapus_utama(id_data_dokumen_utama);
}else if(val == 2){
window.location.href="<?php echo base_url('User2/download_utama/') ?>"+id_data_dokumen_utama;
}
$(".data_aksi"+id_data_dokumen_utama).val("");       
}    



function hapus_utama(id_data_dokumen_utama){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
Swal.fire({
title: 'Anda yakin',
text: "file akan dihapus secara permanen",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Ya Hapus'
}).then((result) => {
if (result.value) {
$.ajax({
type:"post",
data:"token="+token+"&id_data_dokumen_utama="+id_data_dokumen_utama,
url:"<?php echo base_url('User2/hapus_file_utama') ?>",
success:function(data){
Swal.fire(
'Terhapus',
'File berhasil dihapus',
'success'
).then(function(){
window.location.href="<?php echo base_url('User2/proses_pekerjaan/'.$this->uri->segment(3))?>";    
});
}
});
}
})
}

</script>
