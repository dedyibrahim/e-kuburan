<body>
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="card-header mt-2 text-center ">
<h5 align="center">Berkas yang dilampirkan</h5>
</div>
<table class="table mt-2 table-sm table-hover table-striped table-bordered">
<tr>
<th>Nama persyaratan</th>
<th class="text-center">Aksi</th>
</tr>
<?php 
foreach ($data_berkas->result_array() as $berkas){
$data_meta = $this->db->get_where('data_meta_berkas',array('nama_berkas'=>$berkas['nama_berkas']));    
?>
<tr>
<td ><?php echo $berkas['nama_file'] ?></td>    
<td class="text-center">
    <button class="btn btn-sm btn-success" onclick="download_berkas('<?php  echo $berkas['id_data_berkas']?>');"><span class="fa fa-download"></span></button>    
<button class="btn btn-sm btn-success" data-toggle="popover" title="Data informasi" data-content="
<?php 
foreach ($data_meta->result_array() as $meta){
echo $meta['nama_meta']." : ".$meta['value_meta'],"<br>";    
}
?>        
        "><span class="fa fa-eye"></span></button>     
</td>
</tr>
<?php }?>    
</table>
    
<div class="card-header mt-2 text-center ">
<h5 align="center">Informasi yang diberikan</h5>
</div>
<table class="table mt-2 table-sm table-hover table-striped table-bordered">
<tr>
<th>Nama Informasi</th>
<th class="text-center">Aksi</th>
</tr>
<?php 
foreach ($data_informasi->result_array() as $informasi){
?>
<tr>
<td ><?php echo $informasi['nama_informasi'] ?></td>    
<td class="text-center">
<?php if($informasi['lampiran'] !=''){ ?>    
<button class="btn btn-sm btn-success" onclick="download_berkas_informasi('<?php  echo $informasi['id_data_informasi_pekerjaan']?>');"><span class="fa fa-download"></span></button>    
<?php } ?>
<button class="btn btn-sm btn-success" data-toggle="popover" title="Data informasi" data-content="<?php echo $informasi['data_informasi'] ?>"><span class="fa fa-eye"></span></button>     
    
</td>
</tr>
<?php }?>    
</table>    
    
    
<div class="card-header mt-2 text-center ">
<h5 align="center">Dokumen utama yang dikerjakan</h5>
</div>    
<table class="table mt-2 table-sm table-hover table-striped table-bordered">
<tr>
<th>Nama Dokumen utama</th>
<th class="text-center">Aksi</th>
</tr>
<?php 
foreach ($dokumen_utama->result_array() as $utama){
?>
<tr>
<td ><?php echo $utama['nama_berkas'] ?></td>    
<td class="text-center">
    <button class="btn btn-sm btn-success"  onclick="download_utama('<?php echo $utama['id_data_dokumen_utama'] ?>');"><span class="fa fa-download"></span></button>    
    
</td>
</tr>
<?php }?>    
</table>    
    
    
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
$(function () {
  $('[data-toggle="popover"]').popover({
    container: 'body',
    html :true
  });
$('.btn').on('click', function (e) {
$('.btn').not(this).popover('hide');
});
}); 
    
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

function download_berkas(id_data_berkas){
window.location.href="<?php  echo base_url('User1/download_berkas/')?>"+id_data_berkas;
}
function download_berkas_informasi(id_data_berkas){
window.location.href="<?php  echo base_url('User1/download_berkas_informasi/')?>"+id_data_berkas;
}
function download_utama(id_data_berkas){
window.location.href="<?php  echo base_url('User1/download_utama/')?>"+id_data_berkas;
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
