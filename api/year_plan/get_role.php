<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/YearPlan.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $role = new YearPlan($db);

    //loan group query
    $result = $role->read_roles();

    //row count
    $num = $result->rowCount();

    //check if we have loan group
    if($num>0){
        //groups array
        $roles_arr = array();
        $roles_arr['status'] = 0;
        $roles_arr['data'] = array();
        
           

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $role = array(
                'role_id' => $id,
                'position' => $position           
            );

            //push data into roles array
            array_push($roles_arr['data'], $role);

        }
        //Turn array to JSON
        echo json_encode($roles_arr);
    }else{
        //No group
        echo json_encode(
            array('status'=>1, 'message' => 'No group Available')
        );
    }