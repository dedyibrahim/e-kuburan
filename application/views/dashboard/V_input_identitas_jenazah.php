<body>
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="card-header mt-2 mb-2 text-center">
Blok Makam
</div>
<div class="row">
<div class="col-md-5 mx-auto">
<label>Pilih Agama</label>
<select onchange="pilih_blok();" class="form-control blok_agama">
<option>--- Pilih Agama ---</option>
<option value="Islam">Islam</option>
<option value="Kristen">Kristen</option>
<option value="Budha">Budha</option>
</select>
<label>Pilih Blok Makam</label>
<select onchange="tampilkan_makam()" class="form-control blok_makam" disabled="">
<option></option>
</select>
</div>
</div>

    
<div class="row">

<div class="col data_makam">
</div>   
</div>    
</div>
</div>

    
<!-----------modal upload------------------>    
 <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
<form  id="fileForm" method="post" action="<?php echo base_url('Dashboard/simpan_jenazah') ?>">

<div class="modal-content">
<div class="modal-body form_jenazah">
<div class="row">
<div class="col">
    <div class="card-header text-center">
        Lengkapi data jenazah
    </div>
<label>Nama Makam</label>
<input type="tex" readonly="" class="form-control nama_makam required" name="nama_makam"  accept="text/plain" >
<label>Masukan NIK ahli waris</label>
<input type="tex" onkeyup="cari_ahli_waris();" class="form-control required nik_ahli_waris"  accept="text/plain" >
<label>Nama Ahli Waris</label>
<input type="tex" name="nama_ahli_waris"  class="form-control required nama_ahli_waris" placeholder="" disabled="" accept="text/plain" >
<label>Tanggal Lahir</label>
<input type="text" name="tanggal_lahir" disabled="" class="tanggal tanggal_lahir form-control data_jenazah required"  accept="text/plain"  />
<label>Tanggal Wafat</label>
<input type="text" name="tanggal_wafat"   class="tanggal tanggal_wafat form-control data_jenazah required tanggal_wafat" disabled="" placeholder="Tanggal Wafat" accept="text/plain">
<label>Jenis Kelamin</label>
<select class="form-control jenis_kelamin data_jenazah" disabled="">
<option value="Laki-laki">Laki-laki</option>    
<option value="Perumpuan">Perumpuan</option>    
</select>
    <label>Nik Jenazah</label>
<input type="text" name="nik_jenazah"  class="form-control data_jenazah required nik_jenazah" disabled="" placeholder="Nik Jenazah" accept="text/plain">
<label>Nama Jenazah</label>
<input type="text" name="nama_janazah"  class="form-control data_jenazah required nama_jenazah" disabled="" placeholder="Nama Jenazah" accept="text/plain">

</div>
<div class="col">
<div class="card-header text-center">
Lengkapi berkas jenazah
</div>

<label>Ktp Jenazah</label>
<input type="file" name="ktp_jenazah" class=" ktp_jenazah form-control data_jenazah required" disabled="" >
<label>Surat pengantar RT/RW</label>
<input type="file" name="pengantar_rt_rw" class="pengantar_rt_rw form-control data_jenazah required" disabled="" >
<label>Surat Pengantar dari rumah sakit</label>
<input type="file" name="pengantar_rumah_sakit" class="pengantar_rumah_sakit form-control data_jenazah required" disabled="">
<label>Kartu keluarga</label>   
<input type="file" name="kartu_kk" class="kartu_kk form-control data_jenazah required" disabled="" >

<hr>
<label>Pemesanan makam Rp.800.000</label>
<input type="checkbox" class="form-check-inline" onclick="tambah_biaya_makam('pemesanan_makam');"><br>
<label>Gunakan Batu nisan Rp.300.000</label>
<input type="checkbox" class="form-check-inline" onclick="tambah_biaya_makam('batu_nisan');"><br>
<label>Biaya Perpanjang / 5 tahun Rp.100.000</label>
<input type="checkbox" class="form-check-inline" onclick="tambah_biaya_makam('perpanjang');">

<div class="card-header text-center">
<label>Total Bayar</label>    
<h5 class="total_bayar"></h5>    
</div>
</div>
</div>

</div>
   <div class="card-footer">    
<button  type="submit" class="btn btn-success  mx-auto btn-block simpan_perizinan">Simpan Jenazah <i class="fa fa-print"></i></button>
    </div>
</form>       
    </div>
</div>
</div>   


<script>
$(function() {
  $('.tanggal').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
      format: 'YYYY/MM/DD'
    }
  });
});
</script>

<script type="text/javascript">
function tambah_biaya_makam(jenis_biaya){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hitung_biaya') ?>",
data:"token="+getCookie('token')+"&jenis_biaya="+jenis_biaya,
success:function(data){
$('.total_bayar').html(data);
}
})     
}

function cari_ahli_waris(){    
var nik = $(".nik_ahli_waris").val();
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/cari_ahli_waris') ?>",
data:"token="+getCookie('token')+"&nik="+nik,
success:function(data){
var r = JSON.parse(data);
if(r.status == 'success'){
$(".data_jenazah").removeAttr("disabled",true);
$(".nama_ahli_waris").val(r.nama_ahli_waris);
}else{

}

}
});



}    
    
function isi_makam(nama_makam){
$('#modal_form').modal('show');    
$(".nama_makam").val(nama_makam);
}

function tampilkan_makam(){
var blok_makam = $(".blok_makam option:selected").val();    
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/tampilkan_makam') ?>",
data:"token="+getCookie('token')+"&id_data_blok="+blok_makam,
success:function(data){
$(".data_makam").html(data);

}
});
} 
   
    
 function pilih_blok(){
 var agama = $(".blok_agama option:selected").val();    
$(".blok_makam").val(""); 
 
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/data_blok_makam') ?>",
data:"token="+getCookie('token')+"&agama="+agama,
success:function(data){
$(".blok_makam").removeAttr("disabled",true); 
$(".blok_makam").html(data);
}
});

}
 
</script>
    
<script>

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
$(".simpan_perizinan").attr("disabled", true);

formData = new FormData();
formData.append('token',getCookie("token"));
formData.append('blok_agama',$(".blok_agama option:selected").val());
formData.append('blok_makam',$(".blok_makam option:selected").text());
formData.append('nama_makam',$(".nama_makam").val());
formData.append('nik_ahli_waris',$(".nik_ahli_waris").val());
formData.append('nama_ahli_waris',$(".nama_ahli_waris").val());
formData.append('tanggal_lahir',$(".tanggal_lahir").val());
formData.append('tanggal_wafat',$(".tanggal_wafat").val());
formData.append('nik_jenazah',$(".nik_jenazah").val());
formData.append('nama_jenazah',$(".nama_jenazah").val());
formData.append('jenis_kelamin',$(".jenis_kelamin option:selected").val());
formData.append('ktp_jenazah',$(".ktp_jenazah")[0].files[0]);
formData.append('pengantar_rt_rw',$(".pengantar_rt_rw")[0].files[0]);
formData.append('pengantar_rumah_sakit',$(".pengantar_rumah_sakit")[0].files[0]);
formData.append('kartu_kk',$(".kartu_kk")[0].files[0]);

$.ajax({
url: form.action,
processData: false,
contentType: false,
type: form.method,
data: formData,
success:function(data){  
$(".simpan_perizinan").attr("disabled", false);

$('#modal_form').modal('hide');       
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
title: r.message
});
}
});
return false; 
}
});
</script>
</body>

