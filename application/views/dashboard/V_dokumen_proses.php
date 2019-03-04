<body>
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content card p-2 m-3 ">
    <div class="row">
        <div class="col">
            <h5 align="center">Dokumen yang sedang dalam proses <br> <i class="fa fa-3x fa-exchange-alt"></i></h5>

<table style="width:100%;" id="dokumen_proses" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no berkas</th>
<th  align="center" aria-controls="datatable-fixed-header"  >tanggal_dibuat</th>
<th  align="center" aria-controls="datatable-fixed-header"  >jenis client</th>
<th  align="center" aria-controls="datatable-fixed-header"  >jenis perizinan</th>
<th  align="center" aria-controls="datatable-fixed-header"  >phone</th>
<th  align="center" aria-controls="datatable-fixed-header"  >aksi</th>
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

var t = $("#dokumen_proses").dataTable({
initComplete: function() {
var api = this.api();
$('#dokumen_proses')
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
ajax: {"url": "<?php echo base_url('Dashboard/json_dokumen_proses') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_berkas",
"orderable": false
},
{"data": "no_berkas"},
{"data": "nama"},
{"data": "jenis_client"},
{"data": "jenis_perizinan"},
{"data": "tanggal_dibuat"},
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
