<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Agent.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $agent = new Agent($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));
    $agent->email = $data->email;
    $agent->password = $data->password;

    if($agent->login()){
        //create array
        $agent_array = array(
            'status' => 0,
            'message' => 'success',
            'id' => $agent->agent_id,        
            'agent_name' => $agent->agent_name,
            'email' => $agent->email,
            'contact_address' => $agent->contact_address,
            'phone_no' => $agent->phone_no
            
        );

        print_r(json_encode($agent_array));

    }else{
        print_r(json_encode(array("status"=> 1, "message"=>"Email or password invalid.")));
    }

    