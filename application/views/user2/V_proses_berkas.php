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
<label>Pilih Jenis File Perizinan</label>       
<select onchange="jenis_file_perizinan();" class="form-control file_siap">
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
  
</div>    
</div>
   
   
</div>    
    
<script type="text/javascript">
    
</script>
</body>

