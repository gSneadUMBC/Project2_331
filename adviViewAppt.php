<?php session_start() ?>

<!DOCTYPE HTML>
<html>
<head></head>
<body>



<form action="adviViewAppt.php" method="POST" name="form1">
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
 	$date =$_POST['calDate'];
	$type = $_POST['appointment'];
	$monthChange = $_POST['prev'];

	echo("Selected an avalable appointment from the list below or choose another day above.");
	echo("<br>");
	echo("<form action='adviViewAppt.php' method='post' name='form2'>");
	$user = $_SESSION["user"];
	

	if($type == "any")
	{
		$sql = "select * from `student Appts` WHERE `date` = '$date' AND `Advisor E-mail` = '$user' ";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	else
	{	
	$sql = "select * from `student Appts` WHERE `date` = '$date' AND `type`='$type' AND `Advisor E-mail` = '$user' ";

	
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	echo("<table border='3px'>");
	echo("<th align='center' colspan = '7'> Displaying $type appointments for $date  </th>");
        echo("<tr>");
        echo("<td>" . "<strong>Select" . "</td>");
        echo("<td>" . "<strong>Type" . "</td>");
        echo("<td>" . "<strong>Time" . "</td>");
    
        echo("</tr>");

	while($row = mysql_fetch_row($rs))
	  {     

	
	    	echo("<tr>" . "<td>" ."<input type='radio' name='chosenAppt' value = $row[0] >"."</td>");
		echo("<td>".$row[6]."</td>"."<td>".$row[3]."</td>");	   

		echo("</tr>");    
	  }
	$picked = $_POST['chosenAppt'];
	echo("</table>");
	echo("<input type='submit' value='View Appointment details'>");
	echo("</form>");

	$sql = "select * from `student Appts` WHERE `id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);





