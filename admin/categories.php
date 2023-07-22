<?php

use CategoryController as GlobalCategoryController;

require_once '../classes/Category.php';

class CategoryController{
    private $model = null;

    public static function update()
    {
        $model = new Categories();
        $model->updateCategory();

        echo " it's updated";
    }

    public static function delete()
    {
        $model = new Categories();
        $model->deleteCategory();
    }
    
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'update':
        CategoryController::update();
        break;
    case 'delete':
        CategoryController::delete();    
}
