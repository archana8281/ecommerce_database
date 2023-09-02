<?php
require_once '../classes/Product.php';
require_once '../classes/Database.php';
require_once '../classes/common.php';
require_once '../classes/Response.php';
require_once '../classes/Request.php';

class ProductController
{
    private $db = null;
    static $error = null;

    function __construct()
    {
        $this->db = DB::getObject();
    }

    public static function validate(array $values)
    {
        if (!isset($values['category']) || empty($values['category'])) {
            self::$error['category'] = " It is not valid";
        }
        if (!isset($values['slug']) || empty($values['slug'])) {
            self::$error['slug'] = "It is not valid";
        }
        if (!isset($values['image']) || empty($values['image'])) {
            self::$error['image'] = "It is not valid";
        }
        if (!isset($values['currency']) || empty($values['currency'])) {
            self::$error['currency'] = "It is not valid";
        }
        if (!isset($values['price']) || empty($values['price'])) {
            self::$error['price'] = "It is not valid";
        }
        if (!isset($values['offer']) || empty($values['offer'])) {
            self::$error['offer'] = "It is not valid";
        }
        if (!isset($values['description']) || empty($values['description'])) {
            self::$error['description'] = "It is not valid";
        }
        if (!isset($values['text']) || empty($values['text'])) {
            self::$error['text'] = "It is not valid";
        }

        return empty(self::$error) ?? false;
    }

    public static function setInsert(array $values)
    {
        if (self::validate($values) === false) {
            return Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->insert('products', $values)->query();
        return Response::success("New Product Inserted Successfully!");
    }

    public static function setUpdate(int $id, array $values){

        if(self::validate($values) === false){
            return  Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->update('products', $id, $values)->query();
        return Response::success("New Product Updated Successfully!");
    }

    public static function setDelete(int $id){
        if(! $id){
            return self::$error= "Id is null";
        }

        $db = DB::getObject();
        $data = $db->delete('products', $id)->query();

        return Response::success("A Row Deleted Successfully!");     
    }
}

$action = $_REQUEST['action'];

switch ($action) {
    case 'insert':
        $data = Request::getPost() ?? [];
        ProductController::setInsert($data);
        break;
    case 'update':
        Common::setHeaders();
        $id = $_GET['id'];
        $data = Request::getPost() ?? [];
        ProductController::setUpdate($id, $data);
        break;    
    case 'delete':
        Common::setHeaders();
        $id = $_GET['id'] ?? 1;
        ProductController::setDelete($id);
        break;
}
