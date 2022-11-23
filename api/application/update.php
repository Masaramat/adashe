<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: PUT");
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

    $application->application_id = $data->application_id;
    $application->surname = $data->surname;
    $application->othernames = $data->othernames;
    $application->tenor = $data->tenor;
    $application->account_no = $data->account_no;
    $application->amount_in_words = $data->amount_in_words;
    $application->loan_facility = $data->loan_facility;
    $application->purpose = $data->purpose;
    $application->sources_of_repayment = $data->sources_of_repayment;
    $application->location_id = $data->location;
    $application->status = $data->status;
    $application->phone = $data->phone;
    $application->bvn = $data->bvn;
    $application->business = $data->business;
    $application->address = $data->address;
    


    if($application->update()){
        echo json_encode(
            array("message"=>"Loan Updated")
        );
    }else{
        echo json_encode(
            array("message"=>"Loan Not Updated")
        );
    }