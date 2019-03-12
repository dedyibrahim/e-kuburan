<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <button class="btn btn-success" id="menu-toggle"><span id="z" class="fa fa-chevron-left"> </span> Menu</button>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>">Home <span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Riwayat pekerjaan</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Pilihan
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="#">Pengaturan akun</a>
<a class="dropdown-item" href="#">Profil</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="<?php echo base_url('Dashboard/keluar') ?>">Keluar</a>
</div>
</li>
</ul>
</div>
</nav>


<div class="container-fluid">
<div class="row">

<div class="col-md-3 ">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-file-word float-right fa-4x sticky-top"></span>
Dokumen Total <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Total data dokumen</div>
</div>	
</div>	

<div class="col-md-3 "><a href="<?php echo base_url('Dashboard/data_client') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-user-tie float-right fa-4x sticky-top"></span>
Client Total <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Total data client  <div class="float-right"><?php 
$query1 = $this->db->get('data_client')->num_rows();

echo $query1;
?>
</div></div>
</div></a>	
</div>	


<div class="col-md-3  "><a href="<?php echo base_url('Dashboard/dokumen_proses') ?>">
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
</div>	</a>
</div>

<div class="col-md-3 ">
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
<script>
0

$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
var cek_icon = $(".fa-chevron-left").html();
if(cek_icon != undefined){
$("#z").addClass("fa-chevron-right");
}else{
$("#z").addClass("fa-chevron-left");
}


});
</script>