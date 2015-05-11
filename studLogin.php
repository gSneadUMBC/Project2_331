<?php
session_start();
//resets session anytime this page is seen after a successfull login
if($_SESSION['notID']=="false"){
	session_destroy();
	session_start();
}
include('loginStyle.html');
$currentDate = getdate(date("U"));
$_SESSION["CurrMonth"] = $currentDate[month];
?>

<br>

<h2> Welcome to the UMBC ITE advising Sign-up web Application! </h2>
<?php
echo("<form action='studVal.php' method='POST'>");
echo("Student ID:<br><input type='Password' name='loginID'>");
echo("<input type='submit' value = 'Login'>");
echo("</form>");

//login error message
if ($_SESSION['notID'])
	echo ("<font color='red'>*Enter exsiting student ID</font>");

include('footer.html');
?>
