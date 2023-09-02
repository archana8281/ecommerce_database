<?php
class Common{

    public static function setHeaders(){
        header("Content-Type: application/json; charset=utf-8");
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: Content-Type');
        header("Access-Control-Allow-Methods: DELETE, GET, POST, PUT, OPTIONS");
    }

}