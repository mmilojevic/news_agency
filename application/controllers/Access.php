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
        $res = $this->user->createNewUser($post);

        $body = $this->load->view('mail/register', $post, true);
        //send mail
        $this->email->from('root@news.loc', 'Milos Milojevic');
        $this->email->to('milos1234@gmail.com');

        $this->email->subject('Confirm Registration');
        $this->email->message($body);
        $res = $this->email->send();

        if ($res === true){
            ajax_result_ok('Ok.');
        }
        else{
            ajax_result_error('Sending mail failed!');
        }
    }

}
