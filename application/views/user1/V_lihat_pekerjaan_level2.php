<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<?php $kar = $data->row_array(); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
    <h4 align="center">Data pekerjaan <?php echo base64_decode($this->uri->segment(4)) ?>  </h4>
</div>
</div>
<div class="row p-1 m-1">
<div class="container-fluid">
    
<div class="row">
<div class="col">
 <table class="table table-striped  table-condensed">
        <tr>
        <th>Pekerjaan</th>
        <th>Nama client</th>
        <th>Status</th>
        <th>Target selesai</th>
        </tr>
      <?php foreach ($data->result_array() as $d) { ?>
        <tr>
            <td><a href="<?php echo base_url('User1/lihat_status_pekerjaan/'. base64_encode($d['no_berkas'])) ?>"><span class="badge p-2 badge-primary"><?php echo $d['jenis_perizinan']  ?></span></a></td>
            <td><?php echo $d['nama_client']  ?></td>
            <td><?php echo $d['status_berkas']  ?></td>
            <td><?php echo $d['target_kelar']  ?></td>
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
</script>    
</html>
