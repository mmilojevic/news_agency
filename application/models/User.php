<?php

class User extends CI_Model {


    public function __construct() {
        parent::__construct();
    }

    public function check($email, $password) {
        $db = Load_DB('psql');

        $query = "SELECT 'id_' || id as uid, name, email
                  FROM user_t
                  WHERE email=" . $db->escape($email)
                  . " AND password=" .  $db->escape(md5($password)) . ";";

      return $db->query($query)->row_array();
    }
    
    public function createNewUser($data) {
        $db = Load_DB('psql');

        $user_exists = $db->where('email', $data["email"])->get('user')->num_rows();
        if ($user_exists){
            return "User already exists!";
        }
        else{
            $user_data = $data;

            $db->insert('user',$user_data);
            $id_user =  $db->insert_id();

            //login user
            CurrentUser::set(array(
                "uid" => $id_user,
                "name" => $user_data["name"],
                "email" => $user_data["email"]
            ));
        }

        return (int)$id_user;
    }
    
    public function sendMail($from,$from_name, $to, $subject, $body) {
        $this->load->library('PHPMailer/class.phpmailer');
        
        $mail = new PHPMailer;

        $mail->isSendmail();                                      // Set mailer to use SMTP
        $mail->Host = 'localhost';                 // Specify main and backup server
        $mail->From = $from;
        $mail->FromName = $from_name;
        $mail->AddAddress($to);  // Add a recipient
        $mail->IsHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        if(!$mail->Send()) {
           return 'Message could not be sent.';
        }
        
        return true;
    }
    
}
