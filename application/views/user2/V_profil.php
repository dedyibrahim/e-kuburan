<body>
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid ">
<?php  $static = $data_user->row_array(); ?>
<div class="row mt-2">
<div class="col">
<div class="text-center p-2 card-header rounded-bottom ">   
<?php if(!file_exists('./uploads/user/'.$static['foto'])){ ?>
<img style="width:200px; height: 200px;" src="<?php echo base_url('uploads/user/no_profile.jpg') ?>" img="" class="img img-thumbnail" >    
<?php }else{ ?>
<?php if($static['foto'] != NULL){ ?>
<img style="width:200px; height: 200px;" src="<?php echo base_url('uploads/user/'.$static['foto']) ?>" img="" class="img img-thumbnail" >    
<?php }else{ ?>
<img style="width:200px; height: 200px;" src="<?php echo base_url('uploads/user/no_profile.jpg') ?>" img="" class="img img-thumbnail" >        
<?php } ?> 

<?php } ?>
<button class="btn btn-success btn-sm  float-right" onclick="upload_profile();"> Update Poto <span class="fa fa-edit"></span></button>
<div id="form_upload_profile" style="display:none;">
<hr>
<label>Upload foto</label>
<input type='file' id="imgInp" class="form-control" />

</div>
</div>  
</div>

<div class="col-md-7">
<table class="table  table-striped table-bordered">
<tr>
<td>ID</td>
<td id="id_user"><?php echo $static['no_user'] ?></td>
</tr>
<tr>
<td>Username</td>
<td id="username"><?php echo $static['username'] ?></td>
</tr>
<tr>
<td>Nama lengkap</td>
<td id="nama_lengkap"><?php echo $static['nama_lengkap'] ?></td>
</tr>
<tr>
<td>Email</td>
<td id="email"><?php echo $static['email'] ?></td>
</tr>
<tr>
<td>Phone</td>
<td id="phone"><?php echo $static['phone'] ?></td>
</tr>
<tr>
<td>Level</td>
<td> <?php echo $static['level'] ?></td>
</tr>
<tr style="display:none;" id="new_password" >
<td>New Password</td>    
<td><input type="password" class="form-control new_password" placeholder="New password..."></td>    
</tr>

<tr style="display:none;" id="repeat_password">
<td>Repeat Password</td>    
<td><input type="password" class="form-control repeat_password" placeholder="Repeat password..."></td>    
</tr>

</table>    
<div class="card-footer text-center">
<button style="display:none;" class="btn btn-success btn-sm col-md-6 btn_update">Perbaharui Profil</button>  
<button style="display:none;" class="btn btn-success btn-sm col-md-6 simpan_password">Save Password</button>  

<button class="btn btn-success btn-sm col-md-6 btn_edit">Edit Profil</button>  
<button class="btn btn-success btn-sm col-md-5 btn_ubah_password">Change Password</button>  
</div> 
</div>

</div> 
</div>
</div>    
</div>
</div>
</div>

<div class="modal fade" id="modal_ubah_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Crop profile picture</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<img id="my-image" src="#" />
</div>
<div class="modal-footer">
<button id="use" class="btn btn-success btn-sm btn-block btn_upload">Upload</button>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    
$(document).ready(function(){


$(".btn_update").click(function(){
var username        =$(".username").val();
var nama_lengkap    =$(".nama_lengkap").val();
var email           =$(".email").val();
var phone           =$(".phone").val();
var id_user         =$("#id_user").text();
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('User2/update_user')?>",
data:"token="+token+"&username="+username+"&nama_lengkap="+nama_lengkap+"&email="+email+"&phone="+phone+"&id_user="+id_user,
success:function(data){
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function(){
window.location.href='<?php echo base_url('User2/profil') ?>';    
});   
    
}
});

});

$(".simpan_password").on("click",function(){
var new_password    = $(".new_password").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var repeat_password = $(".repeat_password").val();
var id_user         = $("#id_user").text();
if(new_password == '' && repeat_password ==''){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: "warning",
title: "Masih terdapat data yang perlu diisi"
});
}else if(new_password != repeat_password){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: "warning",
title: "Password yang dimasukan tidak sama"
});   
   
}else{

$.ajax({
type:"post",
url:"<?php echo base_url('User2/update_password')?>",
data:"token="+token+"&password="+new_password+"&no_user="+id_user,
success:function(data){
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function(){
window.location.href='<?php echo base_url('User2/profil') ?>';    
});   
    
}
});

}    

});



$(".btn_ubah_password").click(function(){
$(".btn_ubah_password").hide();
$(".simpan_password").show();
$("#new_password").show();
$("#repeat_password").show();
$(".btn_edit").hide(100); 


});


$(".btn_edit").click(function(){
$(".btn_edit").hide(100); 
$(".btn_ubah_password").hide(100);
$(".btn_update").show(100);
$("#username").replaceWith('<input type="text" class="form-control username" value="'+$("#username").text()+'">');
$("#nama_lengkap").replaceWith('<input type="text" class="form-control nama_lengkap" value="'+$("#nama_lengkap").text()+'">');
$("#email").replaceWith('<input type="text" class="form-control email" value='+$("#email").text()+'>');
$("#phone").replaceWith('<input type="text" class="form-control phone" value='+$("#phone").text()+'>');

});
});    

function upload_profile(){
$("#form_upload_profile").show();
}


$("#imgInp").change(function() {
$('#modal_ubah_profile').modal('show');  
readURL(this);
});
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
$('#my-image').attr('src', e.target.result);
var resize = new Croppie($('#my-image')[0], {
viewport: { width: 200, height: 200 },
boundary: { width: 300, height: 300 },
showZoomer: true,
enableResize:false,
enableOrientation: true
});

$('.btn_upload').on('click', function() {
resize.result('base64').then(function(dataImg) {
var data = [{ image: dataImg }, { name: 'myimgage.jpg' }];
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',token);
formData.append('image',dataImg);
formData.append('name',"myimage.jpg");

$.ajax({
type:"post",
processData: false,
contentType: false,
url:"<?php echo base_url('User2/simpan_profile'); ?>",
data:formData,
success:function(data){
$('#modal_ubah_profile').modal('hide');  

var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated bounceInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function(){
window.location.href='<?php echo base_url('User2/profil') ?>';    
});   
}
}); 
});
});
},
reader.readAsDataURL(input.files[0]);
}
}

</script>    


</body>
</html>
