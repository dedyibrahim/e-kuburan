<body  style="color: #edf5e1;">
 

<nav class="navbar navbar-expand-lg navbar-light bg-theme border-bottom">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

 App Management       
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<li class="nav-item active">
<a class="nav-link" href="<?php echo base_url() ?>">Beranda <span class="fa fa-home "></span></a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Pilihan
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="<?php echo base_url('User1/profil') ?>">Profil</a>
<a class="dropdown-item" href="<?php echo base_url('User1/riwayat_pekerjaan') ?>">Histori pekerjaan</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="<?php echo base_url('User1/keluar') ?>">Keluar</a>
</div>
</li>
</ul>
</div>
</div>
</nav>
    
<div class="container">
    <div class="row text-center mt-5 pt-5" style="color: #116466 ;"  >
        <div class="col"><p><h3 style="color:#FF8C00;">Selamat Datang <?php echo $this->session->userdata("nama_lengkap"); ?></h3>Aplikasi Management Tempat penyimpanan dokumen  untuk mempermudah anda dalam mengelola dan mencari dokumen </p></div>
    </div>
    <br><br>
    <div class="row text-center mt-5 " >
        <div class="col-md-3">
            <a class="menu_utama" onclick="check_akses('Level 2','User2');"> 
            <span class="fa fa-folder fa-5x"></span><br>Dokumen Utama
        </a>
        </div>
        
        <div class="col-md-3" >
        <a  class="menu_utama" onclick="check_akses('Level 3','User3');"> 
            <span class="fa fa-folder-plus fa-5x"></span><br>Dokumen Perizinan
        </a>
        </div>   
        
        <div class="col-md-3">
        <a class="menu_utama" onclick="check_akses('Level 1','User1');"> 
            <span class="fa fa-user-cog fa-5x"></span><br>Admin
         </a>    
       </div>
        
        <div class="col">
        <a  class="menu_utama" onclick="check_akses('Admin');"> 
            <span class="fa fa-cogs fa-5x"></span><br>Setting
        </a>    
        </div>
    </div>
 </div>

<script type="text/javascript">
function check_akses(model,model2){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";      
    
$.ajax({
type:"post",
url:"<?php echo base_url('Menu/check_akses') ?>",
data:"token="+token+"&model="+model,
success:function(data){
var r = JSON.parse(data);

if(r.status == 'error'){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan,
});

}else{
window.location.href="<?php  echo base_url()?>"+model2
}

}

});


}
</script>    


<style>


.menu_utama {
color: #116466  !important;
cursor:pointer;
}

.menu_utama:hover{
color: #FF8C00 !important;  
text-decoration: none;
}

</style>

</body>


  