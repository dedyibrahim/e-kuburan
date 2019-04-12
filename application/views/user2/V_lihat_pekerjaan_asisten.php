<body >
<div class="d-flex" id="wrapper">
<?php  $this->load->view('umum/V_sidebar_user2'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/V_navbar_user2'); ?>
<div class="container-fluid">
<div class="card p-2 mt-2">
<?php $static = $asisten->row_array(); ?>
<div class="row">
<div class="col">
    <h5 align="center"><i class="fa fa-3x fa-users"></i><br>Daftar tugas <?php echo base64_decode($this->uri->segment(4)) ?>  <?php echo $static['perizinan']; ?></h5>
<table class="table table-sm  table-condensed table-striped ">
        <tr>
            <th>Tugas</th>   
            <th class="text-center">Status</th>   
            <th class="text-center">Pemberi Tugas</th>   
            <th class="text-center">Target Selesai</th>   
        </tr>
   <?php foreach ($asisten->result_array() as $data){ 
       if($data['no_user'] != $this->session->userdata('no_user')){
       ?>        
        <tr style="color:#900;">
            <td><?php echo $data['nama_dokumen'] ?></td>
            <td class="text-center">
            <?php echo $data['status_berkas'] ?>
            </td>
             <td class="text-center">
            <?php echo $data['pembuat_berkas'] ?>
            </td>
        <td class="text-center">
            <?php echo $data['target_kelar_perizinan'] ?>
            </td>
         </tr>
        
       <?php }else{ ?>
        <tr>
            <td><?php echo $data['nama_dokumen'] ?></td>
            <td class="text-center">
            <?php echo $data['status_berkas'] ?>
            </td>
             <td class="text-center">
            <?php echo $data['pembuat_berkas'] ?>
            </td>
            <td class="text-center">
            <?php echo $data['target_kelar_perizinan'] ?>
            </td>
         </tr>
       <?php } ?>
    <?php }?>        
    </table>
 
</div>
    
</div>
</div>
</div>
</div>
</div>    

</body>
