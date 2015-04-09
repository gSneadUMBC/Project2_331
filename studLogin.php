<?php
session_start();
include('style.html');
$currentDate = getdate(date("U"));
$_SESSION["CurrMonth"] = $currentDate[month];
?>

<br>

<h2> Welcome to the UMBC ITE advising Sign-up web Application! </h2>

<form action='studLogin.php' method='GET'>
Student ID:<br><input type='text' name='loginID'><br>
<input type='submit' value = "Login">
</form>

<?php
include("CommonMethods.php");
$COMMON = new common($debug);

$student = $_GET['loginID'];

$sql = "select `Student ID` from `Students`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$IDlist = array();

while ($row = mysql_fetch_row($rs))
{
	
	$IDlist[] = $row[0];
	

}

if($student)
{
if (in_array($student, $IDlist))
{
$_SESSION["student"] = $student;
echo("Sucessfully logged in with ID:" . $student);
}
else
{
echo("Invalid UMBC student ID");
}
}
include('footer.html');
?>
