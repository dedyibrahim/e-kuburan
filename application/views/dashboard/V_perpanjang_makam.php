<body>
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2 text-center">
Input Ahli Waris
</div>
    
<div class="row">
<div class="col mt-2">
<table style="width:100%;" id="data_perpanjang" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nama jenazah</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nik Jenazah</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nama Ahli waris</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nik Ahli waris</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Tanggal expired</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Status</th>
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

var t = $("#data_perpanjang").dataTable({
initComplete: function() {
var api = this.api();
$('#data_perpanjang')
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
ajax: {"url": "<?php echo base_url('Dashboard/json_data_perpanjang') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_perpanjang",
"orderable": false
},
{"data": "nama_jenazah"},
{"data": "nik_jenazah"},
{"data": "nama_ahli_waris"},
{"data": "nik_ahli_waris"},
{"data": "tanggal_expired"},
{"data": "status"},
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
function refresh_table_perpanjang(){
var table = $('#data_perpanjang').DataTable();
table.ajax.reload( function ( json ) {
$('#data_perpanjang').val( json.lastInput );
});
}    
    
function proses(status,nik_jenazah){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/proses_perpanjang') ?>",
data:"token="+getCookie('token')+"&status="+status+"&nik_jenazah="+nik_jenazah,
success:function(){
refresh_table_perpanjang();
}
});    
    
}


function download(nik_jenazah){
window.location.href="<?php echo base_url('Dashboard/download/') ?>"+nik_jenazah;    
}

</script>    

  
</body>

