<body >
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="card-header mt-2 text-center ">
<h5 align="center">Data pekerjaan diproses
</h5>
</div>

<div class="row mt-2">
<div class="col">    
<table class="table table-sm table-bordered table-striped table-hover">
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
<td><?php 
$d = new DateTime($data['target_kelar']);
echo $d->diff(new DateTime())->format('%a');
 ?> Hari lagi </td>

</tr>
<?php } ?>



</table>    

    </div>
</div>
</div>
</div>

</body>
</html>
