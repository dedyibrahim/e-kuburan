<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid mt-2">
		
<ul id="clothing-nav" class="nav nav-tabs" role="tablist">
	
<li class="nav-item">
<a class="nav-link active" href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Dalam bentuk lampiran ( <?php echo $dalam_bentuk_lampiran->num_rows(); ?> ) Ditampilkan</a>
</li>

<li class="nav-item ml-1">
<a class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab" aria-controls="hats">Dalam bentuk informasi ( <?php echo $dalam_bentuk_informasi->num_rows(); ?> ) Ditampilkan</a>
</li>



</ul>

<div id="clothing-nav-content" class="tab-content">

<div role="tabpanel" class="tab-pane fade show active" id="home" aria-labelledby="home-tab">
<?php if($dalam_bentuk_lampiran->num_rows() == 0){ ?>
   
      <h3 class="text-center mt-2">Hasil pencarian lampiran tidak ditemukan <br><span class="fa fa-folder-open fa-4x"></span></h3>    
  
    
<?php }else{?>
<table class="table table-sm table-bordered table-striped table-condensed">
        <tr>
            <td>No</td>  
            <td>Jenis Lampiran</td>  
            <td>Aksi</td>  
        </tr>   
<?php $h=1; foreach ($dalam_bentuk_lampiran->result_array() as $lampiran){ ?>
        <tr>
            <td> <?php echo $h++ ?></td>
            <td><?php echo str_replace("_"," ",$lampiran['nama_meta']) ?> : <?php echo $lampiran['value_meta'] ?></td>
            <td class="text-center">
                <button onclick="download_berkas('<?php echo $lampiran['id_data_berkas'] ?>')" class="btn btn-sm btn-success">Download Lampiran <span class="fa fa-download"></span></button> 
            
            </td> 
             
        </tr>
<?php } ?>
</table>
<?php } ?>
    
</div>

<div role="tabpanel" class="tab-pane fade" id="hats" aria-labelledby="hats-tab">
<?php if($dalam_bentuk_informasi->num_rows() == 0){ ?>
    <h3 class="text-center mt-2">Hasil pencarian informasi tidak ditemukan <br><span class="fa fa-folder-open fa-4x"></span></h3>    
<?php }else{  ?>
    <table class="table table-sm table-bordered table-striped table-condensed">
        <tr>
            <td>No</td>  
            <td>Jenis Informasi</td>  
            <td>Aksi</td>  
        </tr>   
<?php $h=1; foreach ($dalam_bentuk_informasi->result_array() as $informasi){ ?>
        <tr>
            <td> <?php echo $h++ ?></td>
            <td> <?php echo $informasi['nama_informasi'] ?></td>
            <td class="text-center">
                <button onclick="lihat_informasi('<?php echo $informasi['id_data_informasi_pekerjaan'] ?>')"  class="btn btn-sm btn-success">Lihat Informasi <span class="fa fa-list-alt"></span></button> 
            <?php if($informasi['lampiran'] !=''){ ?>
                <button onclick="download_berkas_informasi('<?php echo $informasi['id_data_informasi_pekerjaan'] ?>')" class="btn btn-sm btn-success">Download Lampiran <span class="fa fa-download"></span></button> 
            
            <?php } ?>
            </td> 
             
        </tr>
<?php } ?>
</table>    
<?php }?>
</div>
</div>
    
    
    
    
<script type="text/javascript">
function download_berkas(id_data_berkas){
window.location.href="<?php echo base_url('User1/download_berkas/') ?>"+id_data_berkas;
}

function download_berkas_informasi(id_data_berkas_informasi){
window.location.href="<?php echo base_url('User1/download_berkas_informasi/') ?>"+id_data_berkas_informasi;
}

function lihat_informasi(id_data_berkas_informasi){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('User1/lihat_informasi')?>",
data:"token="+token+"&id_data_informasi_pekerjaan="+id_data_berkas_informasi,
success:function(data){
$('#modal_informasi').modal('show');
$(".data_informasi").html(data);

}
});    
}

</script> 

</div>
<div class="modal fade" id="modal_informasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body data_informasi">
       
      </div>
      
    </div>
  </div>
</div>
    
</body>
</html>
