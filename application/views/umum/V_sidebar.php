<div class="d-flex <?php if($this->session->userdata('toggled') == 'Aktif'){ echo "toggled"; } ?>" id="wrapper">
<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading">App Management </div>
<div class="list-group list-group-flush">
      
<ul class="list-unstyled components">
<li><a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/data_berkas'); ?>"><i class="fa fa-file-word"></i> Data berkas</a></li>
<li><a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/data_client'); ?>"><i class="fas fa-user-tie"></i> Data client</a></li>
<li><a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/pekerjaan_proses'); ?>"><i class="fa fa-exchange-alt"></i> Pekerjaan diproses</a></li>
<li><a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/data_user'); ?>"><i class="fas fa-users"></i> Data user</a></li>
<li><a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/setting'); ?>"><i class="fas fa-cogs"></i> Setting</a></li>
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
