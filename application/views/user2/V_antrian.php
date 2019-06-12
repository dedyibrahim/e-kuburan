<body >
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<div class="card-header mt-2 text-center">
Pekejaan masuk
</div>

<div class="row">    
<div class="col mt-2">
<?php if($query->num_rows() == 0){ ?>    
    <h5 class="text-center">Pekerjaan yang baru masuk belum tersedia<br>
        <span class="fa fa-folder-open fa-3x"></span>
    </h5>
    
<?php } else { ?>
<table class="table table-hover table-bordered table-sm text-center table-striped ">
<tr>
<th>Nama client</th>
<th>Jenis Pekerjaan</th>
<th class="text-center">Target Selesai</th>
<th>Aksi</th>
</tr>
<?php foreach ($query->result_array() as $data){ ?>


<tr>
<td id='nama_client<?php echo $data['id_data_pekerjaan'] ?>'><?php echo $data['nama_client'] ?></td>
<td><?php echo $data['jenis_perizinan'] ?></td>
<td><?php 

$d = new DateTime($data['target_kelar']);
echo $d->diff(new DateTime())->format('%a');
 ?> Hari lagi </td>
<td>
<select onchange="aksi_option('<?php echo base64_encode($data['no_pekerjaan']) ?>','<?php echo $data['id_data_pekerjaan'] ?>');" class="form-control data_option<?php echo $data['id_data_pekerjaan'] ?>">
<option>-- Klik untuk lihat menu --</option>
<option value="1">Proses Persyaratan</option>
<option value="2">Buat laporan</option>
</select>    
</td>
</tr>
<?php } ?>
</table>
<?php } ?>    
</div>
</div>
</div>    
</div>
</div>

<div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h6>Progress <span class="laporan_client"></span></h6>  
</div>   
<div class="modal-body">
<input class="no_pekerjaan" value="" type="hidden">
<input class="id_data_pekerjaan" value="" type="hidden">
<textarea class="form-control laporan" placeholder="laporkan progress pekerjaan"></textarea>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-success btn-sm simpan_progress">Simpan</button>
</div>
</div>
</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
$(".simpan_progress").click(function(){
var laporan             = $(".laporan").val();
var no_pekerjaan        = $(".no_pekerjaan").val();
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&laporan="+laporan,
url:"<?php echo base_url('User2/simpan_progress_pekerjaan') ?>",
success:function(data){
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 2000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
});
$('#modal_laporan').modal('hide');
$(".laporan").val("");
}
});


});    

});    


function aksi_option(no_pekerjaan,id_data_pekerjaan){
var aksi_option = $(".data_option"+id_data_pekerjaan+" option:selected").val();
if(aksi_option == 1){
tambahkan_kedalam_proses(no_pekerjaan);
}else if(aksi_option == 2){
$('#modal_laporan').modal('show');
var nama_client = $("#nama_client"+id_data_pekerjaan).text();
$(".laporan_client").text(nama_client);
$(".no_pekerjaan").val(no_pekerjaan);
$(".id_data_pekerjaan").val(id_data_pekerjaan);


}
$(".data_option"+id_data_pekerjaan).val("-- Klik untuk lihat menu --");
}    


function tambahkan_kedalam_proses(no_pekerjaan){
window.location.href = "<?php echo base_url('User2/lengkapi_persyaratan/'); ?>"+no_pekerjaan;
}
</script>        

</body>
