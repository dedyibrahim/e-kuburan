<nav class="navbar navbar-expand-lg navbar-light bg-theme border-bottom">
    <button class="btn btn-success" id="menu-toggle"><span id="z" class="fa fa-chevron-left"> </span> Menu</button>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
    

    
    
    
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
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="<?php echo base_url('Dashboard/keluar') ?>">Keluar</a>
</div>
</li>
</ul>
</div>
</nav>


<div class="container-fluid">
<div class="row">

<div class="col  "><a  style="text-decoration:none;" href="<?php echo base_url('Dashboard/data_jenazah') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-users float-right fa-3x sticky-top"></span>
Data Jenazah<br>
<h4>&nbsp;</h4>
</div>
    
<div class="footer p-2 bg_data_bawah">Total data jenazah 
<div class="float-right">
<?php echo $this->db->get('data_jenazah')->num_rows() ?>    
</div>
</div>
</div>	</a>
</div>

<div class="col "><a  style="text-decoration:none;" href="<?php echo base_url('Dashboard/input_ahli_waris') ?>">
<div class="bg_data rounded-top">
<div class="p-2">
<span class="fa fa-users float-right fa-3x sticky-top"></span>
Data Ahli Waris <br>
<h4>&nbsp;</h4>
</div>
<div class="footer p-2 bg_data_bawah" >Total data ahli waris <div class="float-right">
<?php echo $this->db->get('data_ahli_waris')->num_rows() ?>    

</div></div>
</div></a>	
</div>	

</div>	
</div>

<script type="text/javascript">
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
var cek_icon = $(".fa-chevron-left").html();
if(cek_icon != undefined){
$("#z").addClass("fa-chevron-right");
set_toggled();
}else{
$("#z").addClass("fa-chevron-left");
set_toggled();
}



});
function set_toggled(){
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>";      
    
$.ajax({
type:"post",
url:'<?php echo base_url('Dashboard/set_toggled') ?>',
data:"token="+token,
success:function(data){
console.log(data);    
}    
});
        
}
</script> 