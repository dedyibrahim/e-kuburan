<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2 text-center">
Seluruh data client
</div>
    
<div class="row">    
<div class="col mt-2">
<table style="width:100%;" id="data_client" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama file</th>
<th  align="center" aria-controls="datatable-fixed-header"  >pengupload</th>
<th  align="center" aria-controls="datatable-fixed-header"  >tanggal upload</th>
<th  align="center" aria-controls="datatable-fixed-header"  >milik</th>
<th  align="center" aria-controls="datatable-fixed-header"  >aksi</th>
</thead>
<tbody align="center">
</table>            
</div>
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
ajax: {"url": "<?php echo base_url('Dashboard/json_data_client') ?> ", 
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
{"data": "pembuat_client"},
{"data": "jenis_client"},
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
var val = $(".opsi_pekerjaan"+id_data_client).val();

if(val == 1){
window.location.href= "<?php echo base_url('Dashboard/lihat_berkas_client/') ?>"+no_client;
}else if(val == 2){
window.location.href= "<?php echo base_url('Dashboard/lihat_pekerjaan_client/') ?>"+no_client;    
}
$(".opsi_pekerjaan"+id_data_client).val("")
}        
</script>    


</body>

