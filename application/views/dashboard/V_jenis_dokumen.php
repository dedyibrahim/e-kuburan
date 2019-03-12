<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card p-2 mt-2">

    <h3 align="center">Data Jenis Dokumen</h3>
<hr>    
<table style="width:100%;"  id="data_jenis_dokumen" class="table table-sm table-bordered table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no jenis dokumen</th>
<th  align="center" aria-controls="datatable-fixed-header"  >pekerjaan</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama jenis</th>
<th style="width: 25%;" align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>  
<!------------- Modal Lihat Syarat---------------->
<div class="modal fade bd-example-modal-lg" id="modal_lihat_syarat" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="tambah_syarat1">Data persyaratan <span id="title"> </span> </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body p-3 data_modal_lihat_syarat" >

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!------------- Modal Lihat Syarat----------------> 

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
ajax: {"url": "<?php echo base_url('Dashboard/json_data_jenis') ?> ", 
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
</script> 
<script type="text/javascript">

function lihat_syarat(no_jenis){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$(".data_syarat").remove();
$.ajax({
type:"POST",
url:"<?php echo base_url('Dashboard/getSyarat') ?>",
data:"token="+token+"&no_jenis_dokumen="+no_jenis,
success:function(data){
var r = JSON.parse(data);
if(r.status == "null" ){
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
title: 'Data persyaratan masih kosong.'
})

}else{
$('#modal_lihat_syarat').modal('show');    
for(i=0 ; i<r.length; i++){
$(".data_modal_lihat_syarat").append("<div class='data_syarat hapus"+r[i].id_syarat_dokumen+" row m-2'>\n\
\n\<div class=''>"+ parseInt(i+1)+".</div>\n\
<div class='col-md-10'>"+r[i].nama_syarat+"</div>\n\
</div>");

}
}
}    
});
}
</script>

</div>
</body>
