<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/Branch.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $branch = new Branch($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $branch->branch_id = $data->id;
    $branch->branch_name = $data->branch_name;

    if($branch->update()){
        echo json_encode(
            array("message"=>"Branch Updated")
        );
    }else{
        echo json_encode(
            array("message"=>"Branch Not Updated")
        );
    }