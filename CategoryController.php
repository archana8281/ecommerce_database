<?php
require_once 'classes/Category.php';
require_once 'classes/common.php';


class CategoryController {
    private $model = null;

    public static function fetch(){
        $model = new Categories();
        return $model->fetchCategory();
    }

    public static function getOne(int $id){
        $model = new Categories();
        return $model->fetchOne($id);
    }

     public static function add(){
        $model = new Categories();
         $model->addCategory();
     }

    
}

$action = $_REQUEST['action']  ?? 'fetch';

switch($action){
    case 'fetch':
        Common::setHeaders();
        echo json_encode(CategoryController::fetch());
        break;
    case 'fetchone':
        Common::setHeaders();
        $id = $_GET['id'] ?? 1;
        echo json_encode(CategoryController::getOne($id));
        break;
    case 'add':
        CategoryController::add();
        break;
       
        
}
