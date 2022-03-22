<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$category_obj = new Category($db);

// Get ID
$category_obj->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get quote
$category_obj->read_single();

// Verify if id exist in DB
if (isset($category_obj->id)){
    // Create array
    $category_arr = array(
        'id'       => $category_obj->id,
        'category' => $category_obj->category
    );
    // Print result in JSON format
    print_r(json_encode($category_arr));
}else{     
    echo json_encode( array('message' => 'CategoryId Not Found'));
}