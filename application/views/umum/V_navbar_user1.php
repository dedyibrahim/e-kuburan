<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <button class="btn btn-success" id="menu-toggle"><span id="z" class="fa fa-chevron-left"> </span> Menu</button>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
    
<div class="input-group col-md-7 mx-auto" id="adv-search">
<input type="text" class="form-control" id="pencarian_nama_dokumen" placeholder="Cari File Dokumen" />
<div class="input-group-btn">
<div class="btn-group" role="group">
<div class="dropdown dropdown-lg">
<button type="button" style="padding: 0.875rem 0.75rem;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
<div class="dropdown-menu dropdown-menu-right" role="menu">
<form class="form-horizontal" method="post"  action="<?php echo base_url('Dashboard/cari_dokumen') ?>" enctype="multipart/form-data" >
<input type="hidden" name="nama_dokumen" class="form-control" id="pencarian_id_nama_dokumen"  />
<input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" class="form-control" value="<?php echo  $this->security->get_csrf_hash() ?>"  />

<div class="form-group">
<label for="filter">Nama Client</label>
<input type="text" class="form-control" id="pencarian_nama_klien">   
<input type="hidden" name="no_client" class="form-control" id="pencarian_no_nama_client">   
</div>
<hr>
<button type="submit" class="btn btn-success"><span class="fa fa-search" aria-hidden="true"></span> Cari Dokumen</button>
</form>
</div>
</div>
<button type="button" class="btn btn-dark"><span class="fa fa-search" aria-hidden="true"></span></button>
</div>
</div>
</div>

<style>

.dropdown.dropdown-lg .dropdown-menu {
    margin-top: -1px;
    padding: 6px 20px;
}
.input-group-btn .btn-group {
    display: flex !important;
}
.btn-group .btn {
    border-radius: 0;
    margin-left: -1px;
}
.btn-group .btn:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
.btn-group .form-horizontal .btn[type="submit"] {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.form-horizontal .form-group {
    margin-left: 0;
    margin-right: 0;
}
.form-group .form-control:last-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

@media screen and (min-width: 768px) {
    #adv-search {
        width: 500px;
        margin: 0 auto;
    }
    .dropdown.dropdown-lg {
        position: static !important;
    }
    .dropdown.dropdown-lg .dropdown-menu {
        min-width: 600px;
    }
}
    </style>
    
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
<a class="dropdown-item" href="<?php echo base_url('User1/keluar') ?>">Keluar</a>
</div>
</li>
</ul>
</div>
</nav>


<div class="container-fluid">
<div class="row">
	
<div class="col-md-4 mb-1 "><a href="<?php echo base_url('User1/') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-suitcase float-right fa-3x sticky-top"></span>
In <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Pekerjaan Masuk  <div class="float-right">
<?php echo $this->db->get_where('data_pekerjaan',array('status_pekerjaan'=>'Masuk'))->num_rows(); ?>   
</div></div>
</div></a>	
</div>	


<div class="col-md-4  mb-1"><a href="<?php echo base_url('User1/halaman_proses') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-star-half-alt float-right fa-3x sticky-top"></span>
 <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color:	#1ecee7;">Pekerjaan di Proses 
<div class="float-right">
<?php echo $this->db->get_where('data_pekerjaan',array('status_pekerjaan'=>'Proses'))->num_rows(); ?>   
    
</div>
</div>
</div>	</a>
</div>

<div class="col-md-4 mb-1"><a href="<?php echo base_url('User1/halaman_selesai') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-star float-right fa-3x sticky-top"></span>
Out <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2" style="background-color: #1ecee7;">Pekerjaan diselesaikan <div class="float-right">
<?php echo $this->db->get_where('data_pekerjaan',array('status_pekerjaan'=>'Selesai'))->num_rows(); ?>   

</div></div>
</div>	
</div></a>	

</div>	
</div>

<script type="text/javascript">

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