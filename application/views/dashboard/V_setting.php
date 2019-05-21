<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar'); ?>
<div class="container-fluid">
<div class="p-2 mt-2">

<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#jenis">Pengaturan Jenis Pekerjaan <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item ml-1">
<a class="nav-link " data-toggle="tab" href="#dokumen">Pengaturan Nama Persyaratan <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item ml-1">
<a class="nav-link" data-toggle="tab" href="#aplikasi">Pengaturan User <i class="fas fa-cogs"></i></a>
</li>
</ul>

<div class="tab-content">

<div class="tab-pane card container-fluid active" id="jenis">
<div class="row p-2">
<div class="col">
<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah_jenis_dokumen">Tambahkan Jenis Dokumen <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Data jenis pekerjaan</h5>
<?php $this->load->view('dashboard/V_data_jenis_dokumen'); ?>
</div>
</div>
</div>

<!----------------------------Dokumen------------------------------>
<div class="tab-pane card container-fluid fade" id="dokumen">
<div class="row p-2">
<div class="col">
<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah_data_dokumen">Tambahkan Data Dokumen <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Data Nama Dokumen</h5>
<?php $this->load->view('dashboard/V_data_dokumen'); ?>
</div>
</div>
</div>

<!----------------------------Aplikasi------------------------------>
<div class="tab-pane card container-fluid fade" id="aplikasi">
<div class="row p-2">
<div class="col">
<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modal_data_user">Tambahkan Data User <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Pengaturan User <br> <i class="fa fa-3x fa-users"></i></h5>
<?php $this->load->view('dashboard/V_data_user_setting'); ?>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

</body>

