<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Daftar pekerjaan yang baru masuk</h4>
</div>
</div>

<div class="row ">
<div class="col">    
<table class="table table-sm table-striped table-hover">
<tr>
<th>Nama Client</th>
<th>Pekerjaan</th>
<th>Tanggal dibuat</th>
<th>Target selesai</th>
<th class="text-center">Aksi</th>
</tr>       
<?php foreach ($data_tugas->result_array() as    $data){  ?>
<tr>        
<td><?php echo $data['nama_client'] ?></td>
<td>
    <select disabled="" class="form-control pekerjaan<?php echo $data['id_data_pekerjaan'] ?>">    
 <option><?php echo $data['pembuat_client'] ?></option>
        <?php
        foreach ($data_user->result_array() as $user){
        echo "<option value=".$user['no_user'].">".$user['nama_lengkap']."</option>";
            
        }?>
    </select>
   </td>   
<td><?php echo $data['tanggal_dibuat'] ?></td>
<td><?php echo $data['target_kelar'] ?></td>
<td>
 <select onchange="aksi_option('<?php echo base64_encode($data['no_pekerjaan']) ?>','<?php echo $data['id_data_pekerjaan'] ?>');" class="form-control data_option<?php echo $data['id_data_pekerjaan'] ?>">
<option></option>
<option value="1">Lihat Laporan</option>
<option value="2">Alihkan Pekerjaan</option>
</select>    
</td>
</tr>
<?php } ?>



</table>    

    </div>
</div>
</div>
</div>
    

</body>
<script type="text/javascript">
function aksi_option(no_pekerjaan,id_data_pekerjaan){
var val = $(".data_option"+id_data_pekerjaan+" option:selected").val();
if(val == 1){
alert(1);    
}else if (val == 2){
$('.pekerjaan'+id_data_pekerjaan).removeAttr("disabled");
}
}

</script>
</html>
