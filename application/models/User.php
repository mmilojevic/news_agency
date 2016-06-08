<?php

class User extends CI_Model {


    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getActiveUserIfExists($email, $password) {
        $query = "SELECT 'id_' || id as uid, name, email
                  FROM user
                  WHERE email=" . $this->db->escape($email)
                  . " AND password=" .  $this->db->escape(md5($password)) 
                  . " AND active ='t';";

      return $this->db->query($query)->row_array();
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
        $this->db->where('id', $data["id"])
                ->update('user', [
                    "password" => $data["password"],
                    "active" => 't'
                        ]);
        return true;
    }
    
    public function sendMail($from, $to, $subject, $body) {
        $this->load->library('PHPMailer/phpmailer');

        $this->phpmailer->IsSMTP();                                     
        $this->phpmailer->set('Host','127.0.0.1');    
        $this->phpmailer->set('Port','1025'); 
        $this->phpmailer->set('From',$from); 
        $this->phpmailer->AddAddress($to);  
        $this->phpmailer->IsHTML(true);                                  
        $this->phpmailer->set('Subject',$subject); 
        $this->phpmailer->set('Body',$body); 

        if(!$this->phpmailer->Send()) {
           return 'Message could not be sent.';
        }
        
        return true;
    }
    
}
