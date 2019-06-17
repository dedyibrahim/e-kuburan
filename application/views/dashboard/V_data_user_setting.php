<table style="width:100%;" id="data_user" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no user</th>
<th  align="center" aria-controls="datatable-fixed-header"  >username</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama lengkap</th>
<th  align="center" aria-controls="datatable-fixed-header"  >email</th>
<th  align="center" aria-controls="datatable-fixed-header"  >No HP</th>
<th  align="center" aria-controls="datatable-fixed-header"  >level</th>
<th  align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody align="center">
</table>

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
<select class="form-control" id="level_edit">
<option value="User">User</option>
<option value="Admin">Admin</option>
<option Value="Super Admin">Super Admin</option>
</select>




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

<!------------- Modal sublevel---------------->
<div class="modal fade" id="modal_sublevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modal_sublevel">Tambahkan sublevel user</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <input type="hidden" value="" class="no_user">    
    <input type="hidden" value="" class="id_user">    
<label>Pilih Sublevel</label>    
<select class="form-control sublevel">
    <option>Level 1</option>    
    <option>Level 2</option>    
    <option>Level 3</option>    
</select>
<hr>
<button class="btn btn-block btn-success simpan_sublevel">Simpan Sublevel</button>

</div>
    
</div>
</div>
</div>
<!------------- Modal Edit---------------->



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
<select class="form-control" id="level">
<option value="User">User</option>
<option value="Admin">Admin</option>
<option Value="Super Admin">Super Admin</option>
</select>



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

<script type="text/javascript">
$(document).ready(function(){
 $(".simpan_sublevel").click(function(){
     
  alert("asd");   
 });   
    
});    
    
function tambah_sublevel(id_user,no_user){
$(".id_user").val(id_user);    
$(".no_user").val(no_user);    
}    
    
    
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


$("#simpan_user").click(function(){
var username        = $("#username").val();
var email           = $("#email").val();
var phone           = $("#phone").val();
var nama_lengkap    = $("#nama_lengkap").val();
var level           = $("#level option:selected" ).text();
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
data:"token="+token+"&username="+username+"&password="+password+"&level="+level+"&nama_lengkap="+nama_lengkap+"&status="+status+"&email="+email+"&phone="+phone,
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
</script>