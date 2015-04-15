<?php
session_start();

if ($_POST['monthChange'])
	$_SESSION["CurrMonth"]= $_POST['monthChange'];

?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<?php

include("CommonMethods.php");
$COMMON = new common($debug);


$AdEmail = $_SESSION["user"];

$sql= "SELECT `fname` FROM `Advisors` WHERE `E-mail` = '$AdEmail'";
$rs1 = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs1);
$user =$row[0];


$sql= "SELECT `lname` FROM `Advisors` WHERE `E-mail` = '$AdEmail'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$Advisor = $row[0];

echo("Welcome, ".$user. " ". $Advisor."<br>")

?>
<h3>Make a new appointment available!</h3>
<form action="schedule.php" method="post">
<br>
<form action="studentScheduler.php" method="POST" name="form1">
<br>
<?php

	$currentMonth = $_SESSION["CurrMonth"];
	include($currentMonth . ".html");
?>

</form><br><br>
<br>
<table>
<tr>
<td>
   Time:
<select name="time">
   <option vluae="blank"> </option>
   <option value="9:00:00"> 9:00 AM </option>
   <option value="9:30:00"> 9:30 AM </option>
   <option value="10:00:00"> 10:00 AM </option>
   <option value="10:30:00"> 10:30 AM </option>
   <option value="11:00:00"> 11:00 AM </option>
   <option value="11:30:00"> 11:30 AM </option>
   <option value="12:00:00"> 12:00 PM </option>
   <option value="12:30:00"> 12:30 PM </option>
   <option value="13:00:00"> 1:00 PM </option>
   <option value="13:30:00"> 1:30 PM </option>
   <option value="14:00:00"> 2:00 PM </option>
   <option value="14:30:00"> 2:30 PM </option>
   <option value="15:00:00"> 3:00 PM </option>
   <option value="15:30:00"> 3:30 PM </option>
   <option value="16:00:00"> 4:00 PM </option>
</select>
</td>
<td>
   Type:
<select name="advType">
   <option value="blank"> </option>
   <option value="Individual"> Indvidual </option>
   <option value="Group"> Group </option>
</select>
</td> </tr>
</table>
<br>
<br>


<input type="submit" value="Submit">
</form>
<br>

<?php
$COMMON = new common($debug);


$appDate = 0;
$appDate = $_POST['apptDate'];
$apptTime = $_POST['time'];
$apptType = $_POST['appType'];

$weekend = array("2015-03-28","2015-03-29","2015-04-04","2015-04-05"
		 ,"2015-04-11","2015-04-12","2015-04-18","2015-04-19"
		 ,"2015-04-25","2015-04-26","2015-05-02","2015-05-03");
for($i=0;$i< count($weekend);$i++)
  {
    if($weekend[$i] == $appDate)
      {
	echo("That is a weekend! Choose a day during the week!<br>");
	$appDate = 0;
      }
  }

$apptTime = $_POST['time'];
$apptType = $_POST['appType'];
if($appDate && $apptTime && $apptType){
switch ($apptTime){
case "9:00:00":
   echo("The appointment is on ".$appDate." type is ".$apptType." at 9:00 AM");
   break;
case "9:30:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 9:30 AM");
  break;
case "10:00:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 10:00 AM");
  break;
case "10:30:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 10:30 AM");
  break;
case "11:00:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 11:00 AM");
  break;
case "11:30:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 11:30 AM");
  break;
case "12:00:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 12:00 PM");
  break;
case "12:30:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 12:30 PM");
  break;
case "1:00:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 1:00 PM");
  break;
case "1:30:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 1:30 PM");
  break;
case "2:00:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 2:00 PM");
  break;
case "2:30:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 2:30 PM");
  break;
case "3:00:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 3:00 PM");
  break;
case "3:30:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 3:30 PM");
  break;
case "4:00:00":
  echo("The appointment is on ".$appDate." type is ".$apptType." at 4:00 PM");
  break;
default:
  echo("You must choose a time for your appt!!");
}



if($apptType == "group"){
$slots = 10;

$sql = "insert into `Adv_made_Appts`
(`time`,`date`,`type`,`Slots`,`Advisor`,`Advisor Email`)
values('$apptTime','$appDate','$apptType',$slots,'$Advisor','$AdEmail')";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

}
else
{

$slots = 1;
$sql = "insert into `Adv_made_Appts`
(`time`,`date`,`type`,`Slots`,`Advisor`,`Advisor Email`)
values('$apptTime','$appDate','$apptType',$slots,'$Advisor','$AdEmail')";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

}

}
else{
  echo("Please choose a date, time, and type for your appointment");
}

$appDate = 0;


?>

</body>
</html>