<?php
session_start();
session_destroy();

session_start();

$mydate=getdate(date("U"));
$_SESSION["CurrMonth"] = $mydate[month];

?>

<!DOCTYPE HTML>
<html>
<head></head>
<body>

<h2> Please enter your Advisor email and password </h2>

<form action="AdviLogin.php" method="GET">
   Advisor E-mail:<br>
   <input type="email" name="email">
   <br><br>
   Password:<br>
   <input type="password" name="pwd">
   <br><br>
<input type="submit" value="Login">
</form>
<br>
<form action='schedule.php' >
<input  type="submit" value = "schedule appointments">
</form>
<form action='adviViewAppt.php' >
<input  type="submit" value = "view appointments">
</form>
<?php
$_SESSION["user"]= $_GET['email'];
$user = $_SESSION["user"];
echo ("Successfully logged in with: ".$user);
?>
</body>
</html>