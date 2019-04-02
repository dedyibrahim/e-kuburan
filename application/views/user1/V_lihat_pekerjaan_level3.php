<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<?php $kar = $karyawan->row_array(); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Data pekerjaan <?php echo $kar['nama_lengkap'] ?></h4>
</div>
</div>
<div class="row">
    <div class="col">    
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Perizinan masuk <span class="badge badge-light"><?php echo $this->db->get_where('data_syarat_jenis_dokumen',array('status_berkas'=>'Masuk','no_user'=>$kar['no_user']))->num_rows() ?></span></a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Perizinan diproses <span class="badge badge-light"><?php echo $this->db->get_where('data_syarat_jenis_dokumen',array('status_berkas'=>'Proses','no_user'=>$kar['no_user']))->num_rows() ?></span></a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Perizinan diselesaikan dibulan <span class="badge badge-light"><?php echo date('F') ?></span></a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#pekerjaan_selesai" role="tab" aria-controls="pekerjaan_selesai" aria-selected="false">Perizinan selesai <span class="badge badge-light"><?php echo $this->db->get_where('data_syarat_jenis_dokumen',array('status_berkas'=>'Selesai','no_user'=>$kar['no_user']))->num_rows() ?></span></a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
<!------------pekerjaan masuk------------------>
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<div class="row">
<?php
$this->db->select('*');
$this->db->from('data_syarat_jenis_dokumen');
$this->db->join('data_client', 'data_client.no_client = data_syarat_jenis_dokumen.no_client');
$this->db->join('user', 'user.no_user = data_syarat_jenis_dokumen.no_user');
$this->db->where(array('data_syarat_jenis_dokumen.status_berkas'=>'Masuk','data_syarat_jenis_dokumen.no_user'=>$kar['no_user']));
$masuk = $this->db->get();
foreach ($masuk->result_array() as $m){
?>
<div class="col-md-4 mt-2 mb-2">    
<div class="card">
<div class="card-header text-center"><?php echo $m['nama_client'] ?></div>
<div class="card-body">
<p style="font-size:13px; ">Pekerjaan : <?php echo $m['nama_dokumen'] ?><br>
Tanggal dibuat : <?php echo $m['tanggal_tugas'] ?><br>
Target kelar : <?php echo $m['target_kelar_perizinan'] ?><br>
Tugas : <?php echo $m['nama_lengkap'] ?><br>
Client : <?php echo $m['nama_client'] ?></p>
</div>
<div class="card-footer"><button class="btn btn-success btn-block btn-sm">Lihat kemajuan</button></div>
</div>
</div>        
<?php } ?>
</div>    
</div>
<!------------pekerjaan diproses------------------>
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">           
  <div class="row">
<?php
$this->db->select('*');
$this->db->from('data_syarat_jenis_dokumen');
$this->db->join('data_client', 'data_client.no_client = data_syarat_jenis_dokumen.no_client');
$this->db->join('user', 'user.no_user = data_syarat_jenis_dokumen.no_user');
$this->db->where(array('data_syarat_jenis_dokumen.status_berkas'=>'Proses','data_syarat_jenis_dokumen.no_user'=>$kar['no_user']));
$proses = $this->db->get();
foreach ($proses->result_array() as $p){
?>
<div class="col-md-4 mt-2 mb-2">    
<div class="card">
<div class="card-header text-center"><?php echo $p['nama_client'] ?></div>
<div class="card-body">
<p style="font-size:13px; ">Pekerjaan : <?php echo $p['nama_dokumen'] ?><br>
Tanggal dibuat : <?php echo $p['tanggal_tugas'] ?><br>
Tanggal diproses : <?php echo $p['tanggal_proses_tugas'] ?><br>
Target kelar : <?php echo $p['target_kelar_perizinan'] ?><br>
Tugas : <?php echo $p['nama_lengkap'] ?><br>
Client : <?php echo $p['nama_client'] ?></p>
</div>
<div class="card-footer"><button class="btn btn-success btn-block btn-sm">Lihat kemajuan</button></div>
</div>
</div>        
<?php } ?>
</div>        
</div>
<!------------pekerjaan dibulan------------------>
<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
       
</div>
<!------------pekerjaan selesai------------------>
<div class="tab-pane fade" id="pekerjaan_selesai" role="tabpanel" aria-labelledby="pekerjaan_selesai-tab">
      
</div>


</div>
</div>    
</div>
</div>    
</script>    
</html>
