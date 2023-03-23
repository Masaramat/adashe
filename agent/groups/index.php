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
	
	$rccid = $_POST['id'];
	$groupname = $_POST['group_name'];
	$lccname = $_POST['lcc_name'];
	$rccname = $_POST['rcc_name'];
	
	// $id = $row['sno'];
	
	$button = 'Update Group';
				
	include 'form.html.php';
	exit();
}



if (isset($_GET['editform'])){
	
	if ($_POST['id']== ''){
		$error = 'You must choose an RCC for this Group.
		Click &lsquo;back&rsquo; and try again.';
		include '../error.html.php';
		exit();
	}

	$data = json_encode(array("group_id"=>$_POST['id'], "lcc_name"=> $_POST['lccname'], "rcc_id"=>$_POST['rcc'], "group_name"=>$_POST['groupname']));
	$response = callAPI('POST', 'localhost/adashe_api/api/groups/update.php', $data);
	$response = json_decode($response);	
	print_r($response);	
	
	if ($response->status == 1)	{
		$error = $response->message;
		include '../error.html.php';
		exit();
	}
		
	header('Location: .');
	exit();
}

// if (isset($_POST['action']) and $_POST['action'] == 'Delete'){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// 	$id = mysqli_real_escape_string($link, $_POST['id']);
		
// 	// Delete the Group
// 	// $sql = "DELETE FROM group WHERE sno='$id'";
// 	// if (!mysqli_query($link, $sql))	{
// 	// 	$error = 'Error deleting group.';
// 	// 	include 'error.html.php';
// 	// 	exit();
// 	// }
// 	header('Location: .');
// 	exit();
// }


// if (isset($_GET['action']) and $_GET['action'] == 'search'){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// 	// The basic SELECT statement
// 	$select = 'SELECT * ';
// 	$from = ' FROM groups_view';
// 	$where = ' WHERE TRUE';
	
		
// 	$rccid = mysqli_real_escape_string($link, $_GET['rcc']);
// 	if ($rccid != ''){ // An RCC is selected	
// 		$where .= " AND lga_id='$rccid'";
// 	}
	
	
// 	$text = mysqli_real_escape_string($link, $_GET['text']);
// 	if ($text != '') {// Some search text was specified	
// 	$where .= " AND group_name LIKE '%$text%'";
// 	}
	
// 	$result = mysqli_query($link, $select . $from . $where);
// 	if (!$result)	{
// 		$error = 'Error fetching Groups. '.mysqli_error($link);
// 		include '../error.html.php';
// 		exit();
// 	}
// 	while ($row = mysqli_fetch_array($result))	{
// 		$groups[] = array('id' => $row['sno'],  'groupname' =>$row['group_name'], 
// 		'rccid' =>$row['rcc_id'], 'lccname' =>$row['lcc_name'], 'rccname' =>$row['rcc_name'], 
// 		'agentid' => $row['agent_id'], 'agentname' => $row['agent_name']);
// 	}
// 	include 'groups.html.php';
// 	exit();
// }
 

// // Display search form
// include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// $result = mysqli_query($link, 'SELECT * FROM rccs');
// if (!$result){
// 	$error = 'Error fetching rccs from database!: '.mysqli_error($link);
// 	include '../error.html.php';
// 	exit();
// }
// while ($row = mysqli_fetch_array($result)){
// 	$rccs[] = array('rccid' => $row['sno'], 'rccname' => $row['rcc_name']);
// }

// include 'searchform.html.php';

$get_data = callAPI('GET', 'localhost/adashe_api/api/groups/read.php', false);
$groups = json_decode($get_data)->data;

include 'groups.html.php';


?>