<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('post');
        $data["posts"] =$this->post->getAllForUser(CurrentUser::getUid());
        
        $data["title"] = 'My Posts';
        $data["jscripts"][0] = JS_PATH ."home/My_posts.js";
        $data['initializes']["My_posts"] = [''];
        $data['pages'] =[
            'home/my_posts.php'
        ];
        
        $this->load->view('template/default', $data);
    }
    
    
}