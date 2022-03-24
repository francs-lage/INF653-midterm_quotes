<?php  
// Headers   (>>>>> 2nd video: min 2'25" <<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

// Set to update
$author_obj->id = $data->id;
$author_obj->author = $data->author;

// testing for missing parameters
if (isset($author_obj->author) && isset($author_obj->id)){

    // Update author
    if($author_obj->update()){
        echo json_encode(array('message' => 'Author updated'));
    } else {
        echo json_encode(array('message' => 'Author not updated'));
    }
}else {
    echo json_encode( array('message' => 'Missing Required Parameters'));
}