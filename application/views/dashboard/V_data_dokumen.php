<table style="width:100%;" id="data_nama_dokumen" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th align="center" aria-controls="datatable-fixed-header"  >No</th>
<th align="center" aria-controls="datatable-fixed-header"  >no nama dokumen</th>
<th align="center" aria-controls="datatable-fixed-header"  >nama dokumen</th>
<th style="width: 25%;" align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody >
</table>

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

<!------------- Edit Dokumen---------------->
<div class="modal fade bd-example-modal-lg" id="edit_dokumen" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-body">
    <input type="hidden" class="id_nama_dokumen_edit form-control" value="">
<label>No Nama Dokumen</label>    
<input type="text" class="no_nama_dokumen_edit  form-control" value="">

<label>Nama Dokumen</label>    
<input type="text" class="nama_dokumen_edit form-control" value="">


</div>
<div class="modal-footer">
<button class="btn btn-success btn-sm update_nama_dokumen"> Update </button>    
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
function refresh_nama_dokumen(){
var table = $('#data_nama_dokumen').DataTable();
table.ajax.reload( function ( json ) {
$('#data_nama_dokumen').val( json.lastInput );
});
}

function opsi_nama_dokumen(id_nama_dokumen,no_nama_dokumen){
var val = $(".opsi_nama_dokumen"+id_nama_dokumen+" option:selected").val();
if(val == 1){
lihat_meta(no_nama_dokumen);    
}else if(val == 2){
tambah_meta(no_nama_dokumen);    
}else if(val == 3){
edit_nama_dokumen(id_nama_dokumen);
}
$(".opsi_nama_dokumen"+id_nama_dokumen).val("");
}

function edit_nama_dokumen(id_nama_dokumen){
var token = '<?php echo $this->security->get_csrf_hash(); ?>';  
$.ajax({
type:"post",
url :"<?php echo base_url('Dashboard/data_dokumen') ?>",
data:"token="+token+"&id_nama_dokumen="+id_nama_dokumen,
success:function(data){
var r = JSON.parse(data);    
$(".nama_dokumen_edit").val(r.nama_dokumen);
$(".no_nama_dokumen_edit").val(r.no_nama_dokumen);
}
});

$('#edit_dokumen').modal('show');
$(".id_nama_dokumen_edit").val(id_nama_dokumen);
}



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


$(document).ready(function(){

$(".update_nama_dokumen").click(function(){
var id_nama_dokumen     = $(".id_nama_dokumen_edit").val();
var no_nama_dokumen  = $(".no_nama_dokumen_edit").val();
var nama_dokumen        = $(".nama_dokumen_edit").val();
var token    = "<?php echo $this->security->get_csrf_hash() ?>";    


$.ajax({
type:"post",
data:"token="+token+"&id_nama_dokumen="+id_nama_dokumen+"&nama_dokumen="+nama_dokumen+"&no_nama_dokumen="+no_nama_dokumen,
url:"<?php echo base_url('Dashboard/update_nama_dokumen') ?>",
success:function(data){
var r =JSON.parse(data);    
refresh_nama_dokumen();

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
}).then(function(){
$('#edit_dokumen').modal('hide');    
});

}
});

});


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




$("#simpan_dokumen").click(function(){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var nama_dokumen    = $("#nama_dokumen").val();

if(nama_dokumen != ''){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_nama_dokumen') ?>",
data:"token="+token+"&nama_dokumen="+nama_dokumen,
success:function(data){
refresh_nama_dokumen();
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

});
</script> 

