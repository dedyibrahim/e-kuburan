<?php 
class M_proses_login extends CI_Model{
    public function proses_login($username){

$query = $this->db->get_where('data_user',array('username' => $username));
return $query;
	
}

    
}

?>