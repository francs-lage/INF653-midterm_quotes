<?php
// Headers   (>>>> 2nd Video: 5'30" <<<<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote_obj = new Quote($db);

// Get ID
$quote_obj->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get quote
$quote_obj->read_single();

// Print results
if (isset($quote_obj->id)){
    // Create array
    $quote_arr = array(
        'id'       => $quote_obj->id,
        'quote'    => $quote_obj->quote,
        'author'   => $quote_obj->author,
        'category' => $quote_obj->category
    );
    // Make JSON
    print_r(json_encode($quote_arr));
}else{
    // No Quotes
    echo json_encode(array('message' => 'QuoteId not Found'));
}
/* ( ends 9'40", next: test on postman and create on Quote.php )*/