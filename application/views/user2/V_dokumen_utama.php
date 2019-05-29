
<div class="container-fluid">    
<div class="row ">
<div class="col-md-4">    
  <div class="card-header mt-2 text-center">
       Upload dokumen utama
    </div>
<form action="<?php  echo base_url('User2/upload_utama')?>" method="post" enctype="multipart/form-data">
<label>Upload file</label>
<input type="hidden" value="<?php echo $this->uri->segment(3) ?>" name="no_pekerjaan">
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" name="token">
<input type="file" required="" name="file" class="form-control">


<label>Nama file</label>
<input type="text" required="" name="nama_file" class="form-control">

<label>Jenis Utama</label>
<select name="jenis" class="form-control">
<option value="Draft">Draft</option>    
<option value="Minuta">Minuta</option>    
<option value="Salinan">Salinan</option>    
</select>

<label>&nbsp;</label>    
<button type="submit" class="btn btn-block btn-sm btn-success">Upload File</button>
</form>
</div>

<div class="col-md-8">    
<div class="card-header mt-2 text-center">
Dokumen utama yang sudah diupload
</div>
<table class="table table-sm table-striped table-bordered text-center table-hover">
<tr>
<th>nama file</th>
<th>jenis</th>
<th>tanggal upload</th>
<th>aksi</th>
</tr>
<?php foreach ($dokumen_utama->result_array() as $utama){ ?>
<tr>
<td><?php echo $utama['nama_berkas'] ?></td>   
<td><?php echo $utama['jenis'] ?></td>   
<td><?php echo $utama['waktu'] ?></td>   
<td>
<select class="form-control data_aksi<?php echo $utama['id_data_dokumen_utama'] ?>"  onchange="aksi_utama('<?php echo $utama['id_data_dokumen_utama'] ?>','<?php echo $utama['id_data_dokumen_utama'] ?>');">
<option>-- Klik untuk lihat menu --</option>   
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
$(".data_aksi"+id_data_dokumen_utama).val("-- Klik untuk lihat menu --");       
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
