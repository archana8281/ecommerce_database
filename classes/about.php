 <?php
require_once 'database.php';
class About {
   private $_id;
    public $name;
    public $content;
    public $slug;
   private $db = null;


   public function __construct()
   {
       $this->db = DB::getObject();
       
      
   }
   public function fetchAbout(){
      return $this->db->select('about')->query();
  }

  public function fetchOne(int $id){
    return $this->db->selectOne('about', $id)->query();
}
} 


