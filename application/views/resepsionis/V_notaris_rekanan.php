<body>
<?php  $this->load->view('umum/V_sidebar_resepsionis'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_resepsionis'); ?>
<div class="container-fluid">

<div class="card-header mt-2 text-center ">
<h5 align="center">Notaris rekanan</h5>
</div>
<form id="fileForm" method="post" action="<?php echo base_url('Resepsionis/simpan_notaris_rekanan') ?>" >
<div class="row">

<div class="col">
<label>Nama notaris</label>
<input type="text" name="nama_notaris" class="form-control nama_notaris required" value="" placeholder="nama notaris . . ."  accept="text/plain">

<label>No Telepon</label>    
<input type="text" name="no_telepon" class="form-control no_telpon required" value="" placeholder="nomor telepon . . ."  accept="text/plain">


</div>
<div class="col">
<label>Keperluan</label>
<textarea name="alamat"   class="form-control alamat required" accept="text/plain" rows="4" placeholder="alamat notaris . . ."></textarea>
<hr>
<button type="submit" class="btn btn-success simpan_notaris btn-sm btn-block">Simpan tamu <span class="fa fa-save"></span></button> 
</form>
</div>
<hr>


</div>
<div class="row">
<div class="col">
<table style="width:100%;" id="data_notaris" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >penginput</th>
<th  align="center" aria-controls="datatable-fixed-header"  >tanggal</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama notaris</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nomor telepon</th>
<th  align="center" aria-controls="datatable-fixed-header"  >alamat</th>
</thead>
<tbody align="center">
</table>  
</div>
</div>        


</div>
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

var t = $("#data_notaris").dataTable({
initComplete: function() {
var api = this.api();
$('#data_notaris')
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
ajax: {"url": "<?php echo base_url('Resepsionis/json_data_notaris_rekanan') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_notaris_rekanan",
"orderable": false
},
{"data": "penginput"},
{"data": "tanggal_input"},
{"data": "nama_notaris"},
{"data": "no_telpon"},
{"data": "alamat"}


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
$(document).ready(function(){
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
$(".simpan_notaris").attr("disabled", true);

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',token);
formData.append('no_telpon',$(".no_telpon").val()),
formData.append('nama_notaris',$(".nama_notaris").val()),
formData.append('alamat',$(".alamat").val()),


$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){
$(".simpan_notaris").removeAttr("disabled", true);

$(".no_telpon").val("");
$(".nama_notaris").val("");
$(".alamat").val("");

var table = $('#data_notaris').DataTable();
table.ajax.reload( function ( json ) {
$('#data_notaris').val( json.lastInput );
});    

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
title: r.pesan
});
}

});
return false; 
}
});   

});

</script>
</body>

