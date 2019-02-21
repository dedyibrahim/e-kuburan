<body>
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content card p-2 m-3 ">

<!-- Nav tabs -->
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#jenis">Pengaturan Jenis Dokumen <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#dokumen">Pengaturan Data Dokumen <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#aplikasi">Pengaturan Aplikasi <i class="fas fa-cogs"></i></a>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<!----------------------------Jenis Dokumen------------------------------>
<div class="tab-pane container active" id="jenis">
<div class="row p-2">
<div class="col-md-5">
<label>Tambahkan Jenis Dokumen</label> 
<input type="text" id="jenis_dokumen" class="form-control" name="jenis Dokumen" placeholder="Jenis Dokumen">
<hr>
<button  id="simpan_jenis" class="btn btn-success btn-block">Simpan</button>
</div>

<div class="col">
<h5 align="center"> Buat Persyaratan Jenis Dokumen</h5>

</div>
</div>



</div>
<!----------------------------Dokumen------------------------------>
<div class="tab-pane container fade" id="dokumen">
<div class="row p-2">
<div class="col-md-5">
<label>Tambahkan Data Dokumen</label> 
<input type="text"  class="form-control" id="data_dokumen" name="Data Dokumen" placeholder="Data Dokumen">
<hr>
<button class="btn btn-success btn-block" id="simpan_dokumen">Simpan</button>
</div>
<div class="col">
<h5 align="center">Data Dokumen</h5>

</div>
</div>

</div>
<!----------------------------Aplikasi------------------------------>
<div class="tab-pane container fade" id="aplikasi">

<div class="row p-2 ">
<div class="col-md-12 text-center">Pengaturan User <br> <i class="fa fa-3x fa-users"></i> <hr></div>

<div class="col-md-4">
<label>Username</label>
<input type="text" class="form-control" id="username" placeholder="Username . . .">
<label>Nama Lengkap</label>
<input type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap . . .">
<label>Level</label>
<select class="form-control" id="level">
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
<hr>
<button class="btn btn-block btn-success" id="simpan_user">Simpan</button> 
</div>
<div class="col card p-2">
<?php foreach($user->result_array() as $data_user){ ?>
<div class="row"> 
<div class="col-md-3">
<?php 
if($data_user['foto'] ==NULL){
echo "<img class='card p-1' style='width:90%; height:auto;' src=".base_url('uploads/user/user.png').">";

}else{

}
?>

</div>


<div class="col">
No User        : <?php echo $data_user['no_user']; ?><br>
Nama Lengkap   : <?php echo $data_user['nama_lengkap']; ?><br>
Username       : <?php echo $data_user['username']; ?><br>
Tanggal Daftar : <?php echo $data_user['tanggal_daftar']; ?><br>
Level          : <?php echo $data_user['level']; ?><br>
Status         : <?php echo $data_user['status']; ?><br>
</div>
<div class="col-md-2">
<button class="btn btn-warning mx-auto" onclick="getUser('<?php echo base64_encode($data_user['id_user']) ?>')"   data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-user-edit"></i> Edit</button>
</div>
</div><hr>

<?php } ?>

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
<label>Level</label>
<select class="form-control" id="level_edit">
<option value="Admin">Admin</option>
<option Value="Super Admin">Super Admin</option>
</select>

<label>Status</label>
<select class="form-control" id="status_edit">
<option value="Admin">Aktif</option>
<option Value="Super Admin">Tidak Aktif</option>
</select>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success" id="update_user">Update User</button>
</div>
</div>
</div>
</div>
<!------------- Modal Edit---------------->



<script type="text/javascript">
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

}

});

}

$(document).ready(function(){
$("#simpan_jenis").on("click",function(){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
var jenis_dokumen = $("#jenis_dokumen").val();

if(jenis_dokumen !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('Dashboard/simpan_jenis_dokumen') ?>",
data:"token="+token+"&jenis_dokumen="+jenis_dokumen,

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
var nama_lengkap    = $("#nama_lengkap").val();
var level           = $( "#level option:selected" ).text();
var status          = $( "#status option:selected" ).text();
var password        = $("#password").val();
var ulangi_password = $("#ulangi_password").val();
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

if(password != '' && status !='' && ulangi_password !='' && level !='' && nama_lengkap !='' && username !='' ){
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
data:"token="+token+"&username="+username+"&password="+password+"&level="+level+"&nama_lengkap="+nama_lengkap+"&status="+status,
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
var level           = $("#level_edit option:selected" ).text();
var status          = $("#status_edit option:selected" ).text();
var id_user         = $("#id_edit").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/update_user') ?>",
data:"token="+token+"&id_user="+id_user+"&username="+username+"&nama_lengkap="+nama_lengkap+"&level="+level+"&status="+status,
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
alert("halo");

});

});
</script>


</body>

