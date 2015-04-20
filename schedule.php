<?php
session_start();
include('style.html');
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
<h2>Make a new appointment available!</h2>
<form action="schedule.php" method="GET">
<br>
<?php

	$currentMonth = $_SESSION["CurrMonth"];
	include($currentMonth . ".html");

if ($_GET['calDate'] || $_GET['schedule'])
{
	echo("<br>");
	echo("<h3>Schedule appointment</h3>");
	echo("<table border='2px'>");
	echo("<tr><td>");
	echo("Time");
	echo("</td><td>");
	echo("Type");
	echo("</td><td>");
	echo("Group Size");
	echo("</td><tr><td>");
	echo("<select name='time'>");
   		echo("<option value='blank'> </option>");
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
		echo("<option value='16:00:00'> 4:30 PM </option>");
	echo("</select></td><td>");
	echo("<select name='advType'>");
   		echo("<option value='blank'> </option>");
   		echo("<option value='individual'> Indvidual </option>");
   		echo("<option value='group'> Group </option>");
	echo("</select></td><td>");
	echo("<input type='text' name='grpSize' value='10'>");
	echo("</td></tr></table>");

	echo("<input type='submit' name='schedule' value='Submit'>");
	echo("</form>");
	echo("<br>");
		$debug= false;
	$COMMON = new common($debug);
	if ($_GET['calDate'])
		$_SESSION['viewDate'] = $_GET['calDate'];
	$date =$_SESSION['viewDate'];

	if (!($_GET['time']=="blank") && !($_GET['advType']=="blank")){
		
		$grpsize = $_GET['grpSize'];
		$advtype = $_GET['advType'];
		$apptTime = $_GET['time'];
		if (($_GET['advType']=="group") && !(empty($grpsize))){
			$sql = "insert into `Adv_made_Appts`
			(`time`,`date`,`type`,`Slots`,`Advisor`,`Advisor Email`)
			values('$apptTime','$date', '$advtype','$grpsize','$Advisor','$AdEmail')";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		else 
			echo("You did not enter a group size");
	}	
echo("<h3>". $user. "'s schedule");
	echo("<br>");

//Scheduled appointment view 
	echo("<form action='adviViewAppt.php' method='GET' name='form2'>");
	$user = $_SESSION["user"];
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND `Advisor Email` = '$AdEmail'";

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

		$stdDate = date("g:i a", strtotime("$row[1]"));
	    	echo("<tr>" . "<td align='center'>" ."<input type='radio' name='chosenAppt' value = $row[0] >"."</td>");
		echo("<td align='center'>".$row[3]."</td>"."<td align='right'>".$stdDate."</td>");	   

		echo("</tr>");    
	  }

	$picked = $_GET['chosenAppt'];

	echo("</table>");
	echo("<input type='submit' value='View Appointment details'>");
	echo("</form>");

}

?>

</body>
</html>