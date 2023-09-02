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

    function fetchOne(int $id ){
        return $this->db->selectOne('category', $id )
            ->query();
    }
}
