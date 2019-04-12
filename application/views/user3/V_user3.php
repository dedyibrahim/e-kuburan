<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user3'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user3'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Data perizinan yang masuk</h4>
</div>
</div>

<div class="row p-1  m-1">
<table class="table table-hover table-striped ">
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
<td><?php echo $data['nama_file'] ?></td>
<td><?php echo $data['nama_lengkap'] ?></td>
<td><?php echo $data['tanggal_tugas'] ?></td>
<td>
<select onchange="aksi_option('<?php echo $data['no_pekerjaan'] ?>','<?php echo $data['id_data_berkas'] ?>');" class="form-control data_option">
<option></option>
<option value="1">Terima Tugas</option>
<option value="2">Tolak Tugas</option>
<option value="3">Alihkan Tugas</option>
<option value="4">Lihat Persyaratan</option>

</select>    
</td>
</tr>

<?php } ?>
</table>
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


<style>
.swal2-overflow {
overflow-x: visible;
overflow-y: visible;
}    
</style>    

</body>
<script type="text/javascript">

function aksi_option(no_pekerjaan,id_data_berkas){
var aksi_option = $(".data_option option:selected").val();
if(aksi_option == 1){
proses_perizinan(id_data_berkas);   
}else if(aksi_option == 2){
alert(2);    
}else if(aksi_option == 3){
lihat_persyaratan(no_pekerjaan);    
}else if(aksi_option == 4){
lihat_persyaratan(no_pekerjaan);    
}

}

function proses_perizinan(id){
swal.fire({
title: 'Target Kelar Perizinan <br><hr>',
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
