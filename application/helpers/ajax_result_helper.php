<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('ajax_result_error')) {

    function ajax_result_error($message) {
        echo json_encode(array(
            'error' => TRUE,
            'error_message' => $message
        ));
    }

}

if (!function_exists('ajax_result_xss_error')) {

    function ajax_result_xss_error() {
        echo json_encode(array(
            'error' => TRUE,
            'error_message' => 'HTML is not allowed!'
        ));
    }

}

if (!function_exists('ajax_result_ok')) {

    function ajax_result_ok($message, $data = NULL) {
        echo json_encode(array(
            'error' => FALSE,
            'message' => $message,
            'data' => $data
        ));
    }

}
