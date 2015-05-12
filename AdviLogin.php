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

<form action="AdviVal.php" method="POST">
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

</body>
</html>