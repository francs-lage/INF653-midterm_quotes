<?php  
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Set Id to delete
$category_obj->id = $data->id;

// testing for missing parameters
if (isset($category_obj->id)){

    // Delete category
    if($category_obj->delete()){
        echo json_encode( array('message' => 'Category deleted'));
    } else {
        echo json_encode( array('message' => 'Category not deleted'));
    }
}else {
    echo json_encode( array('message' => 'Missing Required Parameters'));
}