<?php
require_once 'Database.php';
class Products {
    private $_id ;
    public $category ;
    public $description ;
    public $image ;
    public $offer ;
    public $price ;
    public $text ;
    private $db = null;

    function __construct( ){
        $this->db = DB::getObject();
    }

    function fetchProduct(){
        return $this->db->select('products')
            ->query();
    }

    function detailProduct(int $id ){
        return $this->db->selectOne('products', $id )
            ->query();
    }

    function detailCategory(int $category){
        return $this->db->selectCategoryproduct('products', $category)
            ->query();
    }
    function addProduct(){
        
    }
    function updateProduct(){
        echo " product one";
    }
    function deleteProduct(){
        echo " product ";
        
    }
}
