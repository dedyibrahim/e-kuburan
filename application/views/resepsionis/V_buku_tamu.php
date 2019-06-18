<body>
<?php  $this->load->view('umum/V_sidebar_resepsionis'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_resepsionis'); ?>
<div class="container-fluid">

<div class="card-header mt-2 text-center ">
<h5 align="center">Buku Tamu</h5>
</div>
<form id="fileForm" method="post" action="<?php echo base_url('Resepsionis/simpan_tamu') ?>" >
<div class="row">

<div class="col">
<label>Nama Klien</label>
<input type="text" name="nama_klien" class="form-control nama_klien required" value="" placeholder="nama klien . . ."  accept="text/plain">

<label>No Telepon</label>    
<input type="text" name="no_telepon" class="form-control nomor_telepon required" value="" placeholder="nomor telepon . . ."  accept="text/plain">

<label>Keperluan dengan</label>    
<select name="keperluan_dengan"  class="form-control keperluan_dengan required" accept="text/plain">
<option >--- Pilih notaris ---</option>   
<?php foreach ($data_karyawan->result_array() as $kar){
echo "<option>".$kar['nama_lengkap']."</option>";    
} ?>   
</select>
</div>
<div class="col">
<label>Keperluan</label>
<textarea name="alasan_keperluan"   class="form-control alasan_keperluan required" accept="text/plain" rows="4" placeholder="keperluan . . ."></textarea>
<hr>
<button type="submit" class="btn btn-success simpan_tamu btn-sm btn-block">Simpan tamu <span class="fa fa-save"></span></button> 
</form>
</div>
<hr>


</div>
<div class="row">
<div class="col">
<table style="width:100%;" id="data_tamu" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >tanggal</th>
<th  align="center" aria-controls="datatable-fixed-header"  >penginput</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama klien</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nomor telepon</th>
<th  align="center" aria-controls="datatable-fixed-header"  >notaris</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Keperluan</th>
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

var t = $("#data_tamu").dataTable({
initComplete: function() {
var api = this.api();
$('#data_tamu')
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
ajax: {"url": "<?php echo base_url('Resepsionis/json_data_tamu') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_buku_tamu",
"orderable": false
},
{"data": "tanggal"},
{"data": "penginput"},
{"data": "nama_klien"},
{"data": "nomor_telepon"},
{"data": "keperluan_dengan"},
{"data": "alasan_keperluan"}


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
$(".simpan_tamu").attr("disabled", true);

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',token);
formData.append('keperluan_dengan',$(".keperluan_dengan option:selected").text());
formData.append('nomor_telepon',$(".nomor_telepon").val()),
formData.append('nama_klien',$(".nama_klien").val()),
formData.append('alasan_keperluan',$(".alasan_keperluan").val()),


$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){
$(".simpan_tamu").removeAttr("disabled", true);

$(".keperluan_dengan").prop('selectedIndex',0);
$(".nomor_telepon").val("");
$(".nama_klien").val("");
$(".alasan_keperluan").val("");


var table = $('#data_tamu').DataTable();
table.ajax.reload( function ( json ) {
$('#data_tamu').val( json.lastInput );
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

