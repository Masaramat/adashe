<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/User.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $user = new User($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $user->user_id = $data->id;
    $user->user_name = $data->username;
    $user->name = $data->name;
    $user->password = md5($data->password);

    if($user->update()){
        echo json_encode(
            array("message"=>"User Updated")
        );
    }else{
        echo json_encode(
            array("message"=>"User Not Updated")
        );
    }