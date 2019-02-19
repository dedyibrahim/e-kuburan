<body>
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content p-2 m-3 ">
<h3 align="center">Create new client </h3>
<hr>
<div class="row">
<div class="col">
<label>Nama</label>	
<input type="text" class="form-control" placeholder="Nama">

<label>Nik</label>	
<input type="text" class="form-control" placeholder="Nik">

<label>Passport</label>	
<input type="text" class="form-control" placeholder="Passport">

<label>Perizinan</label>
<select class="form-control">
<option>Perseroan Terbatas  ( PT ) </option>	
<option>CV </option>	
<option>PD </option>	
<option>Surat tanah </option>	
</select>

<hr>
<button class="btn btn-success btn-block" id="btn_simpan">Save new client</button>
</div>
<div class="col-md-7">
<label>Upload File Dokumen </label>
<div class="input-group">
  <div class="custom-file">
    <input type="file" class="custom-file-input" multiple id="data_dokumen" aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="data_dokumen">Choose file</label>
  </div>
</div>
<hr>
<div id="data_upload"></div>
</div>

</div>
</body>

<script type="text/javascript">
$(document).ready(function(){
$("#data_dokumen").on("change",function(){
var files = $('#data_dokumen')[0].files;
for (var i = 0, f; f = files[i]; i++) {
$("#data_upload").append("<div class='row'><div class='col'><input type='text' id='nama"+i+"' placeholder='Nama File . . .' class='form-control'></div><div class='col'>"+f.name+"</div></div><hr>");
}
});

$("#btn_simpan").on("click",function(){
var files = $('#data_dokumen')[0].files;
var form_data = new FormData();

for (var u = 0, f; f= files[u]; u++) {
var nama  = $("#nama"+u).val();
form_data.append("oke",f);
form_data.append("nama",nama);
$.ajax({
url:"<?php echo base_url('Dashboard/upload_dokumen') ?>",
contentType: false,
chache:false,
contentType:false,
processData:false,
data:form_data,
type:"post",
success:function(data){
	console.log(data);
}
});

}



});

});

</script>


</html>