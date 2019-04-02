<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Daftar pekerjaan yang baru masuk</h4>
</div>
</div>

<div class="row p-2 ">
<?php foreach ($data_tugas->result_array() as    $data){  ?>
<div class='col-md-4 mb-2 '>
<div class='card'>
<div class="card-header text-center">
<?php echo $data['nama_client'] ?>
</div>
<div class="card-body p-2">
 <p style='font-size:12px;'>Nama client : <?php echo $data['nama_client'] ?><br>   
Jenis client : <?php echo $data['jenis_client'] ?><br>   
Tugas : <?php echo $data['pembuat_berkas'] ?><br>   
Tanggal Penugasan : <?php echo $data['tanggal_dibuat'] ?></p>
</div>
<div class="card-footer text-center">
Target Kelar : <?php echo $data['target_kelar'] ?><br>   
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
html: '<input class="form-control" id="target_kelar">',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Simpan target',
customClass: 'swal2-overflow',
onOpen: function() {
$('#target_kelar').datepicker({ minDate:0});
}
}).then((result) => {
var target_kelar = $("#target_kelar").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User/proses_tugas') ?>",
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
window.location.href = "<?php echo base_url('User/halaman_proses'); ?>";
});

}

});

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
