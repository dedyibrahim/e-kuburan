<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<?php foreach ($query->result_array() as $data){ ?> 

<div class="row p-1 ">
<div class="col card  p-1 m-2">
<div class="row  p-1">
<div class="col-md-8  "><h5 align="center">Data client yang dalam antrian</h5><hr>
<p style="font-size:15px; ">Nama client : <?php echo $data['nama_client'] ?><br>
Jenis client : <?php echo $data['jenis_client'] ?><br>
Alamat client : <?php echo $data['alamat_client'] ?><br>
Jenis perizinan : <?php echo $data['jenis_perizinan'] ?><br>
</div>
<div class="col ">
<h5 class="text-center" >Buat Persyaratan </h5>
<hr>
<p style="font-size:15px; "> 
Dibuat pekerjaan : <?php echo $data['tanggal_antrian'] ?><br>
Target kelar: <?php echo $data['target_kelar'] ?>
</p>

<button onclick="tambahkan_kedalam_proses('<?php echo base64_encode($data['no_pekerjaan']) ?>');" class="btn btn-sm btn-success btn-block">Buat Persyaratan <span class="fa fa-list-alt"> </span></button>   
</div>
</div>
</div>    
</div>
<?php } ?>
    
    

</div>    
</div>
</div>
<script type="text/javascript">
function tambahkan_kedalam_proses(no_pekerjaan){

const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: "info",
title: "Silahkan lengkapi persyaratannya terlebih dahulu"
}).then(function() {
window.location.href = "<?php echo base_url('User2/lengkapi_persyaratan/'); ?>"+no_pekerjaan;
});
}

   
</script>        
    
</body>
