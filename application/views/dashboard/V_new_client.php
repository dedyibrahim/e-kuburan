<body onload="refresh();">
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class=" p-2 mt-2 ">

<div class="container card p-3" id="form_client">
    
<form  id="fileForm" method="post" action="<?php echo base_url('Dashboard/create_client') ?>">
<div class="row ">
<div class="col-md-6">
<label>Pilih Jenis client</label>
<select name="jenis" id="pilih_jenis" class="form-control required" accept="text/plain">
<option> </option>
<option value="Perorangan">Perorangan</option>
<option value="Badan Hukum">Badan Hukum</option>	
</select>

    
<label>Jenis Pekerjaan</label>
<input type="text" name="jenis_akta"  id="jenis_akta" class="form-control required"  accept="text/plain">
<label>ID Jenis</label>
<input type="text" name="id_jenis_akta" readonly="" id="id_jenis_akta" class="form-control required"  accept="text/plain">

<div id="form_badan_hukum">
<label  id="label_nama_perorangan">Nama Perorangan</label>
<label  style="display: none;" id="label_nama_hukum">Nama Badan Hukum</label>
<input type="text" name="badan_hukum" id="badan_hukum" class="form-control required"  accept="text/plain">
</div>
<div id="form_alamat_hukum">
    <label style="display: none;" id="label_alamat_hukum">Alamat Badan Hukum</label>
<label  id="label_alamat_perorangan">Alamat Perorangan</label>
<textarea rows="4" id="alamat_badan_hukum" class="form-control required" required="" accept="text/plain"></textarea>
</div>
<hr>
<button type="submit" class="btn btn-success  mx-auto btn-block simpan_perizinan">Simpan & Buat Perizinan <i class="fa fa-save"></i></button>
</form>

</div>
<div class="col"> 
<label>Cari perizinan</label>
<input type="text" class="form-control" id="cari_user" placeholder="Cari yang akan mengurusi Perizinan" >
<hr>
<div class="data_perizinan">

</div>    
</div>
</div>
</div>    
</div>
</div>
</div>    
<script type="text/javascript">
$("#pilih_jenis").on("change",function(){
var client = $("#pilih_jenis option:selected").text();
if(client == "Perorangan"){
$("#form_client").show(100);
$("#label_alamat_perorangan,#label_nama_perorangan").fadeIn(100);
$("#label_alamat_hukum,#label_nama_hukum").fadeOut(100);
}else if(client == "Badan Hukum"){
$("#form_client").show(100);
$("#label_alamat_hukum,#label_nama_hukum").fadeIn(100);
$("#label_alamat_perorangan,#label_nama_perorangan").fadeOut(100);
}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Silahkan pilih jenis client terlebih dahulu.'
})

}

});



</script>        
<script>
$(document).ready(function() {
$.validator.messages.required = '';
$("#fileForm").validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
},submitHandler: function(form) {

var data = [
{jenis_client       :$("#pilih_jenis option:selected").text()},
{jenis_akta         :$("#jenis_akta").val()},
{id_jenis           :$("#id_jenis_akta").val()},
{badan_hukum        :$("#badan_hukum").val()},
{alamat_badan_hukum :$("textarea#alamat_badan_hukum").val()}

];
var token    = "<?php echo $this->security->get_csrf_hash() ?>";


$.ajax({
url: form.action,
type: form.method,
data: { 'token' : token,data},
success: function(response) {

var r = JSON.parse(response);
if(r.status == "Berhasil" ){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'success',
title: 'Dokumen Berhasil di proses.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/proses_berkas'); ?>"+"/"+r.no_berkas+"/";
})

}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'error',
title: r.pesan
})

}

}            
});

}
});
});

$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#jenis_akta,#jenis_akta_perorangan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Dashboard/cari_jenis_dokumen') ?>',
select:function(event, ui){
$("#id_jenis_akta").val("");
$("#id_jenis_akta,#id_jenis_akta_perorangan").val(ui.item.no_jenis_dokumen);
}
}
);
});


$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#cari_user").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Dashboard/cari_user') ?>',
select:function(event, ui){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/set_client_perizinan') ?>",
data:"token="+token+"&no_user="+ui.item.no_user+"&nama_lengkap="+ui.item.nama_lengkap+"&email="+ui.item.email,
success:function(){
refresh();    
}
});


}
});
});
function refresh(){
data_perizinan_sementara();
}

function data_perizinan_sementara(){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/data_perizinan_sementara') ?>",
data:"token="+token,
success:function(data){
$(".data_perizinan").html(data);    
$("#cari_user").val("");
}
});

}

function hapus_perizinan(id){
$(".perizinan"+id).hide('slow');
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_data_perizinan_sementara') ?>",
data:"token="+token+"&id="+id,
success:function(){
refresh();  
}

});

}

</script>

</div>
</body>
</html>
