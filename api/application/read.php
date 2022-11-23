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

    //loan application query
    $result = $application->read();

    //row count
    $num = $result->rowCount();

    //check if we have loan application
    if($num>0){
        //applications array
        $applications_arr = array();
        $applications_arr['status'] = 0;
        $applications_arr['message'] = 'success';
        $applications_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $application = array(
                'application_id' => $application_id,
                'account_no' => $account_no,
                'loan_facility' => $loan_facility,
                'tenor' => $tenor,
                'name' => $name,
                'application_date' => $application_date,
                 'purpose'=>$purpose,
                'business'=>$business,
                'address'=>$address,
                'phone_no' => $phone_no,
                'bvn'=>$bvn,
                'application_status'=>$application_status,
                'location_name'=>$location_name,
               
                'branch_name' => $branch_name
            );

            //push data into applications array
            array_push($applications_arr['data'], $application);

        }
        //Turn array to JSON
        echo json_encode($applications_arr);
    }else{
        //No application
        echo json_encode(
            array('message' => 'No application Available')
        );
    }