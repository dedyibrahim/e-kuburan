<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Daftar pekerjaan proses</h4>
</div>
</div>

<div class="row ">
<div class="col">    
<table class="table table-sm table-striped table-hover">
<tr>
<th>Nama Client</th>
<th>Pembuat Client</th>
<th>Tanggal dibuat</th>
<th>Target selesai</th>
</tr>       
<?php foreach ($data_tugas->result_array() as    $data){  ?>
<tr>        
<td><?php echo $data['nama_client'] ?></td>
<td><?php echo $data['pembuat_client'] ?></td>   
<td><?php echo $data['tanggal_dibuat'] ?></td>
<td><?php echo $data['target_kelar'] ?></td>

</tr>
<?php } ?>



</table>    

    </div>
</div>
</div>
</div>

</body>
</html>
