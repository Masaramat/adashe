<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once "../../config/Database.php";
    include_once "../../models/LoanApplication.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $application = new LoanApplication($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $application->application_id = $data->id;
    
    //Delete Application
    if($application->delete()){
        echo json_encode(
            array("message"=>"Loan Deleted")
        );
    }else{
        echo json_encode(
            array("message"=>"Loan Not Deleted")
        );
    }