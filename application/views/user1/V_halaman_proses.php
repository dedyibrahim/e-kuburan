<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Daftar pekerjaan yang sedang diproses</h4>
</div>
</div>

<div class="row p-2">
<?php foreach ($data_tugas->result_array() as    $data){  ?>
<div class='col-md-4  mb-2 '>
<div class='card'>
<div class="card-header text-center">
<?php echo $data['nama_client'] ?>
</div>
<div class="card-body p-2">
    <p style='font-size:12px;'>Nama client : <?php echo $data['nama_client'] ?><br>   
Jenis client : <?php echo $data['jenis_client'] ?><br>   
Tugas : <?php echo $data['pembuat_client'] ?><br>   
Tanggal Penugasan : <?php echo $data['tanggal_dibuat'] ?><br>   
Tanggal Proses : <?php echo $data['tanggal_proses'] ?> </p> 
</div>
<div class="card-footer text-center">
Target Kelar : <?php echo $data['target_kelar'] ?><br>   
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</body>
<script type="text/javascript">
function proses_perizinan(id){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('User/proses_tugas') ?>",
data:"token="+token+"&id_data_pengurus_perizinan="+id,
success:function(data){
var r  = JSON.parse(data);

const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function() {
window.location.href = "<?php echo base_url('User/halaman_proses'); ?>";
})

}

});

}    
 
 
function upload_syarat(id){
$(".upload_perizinan"+id).show();
var dokumen_perizinan = $("#dokumen_perizinan"+id).get(0).files[0];
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$(".btn_upload_syarat"+id).attr("disabled", true);
$(".btn_hapus_syarat"+id).attr("disabled", true);
formData = new FormData();
formData.append('token',token);         
formData.append('dokumen_perizinan',dokumen_perizinan);
formData.append('id_syarat_dokumen',id);
$.ajax({
url        : '<?php echo base_url('User/simpan_file_perizinan') ?>',
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
console.log(percentComplete);
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
var r = JSON.parse(data);
if(r.status == "Berhasil"){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false, 
customClass: 'animated zoomInDown'
});
Toast.fire({
type: 'success',
title: r.pesan
}).then(function(){
$(".upload_perizinan"+id).hide();
$(".btn").removeAttr("disabled");
window.location.href ="<?php echo base_url('User/halaman_proses') ?>";
});    
}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false, 
customClass: 'animated zoomInDown'
});
Toast.fire({
type: 'error',
title: r.pesan
});
$(".upload_perizinan"+id).hide();
$(".btn_hapus_syarat"+id).removeAttr("disabled");    
$(".btn_upload_syarat"+id).removeAttr("disabled");    
}
}
});
}
 
    
</script>    
</html>
