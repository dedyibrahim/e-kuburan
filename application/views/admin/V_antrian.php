<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_admin'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_admin'); ?>
<div class="container-fluid">
<?php foreach ($query->result_array() as $data){ ?> 
    
<div class="row p-1 ">
<div class="col  p-1 m-2">
<div class="row p-1">
<div class="col-md-8  "><h5 align="center">Data client yang dalam antrian</h5><hr>
    <p style="font-size:15px; ">Nama client : <?php echo $data['nama_client'] ?><br>
Jenis client : <?php echo $data['jenis_client'] ?><br>
Alamat client : <?php echo $data['alamat_client'] ?><br>
Jenis perizinan : <?php echo $data['jenis_perizinan'] ?><br>
</div>
<div class="col card p-2">
<button onclick="tambahkan_kedalam_proses('<?php echo $data['no_berkas'] ?>');" class="btn btn-success btn-block">Proses pekerjaan <span class="fa fa-exchange-alt"> </span></button>   
<hr>
<p>Tanggal dibuat pekerjaan : <?php echo $data['tanggal_dibuat'] ?><br>
Tanggal Antrian : <?php echo $data['tanggal_antrian'] ?></p>

</div>
</div>
</div>    
</div>
<?php } ?>
    
    

</div>    
</div>
</div>
<script type="text/javascript">
function tambahkan_kedalam_proses(no_berkas){
var token     = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Admin/tambahkan_kedalam_proses') ?>",
data:"token="+token+"&no_berkas="+no_berkas,
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
}).then(function() {
window.location.href = "<?php echo base_url('Admin/pekerjaan_proses'); ?>";
});


}

});


}   
</script>        
    
</body>
