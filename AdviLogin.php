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
<input  type="submit" value = "view & schedule appointments">
</form>

<?php
include("CommonMethods.php");
$COMMON = new common($debug);
$pwd = $_GET['pwd'];
$_SESSION["user"] = $_GET['email'];

$temp = $_GET['email'];
$sql = "select `password` from `Advisors` where `E-mail` ='$temp' ";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if ($pwd == $row[0])
{

$user = $_SESSION["user"];
echo ("Successfully logged in with: ".$user);
}
else
{
echo("Invalid Password. Please try again.");
}
?>
</body>
</html>