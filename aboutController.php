 <?php
require_once 'classes/about.php';
require_once 'classes/common.php';

class AboutController{
    private $about = null;
     
    public static function fetch(){
        $about = new About();
       return $about->fetchAbout();
    }
    public static function fetchSingle(int $id){
        $about = new About();
       return $about->fetchOne($id);
    }
}

$action =$_REQUEST['action'] ?? 'fetch';

switch($action){
    case 'fetch':
        Common::setHeaders();
        // print_r(json_encode(urlencode( aboutController::fetch())));
        echo json_encode(aboutController::fetch());
        break;
    case 'fetchone':
        Common::setHeaders();
        $id = $_GET['id'] ?? 1;
        echo json_encode(aboutController::fetchSingle($id));
        break;
}


