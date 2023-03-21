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

    //loan application query
    $result = $agent->read();

    //row count
    $num = $result->rowCount();

    //check if we have loan application
    if($num>0){
        //applications array
        $agent_array = array();
        $agent_array['status'] = 0;
        $agent_array['message'] = 'success';
        $agent_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $agent = array(                
                'user_id' => $sno,                
                'name' => $agent_name,
                'email' => $email,
                'password' => $password,
                'phone_no' => $phone_no
            );

            //push data into applications array
            array_push($agent_array['data'], $agent);

        }
        //Turn array to JSON
        echo json_encode($agent_array);
    }else{
        //No application
        echo json_encode(
            array('message' => 'No application Available')
        );
    }