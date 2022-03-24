<?php  
// Headers   (>>>>> 2nd video: min 16'20" <<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author_obj = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Insert data into object
$author_obj->author = $data->author;

// testing for missing parameters
if (isset($author_obj->author)){

    // Create new author entry
    if($author_obj->create()){
        echo json_encode( array('message' => 'Author created'));
    } else {
        echo json_encode( array('message' => 'Author not created'));
    }
}else {
    echo json_encode( array('message' => 'Missing Required Parameters'));
}