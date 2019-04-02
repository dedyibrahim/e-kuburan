<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Tambahkan pekerjaan & client baru</h4>
</div>
</div>   
<form  id="fileForm" method="post" action="<?php echo base_url('User2/create_client') ?>">

 <div class="row  p-3" >

<div class="col-md-6">
<label>Pilih Jenis client</label>
<select name="jenis" id="pilih_jenis" class="form-control required" accept="text/plain">
<option> </option>
<option value="Perorangan">Perorangan</option>
<option value="Badan Hukum">Badan Hukum</option>	
</select>
    
<label>Jenis Pekerjaan</label>
<input type="text" name="jenis_akta"  id="jenis_akta" class="form-control required"  accept="text/plain">
<input type="hidden" name="id_jenis_akta" readonly="" id="id_jenis_akta" class="form-control required"  accept="text/plain">
<label>Target Kelar</label>
<input type="text" name="target_kelar" readonly="" id="target_kelar" class="form-control required"  accept="text/plain">

</div>
<div class="col "> 
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
<button type="submit" class="btn btn-success  mx-auto btn-block simpan_perizinan">Simpan client & Buat pekerjaan <i class="fa fa-save"></i></button>
</form>
    
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
    
$("#fileForm").submit(function(e) {
e.preventDefault();
$.validator.messages.required = '';
}).validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
},    
submitHandler: function(form) {
    
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
formData = new FormData();
formData.append('token',token);
formData.append('jenis_client',$("#pilih_jenis option:selected").text());
formData.append('jenis_akta',$("#jenis_akta").val()),
formData.append('id_jenis',$("#id_jenis_akta").val()),
formData.append('badan_hukum',$("#badan_hukum").val()),
formData.append('target_kelar',$("#target_kelar").val()),
formData.append('alamat_badan_hukum',$("textarea#alamat_badan_hukum").val()),
console.log(formData);


$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(){   
}
});
return false; 
}
});

    

$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#jenis_akta,#jenis_akta_perorangan").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('User2/cari_jenis_dokumen') ?>',
select:function(event, ui){
$("#id_jenis_akta").val("");
$("#id_jenis_akta,#id_jenis_akta_perorangan").val(ui.item.no_jenis_dokumen);
}
}
);
});

$(function() {
$("input[name='target_kelar']").datepicker({ minDate:0});
});
</script>
</div>
</body>
</html>
