<?php

class Post extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getLatest($num) {
        
        $sql = 'SELECT u.name, u.email, up.title, up.post, up.edited '
                . ' FROM user u JOIN user_post up ON u.id = up.id_user '
                . ' ORDER BY up.edited DESC LIMIT ' .  $this->db->escape($num);
        return $this->db->query($sql)->result_array();
        
    }
}

