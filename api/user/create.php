<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/User.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();
    $password = "";

    //instantiate loan application object
    $user = new User($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));
    $user->name = $data->name;
    $user->user_name = $data->username;
    $user->password = md5($data->password);

    if($user->create()){
        echo json_encode(
            array("message"=>"User Created")
        );
    }else{
        echo json_encode(
            array("message"=>"User Not Created")
        );
    }