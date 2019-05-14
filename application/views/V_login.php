<body class="bg_login">
<br>
<br>
<br>
<div class="container ">
<div class="row">
<div class="col-md-10 mx-auto">    

<div class="row">    
    <div class="col-md-4 mx-auto">
<h4 align="center" class="text-lg-center text-white "><i class="fa fa-lock fa-2x"></i><br> Input your detail login </h4>
<hr>    
<label>Username</label>
<input type="text" class="form-control" id="username" placeholder="your username">
<label>Password</label>
<input type="password" class="form-control" id="password" placeholder="your password">
<hr>
<button class="btn btn-white btn-sm btn-block" id="proses_login">Sign in <i class="fa fa-key"></i></button>
</div>    
    </div>
    
</div>        
</div>
</div>



<div class="fixed-bottom mt-5 pt-5">
<div class="row">
<div class="mx-auto">    
    <p class="text-white text-center">App Management <br> V.1.0.1</p>
</div>
</div>
</div>   
</body>
<script type="text/javascript">
var callback = function() {
$("#proses_login").attr("disabled", true);

var token    = "<?php echo $this->security->get_csrf_hash() ?>";
var username = $("#username").val();
var password = $("#password").val();

$.ajax({
type:"post",
url:"<?php echo base_url('Login/proses_login') ?>",
data:"token="+token+"&username="+username+"&password="+password,
success:function(data){
var r =JSON.parse(data);

if(r.status == "Berhasil"){
$("#proses_login").attr("disabled",true);
if(r.level  == "Super Admin" ){            
const Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 1000,
animation: false,
customClass: 'animated fadeInDown'
});

Toast.fire({
type: 'success',
title: 'Signed in successfully'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard'); ?>";
});
}else if(r.level == "User"){

const Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 1000,
animation: false,
customClass: 'animated fadeInDown'
});

if(r.sublevel == 'Level 1'){
Toast.fire({
type: 'success',
title: 'Signed in successfully'
}).then(function() {
window.location.href = "<?php echo base_url('User1'); ?>";
});
    
}else if (r.sublevel == 'Level 2'){
Toast.fire({
type: 'success',
title: 'Signed in successfully'
}).then(function() {
window.location.href = "<?php echo base_url('User2'); ?>";
});
    
}else if(r.sublevel == 'Level 3'){
Toast.fire({
type: 'success',
title: 'Signed in successfully'
}).then(function() {
window.location.href = "<?php echo base_url('User3'); ?>";
});

}

}else if(r.level  == "Admin" ){
const Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 1000,
animation: false,
customClass: 'animated fadeInDown'
});

Toast.fire({
type: 'success',
title: 'Signed in successfully'
}).then(function() {
window.location.href = "<?php echo base_url('Admin'); ?>";
})

}

}else{
const Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 1000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'The login is invalid.'
})
$('#proses_login').removeAttr("disabled");
}



}
});


};

$(document).keypress(function() {
if (event.which == 13) callback();
});
$('#proses_login').click(callback);   



</script>

<html>


