<?php
class Response {
    public static function success($message){
        http_response_code(200);
        header("Content-Type: application/json; charset=utf-8");
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: Content-Type');
        header("Access-Control-Allow-Methods: DELETE, GET, POST, PUT");
        $respose['success'] = true;
        $respose['message'] = $message;
        echo json_encode($respose);
        exit;
        
    }

    public static function fail($errors){
        http_response_code(200);
        header("Content-Type: application/json; charset=utf-8");
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: Content-Type');
        header("Access-Control-Allow-Methods: DELETE, GET, POST, PUT");
        $respose['success'] = false;
        $respose['errors'] = $errors;
        echo json_encode($respose);
        exit;
    }
}