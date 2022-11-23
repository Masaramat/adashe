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

    //loan application query
    $result = $branch->read();

    //row count
    $num = $result->rowCount();

    //check if we have loan application
    if($num>0){
        //applications array
        $branch_arr = array();
        $branch_arr['status'] = 0;
        $branch_arr['message'] = 'success';
        $branch_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $branch = array(                
                'branch_id' => $branch_id,                
                'branch_name' => $branch_name
            );

            //push data into applications array
            array_push($branch_arr['data'], $branch);

        }
        //Turn array to JSON
        echo json_encode($branch_arr);
    }else{
        //No application
        echo json_encode(
            array('message' => 'No application Available')
        );
    }