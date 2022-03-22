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

// I tried this firs t and It didn't work. I'm wondering why
//$data = json_decode(file_get_contents("php://input"));
//Set to update
//$quote_obj->authorId = $data->authorId;
//$quote_obj->authorId = $data->categoryId;

$quote_obj->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();
$quote_obj->categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : die();

// author read query
$result = $quote_obj->read_comb();

// Get row count
$num = $result->rowCount();

//check if any quotes
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
    echo json_encode(array('message' => 'No Quotes Found'));
}