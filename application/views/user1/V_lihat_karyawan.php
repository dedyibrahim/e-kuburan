<body>
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="card-header mt-2 text-center ">
<h5 align="center">Data jumlah pekerjaan karyawan</h5>
</div>
<div class="row  m-1">
<table class="table table-sm  table-bordered table-condensed table-striped ">
    <tr class="text-center">
<th rowspan="3" class="align-middle">Nama karyawan</th>   
<th class="text-center" colspan="6">Jenis Dokumen</th>

<tr class="text-center">
<th colspan="3">Dokumen utama</th>    
<th colspan="3">Dokumen perizinan</th>    
</tr>

<tr class="text-center">
<th>In</th>    
<th>Progress</th>    
<th>Out</th>

<th>In</th>    
<th>Progress</th>    
<th>Out</th> 
</tr>

<?php $h=1; foreach ($karyawan->result_array() as $kar){ ?>    
<tr>
<td><?php echo $kar['nama_lengkap'] ?></td>

<!--------- dokumen utama count---------------->
<td class="text-center">
    <a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Masuk')."/". base64_encode("Level 2")) ?>"><span class="badge p-2 badge-primary "><?php echo  $this->db->get_where('data_pekerjaan',array('no_user'=>$kar['no_user'],'status_pekerjaan'=>'Masuk'))->num_rows(); ?></span></a>    
</td>
<td class="text-center">
<a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Proses')."/". base64_encode("Level 2")) ?>"><span class="badge p-2 badge-warning"><?php echo  $this->db->get_where('data_pekerjaan',array('no_user'=>$kar['no_user'],'status_pekerjaan'=>'Proses'))->num_rows(); ?></span></a>     
</td>
<td class="text-center">
<a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Selesai')."/". base64_encode("Level 2")) ?>"><span class="badge p-2 badge-success"><?php echo $this->db->get_where('data_pekerjaan',array('no_user'=>$kar['no_user'],'status_pekerjaan'=>'Selesai'))->num_rows(); ?></span></a>     
</td>
<!--------- dokumen perizinan count---------------->
<td class="text-center">
<a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Masuk')."/". base64_encode("Level 3")) ?>"><span class="badge p-2 badge-primary"><?php echo $this->db->get_where('data_berkas',array('no_pengurus'=>$kar['no_user'],'status'=>'Masuk'))->num_rows(); ?></span></a>      
</td>
<td class="text-center">
<a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Proses')."/". base64_encode("Level 3")) ?>"><span class="badge p-2 badge-warning"><?php echo $this->db->get_where('data_berkas',array('no_pengurus'=>$kar['no_user'],'status'=>'Proses'))->num_rows(); ?></span></a>      
</td>
<td class="text-center">
<a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Selesai')."/". base64_encode("Level 3")) ?>"><span class="badge p-2 badge-success"><?php echo $this->db->get_where('data_berkas',array('no_pengurus'=>$kar['no_user'],'status'=>'Selesai'))->num_rows(); ?></span></a>      
</td>

</tr>

<?php } ?>
</table>   
</div>   
</script>    
</html>
