<?php 
class Dashboard extends CI_Controller{
    public function __construct() {
        parent::__construct();
$this->load->library('session');
   if(!$this->session->userdata('username')){
       redirect(base_url('Login'));
      }       
    }

    public function index(){
        $this->load->view('umum/V_header');
        $this->load->view('dashboard/V_new_client');
    }
    
    public function upload_dokumen(){

             $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png|docx|pdf|doc|';
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('oke')){
                 echo print_r($this->upload->display_errors());
          
                }else{
                
                }
    
     $data = $this->input->post();

     echo print_r($data);    

    }

public function keluar(){
    $this->session->sess_destroy();
redirect (base_url('Login'));
}

   public function setting(){
        $this->load->view('umum/V_header');
        $this->load->view('dashboard/V_setting');
    }

    
}
