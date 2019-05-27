<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<?php $static = $data_persyaratan_pekerjaan->row_array(); ?>
<div class="container-fluid ">
<div class="card-header mt-2 text-center ">
<h5 align="center">Daftar Berkas <?php echo $static['nama_client'] ?> </h5>
</div>
<table class="table mt-2 table-sm table-hover table-striped table-bordered">
<tr>
<th>Nama persyaratan</th>
<th class="text-center">Jumlah lampiran</th>
<th class="text-center">Aksi</th>
</tr>
<?php 
foreach ($data_persyaratan_pekerjaan->result_array() as $persyaratan){
?>
<tr>
<td ><?php echo $persyaratan['nama_dokumen'] ?></td>    
<td class="text-center"><?php echo $this->db->get_where('data_berkas',array('no_pekerjaan'=>$persyaratan['no_pekerjaan_syarat'],'no_nama_dokumen'=>$persyaratan['no_nama_dokumen']))->num_rows();?></td>    
<td>
<select onchange="aksi_opsi('<?php echo $persyaratan['id_data_persyaratan_pekerjaan'] ?>','<?php echo base64_encode($persyaratan['no_pekerjaan_syarat']) ?>','<?php echo base64_encode($persyaratan['no_nama_dokumen']) ?>')" class="form-control aksi<?php echo $persyaratan['id_data_persyaratan_pekerjaan'] ?>">
<option></option>
<option value="1">Tampilkan lampiran</option>   
</select>    
</td>
</tr>
<?php }?>    
</table>
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

<!-------------------modal laporan--------------------->

<div class="modal fade" id="modal_tampil_lampiran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-body" id="lihat_data_lampiran">

</div>
</div>
</div>
</div>


<script type="text/javascript">
    
    
    
function aksi_opsi(id_data_persyaratan_pekerjaan,no_pekerjaan,no_nama_dokumen){
var val =  $(".aksi"+id_data_persyaratan_pekerjaan+" option:selected").val();   

if(val == 1){
tampilkan_lampiran(no_pekerjaan,no_nama_dokumen);
}

$(".aksi"+id_data_persyaratan_pekerjaan).val(""); 
}    

function tampilkan_lampiran(no_pekerjaan,no_nama_dokumen){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User1/data_lampiran_persyaratan') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&no_nama_dokumen="+no_nama_dokumen,
success:function(data){
$('#modal_tampil_lampiran').modal('show');
$("#lihat_data_lampiran").html(data);
}

});
        
}

function download(id_data_berkas){
window.location.href="<?php  echo base_url('User1/download_lampiran/')?>"+id_data_berkas;
}

    
function lihat_status_sekarang(id_data_berkas){
$('#modal_laporan').modal('show');
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('User1/lihat_laporan') ?>",
data:"token="+token+"&id_data_berkas="+id_data_berkas,
success:function(data){
$("#lihat_status_sekarang").html(data);
}

});
}        
</script>   
</html>
