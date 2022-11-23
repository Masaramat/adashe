<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/LoanApplication.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $application = new LoanApplication($db);

    $application->application_id = isset($_GET['id']) ? $_GET['id'] : die();

    $application->read_single();

    //create array
    $application_array = array(
        'status' => 0,
        'message' => 'success',
        'id' => $application->application_id,
        'customer_name' => $application->customer_name,
        'loan_facility' => $application->loan_facility,
        'tenor' => $application->tenor,
        'application_date' => $application->application_date
    );

    print_r(json_encode($application_array));