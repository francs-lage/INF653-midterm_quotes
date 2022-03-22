<?php  
// Headers   (>>>>> 3nd video: 7'15" <<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote_obj = new Quote($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set Id to update
$quote_obj->id = $data->id;

// Delete quote
if($quote_obj->delete()){
    echo json_encode( array('message' => 'Quote deleted'));
} else {
    echo json_encode( array('message' => 'Quote not Deleted'));
}
/* (>>>>>>> 3nd video: ends 8'00" next test on Postman and starts with category <<<<<<)*/