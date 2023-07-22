<?php
require_once '../classes/Product.php';

class ProductController{
    private $item = null;

    public static function update(){
        $item = new Products();
        $item->updateProduct();

    }

    public static function delete(){
        $item = new Products();
        $item->deleteProduct();

    }
}

$action = $_REQUEST['action'];

switch($action){
    case 'update':
        ProductController::update();
        break;
    case 'delete':
         ProductController::delete();
         break;
}