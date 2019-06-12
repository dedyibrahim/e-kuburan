<body >
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<div class="card p-2 mt-2">

<div class="row">
<div class="col">
<h5 align="center"><i class="fa fa-3x fa-user-tie"></i><br>Data client yang telah anda kerjakan</h5>

<table style="width:100%;" id="data_client" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no client</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama client</th>
<th  align="center" aria-controls="datatable-fixed-header"  >jenis client</th>
<th  align="center" aria-controls="datatable-fixed-header"  >pembuat client</th>
<th  align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody align="center">
</table> 
</div>
</div>
</div>

<!------------- Modal Tambah pekerjaan---------------->
<div class="modal fade bd-example-modal-md" id="modal_tambah_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" >Buat pekerjaan baru <span id="title"> </span> </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body p-3 " >
<div class="row  p-3" >

<div class="col">
<form  id="fileForm" method="post" action="<?php echo base_url('User2/buat_pekerjaan_baru') ?>">

<label>Jenis Pekerjaan</label>
<input type="hidden" name="no_client"  id="no_client" class="form-control required"  accept="text/plain">
<input type="text" name="jenis_akta"  id="jenis_akta" class="form-control required"  accept="text/plain">
<input type="hidden" name="id_jenis_akta" readonly="" id="id_jenis_akta" class="form-control required"  accept="text/plain">
<label>Target selesai</label>
<input type="text" name="target_kelar" readonly="" id="target_kelar" class="form-control required"  accept="text/plain">
<hr>
<button type="submit" class="btn btn-success btn-sm  mx-auto btn-block simpan_perizinan">Simpan client & Buat pekerjaan <i class="fa fa-save"></i></button>
</div>
</form>
</div>    
</div>

</div>
</div>
</div>
<!------------- Modal tambah pekerjaan---------------->



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

var t = $("#data_client").dataTable({
initComplete: function() {
var api = this.api();
$('#data_client')
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
ajax: {"url": "<?php echo base_url('User2/json_data_client') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_client",
"orderable": false
},
{"data": "no_client"},
{"data": "nama_client"},
{"data": "jenis_client"},
{"data": "pembuat_client"},
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
function opsi_client(id_data_client,no_client){
var val = $('.opsi_pekerjaan'+id_data_client).val();
if(val == 1){
window.location.href= "<?php echo base_url('User2/lihat_berkas_client/')?>"+no_client ;    
}else if(val == 2){
$('#modal_tambah_pekerjaan').modal('show');    
$('#no_client').val(no_client);
}
$('.opsi_pekerjaan'+id_data_client).val("-- Klik untuk melihat menu --")
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
$(".simpan_perizinan").attr("disabled", true);
    
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',token);
formData.append('jenis_akta',$("#jenis_akta").val()),
formData.append('id_jenis',$("#id_jenis_akta").val()),
formData.append('target_kelar',$("#target_kelar").val()),
formData.append('no_client',$("#no_client").val()),


$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){   
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
}).then(function(){
window.location.href='<?php echo base_url('User2/pekerjaan_antrian') ?>';    
});

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
source:'<?php echo site_url('User2/cari_jenis_dokumen') ?>',
select:function(event, ui){
$("#id_jenis_akta").val("");
$("#id_jenis_akta,#id_jenis_akta_perorangan").val(ui.item.no_jenis_dokumen);
}
}
);
});

$(function() {
$("input[name='target_kelar']").datepicker({ minDate:0,dateFormat: 'dd/mm/yy'
});
});


</script>
</body>
