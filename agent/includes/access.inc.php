<?php
include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/network/api_request.php';

session_start();
function userIsLoggedIn(){

	if (isset($_POST['action']) and $_POST['action'] == 'login') {
		if (
			!isset($_POST['email']) or $_POST['email'] == '' or
			!isset($_POST['password']) or $_POST['password'] == ''
		) {
			$GLOBALS['loginError'] = 'Please fill in both fields';
			return FALSE;
		}
		$password = $_POST['password'];

		$data = json_encode(array("email" =>  $_POST['email'], "password" => $password));
		$get_data = callAPI('POST', 'localhost/adashe_api/api/agent/login.php', $data);
		$response = json_decode($get_data);

		if ($response->status == 0){

			$_SESSION['loggedIn'] = true;
			$_SESSION['agent'] = $response;		
			
			return true;

		} else {
			unset($_SESSION['loggedIn']);
			unset($_SESSION['agent']);		
			
			$GLOBALS['loginError'] = $response->message;
		
			return false;
		}
	}

	if (isset($_POST['action']) and $_POST['action'] == 'logout') {

		unset($_SESSION['loggedIn']);
		unset($_SESSION['agent']);
		

		
		header('Location: ' . $_POST['goto']);

		exit();
	}
}




?>