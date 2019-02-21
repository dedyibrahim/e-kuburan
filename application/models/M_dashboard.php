<?php 
class M_dashboard extends CI_model{

public function simpan_user($data){
$query = $this->db->insert('user',$data);   
return $query;    
}
public function data_user(){
$query = $this->db->get('user');   
return $query;    
}
public function ambil_user($id_user){
$query = $this->db->get_where('user',array('id_user'=>base64_decode($id_user)));
return $query;

}
public function update_user($data,$id_user){
$this->db->update('user',$data,array('id_user'=>$id_user));

}
    

}
?>