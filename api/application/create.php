<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
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

    $application->surname = $data->surname;
    $application->othernames = $data->othernames;
    $application->bvn = $data->bvn;
    $application->phone = $data->phone;
    $application->address = $data->address;
    $application->account_no = $data->account_no;

    $application->tenor = $data->tenor;
    $application->loan_facility = $data->loan_facility;
    $application->amount_in_words = $data->amount_in_words;
    
    
    $application->business = $data->business;
    $application->purpose = $data->purpose;
    $application->sources_of_repayment = $data->sources_of_repayment;

    $application->location_id = $data->location_id;
    
    if($application->create()){
        echo json_encode(
            array("message"=>"Loan Created")
        );
    }else{
        echo json_encode(
            array("message"=>"Loan Not Created")
        );
    }