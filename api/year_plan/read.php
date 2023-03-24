<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/YearPlan.php";

    //instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate loan application object
    $year_plan = new YearPlan($db);

    //loan application query
    $result = $year_plan->read();

    //row count
    $num = $result->rowCount();

    //check if we have loan application
    if($num>0){
        //applications array
        
        $year_plan_array = array();
        $year_plan_array['status'] = 0;
        $year_plan_array['message'] = 'success';
        $year_plan_array['data'] = array();


        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            
            extract($row); 
                  
            $yr_plan = array( 
                'plan_id'  => $sno,             
                'group_name' => $group_name,                
                'rcc_name' => $rcc_name,
                'lcc_name' => $lcc_name,                
                'share_value' => $sharevalue,
                'welfare_value' => $welfarevalue,                
                'start_week' => $startweek,
                'status' => $status
            );
             $member_res = $year_plan->read_members($sno);
            $num_rows = $member_res->rowCount();
            $yr_plan['members'] = array();
            if($num_rows>0){
                while($row1 = $member_res->fetch(PDO::FETCH_ASSOC)){
                    extract($row1);
                    $members = array(
                        'member_name' => $member_name,
                        'contact_address' => $contact_address,
                        'phone_no' => $phone_no,
                        'email' => $email,
                        'position' => $position

                    );

                    array_push($yr_plan['members'], $members);

                }
            } 
            //push data into applications array
            array_push($year_plan_array['data'], $yr_plan);
            
        }
        //Turn array to JSON
        echo json_encode($year_plan_array);
    }else{
        //No application
        echo json_encode(
            array('message' => 'No application Available')
        );
    }