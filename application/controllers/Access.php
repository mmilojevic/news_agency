<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Access extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function login() {
        $data["title"] = 'Login';
        $data["page_title"] = 'Login';
        $data["jscripts"] = [JS_PATH ."access/Login.js"];
        
        $data['initializes'] = [
            "Login" => [""]
        ];
        
        $data["pages"] = [
            'access/login'
        ];
        $this->load->view('template/default', $data);
    }
    
    public function processLogin() {
        $post = $this->input->post();
        if (isset($post["email"]) === false || isset($post["name"]) === false){
                    ajax_result_error(ERROR_MISSING_PARAMETAR);
        }

        $this->load->model('user');
        $user = $this->user->check($post["email"], $post["password"]);

        if (count($user) !== 0) {
            CurrentUser::set($user);
        }
        else{
            ajax_result_error("Email ili šifra nisu u redu!");
        }

    }
    
    public function logout() {
        CurrentUser::destroy();
        redirect(WWW_PATH . 'access/login');
    }

    public function register() {
        $this->load->model('user');
        $data["title"] = 'Registration';
        $data["page_title"] = 'Registration';
        $data["jscripts"] = [
            JS_PATH ."access/Register.js"
            ];
                
        $data['initializes'] = [
            "Register" => [],
        ];
        
        $data["pages"] =[
            'access/register'
        ];
        $this->load->view('template/default', $data);
    }

    public function processRegister() {
        $post = $this->input->post();
        if (isset($post["name"]) === false || isset($post["email"]) === false){
                ajax_result_error(ERROR_MISSING_PARAMETAR);
                return;
        }

        $this->load->model('user');
        $this->load->library('email');

        //insert user
        $result = $this->user->createNewUser($post);

        if (is_string($id_user)){
            ajax_result_error($id_user);
        }
        else{
            $post["id"] = $result;
        }
        
        $body = $this->load->view('mail/registration', $post);
        $this->user->sendMail('info@news.loc', 
                'News Agency', 
                $post['email'], 
                'Registration Confirmation',
                $body);
    }
    
    public function updatePassword($id) {
        
    }

}
