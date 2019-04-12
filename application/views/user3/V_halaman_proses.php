<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user3'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user3'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Data perizinan yang perlu diproses </h4>
</div>
</div>
    
<div class="row p-1 m-1">
    <table class="table table-hover table-striped ">
        <tr>
            <th>Nama client</th>
            <th>Nama Tugas</th>
            <th>Dari</th>
            <th class="text-center">Target kelar perizinan</th>
            <th>Aksi</th>
        </tr>
        
    
<?php foreach ($data_tugas->result_array() as    $data){  ?>
        <tr>
            <td><?php echo $data['nama_client'] ?></td>
            <td><?php echo $data['nama_file'] ?></td>
            <td><?php echo $data['nama_lengkap'] ?></td>
            <td class="text-center"><?php echo $data['target_kelar_perizinan'] ?></td>
            <td>
                <select onchange="aksi_option('<?php echo $data['no_pekerjaan'] ?>','<?php echo $data['id_data_berkas'] ?>');" class="form-control data_option">
                    <option value="1">Tolak Tugas</option>
                    <option value="2">Alihkan Tugas</option>
                    <option value="3">Lihat Persyaratan</option>
                    <option value="4">Upload Berkas</option>
                </select>    
            </td>
        </tr>
        
<?php } ?>
    </table>
</div>
</div>

<!-------------------modal laporan--------------------->

<div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <input type="hidden" value="" id="no_nama_dokumen">
          <input type="hidden" value="" id="no_berkas">
          <textarea id="laporan"class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="simpan_laporan">Simpan laporan</button>
      </div>
    </div>
  </div>
</div>

<!-------------modal--------------------->
<div class="modal fade" id="modal_data" tabindex="-1" role="dialog" aria-labelledby="modal_dinamis" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content ">
<div class="modal-body tampilkan_data">

</div>
</div>
</div>
</div>



</body>





<script type="text/javascript">
function aksi_option(no_pekerjaan,id_data_berkas){
var aksi_option = $(".data_option option:selected").val();
if(aksi_option == 1){
form_tolak_tugas();
}else if(aksi_option == 2){
form_alihkan_tugas();
}else if(aksi_option == 3){
form_lihat_persyaratan(no_pekerjaan);    
}else if(aksi_option == 4){
form_upload_berkas(no_pekerjaan,id_data_berkas);
}

}
 
/*function upload_syarat(id){
$(".upload_perizinan"+id).show();
var dokumen_perizinan = $("#dokumen_perizinan"+id).get(0).files[0];
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$(".btn_upload_syarat"+id).attr("disabled", true);
$(".btn_hapus_syarat"+id).attr("disabled", true);
formData = new FormData();
formData.append('token',token);         
formData.append('dokumen_perizinan',dokumen_perizinan);
formData.append('id_syarat_dokumen',id);
$.ajax({
url        : '<?php echo base_url('User3/simpan_file_perizinan') ?>',
type       : 'POST',
contentType: false,
cache      : false,
processData: false,
data       : formData,
xhr        : function (){
var jqXHR = null;
if ( window.ActiveXObject ){
jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
}else{
jqXHR = new window.XMLHttpRequest();
}
jqXHR.upload.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
console.log(percentComplete);
$("#upload_perizinan_progress"+id).attr('style',  'width:'+percentComplete+'%');
}
}, false );
jqXHR.addEventListener( "progress", function ( evt ){
if ( evt.lengthComputable ){
var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
}
}, false );
return jqXHR;
},
success    : function ( data ){
var r = JSON.parse(data);
if(r.status == "Berhasil"){
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
title: r.pesan
}).then(function(){
$(".upload_perizinan"+id).hide();
$(".btn").removeAttr("disabled");
window.location.href ="<?php echo base_url('User3/halaman_proses') ?>";
});    
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
});
$(".upload_perizinan"+id).hide();
$(".btn_hapus_syarat"+id).removeAttr("disabled");    
$(".btn_upload_syarat"+id).removeAttr("disabled");    
}
}
});
}*/
 
  
function form_lihat_persyaratan(no_pekerjaan){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User3/lihat_persyaratan') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan,
success:function(data){
$(".tampilkan_data").html(data);
$('#modal_data').modal('show');
}
});
}

function form_upload_berkas(no_pekerjaan,id_data_berkas){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('User3/form_upload_berkas') ?>",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&id_data_berkas="+id_data_berkas,
success:function(data){
$(".tampilkan_data").html(data);
$('#modal_data').modal('show');
}
});
}

function form_alihkan_tugas(no_pekerjaan,id_data_berkas){

}

function form_tolak_tugas(no_pekerjaan,id_data_berkas){

}

function download(id_data_berkas){
window.location.href="<?php echo base_url('User3/download_berkas/') ?>"+id_data_berkas;
}

</script>    
</html>
