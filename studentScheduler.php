<?php
//Starts the session with the stored month
session_start();
?>

//imports html start and CSS features
<?php include("style.html"); ?>

//radio buttons that pick what type of advising
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



//includes HTML calendar based on the current month

	What day would you like to look at?
<?php

	$currentMonth = $_SESSION["CurrMonth"];
	echo("The month is " .$_SESSION["CurrMonth"]);
	include("$currentMonth".".html");

?>



</form>
<br>

<?php

	//this block collects the date and type of appointment for the submit button below	
	include("CommonMethods.php");

  	$COMMON = new common($debug);	
 	$date =$_POST['calDate'];
	$type = $_POST['appointment'];

	echo("Selected an avalable appointment from the list below or choose another day above.");
	echo("<br>");
	echo("<form action='studentScheduler.php' method='post' name='form2'>");

		
	//this conditional decides which available appointments to show based on the radio button input above
	if($type == "any")
	{
		$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date' AND 'Slots` > 0";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	else
	{	

	//this block prints out the appointments available to the students
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date'AND `type`='$type' AND 'Slots` > 0";
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
	
	//assigns the id of the picked appt to a variable and then uses that variable to 
	$picked = $_POST['chosenAppt'];
	echo("</table>");
	echo("<input type='submit' value='Schedule'>");
	echo("</form>");
	$sql = "select * from `Adv_made_Appts` WHERE `id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
//conditional statement to only execute sql commands if the student has picked an appointment
if($picked)
{

$sql=
"INSERT INTO `student Appts` (`Student ID`,`Date`, `Time`, `Advisor`, `Advisor E-mail`) 
VALUES ('UA54617','$row[2]','$row[1]','$row[5]','$row[6]')"; 
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$sql = "UPDATE `Adv_made_Appts` SET `Slots`=`Slots` - 1 WHERE `date` = '$row[2]' AND `time` = '$row[1]' AND `Advisor`= '$row[5]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}
$_SESSION["CurrMonth"] = $_POST['prev']
?>