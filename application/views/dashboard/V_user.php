<body>
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2 text-center">
    Masukan user baru <span class="fa fa-plus"></span>
</div>
 <form  id="fileForm" method="post" action="<?php echo base_url('Dashboard/simpan_user') ?>">
<div class="row  p-3" >
<div class="col-md-6">
<label>Nama Depan</label>
<input type="text" name="nama_depan"   class="form-control required nama_depan"  accept="text/plain">
<label>Nama Belakang</label>
<input type="text" name="nama_belakang"   class="form-control required nama_belakang"  accept="text/plain">
<label>Level</label>
<select class='form-control level'>
<option value='Admin'>Admin</option>    
<option value='User'>User</option>    
</select>
</div>

<div class="col ">
<label>Username</label>
<input type="text" name="username"  class="form-control required username"  accept="text/plain">
<label>Password</label>
<input type="password" name="password"  class="form-control required password"  accept="text/plain">
<label>Ulangi Password</label>
<input type="password" name="ulangi_password"    class="form-control required ulangi_password"  accept="text/plain">

</div>

<div class="col-md-12 mx-auto  mt-2">
    <div class="card-footer">    
        <button  type="submit" class="btn btn-success col-md-6 mx-auto btn-block simpan_user">Simpan User <i class="fa fa-save"></i></button>
    </div>
</form>   
</div>
</div>
     
<div class="row">
<div class="col mt-2">
<table style="width:100%;" id="data_user" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama lengkap</th>
<th  align="center" aria-controls="datatable-fixed-header"  >username</th>
<th  align="center" aria-controls="datatable-fixed-header"  >level</th>
<th  align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody align="center">
</table>            
</div>
</div>
</div>
</div>     
     
<script type="text/javascript">
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
$(".simpan_user").attr("disabled", true);

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',getCookie("token"));
formData.append('nama_depan',$(".nama_depan").val()),
formData.append('nama_belakang',$(".nama_belakang").val()),
formData.append('level',$(".level option:selected").val()),
formData.append('username',$(".username").val()),
formData.append('password',$(".password").val()),
formData.append('ulangi_password',$(".ulangi_password").val()),

$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){
$(".simpan_user").removeAttr("disabled", true);
$(".form-control").val("");    
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: r.status,
title: r.message
});

refresh_table_user();
}

});
return false; 
}
});

function refresh_table_user(){
var table = $('#data_user').DataTable();
table.ajax.reload( function ( json ) {
$('#data_user').val( json.lastInput );
});
}

function hapus_user(id_data_user){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_user') ?>",
data:"token="+getCookie('token')+"&id_data_user="+id_data_user,
success:function(){
refresh_table_user();
}

});
}
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
"data": "id_data_user",
"orderable": false
},
{"data": "nama_lengkap"},
{"data": "username"},
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


</script>


</body>

