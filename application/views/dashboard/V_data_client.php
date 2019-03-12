<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card p-2 mt-2">

    <div class="row">
        <div class="col">
            <h5 align="center"><i class="fa fa-3x fa-user-tie"></i><br>Data Client</h5>

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
<div class="modal fade bd-example-modal-lg" id="modal_tambah_pekerjaan" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" >Tambah Data Perizinan <span id="title"> </span> </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body p-3 " >
   <div class="row">
   
<div class="col-md-6">
<label>Jenis Pekerjaan</label>
<input type="text" name="jenis_akta"  id="jenis_akta" class="form-control required"  accept="text/plain">
<label>ID Jenis</label>
<input type="text" name="id_jenis_akta" readonly="" id="id_jenis_akta" class="form-control required"  accept="text/plain">

<input type="hidden" name="no_client" readonly="" id="no_client" class="form-control required"  accept="text/plain">

<div id="form_badan_hukum">
 <label >Nama</label>
 <input type="text" name="nama_client" id="nama_client" readonly="" class="form-control required"  accept="text/plain">
</div>

</div>
<div class="col">   
<div id="form_alamat_hukum">
<label >Alamat</label>
<textarea rows="6" id="alamat_client" readonly="" class="form-control required"  accept="text/plain"></textarea>
</div>
</div>





</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button class="btn  btn-success" id="simpan_user">Proses Perizinan</button> 
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

function buat_pekerjaan(no_client){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/getClient') ?>",
data:"token="+token+"&no_client="+no_client,
success:function(data){

var r = JSON.parse(data);

$("#title").html(r.nama_client);
$("#nama_client").val(r.nama_client);
$("#no_client").val(r.no_client);
$("#alamat_client").html(r.alamat_client);

$('#modal_tambah_pekerjaan').modal('show');

}

});

}


$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#jenis_akta,#jenis_akta_perorangan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Dashboard/cari_jenis_dokumen') ?>',
select:function(event, ui){
$("#id_jenis_akta").val("");
$("#id_jenis_akta,#id_jenis_akta_perorangan").val(ui.item.no_jenis_dokumen);
}
}
);
});

$(document).ready(function(){
$("#simpan_user").click(function(){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

var jenis_akta     = $("#jenis_akta").val();
var id_jenis_akta  = $("#id_jenis_akta").val();
var no_client      = $("#no_client").val();

if(id_jenis_akta != '' && jenis_akta != ''){

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_data_berkas') ?>",
data:"token="+token+"&no_client="+no_client+"&jenis_akta="+jenis_akta+"&id_jenis_akta="+id_jenis_akta,
success:function(data){
var r = JSON.parse(data);    
if(r.status == "Berhasil" ){
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
title: 'Dokumen Berhasil di proses.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/proses_berkas'); ?>"+"/"+r.no_berkas+"/";
})
$('#modal_tambah_pekerjaan').modal('hide');
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
type: 'error',
title: 'Terdapat Kesalahan hubungi administrator.'
})

}
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
title: 'Jenis Akta belum terpilih.'
})
}

});
});

</script>
</body>
