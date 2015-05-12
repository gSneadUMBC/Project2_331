<?php
session_start();
include('adviStyle.html');
if ($_GET['monthChange'])
	$_SESSION["CurrMonth"]= $_GET['monthChange'];

?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<?php

include("CommonMethods.php");
$COMMON = new common($debug);


$AdEmail = $_SESSION["user"];
$picked = $_GET['chosenAppt'];

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

if ($_GET['calDate'] || $_GET['schedule'] || $_GET['delete'] || $_GET['sort'])
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
	echo("</td><td>");
	echo("Group Major");
	echo("</td><tr><td>");
	echo("<select name='time'>");
   		echo("<option value='blank'> </option>");
		echo("<option value='8:00:00'> 8:00 AM </option>");
		echo("<option value='8:30:00'> 8:30 AM </option>");
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
   		echo("<option value='individual'> Indvidual </option>");
   		echo("<option value='group'> Group </option>");
	echo("</select></td><td>");
	echo("<input type='text' name='grpSize' value='10'>");
	echo("</td>");
	echo("<td><select name='grpMajor'>");
		echo("<option value='blank'> </option>");
		echo("<option value='CMSC'> CMSC </optoin>");
		echo("<option value='CMPE'> CMPE </optoin></select>");
	echo("</td></tr></table>");

//For scheduling appointments
	echo("<input type='submit' name='schedule' value='Submit'>");
	echo("</form>");
	echo("<br>");
		$debug= false;
	$COMMON = new common($debug);
	if ($_GET['calDate'])
		$_SESSION['viewDate'] = $_GET['calDate'];
	$date =$_SESSION['viewDate'];

	if (!($_GET['time']=="blank") && !($_GET['advType']=="blank")&&($_GET['schedule'])){
		
		$grpsize = $_GET['grpSize'];
		$advtype = $_GET['advType'];
		$apptTime = $_GET['time'];
		$grpMajor = $_GET['grpMajor'];
		if (($_GET['advType']=="group") && !(empty($grpsize))  && !($grpMajor=="blank")){
			$sql = "insert into `Adv_made_Appts`
			(`time`,`date`,`type`,`Slots`,`Advisor`, `Major`, `size`)
			values('$apptTime','$date', '$advtype','$grpsize','All', '$grpMajor', '$grpsize')";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		elseif($_GET['advType']=="individual"){
			$sql = "insert into `Adv_made_Appts`
			(`time`,`date`,`type`,`Slots`,`Advisor`,`Advisor Email`, `size`, `Major`)
			values('$apptTime','$date', '$advtype','1','$Advisor','$AdEmail', '1', 'Any')";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);		
		}
	}	

//Start of the table diplaying appointments
echo("<h3>". $user. "'s schedule");
	echo("<br>");

//Scheduled appointment view 
	echo("<form action='schedule.php' method='GET' name='form2'>");
	$user = $_SESSION["user"];

//deletes the appointment
	if($_GET['delete'] && $picked){
		$sql = "Delete from `Adv_made_Appts` where `id` = '$picked'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	$sort = $_GET['sort'];
	if($sort == 'time'){
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND (`Advisor Email` = '$AdEmail' OR `Advisor`='All') ORDER BY `time`";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	elseif($sort == 'type'){
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND (`Advisor Email` = '$AdEmail' OR `Advisor`='All') ORDER BY `type`";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	elseif($sort == 'major'){
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND (`Advisor Email` = '$AdEmail' OR `Advisor`='All') ORDER BY `major`";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	else{
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND (`Advisor Email` = '$AdEmail' OR `Advisor`='All')";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	echo("<table border='3px'>");
	echo("<th align='center' colspan = '3'> Displaying $type appointments for $date  </th>");
        echo("<tr>");
        echo("<th align='center'>" . "<strong>Select" . "</td>");
        echo("<th align='center'>" . "<a href ='schedule.php?sort=time'><strong>Time" . "</td>");
        echo("<th align='center'>" . "<a href ='schedule.php?sort=type'><strong>Type" . "</td>");
	echo("<th align='center'>" . "<a href ='schedule.php?sort=major'><strong>Major" . "</td>");
    
        echo("</tr>");

	while($row = mysql_fetch_row($rs))
	  {     
		$stdDate = date("g:i a", strtotime("$row[1]"));

	    	echo("<tr>" . "<td align='center'>" ."<input type='radio' name='chosenAppt' value = $row[0] >"."</td>");
		echo("<td align='center'>". $stdDate ."</td>");
		echo("<td align='center'>".$row[3]);
		if ($row[3]=="group")
			echo(" (". $row[4]. "/". $row[7]. ")");
		echo("</td>");
		echo("<td align='center'>".$row[8]."</td>");
		echo("</tr>");    
	  }

	echo("</table>");
	echo("<input type='submit' name='delete' value='delete'>      ");
	echo("<input type='submit' name='details' value='View Appointment details'>");
	echo("</form>");

}
if ($_GET['details'] && $picked){
	$debug= false;
	$COMMON = new common($debug);	

	//picks time of selected appointment
	$sql = "select * from `student Appts` WHERE `Appt_id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	$studIDs = array();
	while($row = mysql_fetch_row($rs))
	{
		$inside = in_array($row[0],$studIDs);
		if(!$inside){
			$studIDs[] = $row[2];	
			$detailDate = $row[3];
			$detailTime = date("g:i a", strtotime("$row[4]"));
		}
	}
	if($picked){
		echo("<br>");
		echo("<table border='1px'>");
		echo("<th align='center' colspan = '5'> Displaying Students attending advising on ". $detailDate. " at ". $detailTime.  "</th>");
       		echo("<tr>");
        	echo("<td align='center'>" . "<strong>Student ID" . "</td>");
        	echo("<td align='center'>" . "<strong>Major" . "</td>");
		echo("<td align='center'>" . "<strong>First Name" . "</td>");
 		echo("<td align='center'>" . "<strong>Last Name" . "</td>");
 		echo("<td align='center'>" . "<strong>E-mail" . "</td>");
		echo("</tr>");

		for($i = 0;$i < count($studIDs);$i++){
			$sql = "select * from `Students` WHERE `Student ID` = '$studIDs[$i]'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);

			echo("<tr>");
        		echo("<td>" . "$row[1]" . "</td>");
        		echo("<td>" . "$row[2]" . "</td>");
			echo("<td>" . "$row[3]" . "</td>");
 			echo("<td>" . "$row[4]" . "</td>");
 			echo("<td>" . "$row[5]" . "</td>");
			echo("</tr>");
		}
	}

}	
if($_GET['delete'] && $picked){

//deletes the appointment
	$sql = "Delete from `Adv_made_Appts` where `id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}
?>

</body>
</html>