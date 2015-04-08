<?php
session_start();
?>

<!DOCTYPE HTML>
<html>
<head></head>
<body>

<h2> Please enter your Advisor email and password </h2>

<form action="AdviLogin.php" method="GET">
   Advisor E-mail:<br>
   <input type="email" name="email">
   <br>
   Password:<br>
   <input type="password" name="pwd">
   <br>
<input type="submit" value="Login">
</form>

<form action='schedule.php' >
<input  type="submit" value = "Schedule appointments">
</form>
<?php
$_SESSION["user"]= $_GET['email'];
$user = $_SESSION["user"];
echo ("the user is ".$user);
?>
</body>
</html>