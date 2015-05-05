<?php


$student = $_POST['loginID'];

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
	//echo("<br>this is where ths header is<br>");
	header('location:studLogin.php');
}
else{

	header('location:studentScheduler.php');
}
?>