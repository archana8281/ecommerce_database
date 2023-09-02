<?php

use CategoryController as GlobalCategoryController;

require_once '../classes/Category.php';
require_once '../classes/Database.php';
require_once '../classes/common.php';
require_once '../classes/Response.php';
require_once '../classes/Request.php';

class CategoryController {

    private $model = null;
    private $db = null;
    static $error = null;

    function __construct()
    {
        $this->db = DB::getObject();
    } 
       
    public static function validate(array $values){
      if(! isset($values["name"]) || empty($values["name"])){
        self::$error["name"] = "it is not  valid";
      }
      
      if(! isset($values["slug"]) || empty($values["slug"])){
        self::$error["slug"] = "it is not valid";
      }

      return empty(self::$error) ?? false;
    }
    
    public static function edit(int $id, array $values){
        // print_r($values);
        // die();
        if(self::validate($values) === false) {
            
            return Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->update('category', $id, $values)->query();

        return Response::success("New Category Updated Successfully!");
    }

    public static function deleteOne(int $id)
    {
        if(! $id){
           return self::$error = "Id is null";
        }

        $db = DB::getObject();
        $data = $db->delete('category', $id)->query();

        return Response::success("A Row Deleted Successfully!");                   
    }

    public static function setInsert(array $values){
        if(self::validate($values) === false) {
            return Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->insert('category', $values)->query();
        
        return Response::success("New Category Inserted Successfully!");
    }
}

$action = $_REQUEST['action'] ?? 'delete';

switch ($action) {
    case 'delete':
        Common::setHeaders();
        $id = $_GET['id'] ;
        echo json_encode(CategoryController::deleteOne($id));
        break;
    case 'insert':
        // Common::setHeaders();
        $data = Request::getPost() ?? [];
        CategoryController::setInsert($data);
        break;
    case 'edit':      /*print_r($_GET); die;*/
        Common::setHeaders();
        $id = $_GET['id'] ;
        $data = Request::getPost() ?? [];
        CategoryController::edit($id, $data);
        break;

}
