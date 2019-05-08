<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid ">
<?php  $static = $data_user->row_array(); ?>
<div class="row">
<div class="col-md-7 mx-auto">
<div class="card-header mt-2 text-center ">
<h5 align="center">Profil</h5>
</div>
    <img src=" s">    
<div class="card-body">
    <table class="table  table-striped">
        <tr>
            <td>ID</td>
            <td> : <?php echo $static['no_user'] ?></td>
        </tr>
      <tr>
            <td>Username</td>
            <td> : <?php echo $static['username'] ?></td>
        </tr>
      <tr>
            <td>Nama lengkap</td>
            <td> : <?php echo $static['nama_lengkap'] ?></td>
        </tr>
      <tr>
            <td>Email</td>
            <td> : <?php echo $static['email'] ?></td>
        </tr>
      <tr>
            <td>Phone</td>
            <td> : <?php echo $static['phone'] ?></td>
        </tr>
      <tr>
            <td>Level</td>
            <td> : <?php echo $static['level'] ?></td>
        </tr>
    </table>    
</div>
    <div class="card-footer text-center">
        <button class="btn btn-success btn-sm col-md-6">Update profil</button>  
        <button class="btn btn-warning btn-sm col-md-5">Ubah password</button>  
    </div>    
</div>
</div>    
</div>
</div>
</div>    
</body>
</html>
