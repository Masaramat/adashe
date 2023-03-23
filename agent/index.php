
<?php
include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/access.inc.php';

 if (!userIsLoggedIn()){
	include 'login.html.php';
	exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Welcome </title>
<meta http-equiv="content-type"
content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Welcome</h1>
<ul>
<li><a href="rccs/">Manage RCC</a></li>
<li><a href="groups/">Manage Group</a></li>
<li><a href="yearplan/">Year Plan</a></li>
</ul>
<p> <?php  //echo $_SERVER['DOCUMENT_ROOT'] . '/adashenew/agent/includes/db.inc.php'; ?> </p>

</body>
</html>