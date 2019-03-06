<body onload="refresh();">
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content card p-2 m-3 ">

<?php 


$data2 = $data->row_array();

?>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#upload_utama">Upload Dokumen Utama <i class="fas fa-file-upload"></i></a>
</li>

<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#upload_perizinan">Upload Dokumen Perizinan <i class="fas fa-file-upload"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#upload_dokumen_perorangan">Upload Dokumen Perorangan <i class="fas fa-file-upload"></i></a>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="row m-3">
<div class="col-md-6">
Jenis Perizinan:<?php echo $data2['jenis_perizinan'] ?><br>
Jenis Client:<?php echo $data2['jenis_client'] ?><br>
Nama:<?php echo $data2['nama_client'] ?><br>
Alamat:<?php echo $data2['alamat_client'] ?><br>
</div>
</div>
<hr>
<!----------------------------Jenis UTAMA------------------------------>
<div class="tab-pane container active p-2" id="upload_utama">
<div class="container">
<br />
<div id="smartwizard">
<ul>
<li><a href="#step-1">Step 1<br /><small>Upload Draft</small></a></li>
<li><a href="#step-2">Step 2<br /><small>Upload Minuta</small></a></li>
<li><a href="#step-3">Step 3<br /><small>Upload Salinan</small></a></li>
</ul>

<div class="col-md-6 mx-auto">
<div id="step-1">
<h2 class="mx-auto text-center">Draft Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-0" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Draft</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>

</div>
<div id="step-2">
<h2 class="mx-auto text-center">Minuta Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-1" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Minuta</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>
</div>
<div id="step-3">
<h2 class="mx-auto text-center">Salinan Upload <i class="fa fa-file-upload"></i></h2><hr>
<div id="form-step-2" role="form" data-toggle="validator">
<div class="form-group">
<label for="email">Upload Salinan</label>
<input type="file" class="form-control">
<div class="help-block with-errors"></div>
</div>
</div>
</div>

</div>
</div>


</div>


<script type="text/javascript">
$(document).ready(function(){
$('#smartwizard').smartWizard({
theme: 'arrows'       
});
});
</script>

</div>    
<!----------------------------Jenis PERIZINAN------------------------------>
<div class="tab-pane container " id="upload_perizinan">
<div class="row">
<div class="col-md-5 mx-auto"><input type="text" id="cari_nama_dokumen" placeholder="cari dokumen perizinan yang ingin di upload" class="form-control"></div>    
</div>
    <hr>
    <div class="row">
        <div class="col" id="form_perizinan">
            
        </div>
    </div>
</div>

<!----------------------------Jenis PERorangan------------------------------>
<div class="tab-pane container " id="upload_dokumen_perorangan">
<div class="row">
<div class="col-md-5 mx-auto">
<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal_perorangan" >Tambah Perorangan <i class="fa fa-plus"></i></button>
</div>

</div>
</div>


</div>
</div>
</div>
    
<!-----------------modal perorangan --------------> 
<div class="modal fade bd-example-modal-lg" id="modal_perorangan" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="tambah_syarat1">Upload data perorangan <span id="title"> </span> </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form  id="fileForm" method="post" action="<?php echo base_url('Dashboard/create_perorangan') ?>">
<div class="modal-body" >
<label>Nama Identitas</label>
<input type="text" name="nama_identitas" id="nama_identitas" class="form-control required" accept="text/plain">
<label>No Identitas</label>
<input type="text" name="no_identitas" id="no_identitas" class="form-control required" accept="text/plain">
<label>Jenis Identitas</label>
<select name="jenis_identitas" id="jenis_identitas" class="form-control required" accept="text/plain">
<option></option>    
<option>KTP</option>    
<option>PASSPOR</option>    
</select>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success" >Simpan Perorangan</button>
</div>
</form>
</div>
</div>
</div>
<!-----------------modal perorangan --------------> 

    
<script type="text/javascript">
var data_orang = $(".hitung_orang").length+1;
var values = [];

for(i=1; i<data_orang; i++){
values.push({
nama_identitas: $("#nama_identitas"+i).val(),
no_identitas: $("#no_identitas"+i).val(),
status: $("#status"+i+" option:selected").text(),
jenis_identitas: $("#jenis_identitas"+i+" option:selected").text()
});
}
$("#tambah_perorangan").on("click",function(){
var h = $(".hitung_orang").length+1;

var data = "<div class='row hitung_orang'>\n\
<div class='col'>\n\
<label>Nama Identitas</label>\n\
<input type='text' name='nama_identitas"+h+"'  id='nama_identitas"+h+"' value='' class='form-control required' placeholder='Nama . . .'></div>\n\
<div class='col'>\n\
<label>No Identitas</label>\n\
<input type='text' name='no_identitas"+h+"' id='no_identitas"+h+"' value='' class='form-control required' placeholder='No . . .'>\n\
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
<div class='col' >\n\
<label>Jenis Identitas</label>\n\
<select name='jenis_identitas"+h+"' id='jenis_identitas"+h+"' class='form-control required'>\n\
<option></option>\n\
<option>KTP</option>\n\
<option>PASSPOR</option>\n\
</div> ";
$(data).appendTo('.data_orang').fadeIn( "slow", function() {
});       
});

  

$(function () {


$("#cari_nama_dokumen").autocomplete({
minLength:0,
delay:0,
source:'<?php echo base_url('Dashboard/cari_nama_dokumen') ?>',
select:function(event, ui){
var no_berkas = "<?php echo $this->uri->segment(3) ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";


$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_syarat') ?>",
data:"token="+token+"&no_nama_dokumen="+ui.item.no_nama_dokumen+"&nama_dokumen="+ui.item.nama_dokumen+"&no_berkas="+no_berkas,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Gagal"){
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
title: 'Jenis Dokumen sudah ditambahkan'
})
}else{
$("#cari_nama_dokumen").val("");    
refresh();    
}
}  

});

}

}
);
});

function refresh(){
load_form_perizinan();
}


function load_form_perizinan(){
var no_berkas = "<?php echo $this->uri->segment(3) ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/form_perizinan') ?>",
data:"token="+token+"&no_berkas="+no_berkas,
success:function(data){
$("#form_perizinan").html(data);  
}
});
}

function hapus_syarat(id){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/hapus_syarat') ?>",
data:"token="+token+"&id_syarat_dokumen="+id,
success:function(data){
$("#syarat"+id).hide('slow');
}
});
}

$(document).ready(function() {
$.validator.messages.required = '';
$("#fileForm").validate({
highlight: function (element, errorClass) {
$(element).closest('.form-control').addClass('is-invalid');
},
unhighlight: function (element, errorClass) {
$(element).closest(".form-control").removeClass("is-invalid");
},submitHandler: function(form) {
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

var data = [
{jenis_identitas    :$("#jenis_identitas option:selected").text()},
{nama_identitas     :$("#nama_identitas").val()},
{no_identitas       :$("#no_identitas").val()}
];
    
$.ajax({
url: form.action,
type: form.method,
data: { 'token' : token,data},
success: function(response) {

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
