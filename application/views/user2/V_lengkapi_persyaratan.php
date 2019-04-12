<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<?php $data2 = $data->row_array();  ?>
<div class="container-fluid">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Lengkapi persyaratan <?php echo $data2['nama_client'] ?></h4>
</div>
</div>


<div class="row m-3">
<div class="col-md-6">
Jenis Perizinan : <?php echo $data2['jenis_perizinan'] ?><br>
Jenis Client : <?php echo $data2['jenis_client'] ?><br>
Nama : <?php echo $data2['nama_client'] ?><br>
Alamat : <?php echo $data2['alamat_client'] ?><br>
</div>
<div class="col text-center p-5">
<button class="btn btn-success  float-right"  onclick="lanjutkan_proses_perizinan('<?php echo $this->uri->segment(3) ?>');">Lanjutkan keproses perizinan <span class="fa fa-exchange-alt"></span></button>
</div>    
</div>
    <hr>
<div class="container">
<div class="row">
<div class="col">


<div class="row ">

<div class="col  mx-auto ">
<p class="text-center"> Definisikan persyaratan</p>     
<input type="text" class="form-control" name="definisikan_persyaratan" id="definisikan_persyaratan">
<hr>
</div>

</div>

<div class="row">
<div class="col mx-auto " >
<form  id='fileForm' method='post' enctype="multipart/form-data" action="<?php echo base_url('User2/simpan_persyaratan/'.$this->uri->segment(3)) ?>">

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo  $this->security->get_csrf_hash() ?>" class="form-control" >
<input type="hidden" name="no_client" value="<?php echo $data2['no_client'] ?>">
<input type="hidden" name="no_pekerjaan" value="<?php echo $data2['no_pekerjaan'] ?>">
<input type="hidden" name="nama_folder" value="<?php echo $data2['nama_folder'] ?>">
<div id="data_dokumen_persyaratan">

</div>
</form>
</div>
</div>    
</div>    

<div class="col">
<div class="row ">

<div class="col   mx-auto ">
<p class="text-center">Persyaratan terdefinisikan</p>
<hr>
<?php foreach ($data_upload->result_array() as $u){  ?>
<div class="card p-2 m-2">
<?php $meta = $this->db->get_where('data_meta_berkas',array('nama_berkas'=>$u['nama_berkas']) );
foreach ($meta->result_array() as  $m){
?>
<?php 
$subjectVal = $m['nama_meta']; 
$hasil_meta = str_replace('_', '&nbsp;', $subjectVal); 
echo  $hasil_meta;
?> : <?php echo $m['value_meta'] ?> <br> 
<?php } ?>   
</div>
<?php } ?>
</div>
<hr>
</div>

</div>
</div>
</div>
</div>

</div>
</div>

<script type="text/javascript">
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


$("#fileForm").validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
}    

});



function upload_siap(){
var file_siap_upload  = $("#file_siap_upload").get(0).files[0];
var no_jenis          = $("#no_jenis_siap").val();
var nama_jenis        = $("#nama_jenis_siap").val();
var token             = "<?php echo $this->security->get_csrf_hash() ?>";

formData = new FormData();
formData.append('token',token);         
formData.append('file_upload',file_siap_upload);
formData.append('no_jenis',no_jenis);
formData.append('nama_jenis',nama_jenis);

$.ajax({
url        : '<?php echo base_url('User2/simpan_file_siap_upload') ?>',
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
$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#definisikan_persyaratan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('User2/cari_persyaratan') ?>',
select:function(event, ui){
$.ajax({
type:"post",
data:"token="+token+"&no_nama_dokumen="+ui.item.no_nama_dokumen+"&no_daftar_persyaratan="+ui.item.no_daftar_persyaratan+"&nama_persyaratan="+ui.item.nama_persyaratan,
url:"<?php echo base_url('User2/form_persyaratan') ?>",
success:function(data){
$("#data_dokumen_persyaratan").html(data);
}
});

}
}
);
});
</script>
</body>

