<?php
session_start();

$user = strtolower($_POST['email']);
$pwd = $_POST['pwd'];
	include("CommonMethods.php");
	$COMMON = new common($debug);
if($user){
	
	

	
	$sql = "select `E-mail` from `Advisors`";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	$IDlist = array();

	while ($row = mysql_fetch_row($rs)){
	$IDlist[] = $row[0];
	}

	if (in_array($user, $IDlist)){
		$_SESSION['user'] = $user;
	}
	else{
		$_SESSION['user'] ="";
	}
}
	$sql = "select `password` from `Advisors` WHERE `E-mail` = '$user'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
	$validPword = $row[0];
if (!$_SESSION['user'] || ($pwd != $validPword)){
	$_SESSION['notID']="true";
	header('location:AdviLogin.php');
}
else{
	$_SESSION['notID']="false";
	header('location:schedule.php');
}
?>