<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user3'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user3'); ?>
<div class="container-fluid ">
<div class="card-header mt-2 mb-2 text-center">
Data perizinan yang perlu dikerjakan
</div>

<div class="row ">
    <div class="col">    
<?php if($data_tugas->num_rows() == 0){ ?>
    <h5 class="text-center">Data perizinan yang perlu dikerjakan belum tersedia <br>
        <span class="fa fa-sticky-note fa-3x"></span>
    </h5>
 <?php } else{ ?> 
<table class="table table-hover table-sm table-bordered text-center table-striped ">
<tr>
<th>Nama client</th>
<th>Nama Tugas</th>
<th>Dari</th>
<th>Tanggal penugasan</th>
<th>Aksi</th>
</tr>


<?php foreach ($data_tugas->result_array() as    $data){  ?>
<tr>
<td><?php echo $data['nama_client'] ?></td>
<td id="nama_file<?php echo $data['id_data_berkas']?>"><?php echo $data['nama_file'] ?></td>
<td ><?php echo $data['nama_lengkap'] ?></td>
<td><?php echo $data['tanggal_tugas'] ?></td>
<td>
<select onchange="aksi_option('<?php echo $data['no_pekerjaan'] ?>','<?php echo $data['id_data_berkas'] ?>');" class="form-control data_option<?php echo $data['id_data_berkas'] ?>">
<option></option>
<option value="1">Terima Tugas</option>
<option value="2">Tolak Tugas</option>
<option value="3">Lihat Persyaratan</option>
</select>    
</td>
</tr>

<?php } ?>
</table>
<?php } ?>
    
</div>

</div>

<!-------------modal--------------------->
<div class="modal fade" id="modal_proses" tabindex="-1" role="dialog" aria-labelledby="modal_dinamis" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content ">
<div class="modal-header">
<h5 class="modal-title" id="modal_dinamis">Modal</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body data_modal">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>

<!-------------modal--------------------->
<div class="modal fade" id="modal_lihatpersyaratan" tabindex="-1" role="dialog" aria-labelledby="modal_dinamis" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content ">
<div class="modal-body lihat_syarat">

</div>
</div>
</div>
</div>

<!-------------modal tolak perizinan--------------------->
<div class="modal fade" id="modal_tolak_perizinan" tabindex="-1" role="dialog" aria-labelledby="modal_dinamis" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content ">
<div class="modal-header">
    <h6>Penolakan tugas <span class="nama_tugas"></span></h6>
</div>
<div class="modal-body ">
<input type="hidden" class="id_data_berkas">    
<input type="hidden" class="no_pekerjaan">    
<textarea class="form-control alasan_penolakan" placeholder="Masukan alasan penolakan"></textarea>
</div>
<div class="modal-footer">
<button class="btn btn-sm btn-success simpan_penolakan">Simpan Penolakan</button>
</div>    
</div>
</div>
</div>


<style>
.swal2-overflow {
overflow-x: visible;
overflow-y: visible;
}    
</style>    

</body>
<script type="text/javascript">
$(document).ready(function(){
$(".simpan_penolakan").click(function(){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
var alasan_penolakan  = $(".alasan_penolakan").val();
var id_data_berkas    = $(".id_data_berkas").val();
var no_pekerjaan      = $(".no_pekerjaan").val();
var nama_tugas        = $("#nama_file"+id_data_berkas).text();

if(alasan_penolakan !=''){
$.ajax({
type:"post",
url:"<?php echo base_url('User3/tolak_tugas') ?>",
data:"token="+token+"&id_data_berkas="+id_data_berkas+"&alasan_penolakan="+alasan_penolakan+"&no_pekerjaan="+no_pekerjaan+"&nama_tugas="+nama_tugas,
success:function(data){
var r  = JSON.parse(data);
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
}).then(function() {
window.location.href = "<?php echo base_url('User3/halaman_proses'); ?>";
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
type: "warning",
title: "Alasan penolakan belum diberikan"
});

}
});    
    
});



function aksi_option(no_pekerjaan,id_data_berkas){
var aksi_option = $(".data_option"+id_data_berkas+" option:selected").val();
if(aksi_option == 1){
proses_perizinan(id_data_berkas);   
}else if(aksi_option == 2){
$('#modal_tolak_perizinan').modal('show');
var nama_file = $("#nama_file"+id_data_berkas).text();
$(".nama_tugas").html(nama_file);
$(".id_data_berkas").val(id_data_berkas);
$(".no_pekerjaan").val(no_pekerjaan);

}else if(aksi_option == 3){
lihat_persyaratan(no_pekerjaan);    
}
$(".data_option"+id_data_berkas).val("");
}

function proses_perizinan(id){
swal.fire({
title: 'Target Selesai Perizinan <br><hr>',
html: '<input class="form-control" readonly="" id="target_kelar">',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Simpan target',
customClass: 'swal2-overflow',
onOpen: function() {
$('#target_kelar').datepicker(
{ minDate:0,
dateFormat: 'dd/mm/yy'
}
);
}
}).then((result) => {

if($("#target_kelar").val() == ''){
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
title: "Anda belum memasukan target"
});
}else{
var target_kelar = $("#target_kelar").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User3/proses_tugas') ?>",
data:"token="+token+"&id_data_berkas="+id+"&target_kelar="+target_kelar,
success:function(data){
var r  = JSON.parse(data);
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
}).then(function() {
window.location.href = "<?php echo base_url('User3/halaman_proses'); ?>";
});
}
});
}
});
}

function lihat_persyaratan(no_pekerjaan){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User3/lihat_persyaratan') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
success:function(data){
$(".lihat_syarat").html(data);
$('#modal_lihatpersyaratan').modal('show');
}
});


}

function download(id_data_berkas){
window.location.href="<?php echo base_url('User3/download_berkas/') ?>"+id_data_berkas;
}


</script>    
<script>
$(function() {
$("input[name='target_kelar']").datepicker({ minDate:0});
});
</script>
</html>
