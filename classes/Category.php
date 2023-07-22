<?php
require_once 'database.php';
class  Categories
{
    private $_id;
    public $name;
    public $slug;
    private $db = null;

    function __construct()
    {
        $this->db = DB::getObject();
        
       
    }
    function fetchCategory(){
        return $this->db->select('category')
            ->query();
    }
    function getCategory()
    {
        $f = new DB;
        $f->select('user');
        
    }
    function  getField(){
        $f = new DB;
        $f->selectOne( '' , '');
    } 
    function addCategory(){
        $f = new DB;
        $f->insert( $tableName = 'users', $values  = ['name' => '', 'age' => '']);
    }

    function updateCategory()
    {
        $f = new DB;
        $f->update('users',  ['name' => 'Neem', 'age' => 28], 6);
    }
    function deleteCategory()
    {
        $f = new DB;
        $f->delete();
    }
}
