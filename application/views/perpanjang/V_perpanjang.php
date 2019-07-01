<div class="container-fluid">
    <div class="row card-header ">
        <div class="col-md-6 mx-auto text-center">
            <span class="fa fa-home fa-3x"></span><br><h4>E-kuburan Sistem Perpanjang Masa kuburan</h4>
            <label>Cari makam kerabat </label>
            <input type="number" onkeyup="cari_ahli_waris();" class="form-control nik_ahli_waris" placeholder="masukan nik ahli waris">
            
        </div>
    </div>
    <div class="container">
    <div class="row ">
        <div class="col data_jenazah">
            
        </div>
    </div>

</div>
</div>


<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">

<div class="modal-content">
<div class="modal-body form_jenazah">
<div class="row">
<div class="col">
    <div class="card-header text-center">
             Untuk dapat memperpanjang masa kuburan silahkan transfer ke rekening dibawah inimical
            <p>BANK : Mandiri Syariah 
                <br>
                Attn :Bapak Ciko
                <br>
                Nomor rekening :7099034801
                <br>
                Sebesar :Rp 100.000
            </p>
            <label>Upload Bukti Transfer</label>
            <input type="hidden" class="form-control nik_jenazah">
            <input type="file" class="form-control bukti_transfer">
            <hr>
            <button type="button" class="btn btn-success simpan_bukti btn-block">Upload bukti transfer <span class="fa fa-upload"></span></button>
    </div>
 
</div>
</div>
</div>
    
</div>   

<script type="text/javascript">
$(document).ready(function(){
$(".simpan_bukti").click(function(){
    
formData = new FormData();
formData.append('token',getCookie("token"));
formData.append('bukti_transfer',$(".bukti_transfer")[0].files[0]);
formData.append('nik_jenazah',$(".nik_jenazah").val());


 $.ajax({
url: "<?php echo base_url('Perpanjang/simpan_bukti_perpanjang') ?>",
processData: false,
contentType: false,
type: "post",
data: formData,
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
title: r.message
});
$('#modal_form').modal('hide');

}
});

});    
});
    
    
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

function perpanjang_makam(nik_jenazah){
$('#modal_form').modal('show');    
$(".nik_jenazah").val(nik_jenazah);
}

</script>