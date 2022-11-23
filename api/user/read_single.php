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

    $user->user_id = isset($_GET['id']) ? $_GET['id'] : die();

    $user->read_single();

    //create array
    $user_array = array(
        'status' => 0,
        'message' => 'success',
        'id' => $user->user_id,        
        'user_name' => $user->user_name,
        'password' => md5($user->password),
        'name' => $user->name
        
    );

    print_r(json_encode($user_array));