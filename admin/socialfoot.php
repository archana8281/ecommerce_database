<?php

use SocialController as GlobalSocialController;

require_once '../classes/Product.php';
require_once '../classes/Database.php';
require_once '../classes/common.php';
require_once '../classes/Response.php';
require_once '../classes/Request.php';

class SocialController
{
    private $db = null;
    static $error = null;

    function __construct()
    {
        $this->db = DB::getObject();
    }

    public static function validate(array $values)
    {
        if (!isset($values['name']) || empty($values['name'])) {
            self::$error['name'] = "It is not valid";
        }
        if (!isset($values['slug']) || empty($values['slug'])) {
            self::$error['slug'] = "It is not valid";
        }
        return empty(self::$error) ?? false;
    }

    public static function setInsert(array $values)
    {
        if (self::validate($values) === false) {
            return Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->insert('social', $values)->query();
        return Response::success("New social Inserted Successfully!");
    }

    public static function setUpdate(int $id, array $values)
    {
        if (self::validate($values) === false) {
            return Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->update('social', $id, $values)->query();
        return Response::success("New social Updated Successfully!");
    }

    public static function setDelete(int $id)
    {
        if (!$id) {
            return self::$error = "Id is null";
        }

        $db = DB::getObject();
        $data = $db->delete('social', $id)->query();

        return Response::success("A Row Deleted Successfully!");
    }
}

$action = $_REQUEST['action'];
switch ($action) {
    case 'insert':
        $data = Request::getPost() ?? [];
        GlobalSocialController::setInsert($data);
        break;
    case 'update':
        $id = $_GET['id'];
        $data = Request::getPost() ?? [];
        GlobalSocialController::setUpdate($id, $data);
        break;
    case 'delete':
        $id = $_GET['id'];
        GlobalSocialController::setDelete($id);
        break;
}
