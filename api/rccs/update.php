<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/Rcc.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $rcc = new Rcc($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $rcc->rcc_id = $data->rcc_id;
    $rcc->rcc_name = $data->rcc_name;
    $rcc->rcc_location = $data->rcc_location;
    $rcc->agent_id = $data->agent_id;

    if($rcc->update()){
        echo json_encode(
            array("message"=>"rcc Updated")
        );
    }else{
        echo json_encode(
            array("message"=>"rcc Not Updated")
        );
    }