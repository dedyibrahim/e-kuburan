<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<div class="card p-2 mt-2">

<div class="row">
<div class="col">
<h5 align="center"><i class="fa fa-3x fa-users"></i><br>Daftar asisten yang anda berikan pekerjaan</h5>
<table class="table table-sm  table-condensed table-striped ">
        <tr>
            <th> Asisten</th>   
            <th class="text-center">In</th>   
            <th class="text-center">Progress</th>   
            <th class="text-center">Out</th>   
        </tr>
   <?php foreach ($asisten->result_array() as $data){ ?>        
        <tr>
            <td><?php echo $data['nama_lengkap'] ?></td>
            <td class="text-center">
                <a href="<?php echo base_url('User2/lihat_pekerjaan_asisten/'.base64_encode($data['no_pengurus'])."/".base64_encode('Masuk')) ?>"><span class="badge p-2 badge-primary"><?php echo  $this->db->get_where('data_berkas',array('no_pengurus'=>$data['no_pengurus'],'status'=>'Masuk'))->num_rows(); ?></span></a>    
            </td>
            <td class="text-center">
                <a href="<?php echo base_url('User2/lihat_pekerjaan_asisten/'.base64_encode($data['no_pengurus'])."/".base64_encode('Proses')) ?>"><span class="badge p-2 badge-warning"><?php echo  $this->db->get_where('data_berkas',array('no_pengurus'=>$data['no_pengurus'],'status'=>'Proses'))->num_rows(); ?></span></a>     
            </td>
            <td class="text-center">
                <a href="<?php echo base_url('User2/lihat_pekerjaan_asisten/'.base64_encode($data['no_pengurus'])."/".base64_encode('Selesai')) ?>"><span class="badge p-2 badge-success"><?php echo  $this->db->get_where('data_berkas',array('no_pengurus'=>$data['no_pengurus'],'status'=>'Selesai'))->num_rows(); ?></span></a>     
            </td>
         </tr>
    <?php }?>        
    </table>
 
</div>
    
</div>
</div>
</div>
</div>
</div>    

</body>
