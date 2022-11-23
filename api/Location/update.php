<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/Location.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $location = new Location($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $location->location_id = $data->id;
    $location->location_name = $data->location_name;
    $location->branch_id = $data->branch_id;
    $location->user_id = $data->user_id;

    if($location->update()){
        echo json_encode(
            array("message"=>"Location Updated")
        );
    }else{
        echo json_encode(
            array("message"=>"Location Not Updated")
        );
    }