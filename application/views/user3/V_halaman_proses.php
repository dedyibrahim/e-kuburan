<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user3'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user3'); ?>
<div class="container-fluid ">
<div class="card-header mt-2 mb-2 text-center">
Data perizinan yang perlu diproses
</div>
    
<div class="row p-1 m-1">
<table class="table table-hover table-striped table-sm table-bordered text-center">
<tr>
<th>Nama client</th>
<th>Nama Tugas</th>
<th>Dari</th>
<th class="text-center">Target selesai perizinan</th>
<th>Aksi</th>
</tr>


<?php foreach ($data_tugas->result_array() as    $data){  ?>
<tr>
<td><?php echo $data['nama_client'] ?></td>
<td><?php echo $data['nama_file'] ?></td>
<td><?php echo $data['nama_lengkap'] ?></td>
<td class="text-center"><?php echo $data['target_kelar_perizinan'] ?></td>
<td>
<select onchange="aksi_option('<?php echo $data['no_pekerjaan'] ?>','<?php echo $data['id_data_berkas'] ?>');" class="form-control data_option<?php echo $data['id_data_berkas'] ?>">
<option value="1"></option>
<option value="2">Buat Laporan</option>
<option value="3">Lihat Persyaratan</option>
<option value="4">Upload Berkas</option>
</select>    
</td>
</tr>

<?php } ?>
</table>
</div>
</div>

<!-------------------modal laporan--------------------->

<div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Masukan Progress Pekerjaan</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<input type="hidden" value="" id="no_pekerjaan">
<input type="hidden" value="" id="id_data_berkas">
<textarea id="laporan"class="form-control" placeholder="masukan progress pekerjaan"></textarea>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-sm btn-success" id="simpan_laporan">Simpan laporan</button>
</div>
</div>
</div>
</div>

<!-------------modal--------------------->
<div class="modal fade" id="modal_data" tabindex="-1" role="dialog" aria-labelledby="modal_dinamis" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content ">
<div class="modal-body tampilkan_data">

</div>
</div>
</div>
</div>



</body>





<script type="text/javascript">
function aksi_option(no_pekerjaan,id_data_berkas){
var aksi_option = $(".data_option"+id_data_berkas+" option:selected").val();
if(aksi_option == 1){
}else if(aksi_option == 2){
$('#modal_laporan').modal('show');
$("#no_pekerjaan").val(no_pekerjaan);
$("#id_data_berkas").val(id_data_berkas);
}else if(aksi_option == 3){
form_lihat_persyaratan(no_pekerjaan);    
}else if(aksi_option == 4){
form_upload_berkas(no_pekerjaan,id_data_berkas);
}
$(".data_option"+id_data_berkas).val("");
}


function form_lihat_persyaratan(no_pekerjaan){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User3/lihat_persyaratan') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
success:function(data){
$(".tampilkan_data").html(data);
$('#modal_data').modal('show');
}
});
}

function form_upload_berkas(no_pekerjaan,id_data_berkas){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User3/form_upload_berkas') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&id_data_berkas="+id_data_berkas,
success:function(data){
$(".tampilkan_data").html(data);
$('#modal_data').modal('show');
}
});
}
function form_tolak_tugas(no_pekerjaan,id_data_berkas){
}

function download(id_data_berkas){
window.location.href="<?php echo base_url('User3/download_berkas/') ?>"+id_data_berkas;
}

$(document).ready(function(){
$("#simpan_laporan").click(function(){
var no_pekerjaan   = $("#no_pekerjaan").val();
var id_data_berkas = $("#id_data_berkas").val();
var laporan        = $("#laporan").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
data:"token="+token+"&laporan="+laporan+"&id_data_berkas="+id_data_berkas+"&no_pekerjaan="+no_pekerjaan,
url :"<?php echo base_url('User3/simpan_laporan') ?>",
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
$('#modal_laporan').modal('hide');
$("#laporan").val("")

}
});

}); 

});

</script>    
</html>
