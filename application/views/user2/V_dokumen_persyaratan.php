<div class="container">
<div class="row">
<div class="col mt-2">
<?php  $static = $data->row_array(); ?>
    <div class="card-header text-center" >Minimal persyaratan <br> <?php echo $static['jenis_perizinan'] ?></div>
<table class="table table-sm mt-2 table-bordered table-striped table-condensed">
<tr>
<th>Nama Persyaratan minimal</th>
<th class="text-center">Aksi</th>
</tr>
<?php
foreach ($minimal_persyaratan->result_array() as $d){ ?>
<tr>
<td><?php echo $d['nama_dokumen'] ?></td>    
<td class="text-center">
<button class="btn btn-success m-1 btn-sm" onclick="tampil_modal_upload('<?php echo $d['no_pekerjaan_syarat'] ?>','<?php echo $d['id_data_persyaratan_pekerjaan'] ?>')"><span class="fa fa-upload"></span></button>
<button class="btn btn-danger btn-sm" onclick="hapus_persyaratan('<?php echo $d['id_data_persyaratan_pekerjaan'] ?>','<?php echo $d['no_pekerjaan_syarat'] ?>')"><span class="fa fa-trash"></span></button>
</td>    
</tr>    
<?php } ?>
<tr>
<th class="text-center" colspan="2">Pilih persyaratan Tambahan</th>    
</tr>
<tr>
<td colspan="2">
<select onchange="persyaratan_tambahan('<?php echo $static['no_client'] ?>','<?php echo $static['no_pekerjaan'] ?>','<?php echo $static['no_jenis_perizinan'] ?>');" class="form-control persyaratan_tambahan">
<option></option>    
<?php foreach ($nama_dokumen->result_array() as $dok){ ?>
<option value="<?php  echo $dok['no_nama_dokumen']?>"><?php echo $dok['nama_dokumen'] ?></option>
<?php } ?>
</select>
</td>    
</tr>

</table>
</div>
    
<div class="col mt-2">
<div class="card-header text-center" >Data Persyaratan yang sudah dilampirkan</div>

<div class="syarat_telah_dilampirkan">
    
</div>

</div>    

</div>
</div>
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="exampleModalLabel">Upload Persyaratan <span class="i"><span></h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<!---<form action="<?php echo base_url('User2/simpan_persyaratan') ?>" method="post" enctype="multipart/form-data" >  
-->
<div class="modal-body form_persyaratan">

    
</div>
<!--</form>-->
</div>
</div>
</div>
<script type="text/javascript">
function persyaratan_tambahan(no_client,no_pekerjaan,no_jenis_perizinan){
var no_nama_dokumen = $(".persyaratan_tambahan option:selected").val();
var nama_dokumen    = $(".persyaratan_tambahan option:selected").text();
var token             = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
    
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&no_client="+no_client+"&no_nama_dokumen="+no_nama_dokumen+"&nama_dokumen="+nama_dokumen+"&no_jenis_dokumen="+no_jenis_perizinan,
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
    
function simpan_syarat(){
var result = { };
var jml_meta = $('.meta').length;
for (i = 1; i <=jml_meta; i++) {
var key   =($("#data_meta"+i).attr('name'));
var value =($("#data_meta"+i).val());
$.each($('form').serializeArray(), function() {
result[key] = value;
});
}

var token             = "<?php echo $this->security->get_csrf_hash() ?>";
var name = $("#id").attr("name");
formdata = new FormData();
file = $("#file_berkas").prop('files')[0];;
formdata.append("file_berkas", file);
formdata.append("token", token);
formdata.append("id_data_persyaratan", $("#id_data_persyaratan").val());
formdata.append("no_pekerjaan", $("#no_pekerjaan").val());
if ($('#informasi').is(':empty')){
var data_informasi = CKEDITOR.instances['informasi'].getData();    
formdata.append('data_informasi',data_informasi);
}else{
formdata.append('data_meta', JSON.stringify(result));
}
jQuery.ajax({
url: "<?php echo base_url('User2/simpan_persyaratan') ?>",
type: "POST",
data: formdata,
processData: false,
contentType: false,
success: function (result) {
var r = JSON.parse(result);
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
});
refresh();
$('#modal_upload').modal('hide');
}

});

}

function tampil_modal_upload(no_pekerjaan,id_data_persyaratan_pekerjaan){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&id_data_persyaratan="+id_data_persyaratan_pekerjaan,
url:"<?php echo base_url('User2/form_persyaratan') ?>",
success:function(data){
$('.form_persyaratan').html(data);    
$('#modal_upload').modal('show');
if ($('#informasi').is(':empty')){
CKEDITOR.replace('informasi', {
toolbarGroups: [{
"name": "basicstyles",
"groups": ["basicstyles"]
},
{
"name": "links",
"groups": ["links"]
},
{
"name": "paragraph",
"groups": ["list", "blocks"]
},
{
"name": "document",
"groups": ["mode"]
},
{
"name": "insert",
"groups": ["insert"]
},
{
"name": "styles",
"groups": ["styles"]
}

],
removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
});
}
}    
});
}
    
    
    
function persyaratan_telah_dilampirkan(){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token,
url:"<?php echo base_url('User2/persyaratan_telah_dilampirkan/'.$this->uri->segment(3)) ?>",
success:function(data){
$('.syarat_telah_dilampirkan').html(data);
$(function () {
  $('[data-toggle="popover"]').popover({
    container: 'body',
    html :true
  });
$('.btn').on('click', function (e) {
$('.btn').not(this).popover('hide');
});
});
}
});
}  

function download_berkas_informasi(id_data_berkas){
window.location.href="<?php echo base_url('User2/download_berkas_informasi/') ?>"+id_data_berkas;
}

function hapus_berkas_informasi(no_pekerjaan,id_data_informasi){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&id_data_informasi_pekerjaan="+id_data_informasi,
url:"<?php echo base_url('User2/hapus_berkas_informasi') ?>",
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
});
refresh();

}
});    
}
function hapus_berkas_persyaratan(no_pekerjaan,id_data_berkas){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&id_data_berkas="+id_data_berkas,
url:"<?php echo base_url('User2/hapus_berkas_persyaratan') ?>",
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
});
refresh();

}
});    
}
</script>