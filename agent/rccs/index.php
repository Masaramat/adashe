<?php

include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/access.inc.php';

if (!isset($_SESSION['agent'])){
	header('Location: ..');
	echo "not logged in";
	exit();
}

if (isset($_POST['add_rcc'])){	
	
	$data = json_encode(array( "rcc_name" => $_POST['rccname'], "rcc_location" => $_POST['rcclocation'], "agent_id" => $_POST['agent']));
	
	$response = callAPI('POST', 'localhost/adashe_api/api/rccs/create.php', $data);
	$response = json_decode($response);	
	if ($response->status == 1){
		$error = $response->message;
		include '../error.html.php';
		exit();
	}
	$rccid = $response->rcc_id;
	
	header('Location: .');
	exit();
}



if (isset($_POST['action']) and $_POST['action'] == 'Edit'){
	$get_data = callAPI('POST', 'localhost/adashe_api/api/rccs/read_single.php?id='.$_POST['id'], false);
	$row = json_decode($get_data);
	if ($row->status == 1){
		$error = 'Error fetching RCC details.';
		include '../error.html.php';
		exit();
	}
	$pagetitle = 'Edit RCC';
	$action = 'editform';
	
	$rccname = $row->rcc_name;
	$rcclocation = $row->rcc_location;
	$agentid = $row->agent_id;
	$id = $row->id;
	
	$button = 'Update RCC';

	$get_agents = callAPI('GET', 'localhost/adashe_api/api/agent/read.php', false);
	$agents = json_decode($get_agents);
	$agents = $agents->data;
	
			
	
	include 'form.html.php';
	exit();
}


if (isset($_GET['editform'])){	
	
	$data = json_encode(array("rcc_id" => $_POST['id'], "rcc_name" => $_POST['rccname'], "rcc_location" => $_POST['rcclocation'], "agent_id" => $_POST['agent']));
	
	$response = callAPI('PUT', 'localhost/adashe_api/api/rccs/update.php', $data);
	$response = json_decode($response);
	if($response->status == 0){
		$message = $response->message;
		header('Location: .');
	}else{
		$error = $response->message;
		include '../error.html.php';
	}
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete'){	
	$data = json_encode(array("id"=> $_POST['id']));		
	$response = callAPI('POST', 'localhost/adashe_api/api/rccs/delete.php', $data);
	header('Location: .');
	exit();
}

// include 'searchform.html.php';
$get_agents = callAPI('GET', 'localhost/adashe_api/api/agent/read.php', false);
	$agents = json_decode($get_agents);
	$agents = $agents->data;

$get_data = callAPI('GET', 'localhost/adashe_api/api/rccs/read.php', false);
$rccs = json_decode($get_data);

include "rccs.html.php";


?>