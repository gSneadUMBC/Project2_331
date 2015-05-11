<?php

session_start();
session_destroy();

session_start();

include("loginStyle.html");

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
$pwd  = $_GET['pwd'];
$sql = "select `E-mail` from `Advisors`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$IDlist = array();

while ($row = mysql_fetch_row($rs)){
	$IDlist[] = $row[0];
}

$sql = "select `password` from `Advisors` WHERE `E-mail` = '$user'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$validPword = $row[0];
if($user)
{
	if (in_array($user, $IDlist) && $validPword == $pwd){
		echo ("Successfully logged in with: ".$user);
		$_SESSION["user"]= $_GET['email'];
	
	}
	else
		echo("<font color='red'>**Invalid Email or password. Please try again.</font>");
}
?>
</body>
</html>