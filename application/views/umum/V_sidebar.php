<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading">App Management </div>
<div class="list-group list-group-flush">
      
<ul class="list-unstyled components">
<li class="active">
<a href="#homeSubmenu"  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-light">
<i class="fas fa-users"></i> Client</a>
<ul class="list-unstyled collapse" id="homeSubmenu">
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url(); ?>">Client Baru <i class="fa fa-plus float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/data_client'); ?>">Data Client <i class="fa fa-list-alt float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/data_perorangan'); ?>">Data Perorangan <i class="fa fa-users float-right"></i></a>
</li>
</ul>
</li>

<li class="active">
<a href="#menu_dokumen" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-light">
<i class="fas fa-file"></i> Dokumen</a>
<ul class="list-unstyled collapse " id="menu_dokumen">
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/jenis_dokumen'); ?>">Jenis Dokumen  <i class="fa fa-filter float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/nama_dokumen'); ?>">Nama Dokumen <i class="fa fa-book float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/dokumen_proses'); ?>">Dokumen Proses <i class="fa fa-exchange-alt float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/dokumen_selesai'); ?>">Dokumen Selesai <i class="fa fa-flag-checkered float-right"></i></a>
</li>
</ul>
</li>


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
