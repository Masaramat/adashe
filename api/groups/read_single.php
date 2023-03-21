<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Group.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $group = new Group($db);

    $group->group_id = isset($_GET['id']) ? $_GET['id'] : die();

    $group->read_single();

    //create array
    $group_array = array(
        'status' => 0,
        'message' => 'success',
        'group_id' => $group->group_id,
        'group_name' => $group->group_name,
        'lcc_name' => $group->lcc_name,
        'rcc_name' => $group->rcc_name,
        'agent_name' => $group->agent_name,
        'agent_email' => $group->agent_email
    );

    print_r(json_encode($group_array));