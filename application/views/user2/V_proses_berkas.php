<body onload="refresh();">
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Daftar pekerjaan yang sedang diproses</h4>
</div>
</div>
    
    
<div class="row m-3">
<div class="col-md-6">
Jenis Perizinan : <?php  $data2 = $data->row_array(); echo $data2['jenis_perizinan'] ?><br>
Jenis Client : <?php echo $data2['jenis_client'] ?><br>
Nama : <?php echo $data2['nama_client'] ?><br>
Alamat : <?php echo $data2['alamat_client'] ?><br>
</div>
</div>

<div class="row">

<div class="col-md-5 mx-auto">
<label>Pilih jenis file perizinan</label>       
<select onchange="jenis_file_perizinan();" class="form-control file_perizinan">
<option></option>
<?php $d = $this->db->get('nama_dokumen');
foreach ($d->result_array() as $n){
?>
<option value="<?php echo $n['no_nama_dokumen'] ?>"><?php echo $n['nama_dokumen'] ?></option>
<?php } ?>
</select>
<hr>
</div>
</div>
    <div class="data_form_perizinan"></div>    
</div>    
</div>
   
   
</div>    
    
<script type="text/javascript">

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
function tentukan_user(id){
var nama     = $(".tentukan_user"+id+" option:selected").text();
var no_user  = $(".tentukan_user"+id+" option:selected").val();
var token     = "<?php echo $this->security->get_csrf_hash() ?>";
if(no_user !=''){
$.ajax({
type:"post",
url:"<?php echo base_url('User2/simpan_pekerjaan_user') ?>",
data:"token="+token+"&no_user="+no_user+"&nama_user="+nama+"&id_data_berkas="+id,
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
</script>
</body>

