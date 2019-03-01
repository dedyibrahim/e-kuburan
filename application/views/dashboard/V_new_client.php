<body>
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content card p-2 m-3 ">
<div class="row">
<div class="col-md-4 mx-auto p-2">
<div class="text-center color_fa">
<i class=" text-center fa-3x  fa fa-user-tie"></i>
<h4>Create New Client</h4>
</div>
<hr>
<label>Pilih Jenis client</label>
<select name="jenis" id="pilih_jenis" class="form-control">
<option> </option>
<option value="Perorangan">Perorangan</option>
<option value="Badan Hukum">Badan Hukum</option>	
</select>
</div>
</div>

<div style="display:none;" class="container" id="form_client">
<hr>
<form  id="fileForm" method="post" action="<?php echo base_url('Dashboard/create_client') ?>">
<div class="row">
   
<div class="col-md-4">
<h5 align="center">Data Client</h5><hr>
<label>Jenis Pekerjaan</label>
<input type="text" name="jenis_akta"  id="jenis_akta" class="form-control required"  accept="text/plain">
<label>ID Jenis</label>
<input type="text" name="id_jenis_akta" readonly="" id="id_jenis_akta" class="form-control required"  accept="text/plain">
<div id="form_badan_hukum">
<label>Nama Badan Hukum</label>
<input type="text" name="badan_hukum" id="badan_hukum" class="form-control required"  accept="text/plain">
</div>
<div id="form_alamat_hukum">
<label>Alamat Badan Hukum</label>
<textarea id="alamat_badan_hukum" class="form-control required"  accept="text/plain"></textarea>
</div>
</div>
<div class="col">
<button type="button" class="btn btn-success btn-sm float-right" id="tambah_perorangan">Tambah Perorangan <i class="fa fa-plus"></i></button>
<h5 align="center">Data Perorangan</h5>
<hr>
<div class="data_orang skroll p-3">
<div class="row hitung_orang">
<div class="col">
<label>Nama KTP</label>
<input type="text" name="ktp1" id="ktp1"  class="form-control required" accept="text/plain" placeholder="Nama . . .">
</div>
<div class="col">
<label>NIK KTP</label>
<input type="text" name="nik1" id="nik1"  class="form-control required" accept="text/plain" placeholder="NIK . . .">
</div>
<div class="col">
<label>Status Jabatan</label>
<select name="status1" id="status1" class="form-control required" accept="text/plain">
<option></option>
<option>Presiden Komisaris</option>
<option>Komisaris </option>
<option>Komisaris Utama</option>
<option>Presiden Direktur</option>
<option>Direktur</option>
<option>Direktur Utama</option>
<option>Pemegang Saham</option>
</select>
</div>

</div>    
</div>
</div>



</div>
    <hr>
<button type="submit" class="btn btn-success col-md-6 mx-auto btn-block simpan_perizinan">Simpan & Proses Perizinan <i class="fa fa-save"></i></button>
</form>
</div>    

</div>
</div>
</div>
<script type="text/javascript">
$("#pilih_jenis").on("change",function(){
var client = $("#pilih_jenis option:selected").text();
if(client == "Perorangan"){
$("#form_client").show(100);
$("#form_alamat_hukum,#form_badan_hukum").hide(100);
}else if(client == "Badan Hukum"){
$("#form_client").show(100);
$("#form_alamat_hukum,#form_badan_hukum").show(100);
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
$("#form_client").hide(100);
$("#form_alamat_hukum,#form_badan_hukum").hide(100);

}

});

$("#tambah_perorangan").on("click",function(){
var h = $(".hitung_orang").length+1;

var data = "<div class='row hitung_orang'>\n\
<div class='col'>\n\
<label>Nama KTP</label>\n\
<input type='text' name='ktp"+h+"'  id='ktp"+h+"' value='' class='form-control required' placeholder='Nama . . .'></div>\n\
<div class='col'>\n\
<label>NIK KTP</label>\n\
<input type='text' name='nik"+h+"' id='nik"+h+"' value='' class='form-control required' placeholder='NIK . . .'>\n\
</div>\n\
<div class='col' >\n\
<label>Status Jabatan</label>\n\
<select name='status"+h+"' id='status"+h+"' class='form-control required'>\n\
<option></option>\n\
<option>Presiden Komisaris</option>\n\
<option>Komisaris </option>\n\
<option>Komisaris Utama</option>\n\
<option>Presiden Direktur</option>\n\
<option>Direktur</option>\n\
<option>Direktur Utama</option>\n\
<option>Pemegang Saham</option></select></div>\n\
</div> ";
$(data).appendTo('.data_orang').fadeIn( "slow", function() {
});       
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
var data_orang = $(".hitung_orang").length+1;
var values = [];

for(i=1; i<data_orang; i++){
values.push({
ktp: $("#ktp"+i).val(),
nik: $("#nik"+i).val(),
status: $("#status"+i+" option:selected").text()
});
}

var data = [
{jenis_client       :$("#pilih_jenis option:selected").text()},
{jenis_akta         :$("#jenis_akta").val()},
{id_jenis           :$("#id_jenis_akta").val()},
{badan_hukum        :$("#badan_hukum").val()},
{alamat_badan_hukum :$("textarea#alamat_badan_hukum").val()},
values

];
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

    
$.ajax({
url: form.action,
type: form.method,
data: { 'token' : token,data},
success: function(response) {
$('#answers').html(response);
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
</script>
</body>
