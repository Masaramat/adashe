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

    //loan application query
    $result = $location->read();

    //row count
    $num = $result->rowCount();

    //check if we have loan application
    if($num>0){
        //applications array
        $location_arr = array();
        $location_arr['status'] = 0;
        $location_arr['message'] = 'success';
        $location_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $location = array(                
                'location_id' => $location_id,                
                'location_name' => $location_name,
                'branch_name' => $branch_name,
                'user_name' => $name
            );

            //push data into applications array
            array_push($location_arr['data'], $location);

        }
        //Turn array to JSON
        echo json_encode($location_arr);
    }else{
        //No application
        echo json_encode(
            array('message' => 'No application Available')
        );
    }