<?php

require_once 'classes/social.php';
require_once 'classes/common.php';

class SocialController{

    private $social = null;

    public static function fetch(){
        $social = new Social();
        return $social->fetchSocial();
    }

    public static function fetchSingle(int $id){
        $social = new Social();
        return $social->fetchone($id);
    }
}

$action = $_REQUEST['action']?? 'fetch';

switch($action){
    case 'fetch':
        Common::setHeaders();
        echo json_encode(SocialController::fetch());
        break;
    case 'fetchone':
        Common::setHeaders();
        $id = $_GET['id'] ?? 1;
        echo json_encode(SocialController::fetchSingle($id));
}