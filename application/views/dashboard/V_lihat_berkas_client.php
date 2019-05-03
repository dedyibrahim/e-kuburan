<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Seluruh data berkas </h4>
</div>
</div>
    
<div class="row">
    <div class="col">    
    <table class="table table-sm table-striped ">
        <tr>
            <th>Nama berkas</th>   
            <th>Pengupload</th>   
            <th>Tanggal upload</th>   
            <th>Aksi</th>   
        </tr>
       <?php foreach ($query->result_array() as $d){ ?> 
        <tr>
            <td><?php  echo $d['nama_file']?></td> 
            <td><?php  echo $d['pengupload']?></td> 
            <td><?php  echo $d['tanggal_upload']?></td> 
            <td><button  onclick="download('<?php echo $d['id_data_berkas'] ?>')"class="btn btn-success btn-sm"> Download <span class="fa fa-download"></span></button></td>
        </tr>
       <?php } ?>
    </table>
    
    </div>  
</div>

</div>
</div>    
</body>

<script type="text/javascript">

function download(id_data_berkas){
window.location.href="<?php echo base_url('Dashboard/download_berkas/') ?>"+id_data_berkas;
} 
</script>