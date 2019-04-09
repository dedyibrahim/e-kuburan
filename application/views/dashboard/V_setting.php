<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="p-2 mt-2">

<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#jenis">Pengaturan Jenis Pekerjaan <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item ml-1">
<a class="nav-link " data-toggle="tab" href="#dokumen">Pengaturan Nama Dokumen <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item ml-1">
<a class="nav-link" data-toggle="tab" href="#aplikasi">Pengaturan User <i class="fas fa-cogs"></i></a>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<!----------------------------Jenis Dokumen------------------------------>
<div class="tab-pane card container active" id="jenis">
<div class="row p-2">
<div class="col">

<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah_jenis_dokumen">Tambahkan Jenis Dokumen <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Data persyaratan jenis dokumen</h5>
<table style="width:100%;"  id="data_jenis_dokumen" class="table table-sm table-bordered table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no jenis dokumen</th>
<th  align="center" aria-controls="datatable-fixed-header"  >pekerjaan</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama jenis</th>
<th style="width: 25%;" align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
</div>



</div>
<!----------------------------Dokumen------------------------------>
<div class="tab-pane card container fade" id="dokumen">
<div class="row p-2">
<div class="col">
<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah_data_dokumen">Tambahkan Data Dokumen <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Data Nama Dokumen</h5>
<table style="width:100%;" id="data_nama_dokumen" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no nama dokumen</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama dokumen</th>
<th style="width: 25%;" align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody align="center">
</table>


</div>
</div>

</div>
<!----------------------------Aplikasi------------------------------>
<div class="tab-pane card container fade" id="aplikasi">
<div class="row p-2">
<div class="col">
<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modal_data_user">Tambahkan Data User <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Pengaturan User <br> <i class="fa fa-3x fa-users"></i></h5>

<table style="width:100%;" id="data_user" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no user</th>
<th  align="center" aria-controls="datatable-fixed-header"  >username</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama lengkap</th>
<th  align="center" aria-controls="datatable-fixed-header"  >email</th>
<th  align="center" aria-controls="datatable-fixed-header"  >tanggal dibuat</th>
<th  align="center" aria-controls="datatable-fixed-header"  >level</th>
<th  align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody align="center">
</table>            
</div>
</div>

</div>



</div>
</div>
</div>
<!------------- Modal Edit---------------->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update User </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<input type="hidden" value="" class="form-control" id="id_edit" placeholder="Username . . .">
<label>Username</label>
<input type="text" class="form-control" id="username_edit" placeholder="Username . . .">
<label>Nama Lengkap</label>
<input type="text" class="form-control" id="nama_lengkap_edit" placeholder="Nama Lengkap . . .">
<label>Email</label>
<input type="text" class="form-control" id="email_edit" placeholder="Email . . .">
<label>Phone</label>
<input type="text" class="form-control" id="phone_edit" placeholder="Nomor Handphone . . .">

<label>Level</label>
<select onchange="subleveledit();" class="form-control" id="level_edit">
<option value="User">User</option>
<option value="Admin">Admin</option>
<option Value="Super Admin">Super Admin</option>
</select>

<div class="sublevel_edit">
<label>Level</label>
<select class="form-control" id="sublevel_edit">
<option value="Level 1">Level 1</option>
<option value="Level 2">Level 2</option>
<option Value="Level 3">Level 3</option>
</select>
</div>

<label>Status</label>
<select class="form-control" id="status_edit">
<option value="Aktif">Aktif</option>
<option Value="Tidak Aktif">Tidak Aktif</option>
</select>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success" id="update_user">Update User <i class="fa fa-save"></i></button>
</div>
</div>
</div>
</div>
<!------------- Modal Edit---------------->


<!------------- Modal Tambah jenis dokumen---------------->
<div class="modal fade bd-example-modal-lg" id="tambah_jenis_dokumen" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="tambah_syarat1">Tambahkan Syarat <span id="title"> </span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<label>Tambahkan Jenis Dokumen</label> 
<input type="text" id="jenis_dokumen" class="form-control" name="jenis Dokumen" placeholder="Jenis Dokumen">
<label>Pekerjaan</label>
<select name="pekerjaan" id="pekerjaan" class="form-control">
<option>NOTARIS</option>   
<option>PPAT</option>   
</select>
<hr>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success"  id="simpan_jenis">Simpan Jenis Dokumen</button>
</div>
</div>
</div>
</div>
<!------------- Modal Tambah jenis dokumen---------------->

<!------------- Modal Tambah jenis dokumen---------------->
<div class="modal fade bd-example-modal-lg" id="tambah_data_dokumen" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="tambah_syarat1">Tambahkan Syarat <span id="title"> </span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<label>Tambahkan Nama Dokumen</label> 
<input type="text"  class="form-control" id="nama_dokumen" name="Nama Dokumen" placeholder="Nama Dokumen">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success"  id="simpan_dokumen">Simpan Nama Dokumen</button>
</div>
</div>
</div>
</div>
<!------------- Modal Tambah jenis dokumen---------------->
<div class="modal fade bd-example-modal-lg" id="modal_data_user" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" >Tambah Data User <span id="title"> </span> </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body p-3 " >
<label>Username</label>
<input type="text" class="form-control" id="username" placeholder="Username . . .">
<label>Nama Lengkap</label>
<input type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap . . .">

<label>Email</label>
<input type="text" class="form-control" id="email" placeholder="Email . . .">
<label>Phone</label>
<input type="text" class="form-control" id="phone" placeholder="Phone . . .">

<label>Level</label>
<select onchange="sublevel();" class="form-control" id="level">
<option value="User">User</option>
<option value="Admin">Admin</option>
<option Value="Super Admin">Super Admin</option>
</select>

<div class="sublevel">
<label>Level</label>
<select  class="form-control" id="sublevel">
<option value="Level 1">Level 1</option>
<option value="Level 2">Level 2</option>
<option Value="Level 3">Level 3</option>
</select>
</div>

<label>Status</label>
<select class="form-control" id="status">
<option value="Admin">Aktif</option>
<option Value="Super Admin">Tidak Aktif</option>
</select>

<hr>
<label>Password</label>
<input type="password" id="password" class="form-control" placeholder="Username . . .">
<label>Ulangi Password</label>
<input type="password" id="ulangi_password" class="form-control" placeholder="Username . . .">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button class="btn btn-block btn-success" id="simpan_user">Simpan</button> 
</div>
</div>
</div>
</div>
<!------------- Modal Lihat Syarat---------------->

<!------------- Modal Meta---------------->
<div class="modal fade bd-example-modal-lg" id="modal_meta" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" >Tambahkan Data Meta</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <input type="hidden" class="no_nama_dokumen">
    <label>Masukan Nama Meta</label>
    <input type="text" class="form-control nama_meta">    
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success btn-sm"  id="simpan_meta">Simpan data Meta</button>
</div>
</div>
</div>
</div>


<!------------- Modal Meta---------------->
<div class="modal fade bd-example-modal-lg" id="lihat_meta" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" >Data Meta</h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body lihat_data_meta">

</div>

</div>
</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
$("#simpan_meta").click(function(){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";    
var no_nama_dokumen = $(".no_nama_dokumen").val();
var nama_meta       = $(".nama_meta").val();
if(nama_meta != ''){
$.ajax({
type:"post",
url :"<?php echo base_url('Dashboard/simpan_meta') ?>",
data:"token="+token+"&no_nama_dokumen="+no_nama_dokumen+"&nama_meta="+nama_meta,
success:function(data){
var r =JSON.parse(data);    
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
})
$('#modal_meta').modal('hide');
$(".nama_meta").val("");
}

});


} else {
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: "warning",
title: "Data Meta Masih Kosong"
});
}

});

});

function sublevel(){
var ket_level = $("#level option:selected").text();

if(ket_level != 'User'){
$(".sublevel").hide();    
}else{
$(".sublevel").show();        
}
}
function subleveledit(){
var ket_level = $("#level_edit option:selected").text();

if(ket_level != 'User'){
$(".sublevel_edit").hide();    
}else{
$(".sublevel_edit").show();        
}
}



function getUser(id_user){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/getUser') ?>",
data:"token="+token+"&id_user="+id_user,
success:function(data){
var r = JSON.parse(data);
$("#id_edit").val(r.id_user);
$("#username_edit").val(r.username);
$("#nama_lengkap_edit").val(r.nama_lengkap);
$("#email_edit").val(r.email);
$("#phone_edit").val(r.phone);

}

});

}

$(document).ready(function(){
$("#simpan_jenis").on("click",function(){
var token         = "<?php echo $this->security->get_csrf_hash() ?>";
var jenis_dokumen = $("#jenis_dokumen").val();
var pekerjaan    = $("#pekerjaan option:selected").text();

if(jenis_dokumen !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('Dashboard/simpan_jenis_dokumen') ?>",
data:"token="+token+"&jenis_dokumen="+jenis_dokumen+"&pekerjaan="+pekerjaan,
success:function(data){
var r = JSON.parse(data);
if(r.status =="Berhasil"){
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
title: 'Jenis Dokumen Berhasil Ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}

}   

});

}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Masukan Jenis dokumen.'
})

}

});


$("#simpan_user").click(function(){
var username        = $("#username").val();
var email           = $("#email").val();
var phone           = $("#phone").val();
var nama_lengkap    = $("#nama_lengkap").val();
var level           = $("#level option:selected" ).text();
var sublevel        = $("#sublevel option:selected" ).text();
var status          = $("#status option:selected" ).text();
var password        = $("#password").val();
var ulangi_password = $("#ulangi_password").val();
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

if(password != '' && email !='' && password !='' && status !='' && ulangi_password !='' && level !='' && nama_lengkap !='' && username !=''  ){
if(password != ulangi_password){
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Password yang anda masukan tidaklah sesuai.'
})
}else{
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_user')?>",
data:"token="+token+"&username="+username+"&password="+password+"&level="+level+"&nama_lengkap="+nama_lengkap+"&status="+status+"&email="+email+"&phone="+phone+"&sublevel="+sublevel,
success:function(data){
var r = JSON.parse(data);
if(r.status =="Berhasil"){
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
title: 'User Berhasil ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}

}

});

}
}else{

const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Data yang dimasukan belum lengkap.'
})
}
});

$("#update_user").click(function(){
var username        = $("#username_edit").val();
var nama_lengkap    = $("#nama_lengkap_edit").val();
var email           = $("#email_edit").val();
var phone           = $("#phone_edit").val();
var level           = $("#level_edit option:selected" ).text();
var sublevel           = $("#sublevel_edit option:selected" ).text();
var status          = $("#status_edit option:selected" ).text();
var id_user         = $("#id_edit").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/update_user') ?>",
data:"token="+token+"&id_user="+id_user+"&username="+username+"&nama_lengkap="+nama_lengkap+"&level="+level+"&status="+status+"&email="+email+"&phone="+phone+"&sublevel="+sublevel,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Berhasil"){
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
title: 'User Berhasil diperbaharui.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}
}

});
});

$("#simpan_dokumen").click(function(){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var nama_dokumen    = $("#nama_dokumen").val();

if(nama_dokumen != ''){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_nama_dokumen') ?>",
data:"token="+token+"&nama_dokumen="+nama_dokumen,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Berhasil"){
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
title: 'Dokumen Berhasil Ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}

}    

});


}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Nama Dokumen Belum di isikan.'
})   
}

});


$("#simpan_syarat").click(function(){
var jumlah_syarat         = $('.data_syarat').length+1;


if ($('.data_syarat').length > 0 ){

var no_jenis_dokumen      = $('#id_jenis').val();

for(i=1; i<jumlah_syarat; i++){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var no_nama_dokumen = $("#no_nama_dokumen"+i).val();
var nama_syarat     = $("#nama_syarat"+i).val();
var status_syarat   = $("input[name=status_syarat"+i+"]:checked").val();
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_syarat') ?>",
data:"token="+token+"&no_jenis_dokumen="+no_jenis_dokumen+"&no_nama_dokumen="+no_nama_dokumen+"&nama_syarat="+nama_syarat+"&status_syarat="+status_syarat,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Berhasil"){
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
title: 'Syarat Berhasil Ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}
}
});

}

}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Cari Nama dokumen terlebih dahulu.'
})

}

});

});

$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#cari_nama_dokumen").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Dashboard/cari_nama_dokumen') ?>',
select:function(event, ui){
$("#cari_nama_dokumen").val("");

if ($(".syarat_dokumen"+ui.item.id_nama_dokumen).length) {
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Nama Dokumen sudah ditambahkan.'
})
}else{
    
var jumlah_syarat = $('.data_syarat').length+1;

$("#cari_nama_dokumen").val("");
$('#tambahkan_data').append("<div class='row data_syarat syarat_dokumen"+ui.item.id_nama_dokumen+"'>\n\
\n\<input type='hidden' id='no_nama_dokumen"+jumlah_syarat+"' name='no_nama_dokumen"+jumlah_syarat+"' readonly class='form-control-plaintext' id='nama_dokumen"+ui.item.no_nama_dokumen+"' value='"+ui.item.no_nama_dokumen+"'>\n\
<div class='col'><input type='text' id='nama_syarat"+jumlah_syarat+"' name='syarat"+jumlah_syarat+"' readonly class='form-control-plaintext' id='nama_dokumen"+ui.item.id_nama_dokumen+"' value='"+ui.item.nama_dokumen+"'></div>\n\
<div class='col-md-3'><input name='status_syarat"+jumlah_syarat+"' value='wajib' id='status_syarat"+jumlah_syarat+"'  type='checkbox'> Wajib</div>\n\
</div>");

}

}
}
);
});

</script>

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_nama_dokumen").dataTable({
initComplete: function() {
var api = this.api();
$('#data_nama_dokumen')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('Dashboard/json_data_nama_dokumen') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_nama_dokumen",
"orderable": false
},
{"data": "no_nama_dokumen"},
{"data": "nama_dokumen"},
{"data": "view"}


],
order: [[0, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});
</script> 

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_jenis_dokumen").dataTable({
initComplete: function() {
var api = this.api();
$('#data_jenis_dokumen')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('Dashboard/json_data_jenis_dokumen') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_jenis_dokumen",
"orderable": false
},
{"data": "no_jenis_dokumen"},
{"data": "pekerjaan"},
{"data": "nama_jenis"},
{"data": "view"}


],
order: [[0, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});
</script> 

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_user").dataTable({
initComplete: function() {
var api = this.api();
$('#data_user')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('Dashboard/json_data_user') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_user",
"orderable": false
},
{"data": "no_user"},
{"data": "username"},
{"data": "nama_lengkap"},
{"data": "email"},
{"data": "phone"},
{"data": "level"},
{"data": "view"}


],
order: [[0, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});

function tambah_meta(no_nama_dokumen){
$('#modal_meta').modal('show');
$(".no_nama_dokumen").val(no_nama_dokumen);

}
function lihat_meta(no_nama_dokumen){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";    
$.ajax({
type:"post",
data:"token="+token+"&no_nama_dokumen="+no_nama_dokumen,
url:"<?php echo base_url('Dashboard/lihat_data_meta') ?>",
success:function(data){
$(".lihat_data_meta").html(data);
$('#lihat_meta').modal('show');
}
});
}

function hapus_meta(id_data_meta){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";    
$.ajax({
type:"post",
data:"token="+token+"&id_data_meta="+id_data_meta,
url:"<?php echo base_url('Dashboard/hapus_data_meta') ?>",
success:function(){
$('#lihat_meta').modal('hide');
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: 'success',
title: 'Data Meta berhasil dihapus'
})
}
});
}

</script>


</body>

