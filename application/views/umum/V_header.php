<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">		    
<link href="<?php echo base_url() ?>assets/croppie/croppie.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/croppie/croppie.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/jquery/jquery-3.3.1.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/bootstrap-4.1.3/dist/js/bootstrap.bundle.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/bootstrap-4.1.3/dist/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/fontawesome-free-5.7.1/css/all.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/fontawesome-free-5.7.1/js/all.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/jquery/popper.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/sweetalert2/dist/sweetalert2.all.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/sweetalert2/dist/animate.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/jquery-ui-1.12.1/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/jqueryvalidation/dist/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/jqueryvalidation/dist/additional-methods.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/npprogress/nprogress.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/npprogress/nprogress.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/bootstrap-4.1.3/dist/css/simple-sidebar.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/daterange/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/daterange/daterangepicker.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/daterange/daterangepicker.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/bootstrap-4.1.3/js/dist/util.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/toast/build/toastr.min.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/toast/build/toastr.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
</head> 
<script type="text/javascript">
jQuery( document ).ajaxStart(function() {
  NProgress.start();
});

jQuery( document ).ajaxStop(function() {
  NProgress.done();
});




</script>
<body onload="set_cookie();"></body>

<script type="text/javascript">
function set_cookie(){
document.cookie = "token"+ "=" + "<?php echo $this->security->get_csrf_hash(); ?>";
}
function getCookie(cname) {
var name = cname + "=";
var decodedCookie = decodeURIComponent(document.cookie);
var ca = decodedCookie.split(';');
for(var i = 0; i < ca.length; i++) {
var c = ca[i];
while (c.charAt(0) == ' ') {
c = c.substring(1);
}
if (c.indexOf(name) == 0) {
return c.substring(name.length, c.length);
}
}
return "";
}
</script>