<?php
require_once 'classes/Product.php';
require_once 'classes/common.php';

class ProductController{
    private $item = null;

    public static function fetch(){
        $product = new Products();
        return $product->fetchProduct();
    }

    public static function details(int $id){
        $product = new Products();
        return $product->detailProduct($id);
    }

    public static function categoryDetails(int $category){
        $product = new Products();
        return $product->detailCategory($category);
    }

}

$action = $_REQUEST['action'] ?? 'fetch';

switch($action){
    case 'fetch':
        Common::setHeaders();
        echo json_encode(ProductController::fetch());
        break;
    case 'fetchone':
        Common::setHeaders();
        $id = $_GET['id'] ?? 1;
        echo json_encode(ProductController::details($id));
        break;
    case 'fetchcategory':
        Common::setHeaders();
        $category = $_GET['category'] ?? 1;
        echo json_encode(ProductController::categoryDetails($category));
        break;    
}