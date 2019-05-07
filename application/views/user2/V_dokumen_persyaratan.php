<?php $static = $data->row_array();?>    

<div class="row m-2">
<div class="col-md-6">
<div class="card-header mt-2 text-center">
Minimal persyaratan
</div>
<table class="table table-sm table-bordered table-striped table-condensed">
<tr>
<th class="text-center" colspan="2">Pilih persyaratan tambahan</th>    
</tr>
<tr>
<td colspan="2">
<select onchange="persyaratan_tambahan('<?php echo $static['id_data_persyaratan_pekerjaan'] ?>','<?php echo $static['no_client'] ?>','<?php echo $static['no_pekerjaan'] ?>','<?php echo $static['no_jenis_dokumen'] ?>');" class="form-control persyaratan_tambahan">
<option></option>    
<?php foreach ($nama_dokumen->result_array() as $dok){ ?>
<option value="<?php  echo $dok['no_nama_dokumen']?>"><?php echo $dok['nama_dokumen'] ?></option>
<?php } ?>
</select>    
</td>    
</tr>

 <?php
foreach ($data_persyaratan->result_array() as $persyaratan){ ?>
<tr>
<td><?php echo $persyaratan['nama_dokumen'] ?></td>    
<td class="text-center">
    <button class="btn btn-sm btn-success" onclick="tampil_modal_upload('<?php echo $persyaratan['id_data_persyaratan_pekerjaan'] ?>','<?php echo $static['no_client'] ?>','<?php echo $static['no_pekerjaan'] ?>','<?php echo $persyaratan['no_nama_dokumen'] ?>','<?php echo $persyaratan['nama_dokumen'] ?>','<?php echo $static['nama_folder'] ?>')"><span class="fa fa-upload"></span></button>
<button class="btn btn-danger btn-sm" onclick="hapus_persyaratan('<?php echo $persyaratan['id_data_persyaratan_pekerjaan'] ?>','<?php echo $persyaratan['no_pekerjaan'] ?>')"><span class="fa fa-trash"></span></button>

</td>    
</tr>    
<?php } ?>
</table>

</div>

    
<div class="col-md-6">
<div class="card-header mt-2 text-center">
Data persyaratan yang sudah diupload
</div>    
<?php foreach ($data_berkas->result_array() as $u){  ?>
<div class="card p-2 m-1">
<div class="row">
<div class="col"><?php echo $u['nama_file'] ?></div> 
<div class="col-md-3 text-right">
<button class="btn btn-success btn-sm" onclick="download('<?php echo $u['id_data_berkas'] ?>')"><span class="fa fa-download"></span></button>
<button class="btn btn-danger btn-sm" onclick="hapus_berkas('<?php echo $u['no_pekerjaan'] ?>','<?php echo $u['id_data_berkas'] ?>')"><span class="fa fa-trash"></span></button>
</div>    
</div>
</div>
<?php } ?>
</div>
</div>

<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="exampleModalLabel">Upload persyaratan <span class="i"><span></h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('User2/simpan_persyaratan2') ?>" method="post" enctype="multipart/form-data" >  
<div class="modal-body form_persyaratan">

</div>
</form>
</div>
</div>
</div>

<script type="text/javascript">
    
function tampil_modal_upload(id_data_persyaratan_pekerjaan,no_client,no_pekerjaan,no_nama_dokumen,nama_dokumen,nama_folder){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_nama_dokumen="+no_nama_dokumen+"&nama_persyaratan="+nama_dokumen+"&no_pekerjaan="+no_pekerjaan+"&nama_folder="+nama_folder+"&no_client="+no_client,
url:"<?php echo base_url('User2/form_persyaratan') ?>",
success:function(data){
$('.form_persyaratan').html(data);    
$('#modal_upload').modal('show');
$('.i').html(nama_dokumen);

}    

});




}    
    
function hapus_berkas(no_pekerjaan,id_data_berkas){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&id_data_berkas="+id_data_berkas+"&no_pekerjaan="+no_pekerjaan,
url:"<?php echo base_url('User2/hapus_data_berkas') ?>",
success:function(data){

var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 2000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function() {
window.location.href = "<?php echo base_url('User2/proses_pekerjaan/'); ?>"+r.no_pekerjaan;
});

}        
        
});

}

function hapus_persyaratan(id_data_persyaratan_pekerjaan,no_pekerjaan){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&id_data_persyaratan_pekerjaan="+id_data_persyaratan_pekerjaan+"&no_pekerjaan="+no_pekerjaan,
url:"<?php echo base_url('User2/hapus_persyaratan_pekerjaan') ?>",
success:function(data){

console.log(data);
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 2000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function() {
window.location.href = "<?php echo base_url('User2/proses_pekerjaan/'); ?>"+r.no_pekerjaan;
});

}        
        
});

}

function persyaratan_tambahan(id_data_persyaratan_pekerjaan,no_client,no_pekerjaan,no_jenis_dokumen){
var no_nama_dokumen = $(".persyaratan_tambahan option:selected").val();
var nama_dokumen    = $(".persyaratan_tambahan option:selected").text();
var token             = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&no_client="+no_client+"&no_nama_dokumen="+no_nama_dokumen+"&nama_dokumen="+nama_dokumen+"&no_jenis_dokumen="+no_jenis_dokumen,
url:"<?php echo base_url('User2/tambah_persyaratan') ?>",
success:function(data){
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 2000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function() {
window.location.href = "<?php echo base_url('User2/proses_pekerjaan/'); ?>"+r.no_pekerjaan;
});

}        
        
});


$(".persyaratan_tambahan").val("");
}
</script>    