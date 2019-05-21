<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<?php $kar = $data->row_array(); ?>
<div class="container-fluid ">
<div class="card-header mt-2 text-center ">
<h5 align="center">Data pekerjaan <?php echo base64_decode($this->uri->segment(4)) ?> 
</h5>
</div>
    

<div class="row mt-2">
<div class="col">
<table class="table table-sm table-bordered table-striped  text-center table-condensed">
<tr>
<th>Pekerjaan</th>
<th>Nama client</th>
<th>Pekerjaan</th>
<th>Target selesai</th>
<th>Aksi</th>
</tr>
<?php foreach ($data->result_array() as $d) { ?>
<tr>
<td><a href="<?php echo base_url('User1/lihat_status_pekerjaan/'. base64_encode($d['no_pekerjaan'])) ?>"><span class="badge p-2 badge-primary"><?php echo $d['jenis_perizinan']  ?></span></a></td>
<td><?php echo $d['nama_client']  ?></td>
<td>
 <select disabled="" onchange="alihkan_tugas('<?php echo base64_encode($d['no_pekerjaan']) ?>','<?php echo $d['id_data_pekerjaan'] ?>');" class="form-control pekerjaan<?php echo $d['id_data_pekerjaan'] ?>">    
<option><?php echo $d['pembuat_pekerjaan'] ?></option>
<?php
foreach ($data_user->result_array() as $user){
echo "<option value=".$user['no_user'].">".$user['nama_lengkap']."</option>";

}?>
</select>
</td>   
<td><?php echo $d['target_kelar']  ?></td>
<td>
<select onchange="aksi_option('<?php echo base64_encode($d['no_pekerjaan']) ?>','<?php echo $d['id_data_pekerjaan'] ?>');" class="form-control data_option<?php echo $d['id_data_pekerjaan'] ?>">
<option></option>
<option value="1">Lihat Laporan</option>
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
</div>
</div>
    
 <!-------------------modal laporan--------------------->

<div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-body" id="lihat_status_sekarang">

</div>
</div>
</div>
</div>    
<script type="text/javascript">
function aksi_option(no_pekerjaan,id_data_pekerjaan){
var val = $(".data_option"+id_data_pekerjaan+" option:selected").val();
if(val == 1){
lihat_laporan_pekerjaan(no_pekerjaan);   
$('.pekerjaan'+id_data_pekerjaan).attr("disabled",true);
}else if (val == 2){
$('.pekerjaan'+id_data_pekerjaan).removeAttr("disabled");
}
$(".data_option"+id_data_pekerjaan).val("");

}
function alihkan_tugas(no_pekerjaan,id_data_pekerjaan){
var no_user             = $(".pekerjaan"+id_data_pekerjaan+" option:selected").val();
var pembuat_pekerjaan   = $(".pekerjaan"+id_data_pekerjaan+" option:selected").text();
var token               = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&no_user="+no_user+"&pembuat_pekerjaan="+pembuat_pekerjaan,
url:"<?php echo base_url('User1/alihkan_pekerjaan') ?>",
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
window.location.href = "<?php echo base_url('User1/lihat_karyawan'); ?>";
});
}

});
}
function lihat_laporan_pekerjaan(no_pekerjaan){
$('#modal_laporan').modal('show');
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
    
$.ajax({
type:"post",
url:"<?php echo base_url('User1/lihat_laporan_pekerjaan') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
success:function(data){
$("#lihat_status_sekarang").html(data);
}

});
}


</script>   
</html>
