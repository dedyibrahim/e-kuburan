<nav id="sidebar">
<div class="sidebar-header ">
<h6 align="center">App Management Notarian</h6>
<strong>AN</strong>
</div>
    
    
<ul class="list-unstyled components">
<li class="active">
<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
<i class="fas fa-users"></i> Client</a>
<ul class="list-unstyled collapse show" id="homeSubmenu">
<li>
    <a href="<?php echo base_url(); ?>">Client Baru <i class="fa fa-plus float-right"></i></a>
</li>
<li>
    <a href="<?php echo base_url('Dashboard/data_client'); ?>">Data Client <i class="fa fa-list-alt float-right"></i></a>
</li>
</ul>
</li>

<li class="active">
<a href="#menu_dokumen" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
<i class="fas fa-file"></i> Dokumen</a>
<ul class="list-unstyled collapse show" id="menu_dokumen">
<li>
    <a href="<?php echo base_url('Dashboard/jenis_dokumen'); ?>">Jenis Dokumen  <i class="fa fa-filter float-right"></i></a>
</li>
<li>
<a href="<?php echo base_url('Dashboard/nama_dokumen'); ?>">Nama Dokumen <i class="fa fa-book float-right"></i></a>
</li>
<li>
<a href="<?php echo base_url('Dashboard/dokumen_proses'); ?>">Dokumen Proses <i class="fa fa-exchange-alt float-right"></i></a>
</li>
<li>
<a href="<?php echo base_url('Dashboard/dokumen_selesai'); ?>">Dokumen Selesai <i class="fa fa-flag-checkered float-right"></i></a>
</li>
</ul>
</li>


<li><div><a href="<?php echo base_url('Dashboard/setting'); ?>"><i class="fas fa-cogs"></i> Setting</a></div></li>

</ul>
</nav>
<script type="text/javascript">
$(document).ready(function () {
$('#sidebarCollapse').on('click', function () {
$('#sidebar').toggleClass('active');
});
});
</script>
