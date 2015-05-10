<?php
session_start();

$student = strtoupper($_POST['loginID']);

if($student){
	
	include("CommonMethods.php");
	$COMMON = new common($debug);

	$sql = "select `Student ID` from `Students`";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	$IDlist = array();

	while ($row = mysql_fetch_row($rs)){
	$IDlist[] = $row[0];
	}


	if (in_array($student, $IDlist)){
		$_SESSION["student"] = $student;
	}
	else{
		$_SESSION["student"] ="";
	}
}

if (!$_SESSION['student']){
	$_SESSION['notID']="true";
	header('location:studLogin.php');
}
else{
	$_SESSION['notID']="false";
	header('location:studentScheduler.php');
}
?>