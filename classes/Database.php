<?php 
class DB {
    private static $connection = null;
    private static $hostName = "localhost";
    private static $userName = "root"; 
    private static $password = "";
    private static $database = "ecommerce";

    private $query;
    private static $instance = null;

    private static $select = false;

    function __construct()
    {
       
    }

    public static function getObject(){
         self::$connection = mysqli_connect(self::$hostName, self::$userName, self::$password) or die("error");
         mysqli_select_db(self::$connection, self::$database);

         if(! self::$instance) {
            self::$instance = new DB;
         }

         return self::$instance;
    }

    public function query(){
        $result = mysqli_query(self::$connection, $this->query);
        if(self::$select) {
            while($row = mysqli_fetch_object($result)) {
                $rows[] = $row;
            }
           
            return $rows;
        }
        
        return $result;
    }
    
    public function insert($tableName , $values ){//$tableName = 'users', $values  = ['name' => 'Deena', 'age' => 23]
        self::$select = false;
      $this->query = "INSERT INTO $tableName ";
      $this->query .=  '(' ;
      $this->query .= $this->getKeys(array_keys($values)); 
      $this->query .= ')';  
      $this->query .= ' VALUES ';
      $this->query .= '(';
      $this->query .= $this->getValues(array_values($values));
      $this->query .= ')';

      return self::$instance;
    }

    public function update($tableName , $values  , $id )  {//$tableName = 'users', $values  = ['name' => 'Anna', 'age' => 21], $id = 2
        self::$select = false;
      $this->query = "UPDATE  $tableName SET ";
      $this->query .= $this->convertArray($values);
      $this->query .= " WHERE  id = $id ";

      return self::$instance;       
    }

    public function delete($tableName = 'users', $id = 4){//$tableName = 'users', $id = 4
        self::$select = false;
       $this->query = "DELETE FROM $tableName WHERE id = $id";

       return self::$instance;
    }

    public function select($tableName ){//$tableName = 'users'
        self::$select = true;
        $this->query = "SELECT * FROM $tableName";
        

        return self::$instance;
    }

    public function selectOne($tableName, int $id, array $values = []){//$tableName = 'users', int $id = 3 ,$values  = ['name' => 'Beena', 'age' => 23]
        self::$select = true;
        
        $this->query = "SELECT " ;
         $this->query .= $this->getKeys(array_keys($values)) ? empty($values) : '*';
         $this->query .= " FROM $tableName";
         $this->query .= " WHERE id = $id";
         return self::$instance;
    }

    public function selectCategoryproduct($tableName,int $category, array $values = []){//$tableName = 'users', int $id = 3 ,$values  = ['name' => 'Beena', 'age' => 23]
        self::$select = true;
        
        $this->query = "SELECT " ;
         $this->query .= $this->getKeys(array_keys($values)) ? empty($values) : '*';
         $this->query .= " FROM $tableName";
         $this->query .= " WHERE category = $category";
         return self::$instance;
    }


    private function getValues(array $values){
        $query = null;

        foreach($values as $key => $value){
            array_key_first($values) === $key ? 
                $query .= "'$value'" : 
                $query .= ", '$value'";
        }
        return $query;
    }

    private function getKeys(array $keys){
       return implode(", ", $keys);
    }

    private function convertArray(array $Convert){
        $query = [];
        foreach($Convert as $key=>$value){
            $query[] .= "$key = '$value'";
        }
        return implode(", ", $query);
     }

}

/* 
//   DB::getObject()
//   ->select( 'about' ,['name' => 'Anna', 'content' => '21','slug'=>'hfgfg'])
//  ->query();

*/