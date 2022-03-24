<?php  
// Headers   (>>>>> 2nd video: min 16'20" <<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category_obj = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$category_obj->category = $data->category;

// testing for missing parameters
if (isset($category_obj->category)){

    // Create category
    if($category_obj->create()){
        echo json_encode( array('message' => 'Category created'));
    } else {
        echo json_encode( array('message' => 'Category not created'));
    }
}else {
    echo json_encode( array('message' => 'Missing Required Parameters'));
}
