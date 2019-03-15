<body onload="refresh();">
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card p-2 mt-2">

<?php 


$data2 = $data->row_array();

?>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#upload_utama">Upload Dokumen Utama <i class="fas fa-file-upload"></i></a>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#upload_perizinan">Upload Dokumen Perizinan <i class="fas fa-file-upload"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#upload_dokumen_perorangan">Upload Dokumen Perorangan <i class="fas fa-file-upload"></i></a>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="row m-3">
<div class="col-md-6">
Jenis Perizinan:<?php echo $data2['jenis_perizinan'] ?><br>
Jenis Client:<?php echo $data2['jenis_client'] ?><br>
Nama:<?php echo $data2['nama_client'] ?><br>
Alamat:<?php echo $data2['alamat_client'] ?><br>
</div>
</div>
<hr>
<!----------------------------Jenis UTAMA------------------------------>
<div class="tab-pane container active p-2" id="upload_utama">
<div class="container">
<br />
<div id="smartwizard">
<ul>
<li><a href="#step-1">Step 1<br /><small>Upload Draft</small></a></li>
<li><a href="#step-2">Step 2<br /><small>Upload Minuta</small></a></li>
<li><a href="#step-3">Step 3<br /><small>Upload Salinan</small></a></li>
</ul>

<div class="col-md-6 mx-auto">
<div id="step-1">
<h2 class="mx-auto text-center">Draft Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-0" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Draft</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>

</div>
<div id="step-2">
<h2 class="mx-auto text-center">Minuta Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-1" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Minuta</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>
</div>
<div id="step-3">
<h2 class="mx-auto text-center">Salinan Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-2" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Salinan</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>
</div>

</div>
</div>


</div>


<script type="text/javascript">
$(document).ready(function(){
$('#smartwizard').smartWizard({
theme: 'arrows'       
});
});
</script>

</div>    
<!----------------------------Jenis PERIZINAN------------------------------>
<div class="tab-pane container " id="upload_perizinan">
<div class="row">
<div class="col-md-5 mx-auto"><input type="text" id="cari_nama_dokumen" placeholder="cari dokumen perizinan yang ingin di upload" class="form-control"></div>    
</div>
    <hr>
    <div class="row">
        <div class="col" id="form_perizinan">
            
        </div>
    </div>
</div>

<!----------------------------Jenis PERorangan------------------------------>
<div class="tab-pane container " id="upload_dokumen_perorangan">
<div class="row" >
<div class="col">    
    <input type="text" class="form-control" id="cari_data_perorangan" placeholder="Cari Dokumen Perorangan">
</div>    

<div class="col-md-4 ">
<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_perorangan" >Tambah Perorangan <i class="fa fa-plus"></i></button>
</div>
</div>
    <hr>
<div class="data_perorangan" id="data_perorangan">

</div>

    
</div>
</div>


</div>
</div>
</div>
    
<!-----------------modal perorangan --------------> 
<div class="modal fade bd-example-modal-lg" id="modal_perorangan" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="tambah_syarat1">Upload data perorangan <span id="title"> </span> </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
    <form  id="fileForm" method="post" enctype="multipart/form-data" action="<?php echo base_url('Dashboard/create_perorangan') ?>">
<div class="modal-body" >
<label>Nama Identitas</label>
<input type="text" name="nama_identitas" id="nama_identitas" class="form-control required" accept="text/plain">
<label>No Identitas</label>
<input type="text" name="no_identitas" id="no_identitas" class="form-control required" accept="text/plain">
<label>Jenis Identitas</label>
<select name="jenis_identitas" id="jenis_identitas" class="form-control required" accept="text/plain">
<option></option>    
<option>KTP</option>    
<option>PASSPOR</option>    
</select>
<label>Status Jabatan</label>
<select name='status_jabatan' id='status_jabatan' class='form-control required'>
<option></option>
<option>Presiden Komisaris</option>
<option>Komisaris </option>
<option>Komisaris Utama</option>
<option>Presiden Direktur</option>
<option>Direktur</option>
<option>Direktur Utama</option>
<option>Pemegang Saham</option>
<option>-</option>
</select>
<label>Upload Identitas</label>
<input type="file" class="form-control required" accept="image/*"  data-rule-required="true" data-msg-accept="Hanya Menerima file gambar" name="upload_identitas" id="upload_identitas">
<hr>
<div style="display:none;" class="progress upload_identitas_progress">
<div id="upload_identitas_progress" class="bg-success progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 70%"></div>
</div>
</div>
        

<div class="modal-footer">
<button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success" >Simpan Perorangan</button>
</div>
</form>
</div>
</div>
</div>
<!-----------------modal perorangan --------------> 

    
<script type="text/javascript">

$(function () {


$("#cari_nama_dokumen").autocomplete({
minLength:0,
delay:0,
source:'<?php echo base_url('Dashboard/cari_nama_dokumen') ?>',
select:function(event, ui){
var no_berkas = "<?php echo $this->uri->segment(3) ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_syarat') ?>",
data:"token="+token+"&no_nama_dokumen="+ui.item.no_nama_dokumen+"&nama_dokumen="+ui.item.nama_dokumen+"&no_berkas="+no_berkas,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Gagal"){
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
title: 'Jenis Dokumen sudah ditambahkan'
})
}else{
$("#cari_nama_dokumen").val("");    
refresh();    
}
}  

});

}

}
);
});

$(function () {
$("#cari_data_perorangan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo base_url('Dashboard/cari_data_perorangan') ?>',
select:function(event, ui){
var no_berkas = "<?php echo $this->uri->segment(3) ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";


$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_syarat_perorangan') ?>",
data:"token="+token+"&no_berkas="+no_berkas+"&no_nama_perorangan="+ui.item.no_nama_perorangan+"&nama_identitas="+ui.item.nama_identitas+"&jenis_identitas="+ui.item.jenis_identitas+"&file_berkas="+ui.item.file_berkas+"&file_lampiran="+ui.item.file_lampiran+"&no_identitas="+ui.item.no_identitas+"&status_jabatan="+ui.item.status_jabatan,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Berhasil"){
$("#cari_data_perorangan").val("");    
refresh();    

refresh()
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
title:r.pesan
})
}
}  

});

}

}
);
});

function refresh(){
load_form_perizinan();
load_form_perorangan();
}


function load_form_perizinan(){
var no_berkas = "<?php echo $this->uri->segment(3) ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/form_perizinan') ?>",
data:"token="+token+"&no_berkas="+no_berkas,
success:function(data){
$("#form_perizinan").html(data);  
}
});
}

function load_form_perorangan(){
var no_berkas = "<?php echo $this->uri->segment(3) ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/form_perorangan') ?>",
data:"token="+token+"&no_berkas="+no_berkas,
success:function(data){
$("#data_perorangan").html(data);  
}
});
}

function hapus_syarat(id){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_syarat') ?>",
data:"token="+token+"&id_syarat_dokumen="+id,
success:function(data){
$("#syarat"+id).hide('slow');
}
});
}
function hapus_perorangan(id){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_data_syarat_perorangan') ?>",
data:"token="+token+"&id_data_syarat_perorangan="+id,
success:function(data){
$("#syarat_perorangan"+id).hide('slow');
}
});
}

$("#fileForm").submit(function(e) {
e.preventDefault();
$.validator.messages.required = '';
}).validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
},    
submitHandler: function(form) {
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$(".upload_identitas_progress").show();
formData = new FormData();
formData.append('token',token);
formData.append('file_perorangan',$("#upload_identitas").get(0).files[0]);
formData.append('jenis_identitas',$("#jenis_identitas option:selected").text()),
formData.append('nama_identitas',$("#nama_identitas").val()),
formData.append('no_identitas',$("#no_identitas").val()),
formData.append('file_berkas',"<?php echo $this->uri->segment(3) ?>"),
formData.append('status_jabatan',$("#status_jabatan option:selected").text()),

$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
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
$("#upload_identitas_progress").attr('style',  'width:'+percentComplete+'%');
$(".upload_identitas_progress").hide();


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
$('#modal_perorangan').modal('hide');    
});    

$("#upload_identitas").val("");
$("#nama_identitas").val("");
$("#no_identitas").val("");
refresh();
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
}
}

});
return false; 
}
});




$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#jenis_akta,#jenis_akta_perorangan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Dashboard/cari_jenis_dokumen') ?>',
select:function(event, ui){
$("#id_jenis_akta").val("");
$("#id_jenis_akta,#id_jenis_akta_perorangan").val(ui.item.no_jenis_dokumen);
}
}
);
});
</script>
<!---------------------script upload file perorangan------------------------>
<script type="text/javascript">
    
function upload_perorangan(no_nama_perorangan){
var file_perorangan      = $('#file_perorangan'+no_nama_perorangan);

if(file_perorangan.get(0).files[0] == undefined){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'warning',
title: 'File lampiran belum tersedia'
})

}else if(file_perorangan.get(0).files[0].size > 5000000){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false, 
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'warning',
title: 'Maksimal upload 5 MB'
})

}else{
$(".loading_perorangan"+no_nama_perorangan).show();

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',token);         
formData.append('file_perorangan',file_perorangan.get(0).files[0]);
formData.append('id_data_perorangan',no_nama_perorangan);

 $.ajax({
url        : '<?php echo base_url('Dashboard/simpan_file_perorangan') ?>',
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
$("#progress_file"+no_nama_perorangan).attr('style',  'width:'+percentComplete+'%');
}

}, false );
jqXHR.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
//refresh();

}
}, false );
return jqXHR;
},
success    : function ( data ){
//$(".loading_perorangan"+no_nama_perorangan).hide();
refresh();          

}

});
}

}

function update_foto(id_data_perorangan){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_lampiran') ?>",
data:"token="+token+"&id_data_perorangan="+id_data_perorangan,
success:function(data){
refresh();
}

});
        
}
</script>
<!---------------------script upload file perorangan------------------------>

</body>
