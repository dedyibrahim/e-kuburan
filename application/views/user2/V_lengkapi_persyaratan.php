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
</div>
    <hr>
<div class="container">
<div class="row">
<div class="col">


<div class="row ">

<div class="col  mx-auto ">
<p class="text-center"> Pilih file persyaratan yang diupload</p>     
<select onchange="jenis_file_siap();" class="form-control file_siap">
<option></option>
<?php $d = $this->db->get('nama_dokumen');
foreach ($d->result_array() as $n){
?>
<option value="<?php echo $n['no_nama_dokumen'] ?>"><?php echo $n['nama_dokumen'] ?></option>
<?php } ?>
</select>
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
<p class="text-center">Daftar persyaratan yang telah diupload</p>
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
</div>

<script type="text/javascript">

$("#fileForm").validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
}    

});

function jenis_file_siap(){
var no_jenis   = $(".file_siap option:selected").val();
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_nama_dokumen="+no_jenis,
url:"<?php echo base_url('User2/form_persyaratan') ?>",
success:function(data){
$("#data_dokumen_persyaratan").html(data);

}
});

}

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
</script>
</body>

