<body class="bg_login">
    <br>
    <br>
    <br>
    <div class="container ">
        <div class="row">
            <div class="card mx-auto mt-5  " style="width: 20rem;">
            <div class="card-header">
                
                <h4 align="center" class="text-lg-center text-success "><i class="fa fa-key fa-2x"></i><br> Input your detail login </h4>
            </div>
            <div class="card-body">
                <label>Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username . . .">
                <label>Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password . . .">
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-block" id="proses_login">Masuk <i class="fa fa-key"></i></button>
            </div>
        </div>    
    </div>
        
          
    </div>
    <div class=" fixed-bottom">
        <div class="row">
            <div class="mx-auto">    
        <p class="text-dark">App Management Notarian V.1.0</p>
        </div>
        </div>
        </div>   
</body>
<script type="text/javascript">
 $(document).ready(function(){

$("#proses_login").click(function(){

var username = $("#username").val();
var password = $("#password").val();

$.ajax({
type:"post",
url:"<?php echo base_url('Login/proses_login') ?>",
data:"username="+username+"&password="+password,
success:function(data){
var r =JSON.parse(data);

if(r.status == "Berhasil"){
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
   animation: false,
  customClass: 'animated fadeInDown'
});

Toast.fire({
  type: 'success',
  title: 'Signed in successfully'
}).then(function() {
    window.location.href = "<?php echo base_url('Dashboard'); ?>";
})

}else{
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
   animation: false,
  customClass: 'animated tada'
});

Toast.fire({
  type: 'error',
  title: 'The login is invalid.'
})

}

 

}
});

});
});

</script>

<html>


