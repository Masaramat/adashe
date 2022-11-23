<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/User.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $user = new User($db);

    //loan application query
    $result = $user->read();

    //row count
    $num = $result->rowCount();

    //check if we have loan application
    if($num>0){
        //applications array
        $user_array = array();
        $user_array['status'] = 0;
        $user_array['message'] = 'success';
        $user_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user = array(                
                'user_id' => $user_id,                
                'name' => $name,
                'username' => $username,
                'password' => md5($password)
            );

            //push data into applications array
            array_push($user_array['data'], $user);

        }
        //Turn array to JSON
        echo json_encode($user_array);
    }else{
        //No application
        echo json_encode(
            array('message' => 'No application Available')
        );
    }