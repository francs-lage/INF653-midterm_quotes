<?php  
// Headers   (>>>>> 2nd video: min 16'20" <<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

// Place data into object
$quote_obj->quote = $data->quote;
$quote_obj->authorId = $data->authorId;
$quote_obj->categoryId = $data->categoryId;

// testing for missing parameters
if (isset($quote_obj->quote) && isset($quote_obj->authorId) && isset($quote_obj->categoryId)){

    // Create new quote
    if($quote_obj->create()){
        echo json_encode(array('message' => 'Quote Created'));
    } else {
        echo json_encode(array('message' => 'Quote not Created')
        );
    }
}else {
    echo json_encode( array('message' => 'Missing Required Parameters'));
}

/* (>>>>>>> 2nd video: ends min 22'10" next test on Postman <<<<<<)*/