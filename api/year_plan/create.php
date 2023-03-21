<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/YearPlan.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $year_plan = new YearPlan($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));
    $year_plan->group_id = $data->group_id;
    $year_plan->startweek = $data->startweek;
    $year_plan->share_value = $data->share_value;
    $year_plan->welfare = $data->welfare;
    $year_plan->status = $data->status;
    $year_plan->members = $data->members;

    if($year_plan->create()){
        print_r($year_plan->members);
    }else{
        echo json_encode(
            array("message"=>"Branch Not Created")
        );
    }