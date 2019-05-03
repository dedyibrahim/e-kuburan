<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="row">
<?php foreach ($query->result_array() as $data){  ?>        
<div class="col-md-4 mx-auto p-2 ">
<div class="card ">    
    <div class="card-body"><p style="font-size:12px;">Jenis dokumen: <?php echo $data['nama_dokumen'] ?><br>  
<?php echo str_replace("_"," ",$data['nama_meta']) ?> : <?php echo $data['value_meta'] ?><br>   
Pengupload : <?php echo $data['pengupload'] ?><br>  
Tanggal upload : <?php echo $data['tanggal_upload'] ?><br></p>  
</div>
    <div onclick="download_berkas('<?php echo $data['id_data_berkas'] ?>')" class="card-footer"><button class="btn btn-block btn-sm">Download <span class="fa fa-download"></span></button></div>
</div>
    
</div>
<?php } ?>    

</div>
</div>
</div></div>
<script type="text/javascript">
function download_berkas(id_data_berkas){
window.location.href="<?php echo base_url('User3/download_berkas/') ?>"+id_data_berkas;
}
</script>    
</body>
</html>
