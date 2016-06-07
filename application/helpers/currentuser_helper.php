<?php
/**
 * Description of currentUser
 *
 *
 */
class CurrentUser {

    public static function logged(){
        return self::getUid() !== '';
    }

    public static function get(){
        $CI =get_instance();
        return $CI->session->userdata();
    }

    public static function getUid(){
        $CI =get_instance();
        $id = $CI->session->userdata('uid');
        $id = str_replace('id_', '', $id);
        return $id;
    }
    public static function getName(){
        $CI =get_instance();
        return $CI->session->userdata('name');
    }
    public static function getEmail(){
        $CI =get_instance();
        return $CI->session->userdata('email');
    }

    public static function set($array){
        $CI =get_instance();
        return $CI->session->set_userdata($array);
    }
    
    public static function unset_data($array){
        $CI =get_instance();
        return $CI->session->unset_userdata($array);
    }
    
    public static function destroy(){
        $CI =get_instance();
        $CI->session->sess_destroy();
    }

}