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
        $data = $this->input->post();
        if (isset($data["email"]) === false || isset($data["password"]) === false){
                    ajax_result_error(ERROR_MISSING_PARAMETAR);
                    return;
        }

        $this->load->model('user');
        $user_exists = $this->user->checkIfUserExists($data["email"], $data["password"]);

        if ($user_exists) {
            CurrentUser::set($user);
            ajax_result_ok('You are successfully logged in!');
        }
        else{
            ajax_result_error("Email or password are not correct!");
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
        $data = $this->input->post();
        if (isset($data["name"]) === false || isset($data["email"]) === false){
                ajax_result_error(ERROR_MISSING_PARAMETAR);
                return;
        }

        $this->load->model('user');

        //insert user
        $result = $this->user->createNewUser($data);

        if (is_string($result)){
            ajax_result_error($result);
            return;
        }
        else{
            $data["id"] = $result;
        }
        
        $body = $this->load->view('mail/registration', $data, true);
        $this->user->sendMail('info@news.loc', 
                $data['email'], 
                'Registration Confirmation',
                $body);
        
        ajax_result_ok('Mail is sent to your address. PLease confirm registration!');
    }
    
    public function registrationConfirm($id) {
        $this->load->model('user');
        $data["title"] = 'Registration Confirm';
        $data["page_title"] = 'Registration Confirm';
        $data["jscripts"] = [
            JS_PATH ."access/RegistrationConfirm.js"
            ];
                
        $data['initializes'] = [
            "RegistrationConfirm" => [$id],
        ];
        
        $data["pages"] =[
            'access/registration_confirm'
        ];
        $data["id"] = $id;
        $this->load->view('template/default', $data);
    }
    
    public function processRegistrationConfirm() {
        $data = $this->input->post();
        if (isset($data["password"]) === false || isset($data["id"]) === false){
                ajax_result_error(ERROR_MISSING_PARAMETAR);
                return;
        }

        $this->load->model('user');
        $data["password"] = md5($data["password"]);
        $this->user->updatePassword($data);
        ajax_result_ok('You are successfully registered. You can now login!');
    }

}
