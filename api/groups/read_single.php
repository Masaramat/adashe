<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Group.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $group = new Group($db);

    $data = json_decode(file_get_contents("php://input"));

    $group->parameter = isset($_GET['column']) ? $_GET['column'] : die();
    $group->value = isset($_GET['value']) ? $_GET['value'] : die();

    $result = $group->read_single();

     //row count
     $num = $result->rowCount();

     //check if we have loan group
     if($num>0){
         //groups array
         $groups_arr = array();
         $groups_arr['status'] = 0;
         $groups_arr['message'] = 'success';
         $groups_arr['data'] = array();
 
         while($row = $result->fetch(PDO::FETCH_ASSOC)){
             extract($row);
             $group = array(
                 'group_id' => $sno,
                 'group_name' => $group_name,
                 'lcc_name' => $lcc_name,
                 'rcc_name' => $rcc_name,
                 'agent_name' => $agent_name,
                 'agent_email' => $agent_email                 
             );
 
             //push data into groups array
             array_push($groups_arr['data'], $group);
 
         }
         //Turn array to JSON
         print_r(json_encode($groups_arr));
     }else{
         //No group
         print_r(json_encode(array("status"=>1, "message"=>"No groups found.")));
     }

    