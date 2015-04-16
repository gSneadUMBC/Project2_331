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

echo("Welcome, ".$user. " ". $Advisor."<br>");

?>
<h3>Make a new appointment available!</h3>
<form action="schedule.php" method="post">
<br>
<br>
<?php

	$currentMonth = $_SESSION["CurrMonth"];
	include($currentMonth . ".html");

if ($_POST['calDate'] || $_POST['schedule'])
{
	echo("</form><br><br>");
	echo("<br>");
	echo("<table border='1px'>");
	echo("<tr><td>");
	echo("Time");
	echo("</td><td>");
	echo("Type");
	echo("</td><td>");
	echo("Group Size");
	echo("</td><tr><td>");
	echo("<select name='time'>");
   		echo("<option vluae='blank'> </option>");
   		echo("<option value='9:00:00'> 9:00 AM </option>");
   		echo("<option value='9:30:00'> 9:30 AM </option>");
   		echo("<option value='10:00:00'> 10:00 AM </option>");
   		echo("<option value='10:30:00'> 10:30 AM </option>");
   		echo("<option value='11:00:00'> 11:00 AM </option>");
   		echo("<option value='11:30:00'> 11:30 AM </option>");
   		echo("<option value='12:00:00'> 12:00 PM </option>");
   		echo("<option value='12:30:00'> 12:30 PM </option>");
   		echo("<option value='13:00:00'> 1:00 PM </option>");
   		echo("<option value='13:30:00'> 1:30 PM </option>");
   		echo("<option value='14:00:00'> 2:00 PM </option>");
   		echo("<option value='14:30:00'> 2:30 PM </option>");
   		echo("<option value='15:00:00'> 3:00 PM </option>");
   		echo("<option value='15:30:00'> 3:30 PM </option>");
   		echo("<option value='16:00:00'> 4:00 PM </option>");
	echo("</select></td><td>");
	echo("<select name='advType'>");
   		echo("<option value='blank'> </option>");
   		echo("<option value='Individual'> Indvidual </option>");
   		echo("<option value='Group'> Group </option>");
	echo("</select></td><td>");
	echo("<input type='text' name='grpSize'>");
	echo("</td></tr></table>");
	echo("<br><br>");
	echo("</form>");

	echo("<input type='submit' name='schedule' value='Submit'>");
	echo("</form>");
	echo("<br><br>");
		
	$COMMON = new common($debug);
	$date =$_GET['calDate'];	
	$type = $_GET['appointment'];

	echo("Selected an avalable appointment from the list below or choose another day above.");
	echo("<br>");
	echo("<form action='adviViewAppt.php' method='GET' name='form2'>");
	$user = $_SESSION["user"];
	
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND `Advisor Email` = '$user'";

	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	echo("<table border='3px'>");
	echo("<th align='center' colspan = '3'> Displaying $type appointments for $date  </th>");
        echo("<tr>");
        echo("<td align='center'>" . "<strong>Select" . "</td>");
        echo("<td align='center'>" . "<strong>Type" . "</td>");
        echo("<td align='center'>" . "<strong>Time" . "</td>");
    
        echo("</tr>");

	while($row = mysql_fetch_row($rs))
	  {     

	
	    	echo("<tr>" . "<td align='center'>" ."<input type='radio' name='chosenAppt' value = $row[0] >"."</td>");
		echo("<td align='center'>".$row[3]."</td>"."<td align='right'>".$row[1]."</td>");	   

		echo("</tr>");    
	  }

	$picked = $_GET['chosenAppt'];

	echo("</table>");
	echo("<input type='submit' value='View Appointment details'>");
	echo("</form>");

}

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