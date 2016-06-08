<?php

class Post extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getPost($id){
        $sql = 'SELECT u.name AS editor_name, u.email AS editor_email, p.id, '
                . ' p.title, p.body, p.image, p.edited '
                . ' FROM user u JOIN post p ON u.id = p.id_user '
                . ' WHERE p.id=' . $this->db->escape($id);
        return $this->db->query($sql)->row_array();
    } 
            
    public function getLatestPosts($num) {
        $sql = 'SELECT u.name AS editor_name, u.email AS editor_email, p.id, '
                . ' p.title, p.body, p.image, p.edited '
                . ' FROM user u JOIN post p ON u.id = p.id_user '
                . ' ORDER BY p.edited DESC LIMIT ' .  $this->db->escape($num);
        return $this->db->query($sql)->result_array();
    }
    
    public function getPostsForUser($id_user) {
        $sql = 'SELECT * FROM post '
                . ' WHERE id_user = '. $this->db->escape($id_user)
                . ' ORDER BY edited DESC';
        return $this->db->query($sql)->result_array();
    }
    
    public function addPost($data) {
        $db_data["id_user"] = $data["id_user"];
        $db_data["title"] = $data["title"];
        $db_data["body"] = $data["post"];
        $db_data["body"] = nl2br($db_data["body"]);
        $this->db->trans_start();
        
        $this->db->insert('post', $db_data);
        $id_post = $this->db->insert_id();
        
        $image_name = $id_post . '_' . $data["image_name"];
        $this->db->where('id',$id_post)->update('post', ["image"=>$image_name]);
        
        $this->db->trans_complete();
        return $image_name;
    }
    
    public function deletePost($id){
        $this->db->where('id', $id)->delete("post");
    }
}

