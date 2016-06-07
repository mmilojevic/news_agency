<?php

class Post extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getLatest($num) {
        $sql = 'SELECT u.name AS editor_name, u.email AS editor_email, up.id, '
                . ' up.title, up.body, up.image, up.edited '
                . ' FROM user u JOIN user_post up ON u.id = up.id_user '
                . ' ORDER BY up.edited DESC LIMIT ' .  $this->db->escape($num);
        return $this->db->query($sql)->result_array();
    }
    
    public function getPostsForUser($id_user) {
        $sql = 'SELECT * FROM user_post '
                . ' WHERE id_user = '. $this->db->escape($id_user);
        return $this->db->query($sql)->result_array();
    }
    
    public function addPost($data) {
        $db_data["id_user"] = CurrentUser::getUid();
        $db_data["title"] = $data["title"];
        $db_data["body"] = $data["post"];
        $db_data["body"] = nl2br($db_data["body"]);
        $this->db->trans_start();
        
        $this->db->insert('user_post', $db_data);
        $id_post = $this->db->insert_id();
        
        $image_name = $id_post . '_' . $data["image_name"];
        $this->db->update('user_post', ["image"=>$image_name]);
        
        $this->db->trans_complete();
        return $image_name;
    }
    
    public function deletePost($id){
        $this->db->where('id', $id)->delete("user_post");
    }
}

