<?php

class Menu extends CI_Controller{
function __construct() {
parent::__construct();

if(!$this->session->userdata('username')){
redirect(base_url('Login'));
}

}

public function index(){
$this->load->view('umum/V_header');    
$this->load->view('V_menu');    
}
public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}


public function check_akses(){
if($this->input->post()){

$data = $this->db->get_where('sublevel_user',array('no_user'=>$this->session->userdata('no_user'),'sublevel'=>$this->input->post('model')));

if($data->num_rows() == 1){
$status = array(
"status"=>"success",
"pesan"=>"Success Dashboard "
);
$this->session->set_userdata(array('sublevel'=>$this->input->post('model')));
}else if($this->session->userdata('level') == 'Super Admin'){

$status = array(
"status"=>"success",
"pesan"=>"Success Dashboard "
);

}else{
$status = array(
"status"=>"error",
"pesan"=>"Anda tidak memiliki akses kemenu tersebut "
);

}
echo json_encode($status);


}else{
redirect(404);	
}

    
}


    
}
