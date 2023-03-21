<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Rcc.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $rcc = new rcc($db);

    $rcc->rcc_id = isset($_GET['id']) ? $_GET['id'] : die();

    $data = $rcc->read_single();


    if($data){
        //create array
        $rcc_array = array(
            'status' => 0,
            'message' => 'success',
            'id' => $rcc->rcc_id,        
            'rcc_name' => $rcc->rcc_name,
            'rcc_location' => $rcc->rcc_location,
            'agent_name' => $rcc->agent_name,
            'agent_email' => $rcc->agent_email
            
        );

        print_r(json_encode($rcc_array));

    }else{
        print_r(json_encode(array("status" => 0, "message" => "No data")));
    }

    