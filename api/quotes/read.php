<?php
// Headers   starts 21:00
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote_obj = new Quote($db);

// Blog quote query
$result = $quote_obj->read();

// Get row count
$num = $result->rowCount();

//check if any quotes   time 25:00
if($num > 0){
    $quotes_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $quote_item = array(
            'id' => $id,
            'quote' => html_entity_decode($quote),
            'author' => $author,
            'category' => $category
        ); 
        array_push($quotes_arr,$quote_item);
    }
    // Turn to JSON & output
    echo json_encode($quotes_arr);

}else {
    echo json_encode( array('message' => 'No Quotes Found'));
}