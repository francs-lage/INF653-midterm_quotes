<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

// Verify the method called
$method = $_SERVER['REQUEST_METHOD'];
if     ($method == 'POST'  ) include 'create.php';
elseif ($method == 'PUT'   ) include 'update.php';
elseif ($method == 'DELETE') include 'delete.php';
elseif ($method == 'GET'   ){

    // Verify for arguments in the link case method is GET
    if (isset($_GET['id'])) include 'read_single.php';
    else include 'read.php';
}
else echo json_encode(array('message' => 'Fail to Identify Method'));