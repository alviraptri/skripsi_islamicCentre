<?php

class m_login extends CI_Model
{
    function cek($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function Select($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    //lupa kata sandi 
     //Start: method tambahan untuk reset code  
   public function getUserInfo($id)  
   {  
     $q = $this->db->get_where('user', array('nomorInduk' => $id), 1);   
     if($this->db->affected_rows() > 0){  
       $row = $q->row();  
       return $row;  
     }else{  
       error_log('no user found getUserInfo('.$id.')');  
       return false;  
     }  
   }  
   
  public function getUserInfoByEmail($email){  
     $q = $this->db->get_where('user', array('emailUser' => $email), 1);   
     if($this->db->affected_rows() > 0){  
       $row = $q->row();  
       return $row;  
     }  
   }  
   
   public function insertToken($id)  
   {    
     $token = substr(sha1(rand()), 0, 30);   
     $date = date('Y-m-d');  
       
     $string = array(  
         'token'=> $token,  
         'nomorInduk'=>$id,  
         'created'=>$date  
       );  
     $query = $this->db->insert_string('tokens',$string);  
     $this->db->query($query);  
     return $token . $id;  
       
   }  
   
   public function isTokenValid($token)  
   {  
     $tkn = substr($token,0,30);  
     $uid = substr($token,30);     
       
     $q = $this->db->get_where('tokens', array(  
       'tokens.token' => $tkn,   
       'tokens.nomorInduk' => $uid), 1);               
           
     if($this->db->affected_rows() > 0){  
       $row = $q->row();         
         
       $created = $row->created;  
       $createdTS = strtotime($created);  
       $today = date('Y-m-d');   
       $todayTS = strtotime($today);  
         
       if($createdTS != $todayTS){  
         return false;  
       }  
         
       $user_info = $this->getUserInfo($row->nomorInduk);  
       return $user_info;  
         
     }else{  
       return false;  
     }  
       
   }   
   
   public function updatePassword($post)  
   {    
     $this->db->where('nomorInduk', $post['id_user']);  
     $this->db->update('user', array('passUser' => $post['password']));      
     return true;  
   }   
   //End: method tambahan untuk reset code  

    function updatePass($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function resetKey($email, $reset_key)
    {
        $this->db->where('emailUser', $email);
        $data = array('resetPass' => $reset_key,);
        $this->db->update('user', $data);
        if ($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}
?>