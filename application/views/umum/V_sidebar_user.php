<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading">App Management </div>
<div class="list-group list-group-flush">
      
<ul class="list-unstyled components">
<li class="active">
<a href="#homeSubmenu"  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-light">
<i class="fa fa-briefcase"></i> Pekerjaan</a>
<ul class="list-unstyled collapse show" id="homeSubmenu">
<li>
<a class="list-group-item list-group-item-action bg-light" href="">Antrian Pekerjaan<i class="fa fa-suitcase	 float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="">Sedang dikerjakan <i class="fa fa-star-half-alt float-right"></i></a>
</li>
<li>
<a class="list-group-item list-group-item-action bg-light" href="">Selesai dikerjakan<i class="fa fa-star float-right"></i></a>
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
