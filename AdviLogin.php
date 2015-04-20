<?php

session_start();
if ($_SESSOIN['user']){
	echo("Opened");
	header("location: schedule.php");
	die;
}
session_destroy();

session_start();

$mydate=getdate(date("U"));
$_SESSION["CurrMonth"] = $mydate[month];

include("CommonMethods.php");
$COMMON = new common($debug);
?>

<!DOCTYPE HTML>
<html>
<head></head>
<body>

<h2> Please enter your Advisor email and password </h2>

<form action="AdviLogin.php" method="GET">
   Advisor E-mail:<br>
   <input type="email" name="email">
<?php
if ($_GET['email'])
	echo("<font color='red'><br>**Reqired field<br></font>");
else
   echo("<br><br>");
?>
   Password:<br>
   <input type="password" name="pwd">
   <br><br>
<input type="submit" value="Login">
</form>
<br>
<form action='schedule.php' >
<input  type="submit" value = "schedule appointments">
</form>
<?php
$user = $_GET['email'];

$sql = "select `E-mail` from `Advisors`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$IDlist = array();

while ($row = mysql_fetch_row($rs)){
	$IDlist[] = $row[0];
}

if($user)
{
	if (in_array($user, $IDlist)){
		echo ("Successfully logged in with: ".$user);
		$_SESSION["user"]= $_GET['email'];
	}
	else
		echo("<font color='red'>**Invalid Email</font>");
}
?>
</body>
</html>