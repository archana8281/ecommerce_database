<?php

require_once 'Database.php';

class Social{

    private $db = null ;

    public function __construct() {

        $this->db = DB::getObject();
    }

    public function fetchSocial(){

        return $this->db->select('social')
                    ->query();
    }

    public function fetchone(int $id){

        return $this->db->selectOne('social' ,$id)
                    ->query();
    }
}