<body>
<div class="d-flex" id="wrapper">
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
</tr>
<?php foreach ($data->result_array() as $d) { ?>
<tr>
<td><?php echo $d['nama_file']  ?></td>
<td><?php echo $d['nama_client']  ?></td>
<td><?php echo $d['status_berkas']  ?></td>
<td><?php echo $d['target_kelar_perizinan']  ?></td>
</tr>
<?php } ?>    


</table>    
</div>    
</div>
</div>    
</script>    
</html>
