<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Branch.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $branch = new Branch($db);

    $branch->branch_id = isset($_GET['id']) ? $_GET['id'] : die();

    $branch->read_single();

    //create array
    $branch_array = array(
        'status' => 0,
        'message' => 'success',
        'id' => $branch->branch_id,
        'branch_name' => $branch->branch_name,
        
    );

    print_r(json_encode($branch_array));