<div class="d-flex <?php if($this->session->userdata('toggled') == 'Aktif'){ echo "toggled"; } ?>" id="wrapper">
<div class="bg-theme2" id="sidebar-wrapper">
<div class="sidebar-heading text-center">App Management </div>
<div class="list-group list-group-flush">
      
<ul class="list-unstyled components">
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/buku_tamu'); ?>"><i class="fa fa-address-book"></i> Buku Tamu</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/data_akta'); ?>"><i class="fas fa-book"></i> Input Akta</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/data_kas'); ?>"><i class="fa fa-exchange-alt"></i> Kas</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/notaris_rekanan'); ?>"><i class="fas fa-users"></i> Notaris rekanan</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/absen'); ?>"><i class="fas  fa-calendar"></i> Absen</a></li>
</ul>
</div>
</div>


<script type="text/javascript">
$(document).ready(function () {
$('#sidebarCollapse').on('click', function () {
$('#sidebar').toggleClass('active');
});
});
</script>
