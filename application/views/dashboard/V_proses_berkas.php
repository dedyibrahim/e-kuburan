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
<a class="nav-link active" data-toggle="tab" href="#upload_utama"> Dokumen Utama <i class="fas fa-file-upload"></i></a>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#upload_perizinan"> Supporting Document <i class="fas fa-file-upload"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#upload_dokumen_perorangan"> Dokumen Perorangan <i class="fas fa-file-upload"></i></a>
</li>
<div  class="float-right"id="countdown"></div>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="row m-3">
<div class="col-md-6 card p-2">
Jenis Perizinan:<?php echo $data2['jenis_perizinan'] ?><br>
Jenis Client:<?php echo $data2['jenis_client'] ?><br>
Nama:<?php echo $data2['nama_client'] ?><br>
Alamat:<?php echo $data2['alamat_client'] ?><br>
</div>

<div class=" col">

</div>    
</div>
<hr>
<!----------------------------Jenis UTAMA------------------------------>
<div class="tab-pane container active p-2" id="upload_utama">
<div class="row form_utama  p-2">


</div>    
</div>    
<!----------------------------Jenis PERIZINAN------------------------------>
<div class="tab-pane container " id="upload_perizinan">
<div class="row p-2">
<div class="col">

<select onchange="simpan_syarat();" class="form-control simpan_syarat">
<option></option>
<?php $d = $this->db->get('nama_dokumen');
foreach ($d->result_array() as $n){
?>
<option value="<?php echo $n['no_nama_dokumen'] ?>"><?php echo $n['nama_dokumen'] ?></option>
<?php } ?>
</select>
</div>
<!--<input type="text" id="cari_nama_dokumen" placeholder="cari dokumen perizinan yang ingin di upload" class="form-control"></div>    
-->
<div class="col-md-4"><button class="btn btn-success btn-block" onclick="dokumen_sebelumnya('<?php echo $this->uri->segment(3) ?>')" >Dokumen sebelumnya </button></div>
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
<div class="modal fade bd-example-modal-lg " id="modal_perorangan" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
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


<!-----------------modal dokumen lain --------------> 
<div class="modal fade bd-example-modal-lg" id="modal_dokumen_lain" tabindex="-1" role="dialog" aria-labelledby="modal_dokumen_lain" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="tambah_syarat1">Dokumen sebelumnya <span id="title"> </span> </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body data_dokumen_sebelumnya" >


</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success" >Simpan Perorangan</button>
</div>
</div>
</div>
</div>
<!-----------------modal dokumen lain --------------> 


<script type="text/javascript">

function simpan_syarat(){
var no_berkas       = "<?php echo $this->uri->segment(3) ?>";
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var no_nama_dokumen = $(".simpan_syarat option:selected").val();
var nama_dokumen    = $(".simpan_syarat option:selected").text();
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_syarat') ?>",
data:"token="+token+"&no_nama_dokumen="+no_nama_dokumen+"&nama_dokumen="+nama_dokumen+"&no_berkas="+no_berkas,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Gagal"){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 10000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'error',
title: r.pesan
})
}else{
refresh();    
}
}  

});

}

$(function () {
/*$("#cari_nama_dokumen").autocomplete({
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
timer: 10000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'error',
title: r.pesan
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
*/
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
load_form_utama();
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
refresh();
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
url        : '<?php echo base_url('Dashboard/simpan_file_perizinan') ?>',
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
refresh();    
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
refresh();    

}

}

});
}



function load_form_utama(){
var no_berkas = "<?php echo $this->uri->segment(3) ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/form_utama') ?>",
data:"token="+token+"&no_berkas="+no_berkas,
success:function(data){
$(".form_utama").html(data);  
}
});
}


function upload_utama(no_berkas,jenis){
var file_utama = $("#file_"+jenis).get(0).files[0];
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$(".upload_"+jenis).attr("disabled", true);


$(".upload_utama_"+jenis).show();
formData = new FormData();
formData.append('token',token);         
formData.append('file_utama',file_utama);
formData.append('file_jenis',jenis);
formData.append('no_berkas',no_berkas);

$.ajax({
url        : '<?php echo base_url('Dashboard/simpan_utama') ?>',
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
$("#progress_upload_utama_"+jenis).attr('style',  'width:'+percentComplete+'%');
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
refresh();
$(".upload_utama_"+jenis).hide();
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
}

}

});
}

function dokumen_sebelumnya(id){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/dokumen_sebelumnya') ?>",
data:"token="+token+"&no_berkas="+id,
success:function(data){
$(".data_dokumen_sebelumnya").html(data);      
$('#modal_dokumen_lain').modal('show'); 
}    
});


}

function perbaharui(id){
Swal.fire({
title: '<?php echo $this->session->userdata('nama_lengkap') ?> yakin!',
text: "Jika di perbaharui maka dokumen sebelumnya akan di hapus dalam sistem.",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Ya hapus'
}).then((result) => {


if (result.value) {
Swal.fire(
'File Telah di hapus',
'silahkan upload ulang dokumen tersebut.',
'success'
)


var token     = "<?php echo $this->security->get_csrf_hash() ?>";
var no_berkas = "<?php echo $this->uri->segment(3); ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/perbaharui') ?>",
data:"token="+token+"&id_data_dokumen="+id+"&no_berkas="+no_berkas,
success:function(data){
$('#modal_dokumen_lain').modal('hide'); 
refresh();
}

});

}
})

}

function update_utama(no_berkas,jenis_utama){

Swal.fire({
title: '<?php echo $this->session->userdata('nama_lengkap') ?> yakin!',
text: "Jika ingin di update maka dokumen sebelumnya akan di hapus dalam sistem.",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Ya hapus'
}).then((result) => {


if (result.value) {
Swal.fire(
'File Telah di hapus',
'silahkan upload ulang '+jenis_utama+' tersebut.',
'success'
)


var token     = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/perbaharui_utama') ?>",
data:"token="+token+"&no_berkas="+no_berkas+"&jenis_utama="+jenis_utama,
success:function(data){
$('#modal_dokumen_lain').modal('hide'); 
refresh();
}

});

}
})

}

function download_utama(no_berkas,jenis){
window.location="<?php echo base_url('Dashboard/download_utama') ?>/"+no_berkas+"/"+jenis;
}

function download_perizinan(no_client,no_nama_dokumen){
window.location="<?php echo base_url('Dashboard/download_perizinan') ?>/"+no_client+"/"+no_nama_dokumen;
}

</script>
<!---------------------script upload file perorangan------------------------>
<script>

(function($){
var days	= 24*60*60,
hours	= 60*60,
minutes	= 60;
$.fn.countup = function(prop){

var options = $.extend({
callback	: function(){},
start		: new Date()
},prop);

var passed = 0, d, h, m, s, 
positions;

init(this, options);

positions = this.find('.position');



(function tick(){

passed = Math.floor((new Date() - options.start) / 1000);

d = Math.floor(passed / days);
updateDuo(0, 1, d);
passed -= d*days;

h = Math.floor(passed / hours);
updateDuo(2, 3, h);
passed -= h*hours;

m = Math.floor(passed / minutes);
updateDuo(4, 5, m);
passed -= m*minutes;

s = passed;
updateDuo(6, 7, s);

options.callback(d, h, m, s);

setTimeout(tick, 1000);
})();

// This function updates two digit positions at once
function updateDuo(minor,major,value){
switchDigit(positions.eq(minor),Math.floor(value/10)%10);
switchDigit(positions.eq(major),value%10);
}

return this;
};


function init(elem, options){
elem.addClass('countdownHolder');
$.each(['Days','Hours','Minutes','Seconds'],function(i){

$('<span class="count'+this+'">').html(
'<span class="position">\
<span class="digit static">0</span>\
</span>\
<span class="position">\
<span class="digit static">0</span>\
</span>'
).appendTo(elem);


if(this!="Seconds"){
elem.append('<span class="countDiv countDiv'+i+'"></span>');
}
});

}

function switchDigit(position,number){

var digit = position.find('.digit')

if(digit.is(':animated')){
return false;
}

if(position.data('digit') == number){
return false;
}

position.data('digit', number);

var replacement = $('<span>',{
'class':'digit',
css:{
top:'-2.1em',
opacity:0
},
html:number
});

digit
.before(replacement)
.removeClass('static')
.animate({top:'2.5em',opacity:0},'fast',function(){
digit.remove();
})

replacement
.delay(100)
.animate({top:0,opacity:1},'fast',function(){
replacement.addClass('static');
});
}
})(jQuery);


$('#countdown').countup({
start: new Date('<?php echo $data2['count_up'] ?>')
});


function tentukan_user(id){
var nama     = $(".tentukan_user"+id+" option:selected").text();
var no_user  = $(".tentukan_user"+id+" option:selected").val();
var token     = "<?php echo $this->security->get_csrf_hash() ?>";

if(no_user !=''){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_pekerjaan_user') ?>",
data:"token="+token+"&no_user="+no_user+"&nama_user="+nama+"&id_syarat_dokumen="+id,
success:function(data){
refresh();
}

});
}else{

const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 10000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'error',
title: 'Tentukan user yang akan mengerjakan perizinan tersebut'
});

}

}
</script>
</body>
