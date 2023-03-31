<?php

include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/access.inc.php';

if (!isset($_SESSION['agent'])){
	header('Location: ..');
	exit();
}

if (isset($_GET['add'])){
	$pagetitle = 'New Savings Group';
	$action = 'addform';
	
	$rccid = '';
	$lccname ='';
	$groupname = '';	
	
	$id = '';
	$button = 'Add Group';
	$get_rccs = callAPI('GET', 'localhost/adashe_api/api/rccs/read.php', false);
	$rccs = json_decode($get_rccs);
	$rccs = $rccs->data;

	include 'form.html.php';
	exit();
}

if (isset($_GET['addform'])){

	if ($_POST['rcc'] == ''){
		$error = 'You must choose an RCC for this Group.
		Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}
	
	$data = json_encode(array("rcc_id"=> $_POST['rcc'], "lcc_name"=>$_POST['lccname'], "group_name"=>$_POST['groupname']));

	$response = callAPI('POST', 'localhost/adashe_api/api/groups/create.php', $data);
	$response = json_decode($response);	
		
	if ($response->status == 1){
		$error = $response->message;
		include '../error.html.php';
		exit();
	}
	// $groupid = mysqli_insert_id($link);
	
	header('Location: .');
	exit();
}



if (isset($_POST['action']) and $_POST['action'] == 'Edit'){	
	$pagetitle = 'Edit Group';
	$action = 'editform';
	
	$groupid = $_POST['id'];
	$groupname = $_POST['group_name'];
	$lccname = $_POST['lcc_name'];
	$rccid = $_POST['rcc'];
	
	
	// $id = $row['sno'];
	
	$button = 'Update Group';

	$get_rccs = callAPI('GET', 'localhost/adashe_api/api/rccs/read.php', false);
	$rccs = json_decode($get_rccs);
	$rccs = $rccs->data;
				
	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])){

	$data = json_encode(array("group_id"=>$_POST['group_id'], "lcc_name"=> $_POST['lccname'], "rcc_id"=>$_POST['rcc'], "group_name"=>$_POST['groupname']));
	$response = callAPI('POST', 'localhost/adashe_api/api/groups/update.php', $data);
	$response = json_decode($response);	
	print_r($response);	
	
	if ($response->status == 1)	{
		$error = $response->message;
		include '../error.html.php';
		exit();
	}
		
	header('Location: .?');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete'){
	$response = callAPI('POST', 'localhost/adashe_api/api/groups/delete.php', json_encode(array("id"=>$_POST['id'])) );
	$response = json_decode($response);
	if ($response->status == 1){
		$error = $response->message;
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}

$get_data = callAPI('GET', 'localhost/adashe_api/api/groups/read.php', false);
$groups = json_decode($get_data)->data;

include 'groups.html.php';


?>