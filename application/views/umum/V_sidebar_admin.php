<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading">App Management </div>
<div class="list-group list-group-flush">
      
<ul class="list-unstyled components">

<li class="active">
<a href="#homeSubmenu"  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-light">
<i class="fas fa-users"></i> Client</a>
<ul class="list-unstyled collapse show" id="homeSubmenu">
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Admin'); ?>">Client Baru <i class="fa fa-plus float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Admin/data_client'); ?>">Data Client <i class="fa fa-list-alt float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Admin/data_perorangan'); ?>">Data Perorangan <i class="fa fa-users float-right"></i></a>
</li>
</ul>
</li>

    
<li class="active">
<a href="#homeSubmenu"  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-light">
<i class="fa fa-briefcase"></i> Pekerjaan</a>
<ul class="list-unstyled collapse show" id="homeSubmenu">
<li>
    <a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Admin/pekerjaan_baru') ?>">Pekerjaan Baru<i class="fa fa-suitcase	 float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Admin/pekerjaan_antrian') ?>">Dokumen antrian <i class="fa fa-hourglass-start float-right"></i></a>
</li>

<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Admin/pekerjaan_proses') ?>">Dokumen dikerjakan<i class="fa fa-hourglass-half float-right"></i></a>
</li>

<li>
<a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Admin/pekerjaan_selesai') ?>">Dokumen Selesai <i class="fa fa-hourglass-end float-right"></i></a>
</li>

</ul>
</li>

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
