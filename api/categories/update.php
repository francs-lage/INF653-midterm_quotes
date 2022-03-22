<?php  
// Headers   (>>>>> 2nd video: min 2'25" <<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

// Set to update
$category_obj->id = $data->id;
$category_obj->category = $data->category;

// Update category
if($category_obj->update()){
    echo json_encode(
        array('message' => 'Category updated')
    );
} else {
    echo json_encode(
        array('message' => 'Category not updated')
    );
}