<body>
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <form action="<?php echo base_url('Dashboard/buat_laporan') ?>" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo  $this->security->get_csrf_hash() ?>" />
                    <input type="text" name="tanggal" class="tanggal form-control "  /></div>
                       <div class="col-md-5">
                           <button type="submit" class="btn btn-success">Buat Laporan <span class="fa fa-list-alt"></span></button></div>
                    </form>
            </div>
        </div>
        
        
        
        <div class="col text-right">
            <h4>Daftar jenazah <span class="fa fa-list-alt"></span></h4>
        </div>
    </div>
    
 </div>
     
<div class="row">
<div class="col mt-2">
<table style="width:100%;" id="data_jenazah" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama jenazah</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nik jenazah</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama ahli waris</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nik ahli waris</th>
<th  align="center" aria-controls="datatable-fixed-header"  >jenis_kelamin</th>
<th  align="center" aria-controls="datatable-fixed-header"  >blok makam</th>
<th  align="center" aria-controls="datatable-fixed-header"  >tgl wafat</th>
<th  align="center" aria-controls="datatable-fixed-header"  >tgl expired makam</th>
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

var t = $("#data_jenazah").dataTable({
initComplete: function() {
var api = this.api();
$('#data_jenazah')
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
ajax: {"url": "<?php echo base_url('Dashboard/json_data_jenazah') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_jenazah",
"orderable": false
},
{"data": "nama_jenazah"},
{"data": "nik_jenazah"},
{"data": "nama_ahli_waris"},
{"data": "nik_ahli_waris"},
{"data": "jenis_kelamin"},
{"data": "nama_makam"},
{"data": "tanggal_wafat"},
{"data": "tanggal_expired"},
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

<script>
$(function() {
  $('.tanggal').daterangepicker({
    singleDatePicker: false,
    showDropdowns: true,
    locale: {
      format: 'YYYY-MM-DD'
    }
  });
});
</script>

</body>

