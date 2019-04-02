<body>
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user1'); ?>
<div class="container-fluid ">
<div class="row  p-1 m-1">
<div class="col rounded-top p-3" style="background-color: #dcdcdc; ">
<h4 align="center">Lihat pekerjaan karyawan</h4>
</div>
</div>
<div class="row p-1 m-1">
    <table class="table table-sm table-hover table-striped text-center">
        <tr>
            <th>No</th>   
            <th>Nama karyawan</th>   
            <th>Kontak</th>   
            <th>Email</th>   
            <th>Aksi</th>   
        </tr>
    <?php $h=1; foreach ($karyawan->result_array() as $kar){ ?>    
        <tr>
            <td><?php echo $h++?></td>
            <td><?php echo $kar['nama_lengkap']?></td>
            <td><?php echo $kar['phone']?></td>
            <td><?php echo $kar['email']?></td>
            <td><a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user']))."/". base64_encode($kar['sublevel']) ?>"><button class="btn btn-success btn-sm">Lihat pekerjaan <span class="fa fa-eye"></span></button></a></td>
        </tr>
    <?php } ?>
    </table>   
</div>   
</script>    
</html>
