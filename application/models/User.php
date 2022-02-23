<?php

class User extends CI_Model {


    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getActiveUserIfExists($email, $password) {
        $query = "SELECT id as uid, name, email
                  FROM user
                  WHERE email=" . $this->db->escape($email)
                  . " AND password=" .  $this->db->escape(md5($password)) 
                  . " AND active ='t';";
        $res = $this->db->query($query)->row_array();
        
        //this has to be done because of session problems
        $res["uid"] = 'id_' . $res["uid"];
                
        return $res;
    }
    
    public function createNewUser($data) {
        $user_exists = $this->db->where('email', $data["email"])->get('user')->num_rows();
        if ($user_exists){
            return "User already exists!";
        }
        else{
            $user_data = $data;

            $this->db->insert('user',$user_data);
            $id_user =  $this->db->insert_id();
        }

        return (int)$id_user;
    }
    
    public function updatePassword($data) {
        $data["password"] = md5($data["password"]);
        return $this->db->where('id', $data["id"])
                ->update('user', [
                    "password" => $data["password"],
                    "active" => 't'
                        ]);
    }
    
    public function sendMail($phpmailer, $from, $to, $subject, $body) {

        $phpmailer->IsSMTP();                                     
        $phpmailer->set('Host','127.0.0.1');    
        $phpmailer->set('Port','1025'); 
        $phpmailer->set('From',$from); 
        $phpmailer->AddAddress($to);  
        $phpmailer->IsHTML(true);                                  
        $phpmailer->set('Subject',$subject); 
        $phpmailer->set('Body',$body); 

        $result = $phpmailer->Send();
        if(!$result) {
           return 'Message could not be sent.';
        }
        
        return $result;
    }
    
}
