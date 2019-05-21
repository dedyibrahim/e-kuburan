<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>

<div class="container-fluid ">
<div class="card-header mt-2 text-center ">
    <h4 align="center">Status Pekerjaan <?php echo $static['nama_client'] ?></h4>
</div>  

    <div class="row p-1 m-1">
<div class="container-fluid">
<div class="row">
<div class="col">
    <table class="table table-sm table-bordered table-condensed table-striped ">
        <tr>
            <th class="text-center" colspan="2">Jenis Pekerjaan</th>   
            <th class="text-center" colspan="2">Target selesai</th>   
        </tr>
        <tr>
            <td class="text-center" colspan="2"><?php echo $static['jenis_perizinan'] ?></td>   
            <td class="text-center" colspan="2"><?php echo $static['target_kelar'] ?></td>   
        </tr>
        <tr>
            <th class="text-center" colspan="1">Nama File</th>   
            <th class="text-center" colspan="1">Status Berkas</th>
            <th class="text-center" colspan="1">Target Selesai</th>
            <th class="text-center" colspan="1">Pengurus</th>
        </tr>
        
        <?php 
        foreach ( $data->result_array() as $d){ ?>
        <tr class="text-center">
            <td><?php echo $d['nama_file'] ?></td>     
            <td><?php echo $d['status'] ?> <button onclick="lihat_status_sekarang('<?php echo $d['id_data_berkas'] ?>');"  class="btn btn-success float-right btn-sm"><span class="fa fa-eye"></span></button></td>     
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
<div class="modal-body" id="lihat_status_sekarang">

</div>
</div>
</div>
</div>
   
    
<script type="text/javascript">
function lihat_status_sekarang(id_data_berkas){
$('#modal_laporan').modal('show');
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
    
$.ajax({
type:"post",
url:"<?php echo base_url('User1/lihat_laporan') ?>",
data:"token="+token+"&id_data_berkas="+id_data_berkas,
success:function(data){
$("#lihat_status_sekarang").html(data);
}

});
}        
</script>   
</html>
