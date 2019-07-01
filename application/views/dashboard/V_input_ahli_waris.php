<body>
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2 text-center">
Input Ahli Waris
</div><form  id="fileForm" method="post" action="<?php echo base_url('Dashboard/simpan_ahli_waris') ?>">
  
<div class="row">

<div class="col">
<label>Nik</label>
<input type="text" name="nik" class="form-control nik required" placeholder="Nik..." accept="text/plain">
<label>Nama</label>
<input type="text" name="nama" class="form-control nama required" placeholder="Nama . .. " accept="text/plain">
<label>Alamat</label>
<textarea name="alamat" class="form-control alamat  required" placeholder="Alamat . . ." accept="text/plain"></textarea>

</div>
<div class="col">
<label>No.Tlp</label>
<input type="text" name="no_tlp" class="form-control no_tlp  required" placeholder="No Tlp" accept="text/plain">
<label>Hubungan Keluarga</label>
<select name="hubungan_keluarga" class="form-control hubungan_keluarga required nama_agama" accept="text/plain">
<option value="">---- Pilih Keluarga ----</option>
<option value="Ayah">Ayah</option>
<option value="Ibu">Ibu</option>
<option value="Adik">Adik</option>
<option value="Kakak">Kakak</option>
</select>
<label>&nbsp;</label>
<button type="submit" class="btn btn-success btn-block">Simpan <span class="fa fa-save"></span></button>
</form>
</div>

</div>
    
    
<div class="row">
<div class="col mt-2">
<table style="width:100%;" id="data_ahli_waris" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nik</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama</th>
<th  align="center" aria-controls="datatable-fixed-header"  >alamat</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no telepon</th>
<th  align="center" aria-controls="datatable-fixed-header"  >hubungan keluarga</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Status berkas</th>
<th  align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody align="center">
</table>            
</div>
</div>
    
</div>
</div>
    
<!-----------modal upload------------------>    
 <div class="modal fade" id="modal_upload_ktp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload KTP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Upload KTP</label>
          <input type="hidden" class="form-control id_data_ahli_waris required">
          <input type="file" class="form-control required file_ktp" name="file_ktp">
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary simpan_ktp_waris" >Upload KTP <span class="fa fa-save"></span></button>
      </div>
    </div>
  </div>
</div>   
    
<script type="text/javascript">
 $(document).ready(function(){
 $(".simpan_ktp_waris").click(function(){
formData = new FormData();
formData.append('token',getCookie("token"));
formData.append('ktp',$(".file_ktp")[0].files[0]);
formData.append('id_data_ahli_waris',$(".id_data_ahli_waris").val());

 $.ajax({
url: "<?php echo base_url('Dashboard/simpan_ktp_waris') ?>",
processData: false,
contentType: false,
type: "post",
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
title: r.message
});
refresh_table_data_ahli_waris();
 $('#modal_upload_ktp').modal('hide');

}
});
});
});

function hapus_berkas(id_data_ahli_waris){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_berkas') ?>",
data:"token="+getCookie('token')+"&id_data_ahli_waris="+id_data_ahli_waris,
success:function(){
refresh_table_data_ahli_waris();
}
});

}

    
    
function lengkapi_berkas(id_data_ahli_waris){
 $(".id_data_ahli_waris").val(id_data_ahli_waris);   
 $('#modal_upload_ktp').modal('show');
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
$(".simpan_user").attr("disabled", true);

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',getCookie("token"));
formData.append('nik',$(".nik").val()),
formData.append('nama',$(".nama").val()),
formData.append('alamat',$(".alamat").val()),
formData.append('no_tlp',$(".no_tlp").val()),
formData.append('hubungan_keluarga',$(".hubungan_keluarga option:selected").val()),

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

refresh_table_data_ahli_waris();
}

});
return false; 
}
});


function refresh_table_data_ahli_waris(){
var table = $('#data_ahli_waris').DataTable();
table.ajax.reload( function ( json ) {
$('#data_ahli_waris').val( json.lastInput );
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

var t = $("#data_ahli_waris").dataTable({
initComplete: function() {
var api = this.api();
$('#data_ahli_waris')
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
ajax: {"url": "<?php echo base_url('Dashboard/json_data_ahli_waris') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_ahli_waris",
"orderable": false
},
{"data": "nik"},
{"data": "nama"},
{"data": "alamat"},
{"data": "no_tlp"},
{"data": "hubungan_keluarga"},
{"data": "status_berkas"},
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

