<?php

session_start();
?>

<?php include("style.html"); ?>
<form action="studentScheduler.php" method="POST" name="form1">
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

What day would you like to look at?
<?php
$currentMonth = $_SESSION["CurrMonth"];
echo("The month is " .$_SESSION["CurrMonth"]);
include("$currentMonth".".html");

?>



</form>
<br>

<?php
	include("CommonMethods.php");

  	$COMMON = new common($debug);	
 	$date =$_POST['calDate'];
	$type = $_POST['appointment'];

	echo("Selected an avalable appointment from the list below or choose another day above.");
	echo("<br>");
	echo("<form action='studentScheduler.php' method='post' name='form2'>");
	$temp = 0;
	

	if($type == "any")
	{
		$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	else
	{	

	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date'AND `type`='$type'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	echo("<table border='3px'>");
	echo("<th align='center' colspan = '7'> Displaying $type appointments for $date  </th>");
        echo("<tr>");
        echo("<td>" . "<strong>Select" . "</td>");
        echo("<td>" . "<strong>Time" . "</td>");
        echo("<td>" . "<strong>Type" . "</td>");
        echo("<td>" . "<strong>Open Seats" . "</td>");
 	echo("<td>" . "<strong>Advisor" . "</td>");
 	echo("<td>" . "<strong>Advisor E-mail" . "</td>");
        echo("</tr>");

	while($row = mysql_fetch_row($rs))
	  {     

	
	    	echo("<tr>" . "<td>" ."<input type='radio' name='chosenAppt' value = $row[0] >"."</td>");
		echo("<td>".$row[1]."</td>"."<td>".$row[3]."</td>"."<td>".$row[4]."</td>"."<td>".$row[5]."</td>"."<td>".$row[6]."</td>");	   


		echo("</tr>");    
	  }
	$picked = $_POST['chosenAppt'];
	echo("</table>");
	echo("<input type='submit' value='Schedule'>");
	echo("</form>");
	$sql = "select * from `Adv_made_Appts` WHERE `id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
if($picked)
{

$sql=
"INSERT INTO `student Appts` (`Student ID`,`Date`, `Time`, `Advisor`, `Advisor E-mail`) 
VALUES ('UA54617','$row[2]','$row[1]','$row[5]','$row[6]')"; 
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}
$_SESSION["CurrMonth"] = $_POST['prev']
?>