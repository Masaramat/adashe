<?php
if (isset($_POST['rcc_id'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php';
	

	$response = callAPI('POST', 'localhost/adashe_api/api/groups/read_single.php', json_encode(array('column' => 'rcc_id', 'value' => 1)));
	$response = json_decode($response);
	
	
	// // Build the list of groups
	// $sql = "SELECT * FROM adashe.groups WHERE rcc_id = ".$_POST['rcc_id'];
	// $result = mysqli_query($link, $sql);
	// if (!$result){
	// 	$error = 'Error fetching list of groups: '.mysqli_error($link);
	// 	include '../error.html.php';
	// 	exit();
	// }
	// while ($row = mysqli_fetch_assoc($result)){			
	// 	$groups[] = array('groupid' => $row['sno'], 'rccid' => $row['rcc_id'] ,'groupname' => $row['group_name']);
	// 	echo "<option value='".$row['sno']."'>".$row['group_name']."</option>";		
	// }	
	echo "<option value=''>Select Group</option>";
	$groups = $response->data;
}



?>