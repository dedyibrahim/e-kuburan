<body>
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content card p-2 m-3 ">

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#jenis">Pengaturan Jenis Dokumen <i class="fas fa-cogs"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#dokumen">Pengaturan Data Dokumen <i class="fas fa-cogs"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#aplikasi">Pengaturan Aplikasi <i class="fas fa-cogs"></i></a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <!----------------------------Jenis Dokumen------------------------------>
  <div class="tab-pane container active" id="jenis">
   <div class="row p-2">
   <div class="col-md-5">
    <label>Tambahkan Jenis Dokumen</label> 
    <input type="text" id="jenis_dokumen" class="form-control" name="jenis Dokumen" placeholder="Jenis Dokumen">
   <hr>
   <button  id="simpan_jenis" class="btn btn-success btn-block">Simpan</button>
   </div>

    <div class="col">
    <h5 align="center"> Buat Persyaratan Jenis Dokumen</h5>
    
    </div>
  </div>


    
  </div>
  <!----------------------------Dokumen------------------------------>
  <div class="tab-pane container fade" id="dokumen">
     <div class="row p-2">
   <div class="col-md-5">
    <label>Tambahkan Data Dokumen</label> 
    <input type="text"  class="form-control" name="Data Dokumen" placeholder="Data Dokumen">
   <hr>
   <button class="btn btn-success btn-block">Simpan</button>
   </div>
    <div class="col">
    <h5 align="center">Data Dokumen</h5>
    
    </div>
  </div>
    
  </div>
 <!----------------------------Aplikasi------------------------------>
   <div class="tab-pane container fade" id="aplikasi">
     
   </div>
</div>



</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#simpan_jenis").on("click",function(){

var jenis_dokumen = $("#jenis_dokumen").val();

if(jenis_dokumen !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('Dashboard/simpan_jenis_dokumen') ?>",
data:"jenis_dokumen="+jenis_dokumen

});

}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Masukan Jenis dokumen.'
})

}

});

});
</script>

</body>

