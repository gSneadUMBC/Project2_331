<?php 


session_start();

$testing = True;

if ($testing){
echo("Before if " . $_SESSION["MonthInt"]);
if ( $_GET['prev'] == "prev"){
	$_SESSION["MonthInt"]--;
	echo("After if " . $_SESSION["MonthInt"]);	
	echo("<br>pressed Prev");
}
elseif( $_GET['next'] == next)
	$_SESSION["MonthInt"]++;
} 
?>

<!DOCTYPE HTML>
<html>
<head></head>
<body>



<form action="adviViewAppt.php" method="GET" name="form1">
<br>
What kind of advising are you looking for?
<br>
<input type="radio" name="appointment" value="any" checked="checked">
 Any
<input type="radio" name="appointment" value="individual">
Individual
<input type="radio" name="appointment" value="group">
Group
<br><br><br>
uld you like to look at?
<?php
$testing = True;

$months = array("January", "Febuary", "March", "April", "May" );

if ($_SESSION["MonthInt"]==null && $testing){
for ($i = 0; $months[$i] != "April"; $i++){
	$_SESSION["MonthInt"] = $i; 
}
	echo("Initial set up");
	$_SESSION["MonthInt"] ++;
	$monthInt = $_SESSION["MonthInt"];
}
echo("<br>" . $_SESSION["MonthInt"] . "<br>");

if ($testing)
{
	$currentMonth = $months[$_SESSION["MonthInt"]];
	echo("<br>The month is " . $currentMonth);
	include($currentMonth . ".html");

}
else{
	$currentMonth = $_SESSION["CurrMonth"];
	echo("<br>The month is " . $_SESSION["CurrMonth"]);
	include($currentMonth . ".html");
}
?>


</form>


<?php
	include("CommonMethods.php");

  	$COMMON = new common($debug);	
 	$date =$_GET['calDate'];
		
	$type = $_GET['appointment'];
	$monthChange = $_GET['prev'];

	echo("Selected an avalable appointment from the list below or choose another day above.");
	echo("<br>");
	echo("<form action='adviViewAppt.php' method='GET' name='form2'>");
	$user = $_SESSION["user"];
	
if($date){

	if($type == "any")
	{
		$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND `Advisor Email` = '$user'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	else
	{	
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND `type`='$type' AND `Advisor Email` = '$user' ";

	
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
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
}
	$picked = $_GET['chosenAppt'];

	echo("</table>");
	echo("<input type='submit' value='View Appointment details'>");
	echo("</form>");

	
	//picks time of selected appointment
	$sql = "select `Student ID` from `student Appts` WHERE `Appt_id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	

$studIDs = array();
while($row = mysql_fetch_row($rs))
{
	$inside = in_array($row[0],$studIDs);
	if(!$inside)
	{
	$studIDs[] = $row[0];
	}	
}
if($picked){

echo("<table border='1px'>");
echo("<th align='center' colspan = '5'> Displaying Students attending advising  </th>");
       echo("<tr>");
        echo("<td align='center'>" . "<strong>Student ID" . "</td>");
        echo("<td align='center'>" . "<strong>Major" . "</td>");
	echo("<td align='center'>" . "<strong>First Name" . "</td>");
 	echo("<td align='center'>" . "<strong>Last Name" . "</td>");
 	echo("<td align='center'>" . "<strong>E-mail" . "</td>");
	echo("</tr>");

for($i = 0;$i < count($studIDs);$i++)
{
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
?>