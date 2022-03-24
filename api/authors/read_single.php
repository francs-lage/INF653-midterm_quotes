<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$author_obj = new Author($db);

// Get ID
$author_obj->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get quote
$author_obj->read_single();

// Verify if id exist in DB
if (isset($author_obj->id)){
    // Create array
    $author_arr = array(
        'id'       => $author_obj->id,
        'author'   => $author_obj->author
    );
    // Print result in JSON format
    print_r(json_encode($author_arr));
}else{     
    echo json_encode( array('message' => 'authorId Not Found'));
}
