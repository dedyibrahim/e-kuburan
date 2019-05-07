<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<?php  $static = $data->row_array(); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2 text-center">
Lengkapi persyaratan dokumen
<button class="btn btn-success btn-sm  float-right "  onclick="lanjutkan_proses_perizinan('<?php echo $this->uri->segment(3) ?>');">Lanjutkan keproses perizinan <span class="fa fa-exchange-alt"></span>
</div>

<div class="container">
<div class="row">
<div class="col">
<div class="card-header text-center" >Lengkapi minimal persyaratan</div>

<table class="table table-sm table-bordered table-striped table-condensed">
<tr>
<th>Nama Persyaratan minimal</th>
<th class="text-center">Aksi</th>
</tr>
<?php
foreach ($data->result_array() as $d){ ?>
<tr>
<td><?php echo $d['nama_dokumen'] ?></td>    
<td class="text-center">
<button class="btn btn-success btn-sm" onclick="tampil_modal_upload('<?php echo $d['id_data_persyaratan_pekerjaan'] ?>','<?php echo $d['no_client'] ?>','<?php echo $d['no_pekerjaan'] ?>','<?php echo $d['no_nama_dokumen'] ?>','<?php echo $d['nama_dokumen'] ?>','<?php echo $d['nama_folder'] ?>')"><span class="fa fa-upload"></span></button>
<button class="btn btn-danger btn-sm" onclick="hapus_persyaratan('<?php echo $d['id_data_persyaratan_pekerjaan'] ?>','<?php echo $d['no_pekerjaan'] ?>')"><span class="fa fa-trash"></span></button>
</td>    
</tr>    
<?php } ?>
<tr>
<th class="text-center" colspan="2">Pilih persyaratan Tambahan</th>    
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

</table>
</div>
<div class="col">
<div class="card-header text-center" >Data Persyaratan yang sudah dilampirkan</div>
<?php foreach ($data_berkas->result_array() as $u){  ?>
<div class="card p-2 m-1">
<div class="row">
<div class="col"><?php echo $u['nama_file'] ?></div> 
<div class="col-md-3 text-right">
<button class="btn btn-success btn-sm" onclick="download('<?php echo $u['id_data_berkas'] ?>')"><span class="fa fa-download"></span></button>
<a href="<?php echo base_url('User2/hapus_berkas_persyaratan/'.$u['no_pekerjaan']."/".$u['id_data_berkas']) ?>"><button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button></a>
</div>    
</div>
</div>
<?php } ?>

</div>

</div>
</div>
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
<form action="<?php echo base_url('User2/simpan_persyaratan') ?>" method="post" enctype="multipart/form-data" >  
<div class="modal-body form_persyaratan">

</div>
</form>
</div>
</div>
</div>


<script type="text/javascript">

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
window.location.href = "<?php echo base_url('User2/lengkapi_persyaratan/'); ?>"+r.no_pekerjaan;
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
window.location.href = "<?php echo base_url('User2/lengkapi_persyaratan/'); ?>"+r.no_pekerjaan;
});

}        
        
});


$(".persyaratan_tambahan").val("");
}

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

function simpan_persyaratan(){

var file_siap_upload  = $("#file"+id_data_persyaratan).get(0).files[0];
var token             = "<?php echo $this->security->get_csrf_hash() ?>";

formData = new FormData();
formData.append('token',token);         
formData.append('file',file_siap_upload);
formData.append('no_jenis',no_jenis);
formData.append('nama_jenis',nama_jenis);

$.ajax({
url        : '<?php echo base_url('User2/simpan_file_persyaratan') ?>',
type       : 'POST',
contentType: false,
cache      : false,
processData: false,
data       : formData,
xhr        : function (){
var jqXHR = null;
if ( window.ActiveXObject ){
jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
}else{
jqXHR = new window.XMLHttpRequest();
}
jqXHR.upload.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
$("#upload_perizinan_progress"+id).attr('style',  'width:'+percentComplete+'%');
}
}, false );
jqXHR.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
}
}, false );
return jqXHR;
},
success    : function ( data ){
}
});
}    

function lanjutkan_proses_perizinan(no_pekerjaan){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
url:"<?php echo base_url('User2/lanjutkan_proses_perizinan') ?>",
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
window.location.href = "<?php echo base_url('User2/pekerjaan_proses/'); ?>";
});

}
});
}

function download(id_data_berkas){
window.location.href="<?php echo base_url('User3/download_berkas/') ?>"+id_data_berkas;
}
</script>
</body>

