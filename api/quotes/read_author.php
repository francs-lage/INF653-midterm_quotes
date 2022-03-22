<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate database and stablish connection
$database = new Database();
$db = $database->connect();

// Instantiate Quote object
$quote_obj = new Quote($db);

// Get ID
$quote_obj->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();

// author read query
$result = $quote_obj->read_author();

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
        // Push to "data" 
        array_push($quotes_arr,$quote_item);
    }
    // Turn to JSON & output
    echo json_encode($quotes_arr);

}else{
    echo json_encode(array('message' => 'authorId Not Found'));
}