<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<div class="row">    
<div class="col mt-2">
<table class="table table-hover table-striped ">
<tr>
<th>Nama client</th>
<th>Jenis Pekerjaan</th>
<th>Tanggal tugas</th>
<th class="text-center">Target kelar</th>
<th>Aksi</th>
</tr>
<?php foreach ($query->result_array() as $data){ ?> 
<tr>
<td><?php echo $data['nama_client'] ?></td>
<td><?php echo $data['jenis_perizinan'] ?></td>
<td><?php echo $data['tanggal_antrian'] ?></td>
<td><?php echo $data['target_kelar'] ?></td>
<td>
    <select onchange="aksi_option('<?php echo base64_encode($data['no_pekerjaan']) ?>','<?php echo $data['id_data_pekerjaan'] ?>');" class="form-control data_option<?php echo $data['id_data_pekerjaan'] ?>">
<option></option>
<option value="1">Proses Persyaratan</option>
<option value="2">Alihkan Pekerjaan</option>
</select>    
</td>
</tr>
<?php } ?>
 </table>        
</div>
</div>
</div>    
</div>
</div>
<script type="text/javascript">
function aksi_option(no_pekerjaan,id_data_pekerjaan){
var aksi_option = $(".data_option"+id_data_pekerjaan+" option:selected").val();
if(aksi_option == 1){
tambahkan_kedalam_proses(no_pekerjaan);
}else if(aksi_option == 2){
//form_alihkan_tugas();
}else if(aksi_option == 3){
//form_lihat_persyaratan(no_pekerjaan);    
}else if(aksi_option == 4){
//form_upload_berkas(no_pekerjaan,id_data_berkas);
}

}    
    
    
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
