<?php

require_once 'classes/help.php';
require_once 'classes/common.php';

class HelpController{

    private $help = null;

    public static function fetch(){
        $help = new Help();
        return $help->fetchHelp();

    }

    public static function fetchSingle(int $id){
        $help = new Help();
        return $help->fetchone($id);
    }
}

$action =$_REQUEST['action'] ?? 'fetch';

switch($action){
    case 'fetch':
        Common::setHeaders();
        echo json_encode(HelpController::fetch());
        break;
    case 'fetchone':
        Common::setHeaders();
        $id = $_GET['id'] ?? 1;
        echo json_encode(HelpController::fetchSingle($id));
        break;  
}