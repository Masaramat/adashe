<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Rcc.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $rcc = new Rcc($db);

    //loan application query
    $result = $rcc->read();

    //row count
    $num = $result->rowCount();

    //check if we have loan application
    if($num>0){
        //applications array
        $rcc_array = array();
        $rcc_array['status'] = 0;
        $rcc_array['message'] = 'success';
        $rcc_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $rcc = array(                
                'rcc_id' => $sno,                
                'rcc_name' => $rcc_name,
                'rcc_location' => $rcc_location,
                'agent_name' => $agent_name,
                'agent_email' => $agent_email
            );

            //push data into applications array
            array_push($rcc_array['data'], $rcc);

        }
        //Turn array to JSON
        echo json_encode($rcc_array);
    }else{
        //No application
        echo json_encode(
            array('message' => 'No application Available')
        );
    }