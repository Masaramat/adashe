<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Location.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $location = new Location($db);

    $location->location_id = isset($_GET['id']) ? $_GET['id'] : die();

    $location->read_single();

    //create array
    $location_array = array(
        'status' => 0,
        'message' => 'success',
        'id' => $location->location_id,        
        'location_name' => $location->location_name,
        'branch_name' => $location->branch_name,
        'user_name' => $location->user_name,
        
    );

    print_r(json_encode($location_array));