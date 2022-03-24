<?php  
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

/* IF DATA IS WRONG? DATA VERIFICATION IS NEEDED */
// Insert data into object
$author_obj->id = $data->id;

// testing for missing parameters
if (isset($author_obj->id)){

    // Delete author
    if($author_obj->delete()){ /* THIS IS NOT WORKING PROPERLY */
        echo json_encode(array('message' => 'Author deleted'));
    } else {
        echo json_encode(array('message' => 'Author not Deleted'));
    }
}else {
    echo json_encode( array('message' => 'Missing Required Parameters'));
}
