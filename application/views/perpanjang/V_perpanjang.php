<div class="container-fluid">
    <div class="row bg-dark card-header ">
        <div class="col-md-6 text-light  mx-auto text-center">
            <span class="fa fa-home fa-3x"></span><br><h4>E-kuburan Sistem Perpanjang Masa kuburan</h4>
           
            <a href="<?php echo base_url('Perpanjang/logout') ?>">Logout <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

    
    <div class="container">
        <div class="card-header mt-3 text-center"><h3>Data jenazah<h3></div>        
<div class="row">
<div class="col mt-2">
<table style="width:100%;" id="data_jenazah" class="table table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nama Jenazah</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nama ahli waris</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Tanggal wafat</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Tanggal expired</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>            
</div>
</div>
    </div>
    
</div>
    


<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">

<div class="modal-content">
<div class="modal-body form_jenazah">
<div class="row">
<div class="col">
    <div class="card-header text-center">
             Untuk dapat memperpanjang masa kuburan silahkan transfer ke rekening dibawah inimical
            <p>BANK : Mandiri Syariah 
                <br>
                Attn :Bapak Ciko
                <br>
                Nomor rekening :7099034801
                <br>
                Sebesar :Rp 100.000
            </p>
            <label>Upload Bukti Transfer</label>
            <input type="hidden" class="form-control nik_jenazah">
            <input type="file" class="form-control bukti_transfer">
             <hr>
            <button type="button" class="btn btn-success simpan_bukti btn-block">Upload bukti transfer <span class="fa fa-upload"></span></button>
    </div>
 
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
ajax: {"url": "<?php echo base_url('Perpanjang/json_data_perpanjang') ?> ", 
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
{"data": "nama_ahli_waris"},
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
          

<script type="text/javascript">
$(document).ready(function(){
$(".simpan_bukti").click(function(){
    
formData = new FormData();
formData.append('token',getCookie("token"));
formData.append('bukti_transfer',$(".bukti_transfer")[0].files[0]);
formData.append('id_jenazah',$(".nik_jenazah").val());


 $.ajax({
url: "<?php echo base_url('Perpanjang/simpan_bukti_perpanjang') ?>",
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
$('#modal_form').modal('hide');

}
});

});    
});
    
    


function perpanjang_makam(nik_jenazah){
$('#modal_form').modal('show');    
$(".nik_jenazah").val(nik_jenazah);
}

</script>