<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<?php $static = $data->row_array(); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
    <h4 align="center">Status Pekerjaan <?php echo $static['nama_client'] ?></h4>
</div>
</div>
<div class="row p-1 m-1">
<div class="container-fluid">
<div class="row">
<div class="col">
    <table class="table table-condensed table-striped ">
        <tr>
            <th class="text-center" colspan="2">Jenis Pekerjaan</th>   
            <th class="text-center" colspan="2">Target selesai</th>   
        </tr>
        <tr>
            <td class="text-center" colspan="2"><?php echo $static['jenis_perizinan'] ?></td>   
            <td class="text-center" colspan="2"><?php echo $static['target_kelar'] ?></td>   
        </tr>
        
        
        <?php 
        foreach ( $data->result_array() as $d){ ?>
        <tr>
            <td><?php echo $d['nama_file'] ?></td>     
            <td><?php echo $d['status_berkas'] ?> <button onclick="lihat_status_sekarang('<?php echo $d['no_pekerjaan'] ?>','<?php echo $d['no_nama_dokumen'] ?>');"  class="btn btn-success float-right btn-sm"><span class="fa fa-eye"></span></button></td>     
            <td><?php echo $d['target_kelar_perizinan'] ?></td>     
            <td><?php echo $d['pengurus_perizinan'] ?></td>     
        </tr>
        <?php } ?>
    </table>
    
</div>    
</div>

</div>    
</div>
</div>
</div>
</div>
    
 <!-------------------modal laporan--------------------->

<div class="modal fade" id="modal_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Perizinan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="lihat_status_sekarang">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="simpan_laporan">Simpan laporan</button>
      </div>
    </div>
  </div>
</div>
   
    
<script type="text/javascript">
function lihat_status_sekarang(no_berkas,no_nama_dokumen){
$('#modal_laporan').modal('show');
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
    
$.ajax({
type:"post",
url:"<?php echo base_url('User1/lihat_laporan') ?>",
data:"token="+token+"&no_nama_dokumen="+no_nama_dokumen+"&no_berkas="+no_berkas,
success:function(data){
$("#lihat_status_sekarang").html(data);
}

});
}        
</script>   
</html>
