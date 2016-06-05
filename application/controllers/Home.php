<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('post');
        $data["posts"] =$this->post->getLatest(10);
        
        $data["title"] = 'News';
        $data["jscripts"][0] = JS_PATH ."home/Home.js";
        $data['initializes']["Home"] = [''];
        $data['pages'] =[
            'home/v_home.php'
        ];
        
        $this->load->view('template/default', $data);
    }
    
    
}