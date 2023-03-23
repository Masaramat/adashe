<?php

include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/access.inc.php';

 if (!isset($_SESSION['agent'])){
	header('Location: ..');
	exit();
}  

if (isset($_GET['add'])){
	$get_data = callAPI('GET', 'localhost/adashe_api/api/rccs/read.php', false);
	$rccs = json_decode($get_data);
	if (!$rccs->status == 0){
		$error = 'Error fetching list of RCCs: '.mysqli_error($link);
		include '../error.html.php';
		exit();
	}
	$rccs = $rccs->data;

	$pagetitle = 'Add Year Plan';
	$action = 'addform';
	$button = 'Add Year Plan';

	
	
	$rccid = '';
	$rccname = '';
	$group = '';
	$groupname = '';
	$startweek = '';
	$sharevalue = '';
	$welfare = '';
	$status = '';
	$membername = '';
	$email = '';
	$phone = '';
		
	$sno = '';


	 
	
    if (isset($_POST['action']) and $_POST['action'] == 'Addss'){
        
        $membername = $_POST['membername'];
        $role = $_POST['role'];
        $phonenumber = $_POST['phone']; 
        $email = $_POST['email']; 
		$address = $_POST['address'];
        
        $_SESSION['cart'][] = array('member_name' => $membername, 'position' => $role,
         'phone_no' => $phonenumber, 'email' => $email, "password"=> $_POST['password'], 'contact_address' => $address);         
		 include 'form.html.php';
        exit();
    }

	
	include 'form.html.php';
	exit();
}



if (isset($_GET['addform'])){
	if ($_POST['group'] == ''){
		$error = 'You must choose a group for this yearplan.
		Click &lsquo;back&rsquo; and try again.';
		include '../error.html.php';
		exit();
	}

	$members = $_SESSION['cart'];
	$data = json_encode(array(
		"group_id"=> $_POST['group'], 
		"startweek"=> $_POST['ddate'], 
		"share_value"=>$_POST['sharevalue'], 
		"welfare"=> $_POST['welfare'],
		"status"=> "open", 		
		"members"=> $members));

	$response = callAPI('POST', 'localhost/adashe_api/api/year_plan/create.php', $data);
	$response = json_decode($response);	
	if (!$response->status == 0){
		$error = mysqli_error($link);
		$error = 'Error adding yearplan.'.mysqli_error($link);
		include '../../error.html.php';
		exit();
	}
	unset($_SESSION['cart']);

	// $sno = mysqli_insert_id($link);
	
	header('Location: .');
	exit();
}



// if (isset($_POST['action']) and $_POST['action'] == 'Edit'){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// 	$sno = mysqli_real_escape_string($link, $_POST['sno']);
// 	$sql = "SELECT * FROM yearplan_view WHERE sno='$sno'";
	
// 	$result = mysqli_query($link, $sql);
// 	if (!$result){
// 		$error = 'Error fetching yearplan details.';
// 		include '../error.html.php'; 
// 		exit();
// 	}
// 	$row = mysqli_fetch_array($result);
	// $pagetitle = 'Edit Year Plan';
	// $action = 'editform';

// 	$rccid = $row['rcc_id'];
// 	$rccname = $row['rcc_name'];
// 	$group = $row['group_id'];
// 	$groupname = $row['group_name'];
// 	$startweek = $row['startweek'];
// 	$sharevalue = $row['sharevalue'];
// 	$welfare = $row['welfarevalue'];
// 	$status = $row['status'];
		
// 	$sno = $row['sno'];
	
// 	$button = 'Update Year Plan';

// 	// Build the list of rccs
// 	$sql = "SELECT * FROM rccs";
// 	$result = mysqli_query($link, $sql);
// 	if (!$result)	{
// 		$error = 'Error fetching list of rccs.';
// 		include '../../Serror.html.php';
// 		exit();
// 	}
// 	while ($row = mysqli_fetch_array($result)){
// 		$rccs[] = array('rccid' => $row['sno'], 'rccname' => $row['rcc_name']);
// 	}

// 	// Build the list of groups
// 	$sql = "SELECT * FROM adashe.groups WHERE rcc_id = ".$rccid;
// 	$result = mysqli_query($link, $sql);
// 	if (!$result){
// 		$error = 'Error fetching list of groups: '.mysqli_error($link);
// 		include '../../error.html.php';
// 		exit();
// 	}
// 	while ($row = mysqli_fetch_assoc($result)){			
// 		$groups[] = array('groupid' => $row['sno'], 'rccid' => $row['rcc_id'] ,'groupname' => $row['group_name']);		
// 	}	



	
// 	include 'form.html.php';
// 	exit();
// }


// if (isset($_GET['editform'])){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
	
// 	$sno = mysqli_real_escape_string($link, $_POST['sno']);

// 	$rccid = mysqli_real_escape_string($link, $_POST['rcc']);	
// 	$groupid = mysqli_real_escape_string($link, $_POST['group']);
// 	$startweek = mysqli_real_escape_string($link, $_POST['ddate']);	
// 	$sharevalue = mysqli_real_escape_string($link, $_POST['sharevalue']);
// 	$welfare = mysqli_real_escape_string($link, $_POST['welfare']);
// 	$status = 'open';
	
	 	
// 	$sql = "UPDATE yearplan SET
// 	group_id='$groupid',
// 	startweek ='$startweek',
// 	sharevalue='$sharevalue',
// 	welfarevalue='$welfare' 
// 	WHERE sno='$sno'";
	
// 	if (!mysqli_query($link, $sql))	{
// 		$error = 'Error updating submitted year plan.' . mysqli_error($link);
// 		include '../error.html.php';
// 		exit();
// 	}
		
// 	header('Location: .');
// 	exit();
// }

// if (isset($_POST['action']) and $_POST['action'] == 'Delete'){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// 	$id = mysqli_real_escape_string($link, $_POST['id']);
		
	
// 	include 'form.html.php';
// 	exit();
// }


// if (isset($_GET['action']) and $_GET['action'] == 'search'){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// 	// The basic SELECT statement
// 	$select = 'SELECT * ';
// 	$from = ' FROM yearplan_view';
// 	$where = ' WHERE TRUE';
	
		
	
// 	$result = mysqli_query($link, $select . $from . $where);
// 	if (!$result)	{
// 		$error = 'Error fetching year plans: '.mysqli_error($link);
// 		include '../error.html.php';
// 		exit();
// 	}
// 	while ($row = mysqli_fetch_array($result))	{
// 		$yearplans[] = array('id' => $row['sno'],  'rccid' =>$row['rcc_id'], 'rccname' =>$row['rcc_name'], 
// 		'groupid' =>$row['group_id'], 'groupname' =>$row['group_name'], 'sharevalue' => $row['sharevalue'],
// 		'welfare' => $row['welfarevalue'], 'status' => $row['status'], 'startweek' => $row['startweek']);
// 	}
// 	include 'yearplans.html.php';
// 	exit();
// }
 

// if (!isset($_SESSION['cart'])){
// 	$_SESSION['cart'] = array();
// }
// $key = 0;

// if(isset($_GET['id'])){
// 	unset($_SESSION['cart'][$_GET['id']]);
	
	
// }



// // Display search form
// include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// $result = mysqli_query($link, 'SELECT * FROM adashe.groups');


// function editFormDetails(){
// 	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
// 	$sno = mysqli_real_escape_string($link, $_POST['sno']);
// 	$sql = "SELECT * FROM yearplan_view WHERE sno='$sno'";
	
// 	$result = mysqli_query($link, $sql);
// 	if (!$result){
// 		$error = 'Error fetching yearplan details.';
// 		include '../error.html.php'; 
// 		exit();
// 	}
// 	$row = mysqli_fetch_array($result);
// 	$pagetitle = 'Edit Year Plan';
// 	$action = 'editform';

// 	$rccid = $row['rcc_id'];
// 	$rccname = $row['rcc_name'];
// 	$group = $row['group_id'];
// 	$groupname = $row['group_name'];
// 	$startweek = $row['startweek'];
// 	$sharevalue = $row['sharevalue'];
// 	$welfare = $row['welfarevalue'];
// 	$status = $row['status'];
		
// 	$sno = $row['sno'];
	
// 	$button = 'Update Year Plan';
// }

$get_data = callAPI('GET', 'localhost/adashe_api/api/year_plan/read.php', false);
$yearplans = json_decode($get_data)->data;

include 'yearplans.html.php';


?>