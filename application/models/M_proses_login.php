<?php 
class M_proses_login extends CI_Model{
    public function proses_login($username,$password){

$query = $this->db->get_where('user',array('username' => $username,'password'=>md5($password) ));
return $query;
	
}

    
}

?>