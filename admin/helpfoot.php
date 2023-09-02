<?php

use HelpController as GlobalHelpController;

require_once '../classes/Product.php';
require_once '../classes/Database.php';
require_once '../classes/common.php';
require_once '../classes/Response.php';
require_once '../classes/Request.php';

class HelpController
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
        if (!isset($values['content']) || empty($values['content'])) {
            self::$error['content'] = "It is not valid";
        }
        return empty(self::$error) ?? false;
    }

    public static function setInsert(array $values)
    {
        if (self::validate($values) === false) {
            return Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->insert('help', $values)->query();
        return Response::success("New help Inserted Successfully!");
    }

    public static function setUpdate(int $id, array $values)
    {
        if (self::validate($values) === false) {
            return Response::fail(self::$error);
        }

        $db = DB::getObject();
        $data = $db->update('help', $id, $values)->query();
        return Response::success("New help Updated Successfully!");
    }

    public static function setDelete(int $id)
    {
        if (!$id) {
            return self::$error = "Id is null";
        }

        $db = DB::getObject();
        $data = $db->delete('help', $id)->query();

        return Response::success("A Row Deleted Successfully!");
    }
}

$action = $_REQUEST['action'];

switch ($action) {
    case 'insert':
        $data = Request::getPost() ?? [];
        GlobalHelpController::setInsert($data);
        break;
    case 'update':
        $id = $_GET['id'];
        $data = Request::getPost() ?? [];
        GlobalHelpController::setUpdate($id, $data);
        break;
    case 'delete':
        $id = $_GET['id'];
        GlobalHelpController::setDelete($id);
        break;
}
