<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

$method = $_SERVER['REQUEST_METHOD'];
if     ($method == 'POST'  ) include 'create.php';
elseif ($method == 'PUT'   ) include 'update.php';
elseif ($method == 'DELETE') include 'delete.php';
elseif ($method == 'GET'   ){

    // Verify which arguments are in the link
    if (isset($_GET['id'])) $varId = true;
    else $varId = false;
    if (isset($_GET['authorId'])) $varAuthorId = true;
    else $varAuthorId = false;
    if (isset($_GET['categoryId'])) $varCategoryId = true;
    else $varCategoryId = false;

    // route to a specific file according to the combination of arguments
    if ($varId) include 'read_single.php';
    elseif ( $varAuthorId && !$varCategoryId) include 'read_author.php';
    elseif (!$varAuthorId &&  $varCategoryId) include 'read_category.php';
    elseif ( $varAuthorId &&  $varCategoryId) include 'read_comb.php';
    else include 'read.php';
}
else echo json_encode(array('message' => 'Fail to Identify Method'));