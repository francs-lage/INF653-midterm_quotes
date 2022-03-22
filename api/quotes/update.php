<?php  
// Headers   (>>>>> 2nd video: min 2'25" <<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

// Set to update
$quote_obj->id = $data->id;
$quote_obj->quote = $data->quote;
$quote_obj->authorId = $data->authorId;
$quote_obj->categoryId = $data->categoryId;

// Update quote
if($quote_obj->update()){
    echo json_encode(array('message' => 'Quote Updated'));
} else {
    echo json_encode(array('message' => 'Quote not Updated'));
}
/* (>>>>>>> 3nd video: ends min 3'40" next test on Postman and delete function <<<<<<)*/