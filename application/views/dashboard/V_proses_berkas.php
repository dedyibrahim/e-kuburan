<body>
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content card p-2 m-3 ">

<?php 


$data2 = $data->row_array();

?>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#upload_utama">Upload Dokumen Utama <i class="fas fa-file-upload"></i></a>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#upload_perizinan">Upload Dokumen Perizinan <i class="fas fa-file-upload"></i></a>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="row m-3">
        <div class="col-md-6">
            Jenis Perizinan:<?php echo $data2['jenis_perizinan'] ?><br>
            Jenis Client:<?php echo $data2['jenis_client'] ?><br>
            Nama:<?php echo $data2['nama'] ?><br>
            Alamat:<?php echo $data2['alamat'] ?><br>
        </div>
    </div>
    <hr>
<!----------------------------Jenis UTAMA------------------------------>
<div class="tab-pane container active p-2" id="upload_utama">
<div class="container">
<br />
<div id="smartwizard">
<ul>
<li><a href="#step-1">Step 1<br /><small>Upload Draft</small></a></li>
<li><a href="#step-2">Step 2<br /><small>Upload Minuta</small></a></li>
<li><a href="#step-3">Step 3<br /><small>Upload Salinan</small></a></li>
</ul>

<div class="col-md-6 mx-auto">
<div id="step-1">
    <h2 class="mx-auto text-center">Draft Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-0" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Draft</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>

</div>
<div id="step-2">
<h2 class="mx-auto text-center">Minuta Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-1" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Minuta</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>
</div>
<div id="step-3">
    <h2 class="mx-auto text-center">Salinan Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-2" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Salinan</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>
</div>

</div>
</div>


</div>


<script type="text/javascript">
$(document).ready(function(){
$('#smartwizard').smartWizard();
});
</script>

</div>    

<!----------------------------Jenis PERIZINAN------------------------------>
<div class="tab-pane container " id="upload_perizinan">
<?php echo $data2['nama_syarat'] ?>    
<?php echo $data2['status_syarat'] ?>    
</div>

</div>
</div>
</div>
</body>
