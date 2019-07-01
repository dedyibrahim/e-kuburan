<body>
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2 text-center">
Pengaturan Blok
</div>
<form  id="fileForm" method="post" action="<?php echo base_url('Dashboard/simpan_blok') ?>">
<div class="row">
<div class="col">
<label>Nama Blok</label>
<input type="text"  name="nama_blok"  class="form-control nama_blok required" placeholder="Nama Blok" accept="text/plain"> 
<label>Jumlah Makam</label>
<input type="text" name="jumlah_makam"  class="form-control jumlah_makam required" placeholder="Jumlah makam" accept="text/plain"> 
</div>
<div class="col">
<label>Agama</label>
<select name="agama" class="form-control required nama_agama" accept="text/plain">
<option value="Islam">Islam</option>
<option value="Kristen">Kristen</option>
<option value="Budha">Budha</option>
</select>
<label>&nbsp;</label>
<button type="submit" class="btn btn-success btn-block">Simpan Blok <span class="fa fa-save"></span></button>
</div>    
</form>
</div>
    
    
 <div class="row">
<div class="col mt-2">
<table style="width:100%;" id="data_blok" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nama Blok</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Jumlah makam</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nama Agama</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
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
$(".simpan_blok").attr("disabled", true);

formData = new FormData();
formData.append('token',getCookie("token"));
formData.append('nama_blok',$(".nama_blok").val()),
formData.append('jumlah_makam',$(".jumlah_makam").val()),
formData.append('nama_agama',$(".nama_agama option:selected").val()),

$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){
$(".simpan_blok").removeAttr("disabled", true);
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
refresh_table_blok();
}

});
return false; 
}
});</script>
 
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

var t = $("#data_blok").dataTable({
initComplete: function() {
var api = this.api();
$('#data_blok')
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
ajax: {"url": "<?php echo base_url('Dashboard/json_data_blok') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_blok",
"orderable": false
},
{"data": "nama_blok"},
{"data": "jumlah_makam"},
{"data": "nama_agama"},
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

function refresh_table_blok(){
var table = $('#data_blok').DataTable();
table.ajax.reload( function ( json ) {
$('#data_blok').val( json.lastInput );
});
}

function hapus_blok(id_data_blok){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_blok') ?>",
data:"token="+getCookie('token')+"&id_data_blok="+id_data_blok,
success:function(){
refresh_table_blok();
}

});
}
</script>
 
    
</body>

