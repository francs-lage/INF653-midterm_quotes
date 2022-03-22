<?php
// Headers  (>>>>>>>  3nd.Video.starts 12'55" <<<<<<)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate database and stablish connection
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category_obj = new Category($db);

// category read query
$result = $category_obj->read();
// Get row count
$num = $result->rowCount();

//check if any categories    
if($num > 0){
    $category_arr = array();
    //$category_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item = array(
            'id' => $id,
            'category' => $category
        );
        // Push to "data"
        array_push($category_arr, $category_item); 
    }
    // Turn to JSON & output
    echo json_encode($category_arr);

}else {
    echo json_encode(array('message' => 'No Category found'));
}