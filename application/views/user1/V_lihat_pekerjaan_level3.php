<body>
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<?php $kar = $data->row_array(); ?>
<div class="container-fluid ">
<div class="card-header mt-2 text-center ">
<h5 align="center">Data pekerjaan <?php echo base64_decode($this->uri->segment(4)) ?>  </h5>
</div>    

<div class="row mt-2">
<div class="col">
<table class="table table-sm table-bordered table-striped  table-condensed">
<tr>
<th>Nama Tugas</th>
<th>Nama client</th>
<th>Status</th>
<th>Target selesai</th>
<th>Aksi</th>
</tr>
<?php foreach ($data->result_array() as $d) { ?>
<tr>
<td><?php echo $d['nama_file']  ?></td>
<td><?php echo $d['nama_client']  ?></td>
<td><?php echo $d['status_berkas']  ?></td>
<td><?php echo $d['target_kelar_perizinan']  ?></td>
<td>
<select onchange="opsi('<?php echo $d['id_data_berkas'] ?>')" class="form-control aksi<?php echo $d['id_data_berkas'] ?>">
    <option >-- Klik untuk melihat menu --</option>
    <option value="1">Lihat laporan</option>
</select>
</td>
</tr>
<?php } ?>    


</table>    
</div>    
</div>
</div>
<div class="modal fade" id="data_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body data_laporan">
      
      </div>
      
    </div>
  </div>
</div>
    
<script type="text/javascript">
function opsi(id_data_berkas){
var val = $(".aksi"+id_data_berkas+" option:selected").val();

if(val == 1){
lihat_laporan(id_data_berkas);    
}
$(".aksi"+id_data_berkas+"").val("-- Klik untuk melihat menu --");        
}

function lihat_laporan(id_data_berkas){
var token             = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
data:"token="+token+"&id_data_berkas="+id_data_berkas,
url:"<?php echo base_url('User1/lihat_laporan') ?>",
success:function(data){
$('#data_laporan').modal('show'); 
$(".data_laporan").html(data);
}

});
        
}


</script>    
</html>
