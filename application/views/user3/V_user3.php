<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user3'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user3'); ?>
<div class="container-fluid p-1 m-1">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Data perizinan yang harus dikerjakan</h4>
</div>
</div>

<div class="row p-2 m-2">
<?php foreach ($data_tugas->result_array() as    $data){  ?>
<div class='col-md-4 mx-auto m-1  p-1 '>
<div class='card ' >
<div class='card-header '>
<div class="row">
    <div class="col-md-10" style="font-size:13px;"><?php echo $data['nama_dokumen'] ?></div>
<div class="col text-right">
<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="#">Tolak tugas</a>
<a class="dropdown-item" href="#">Alihkan Tugas</a>
</li>
</ul>  
</div>
</div>    
</div>
<div class="card-body" style="font-size:13px;">    
Nama client : <?php echo $data['nama_client'] ?><br>   
Jenis client : <?php echo $data['jenis_client'] ?><br>   
Tugas Dari : <?php echo $data['pembuat_berkas'] ?><br>   
Tanggal Penugasan : <?php echo $data['tanggal_tugas'] ?><br>
</div>
<div class="card-footer">
<button type="button"  onclick='proses_perizinan("<?php echo $data['id_syarat_dokumen'] ?>","proses");' class="btn btn-sm btn-block btn-success">Proses Perizinan <span class="fa fa-exchange-alt"></span></button>
</div>
</div>
</div>
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
<style>
.swal2-overflow {
overflow-x: visible;
overflow-y: visible;
}    

</style>    

</body>
<script type="text/javascript">
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
$('#target_kelar').datepicker({ minDate:0});
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
data:"token="+token+"&id_syarat_dokumen="+id+"&target_kelar="+target_kelar,
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

function tampilkan_modal(id_syarat_dokumen,jenis_modal){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('User/tampilkan_modal') ?>",
data:"token="+token+"&jenis_modal="+jenis_modal,
success:function(data){
$(".data_modal").html(data);
$('#modal_dinamis').modal('show');
}
});

} 


</script>    
<script>
$(function() {
$("input[name='target_kelar']").datepicker({ minDate:0});
});
</script>
</html>
