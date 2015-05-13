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




?>

<h2>Choose an advisor and a day to see thier calendar</h2>
<form action="AdviViewer.php" method="GET">
<br>
<?php
	echo("<select name = 'advisorOpton' >");
	   	echo("<option value='josh.abrams@umbc.edu'> Josh Abrams </option>");
		echo("<option value='annearey@umbc.edu'> Anne Arey </option>");
   		echo("<option value='eastephe@umbc.edu'> Emily Abrams-Stephens </option>");

		echo("</select>");


	$currentMonth = $_SESSION["CurrMonth"];
	include($currentMonth . ".html");

if ($_GET['calDate'] || $_GET['advisorOpton'] )
{
	

//For scheduling appointments
	echo("</form>");
	echo("<br>");
		$debug= false;
	$COMMON = new common($debug);
	$_SESSION['adviPick'] = $_GET['advisorOpton'];
	$user = $_SESSION['adviPick'];
	$_SESSION['viewDate'] = $_GET['calDate'];
	$date =$_SESSION['viewDate'];

	if (!($_GET['time']=="blank") && !($_GET['advType']=="blank")&&($_GET['schedule'])){
		
		$grpsize = $_GET['grpSize'];
		$advtype = $_GET['advType'];
		$apptTime = $_GET['time'];
		if (($_GET['advType']=="group") && !(empty($grpsize))){
			$sql = "insert into `Adv_made_Appts`
			(`time`,`date`,`type`,`Slots`,`Advisor`,`Advisor Email`)
			values('$apptTime','$date', '$advtype','$grpsize','$Advisor','$AdEmail')";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		elseif($_GET['advType']=="individual"){
			$sql = "insert into `Adv_made_Appts`
			(`time`,`date`,`type`,`Slots`,`Advisor`,`Advisor Email`)
			values('$apptTime','$date', '$advtype','1','$Advisor','$AdEmail')";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);		
		}
	}	
$sql= "SELECT `fname` FROM `Advisors` WHERE `E-mail` = '$user'";
$rs1 = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs1);
$userfn =$row[0];

echo("<h3>". $userfn. "'s schedule");
	echo("<br>");

//Scheduled appointment view 
	echo("<form action='AdviViewer.php' method='GET' name='form2'>");

	


	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND `Advisor Email` = '$user'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	echo("<table border='3px'>");
	echo("<th align='center' colspan = '2'> Displaying $type appointments for $date  </th>");
        echo("<tr>");
   
        echo("<td align='center'>" . "<strong>Type" . "</td>");
        echo("<td align='center'>" . "<strong>Time" . "</td>");
    
        echo("</tr>");

	while($row = mysql_fetch_row($rs))
	  {     
		$stdDate = date("g:i a", strtotime("$row[1]"));

	  
		echo("<td align='center'>".$row[3]."</td>"."<td align='right'>".$stdDate."</td>");	   

		echo("</tr>");    
	  }

	echo("</table>");
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