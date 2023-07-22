<?php

require_once 'database.php';

class Help{

    private $db = null;

    public function __construct()
    {
        $this->db = DB::getObject();     
    }

    public function fetchHelp(){
        return $this->db->select('help')
                        ->query();
    }

    public function fetchone(int $id) {
        return $this->db->selectOne('help',$id)
                        ->query();
        
    }
}