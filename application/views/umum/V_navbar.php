<nav class="navbar navbar-expand-lg navbar-light  ">
<div class="container-fluid">
<button type="button" id="sidebarCollapse" class="btn btn-success"><i class="fas fa-align-justify"></i></button>

<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<i class="fas fa-align-justify"></i>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="nav navbar-nav ml-auto">
<li class="nav-item active">
<a class="nav-link" href="#"><i class="color_fa fa-2x fa fa-user"></i></a>
</li>
<li class="nav-item active">
<a class="nav-link" href="<?php echo base_url('Dashboard/keluar'); ?>"><i class=" color_fa fa-2x fa fa-sign-out-alt"> </i></a>
</li>
</ul>
</div>
</div>
</nav>
<div class="container-fluid">
<div class="row">

<div class="col ">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-file-word float-right fa-4x sticky-top"></span>
Dokumen Total <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Total data dokumen</div>
</div>	
</div>	

<div class="col  ">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-user-tie float-right fa-4x sticky-top"></span>
Client Total <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Total data client</div>
</div>	
</div>	

<div class="col  ">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-exchange-alt float-right fa-4x sticky-top"></span>
Dokumen Di Proses <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Total data di proses 
    <div class="float-right"><?php 
$query = $this->db->get_where('data_berkas',array('status_berkas'=>"Proses"))->num_rows();

echo $query;
?>
</div>
</div>
</div>	
</div>

<div class="col  ">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-users float-right fa-4x sticky-top"></span>
Total user <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Total user </div>
</div>	
</div>	

</div>	
</div>
