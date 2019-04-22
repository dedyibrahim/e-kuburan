<body onload="refresh();">
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Pilih jenis perizinan yang ingin di proses <button class="btn btn-success btn-sm  float-right "  onclick="update_selesaikan_pekerjaan('<?php echo $this->uri->segment(3) ?>');">Update selesaikan pekerjaan <span class="fa fa-hourglass-end"></span></button></h4>
</div>
</div>

<div class="row">

<div class="col-md-5 card-header m-2 mx-auto">
<label>Pilih jenis file perizinan</label>       
<select onchange="jenis_file_perizinan();" class="form-control file_perizinan">
<option></option>
<?php $d = $this->db->get('nama_dokumen');
foreach ($d->result_array() as $n){
?>
<option value="<?php echo $n['no_nama_dokumen'] ?>"><?php echo $n['nama_dokumen'] ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="data_form_perizinan m-2 p-2"></div>    
</div>    
</div>
</div>    


<!-------------------modal laporan--------------------->

<div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body data_laporan">
     
      </div>
    </div>
  </div>
</div>
    
<script type="text/javascript">
function update_selesaikan_pekerjaan(no_pekerjaan){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
url:"<?php echo base_url('User2/update_selesaikan_pekerjaan') ?>",
success:function(data){
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 2000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function() {
window.location.href = "<?php echo base_url('User2/pekerjaan_proses/'); ?>";
});

}
});
    
    
}  
    
    
function lihat_progress_perizinan(id_data_berkas){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
data:"token="+token+"&id_data_berkas="+id_data_berkas,
url:"<?php echo base_url('User2/lihat_laporan') ?>",
success:function(data){
$('#modal_laporan').modal('show');
$(".data_laporan").html(data);
}
});

}    
function option_aksi(id_data_berkas){
var val = $(".option_aksi"+id_data_berkas).val();
if(val == 1){
hapus_syarat(id_data_berkas);    
}else if(val == 2){
$('.tentukan_pengurus'+id_data_berkas).removeAttr("disabled");
}

}

function tentukan_pengurus(id_data_berkas){
var pengurus = $(".tentukan_pengurus"+id_data_berkas);

var nama     = $(".tentukan_pengurus"+id_data_berkas+" option:selected").text();
var no_user  = $(".tentukan_pengurus"+id_data_berkas+" option:selected").val();
var token     = "<?php echo $this->security->get_csrf_hash() ?>";
if(no_user !=''){
$.ajax({
type:"post",
url:"<?php echo base_url('User2/simpan_pekerjaan_user') ?>",
data:"token="+token+"&no_user="+no_user+"&nama_user="+nama+"&id_data_berkas="+id_data_berkas,
success:function(data){
refresh();
}
});
}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 10000,
animation: false,
customClass: 'animated zoomInDown'
});
Toast.fire({
type: 'error',
title: 'Tentukan user yang akan mengerjakan perizinan tersebut'
});
}
}

function refresh(){
form_perizinan();  
}

function jenis_file_perizinan(){
var no_nama_dokumen = $(".file_perizinan option:selected").val();     
var nama_dokumen    = $(".file_perizinan option:selected").text();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var no_pekerjaan    = "<?php echo $this->uri->segment(3) ?>";   
$.ajax({
type:"post",
url:"<?php echo base_url('User2/simpan_perizinan') ?>",
data:"token="+token+"&no_nama_dokumen="+no_nama_dokumen+"&nama_dokumen="+nama_dokumen+"&no_pekerjaan="+no_pekerjaan,
success:function(){
refresh();    
}
        
});
}
function form_perizinan(){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var no_pekerjaan    = "<?php echo $this->uri->segment(3) ?>";   
$.ajax({
type:"post",
url:"<?php echo base_url('User2/form_perizinan') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
success:function(data){
$(".data_form_perizinan").html(data);    
}
        
});    
}

function hapus_syarat(id){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",	
url:"<?php echo base_url('User2/hapus_syarat') ?>",	
data:"token="+token+"&id_data_berkas="+id,
success:function(data){	
refresh(); 
}
});
}
function download_berkas(id_data_berkas){
window.location.href="<?php echo base_url('User3/download_berkas/') ?>"+id_data_berkas;
}
</script>
</body>

