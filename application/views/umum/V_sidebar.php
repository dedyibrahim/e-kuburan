<div class="d-flex <?php if($this->session->userdata('toggled') == 'Aktif'){ echo "toggled"; } ?>" id="wrapper">
<div class="bg-theme2" id="sidebar-wrapper">
<div class="sidebar-heading text-center">E-Kuburan </div>
<div class="list-group list-group-flush">
<ul class="list-unstyled components">
<li>
<a class="list-group-item list-group-item-action" href="<?php echo base_url('Dashboard/input_ahli_waris') ?>">Input Ahli Waris<i class="fa fa-pencil-alt float-right"></i></a>
</li>

<li>
<a class="list-group-item list-group-item-action" href="<?php echo base_url('Dashboard/input_identitas_jenazah') ?>">Input Identitas Jenazah<i class="fa fa-pencil-alt float-right"></i></a>
</li>

<li>
<a class="list-group-item list-group-item-action" href="<?php echo base_url('Dashboard/data_jenazah') ?>">Data Jenazah<i class="fa fa-list-ul float-right"></i></a>
</li>

    
<?php if($this->session->userdata('level') == 'Admin'){ ?>
<li class="active">
<a href="#homeSubmenu"  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action ">
<i class="fa fa-briefcase"></i> Pengaturan </a>
<ul class="list-unstyled collapse show" id="homeSubmenu">
<li>
<a class="list-group-item list-group-item-action " href="<?php echo base_url('Dashboard/user') ?>">Pengaturan user<i class="fa fa-suitcase	 float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action " href="<?php echo base_url('Dashboard/pengaturan_blok') ?>">Pengaturan Blok Makam<i class="fa fa-suitcase float-right"></i></a>
</li>
</ul>
</li>
<?php } ?>
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
