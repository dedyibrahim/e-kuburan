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
    <table class="table table-sm  table-condensed table-striped ">
        <tr>
            <th >Nama karyawan</th>   
            <th class="text-center">In</th>   
            <th class="text-center">Progress</th>   
            <th class="text-center">Out</th>   
        </tr>
    <?php $h=1; foreach ($karyawan->result_array() as $kar){ ?>    
        
       <?php if($kar['sublevel'] == 'Level 2'){ ?> 
        <tr>
            <td><?php echo $kar['nama_lengkap'] ?></td>
            <td class="text-center">
                <a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Masuk')) ?>"><span class="badge p-2 badge-primary"><?php echo  $this->db->get_where('data_pekerjaan',array('no_user'=>$kar['no_user'],'status_pekerjaan'=>'Masuk'))->num_rows(); ?></span></a>    
            </td>
            <td class="text-center">
                <a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Proses')) ?>"><span class="badge p-2 badge-warning"><?php echo  $this->db->get_where('data_pekerjaan',array('no_user'=>$kar['no_user'],'status_pekerjaan'=>'Proses'))->num_rows(); ?></span></a>     
            </td>
            <td class="text-center">
                <a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Selesai')) ?>"><span class="badge p-2 badge-success"><?php echo $this->db->get_where('data_pekerjaan',array('no_user'=>$kar['no_user'],'status_pekerjaan'=>'Selesai'))->num_rows(); ?></span></a>     
            </td>
        </tr>
       <?php }elseif($kar['sublevel'] == 'Level 3'){ ?> 
        
        <tr>
            <td><?php echo $kar['nama_lengkap'] ?></td>
            <td class="text-center">
            <a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Masuk')) ?>"><span class="badge p-2 badge-primary"><?php echo $this->db->get_where('data_berkas',array('no_pengurus'=>$kar['no_user'],'status'=>'Masuk'))->num_rows(); ?></span></a>      
            </td>
            <td class="text-center">
            <a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Proses')) ?>"><span class="badge p-2 badge-warning"><?php echo $this->db->get_where('data_berkas',array('no_pengurus'=>$kar['no_user'],'status'=>'Proses'))->num_rows(); ?></span></a>      
            </td>
            <td class="text-center">
            <a href="<?php echo base_url('User1/lihat_pekerjaan/'.base64_encode($kar['no_user'])."/".base64_encode('Selesai')) ?>"><span class="badge p-2 badge-success"><?php echo $this->db->get_where('data_berkas',array('no_pengurus'=>$kar['no_user'],'status'=>'Selesai'))->num_rows(); ?></span></a>      
            </td>
        </tr>
        
       <?php } } ?>
    </table>   
</div>   
</script>    
</html>
