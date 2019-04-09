<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user3'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user3'); ?>
<div class="container-fluid p-1 m-1">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Data perizinan yang diproses</h4>
</div>
</div>
    
<div class="row p-2 m-2">
<?php foreach ($data_tugas->result_array() as    $data){  ?>
<div class='col-md-4 mx-auto m-1  p-2 '>
<div class='card ' >
<div class='card-header '>
<div class="row">
    <div class="col-md-10" style="font-size:13px;"><?php echo $data['nama_dokumen'] ?></div>
<div class="col text-right">
<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" onclick="buat_laporan('<?php echo $data['no_berkas'] ?>','<?php echo $data['no_nama_dokumen'] ?>');"  href="#">Buat Laporan</a>
</li>
</ul>  
</div>
</div>   
</div>
<div class="card-body" style="font-size:13px;">    
<label>Upload dokumen </label>
<input type="file" id="dokumen_perizinan<?php echo  $data['id_syarat_dokumen'] ?>" class='form-control mb-2'>
<div style="display:none;" class="progress upload_perizinan<?php echo $data['id_syarat_dokumen'] ?>" >
<div id="upload_perizinan_progress<?php echo  $data['id_syarat_dokumen'] ?>" class="bg-success progress-bar progress-bar-striped progress-bar-animated" role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style="width:0%"></div>
</div>
<br>
Mulai proses : <?php echo $data['tanggal_proses'] ?><br>
Target kelar : <?php echo $data['target_kelar_perizinan'] ?>
</div>
<div class="card-footer">
<button class="btn btn-block  btn-sm  btn-success m-2 btn_upload_syarat<?php echo  $data['id_syarat_dokumen'] ?>" onclick=upload_syarat("<?php echo $data['id_syarat_dokumen'] ?>");>Upload Perizinan <i class='fa fa-upload'></i></button>
</div>
</div>
</div>
<?php } ?>
</div>
</div>

<!-------------------modal laporan--------------------->

<div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <input type="hidden" value="" id="no_nama_dokumen">
          <input type="hidden" value="" id="no_berkas">
          <textarea id="laporan"class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="simpan_laporan">Simpan laporan</button>
      </div>
    </div>
  </div>
</div>




</body>



<script type="text/javascript">

$(document).ready(function(){
$("#simpan_laporan").click(function(){
var no_nama_dokumen = $("#no_nama_dokumen").val();
var no_berkas       = $("#no_berkas").val();
var laporan         = $("#laporan").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('User3/simpan_laporan') ?>",
data:"token="+token+"&no_nama_dokumen="+no_nama_dokumen+"&no_berkas="+no_berkas+"&laporan="+laporan,
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
window.location.href = "<?php echo base_url('User3/halaman_proses'); ?>";
});
$('#modal_laporan').modal('hide');

}

});   
});    

    
    
});    


function buat_laporan(no_berkas,no_nama_dokumen){
$('#modal_laporan').modal('show');

$("#no_nama_dokumen").val(no_nama_dokumen);
$("#no_berkas").val(no_berkas);


}    
    
    
function proses_perizinan(id){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('User3/proses_tugas') ?>",
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
window.location.href = "<?php echo base_url('User3/halaman_proses'); ?>";
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
url        : '<?php echo base_url('User3/simpan_file_perizinan') ?>',
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
window.location.href ="<?php echo base_url('User3/halaman_proses') ?>";
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
