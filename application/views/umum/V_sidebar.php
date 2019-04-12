<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading">App Management </div>
<div class="list-group list-group-flush">
      
<ul class="list-unstyled components">
<?php if($this->session->userdata('level') == "Super Admin"){ ?>
<li><a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('Dashboard/setting'); ?>"><i class="fas fa-cogs"></i> Setting</a></li>
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
