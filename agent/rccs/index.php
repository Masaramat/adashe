<?php

include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/access.inc.php';

if (!isset($_SESSION['agent'])){
	header('Location: ..');
	echo "not logged in";
	exit();
}

if (isset($_GET['add'])){
	$pagetitle = 'New RCC';
	$action = 'addform';
	$rccname = '';
	$rcclocation = '';
	$agentid = $_SESSION['agent']->id;		
	$id = '';
	$button = 'Add RCC';

	$get_agents = callAPI('GET', 'localhost/adashe_api/api/agent/read.php', false);
	$agents = json_decode($get_agents);
	$agents = $agents->data;


	include 'form.html.php';
	exit();
}



if (isset($_GET['addform'])){
	
	if ($_POST['agent'] == ''){
		$error = 'You must choose an Agent for this RCC.
		Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}
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


// if (isset($_GET['action']) and $_GET['action'] == 'search'){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// 	// The basic SELECT statement
// 	$select = 'SELECT * ';
// 	$from = ' FROM rcc_view';
// 	$where = ' WHERE TRUE';
	
		
// 	$agentid = mysqli_real_escape_string($link, $_GET['agent']);
// 	if ($agentid != ''){ // An agent is selected	
// 		$where .= " AND agent_id='$agentid'";
// 	}
	
	
// 	$text = mysqli_real_escape_string($link, $_GET['text']);
// 	if ($text != '') {// Some search text was specified	
// 	$where .= " AND rcc_name LIKE '%$text%'";
// 	}
	
// 	$result = mysqli_query($link, $select . $from . $where);
// 	if (!$result)	{
// 		$error = 'Error fetching FCAs: '.mysqli_error($link);
// 		include '../error.html.php';
// 		exit();
// 	}
// 	while ($row = mysqli_fetch_array($result))	{
// 		$rccs[] = array('id' => $row['sno'],  'rccname' =>$row['rcc_name'], 'agentid' =>$row['agent_id'], 
// 		'rcclocation' =>$row['rcc_location'], 'agentname' =>$row['agent_name']);
// 	}
// 	include 'rccs.html.php';
// 	exit();
// }
 

// // Display search form
// include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// $result = mysqli_query($link, 'SELECT * FROM agents');
// if (!$result){
// 	$error = 'Error fetching agents from database!';
// 	include '../error.html.php';
// 	exit();
// }
// while ($row = mysqli_fetch_array($result)){
// 	$agents[] = array('agentid' => $row['sno'], 'agentname' => $row['agent_name']);
// }

// include 'searchform.html.php';

$get_data = callAPI('GET', 'localhost/adashe_api/api/rccs/read.php', false);
$rccs = json_decode($get_data);

include "rccs.html.php";


?>