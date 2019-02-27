<nav id="sidebar">
<div class="sidebar-header ">
<h6 align="center">App Management Notarian</h6>
<strong>AN</strong>
</div>
<ul class="list-unstyled components">
<li class="active">
<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
<i class="fas fa-users"></i> Client</a>
<ul class="collapse list-unstyled" id="homeSubmenu">
<li>
<a href="<?php echo base_url(); ?>">New Client </a>
</li>
<li>
<a href="#">Data Client</a>
</li>
</ul>
</li>

<li class="active">
<a href="#menu_dokumen" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
<i class="fas fa-file"></i> Dokumen</a>
<ul class="collapse list-unstyled" id="menu_dokumen">
<li>
<a href="<?php echo base_url('Dashboard/jenis_dokumen'); ?>">Jenis Dokumen</a>
</li>
<li>
<a href="<?php echo base_url('Dashboard/nama_dokumen'); ?>">Nama Dokumen</a>
</li>
</ul>
</li>


<li><div> <a href=""><i class="fas fa-briefcase"></i> About</a></div></li>
<li><div> <a href=""><i class="fas fa-user"></i> Account</a></div></li>
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
