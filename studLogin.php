<?php
session_start();
session_destroy();
session_start();
include('loginStyle.html');
$currentDate = getdate(date("U"));
$_SESSION["CurrMonth"] = $currentDate[month];
?>

<br>

<h2> Welcome to the UMBC ITE advising Sign-up web Application! </h2>

<form action='studVal.php' method='POST'>
Student ID:<br><input type='text' name='loginID'><br>
<input type='submit' value = "Login">
</form>
<?php

	//echo("<form action='studentScheduler.php' method='POST'>");
	//echo("<input type='submit' value = 'View Schedule'><br>");

include('footer.html');
?>
