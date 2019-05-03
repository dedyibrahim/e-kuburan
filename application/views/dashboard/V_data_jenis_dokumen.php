<table style="width:100%;"  id="data_jenis_dokumen" class="table table-sm table-bordered table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header">No</th>
<th  align="center" aria-controls="datatable-fixed-header">no jenis dokumen</th>
<th  align="center" aria-controls="datatable-fixed-header">pekerjaan</th>
<th  align="center" aria-controls="datatable-fixed-header">nama jenis</th>
<th style="width: 25%;" align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

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

<!------------- Modal Tambah syarat jenis---------------->
<div class="modal fade bd-example-modal-lg" id="tambah_syarat_jenis" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
    
<div class="modal-body">
<input type="hidden" class="form-control no_jenis_dokumen" value="" >
<input type="hidden" class="form-control no_nama_dokumen" value="" >
<input type="hidden" class="form-control nama_dokumen" value="" >
<label>Nama Dokumen</label>
<input type="text" class="form-control cari_persyaratan" placeholder="nama dokumen . . .">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-success btn-sm simpan_persyaratan"  >Simpan Persyaratan <span class="fa fa-save"></span></button>
</div>
</div>
</div>
</div>

<!------------- Modal Tambah syarat jenis---------------->
<div class="modal fade bd-example-modal-lg" id="data_persyaratan" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
    
<div class="modal-body data_persyaratan">

</div>

</div>
</div>
</div>


<!------------- Edit Pekerjaan---------------->
<div class="modal fade bd-example-modal-lg" id="edit_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-body">
<label>No Jenis Dokumen</label> 
<input type="text" id="no_jenis_pekerjaan_edit" value="" class="form-control" name="jenis Dokumen" >
<input type="hidden" id="id_jenis_pekerjaan_edit" value="" class="form-control" name="jenis Dokumen" >

<label>Tambahkan Jenis Dokumen</label> 
<input type="text" id="jenis_pekerjaan_edit" value="" class="form-control" name="jenis Dokumen" >

<label>Pekerjaan</label>
<select name="pekerjaan" id="pekerjaan_edit" class="form-control">
<option>NOTARIS</option>   
<option>PPAT</option>   
</select>

</div>
<div class="modal-footer">
<button class="btn btn-success btn-sm update_nama_pekerjaan"> Update </button>    
</div></div>
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


$(document).ready(function(){
$(".update_nama_pekerjaan").click(function(){
var token            = "<?php echo $this->security->get_csrf_hash() ?>";
var no_jenis_dokumen = $("#no_jenis_pekerjaan_edit").val();
var id_jenis_dokumen = $("#id_jenis_pekerjaan_edit").val();
var nama_jenis       =  $("#jenis_pekerjaan_edit").val();
var pekerjaan        = $("#pekerjaan_edit option:selected").text();
 
if(nama_jenis !='' && pekerjaan !='' && no_jenis_dokumen !=''){
    
$.ajax({
type:"POST",
url:"<?php echo base_url('Dashboard/update_jenis_pekerjaan') ?>",
data:"token="+token+"&no_jenis_dokumen="+no_jenis_dokumen+"&nama_jenis="+nama_jenis+"&pekerjaan="+pekerjaan+"&id_jenis_dokumen="+id_jenis_dokumen,
success:function(data){
var r = JSON.parse(data);

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
});

}   
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
type: 'warning',
title: 'Masih terdapat data yang perlu diisi.'
});
}
$('#edit_pekerjaan').modal('hide');
refresh_table_pekerjaan();

});


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

$('.simpan_persyaratan').click(function(){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var nama_dokumen    = $(".nama_dokumen").val();
var no_nama_dokumen = $(".no_nama_dokumen").val();
var no_jenis_dokumen = $(".no_jenis_dokumen").val();

if(nama_dokumen != ''){
$.ajax({
type:'post',
url:'<?php echo base_url('Dashboard/simpan_persyaratan') ?>',
data:"token="+token+"&nama_dokumen="+nama_dokumen+"&no_nama_dokumen="+no_nama_dokumen+"&no_jenis_dokumen="+no_jenis_dokumen,
success:function(data){
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000
});
Toast.fire({
type: r.status,
title: r.pesan
});

$('#tambah_syarat_jenis').modal('hide');
$('.cari_persyaratan').val("");
}
}); 
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000
});
Toast.fire({
type: 'warning',
title: 'Inputan yang dimasukan masih kosong'
});
}

});

});


function refresh_table_pekerjaan(){
var table = $('#data_jenis_dokumen').DataTable();
table.ajax.reload( function ( json ) {
$('#data_jenis_dokumen').val( json.lastInput );
});

}

function tampilkan_data_persyaratan(no_jenis_dokumen){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:'post',
url:'<?php echo base_url('Dashboard/get_persyaratan') ?>',
data:"token="+token+"&no_jenis_dokumen="+no_jenis_dokumen,
success:function(data){
$('#data_persyaratan').modal('show');
$('.data_persyaratan').html(data);
}
});
        
}

function hapus_syarat(id_data_persyaratan){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:'post',
url:'<?php echo base_url('Dashboard/hapus_persyaratan') ?>',
data:"token="+token+"&id_data_persyaratan="+id_data_persyaratan,
success:function(data){
$('.hapus_syarat'+id_data_persyaratan).hide();
}
});
}
    
function opsi_jenis_pekerjaan(id_jenis_dokumen,no_jenis_dokumen){
var val = $(".opsi_pekerjaan"+id_jenis_dokumen+" option:selected").val();
if(val == 1){
$('#tambah_syarat_jenis').modal('show');
$(".no_jenis_dokumen").val(no_jenis_dokumen);
}else if(val == 2){
tampilkan_data_persyaratan(no_jenis_dokumen);
}else if(val == 3){
edit_jenis_pekerjaan(id_jenis_dokumen);
}

$(".opsi_pekerjaan"+id_jenis_dokumen).val("");
}

function edit_jenis_pekerjaan(id_jenis_dokumen){
var token = '<?php echo $this->security->get_csrf_hash(); ?>';  
$.ajax({
type:"post",
url :"<?php echo base_url('Dashboard/data_pekerjaan') ?>",
data:"token="+token+"&id_jenis_dokumen="+id_jenis_dokumen,
success:function(data){
var r = JSON.parse(data);    
$("#id_jenis_pekerjaan_edit").val(id_jenis_dokumen);
$("#no_jenis_pekerjaan_edit").val(r.no_jenis_dokumen);
$("#jenis_pekerjaan_edit").val(r.nama_jenis);

}
});
$('#edit_pekerjaan').modal('show');
}

$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$(".cari_persyaratan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Dashboard/cari_nama_dokumen') ?>',
select:function(event, ui){
$('.no_nama_dokumen').val(ui.item.no_nama_dokumen);
$('.nama_dokumen').val(ui.item.nama_dokumen);
}
}
);
});
</script>
