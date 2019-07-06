<body onload="status_login();"  class="bg-dark"> </body>
<br>
<br>
<br>
<div class="container-fluid">   
<div class="row">    
<div class="col-md-4 mx-auto mt-2" >
<div class="card">    
<div class="card-header">    
<h4 align="center" class="text-lg-center  "><i class="fa fa-lock fa-2x"></i><br>Masukan detail ahli waris</h4>
<p style="text-align:center; color:red; " ><?php echo $this->session->userdata('status_login'); ?></p>   
</div>
<?php echo $script_captcha; ?>    
<div class="card-body" style="color:#000; " > 
<?php echo form_open($action);
?>
<div class="form-group">
<label>Username</label>
<?php echo form_input('username', $username, 'class="form-control" placeholder="masukan username..." '); ?>
</div>
<div class="form-group">
<label>Password</label>
<?php echo form_password('password', $password, 'class="form-control" placeholder="masukan password..." '); ?>
</div>
<div class="form-group">
<?php echo $captcha  ?>
</div>

</div>
<div class="card-footer"> 
<?php echo form_submit('login', 'login', 'class="btn btn-primary btn-block"'); ?>
</div>    
</div>    

</div>
</div>
</div>

<script  type="text/javascript">
function status_login(){
alert("asdasd");    
} 
 
 
function cari_ahli_waris(){
var nik_ahli_waris = $(".nik_ahli_waris").val();
if($.isNumeric(nik_ahli_waris)){
$.ajax({
type:"post",
data:"token="+getCookie("token")+"&nik_ahli_waris="+nik_ahli_waris,
url:"<?php echo base_url('Perpanjang/cari_jenazah') ?>",
success:function(data){
$(".data_jenazah").html(data);


}
    
});
}
}
</script>