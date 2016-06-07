<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Internal extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function myPosts() {
        $this->load->model('post');
        $this->load->helper('string');
        $data["posts"] = $this->post->getPostsForUser(CurrentUser::getUid());
        $data["title"] = 'My Posts';
        $data["page_title"] = 'My Posts';
        $data["jscripts"] = [JS_PATH ."internal/My_post.js"];
        
        $data['initializes'] = [
            "My_post" => [""]
        ];
        
        $data["pages"] = [
            'internal/my_posts'
        ];
        $this->load->view('template/default', $data);
    }
    
    public function addPost() {
        $this->load->model('post');
        $data = $this->input->post();
        $data["image_name"] =  $_FILES["image"]["name"];
        $new_image_name = $this->post->addPost($data);
        
        $tmp_name = $_FILES["image"]["tmp_name"];
        move_uploaded_file($tmp_name, UPLOAD_PATH . $new_image_name);
        
        redirect(WWW_PATH . 'internal/myPosts');
    }
    
    public function deletePost() {
        $this->load->model('post');
        $id = $this->input->post('id');
        $this->post->deletePost($id);
        
        redirect(WWW_PATH . 'internal/myPosts');
    }
    
}