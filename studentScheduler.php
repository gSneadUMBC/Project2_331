<?php

//starts session and assigns session variables
session_start();

if (!$_SESSION["student"])
	header('locatoin:studLogin.php');

if ($_GET['monthChange']){
	$_SESSION["CurrMonth"]= $_GET['monthChange'];
}
?>

<?php //this line includes the style elements for the page ?>
<?php include("studStyle.html"); 

include("CommonMethods.php");
$COMMON = new common($debug);


$studID = $_SESSION["student"];

$sql= "SELECT `firstname` FROM `Students` WHERE `Student ID` = '$studID'";
$rs1 = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs1);
$userFName =$row[0]; 


$sql= "SELECT `lastname` FROM `Students` WHERE `Student ID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$userLName = $row[0];

echo("Welcome " . $userFName . " " . $userLName);

?>

<?php //this is the form that allows you to pick what type of appointment you want ?>
<form action="studentScheduler.php" method="GET" name="form1">
<br>

What kind of advising are you looking for?
<br>
<input type="radio" name="appointment" value="any" checked="checked">
 Any
<input type="radio" name="appointment" value="individual">
Individual
<input type="radio" name="appointment" value="group">
Group
<br><br>

<?php //this include is controlled by the current month selected, by default it is the current month we are in ?>
What day would you like to look at?
<?php
	//this sets the include value for the calendar
	$currentMonth = $_SESSION["CurrMonth"];
	include($currentMonth . ".html");
?>

</form>

<br>

<?php

	//include("CommonMethods.php");
	//$debug = false;

	//variables declared and used in this page
  	//$COMMON = new common($debug);	
 	$date =$_GET['calDate'];
	$type = $_GET['appointment'];
	$monthChange = $_GET['prev'];

if($date){
	//constructing the table that will house the appointments listed
   	echo("<table border='3px'>");
	echo("<form action='studentScheduler.php' method='GET' name='form2'>");

	
	//displays appointments based on type chosen
	if($type == "any")
	{
		$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date'AND `Slots` > 0";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	else
	{	
	
	$sql = "select * from `Adv_made_Appts` WHERE `date` = '$date'AND `type`='$type' AND `Slots` > 0";
	
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	
	//builds table with data from pulled appointments
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
		$stdDate = date("g:i a", strtotime("$row[1]"));
		
	    	echo("<tr>" . "<td>" ."<input type='radio' name='chosenAppt' value = $row[0] >"."</td>");
		echo("<td>". $stdDate ."</td>"."<td>".$row[3]."</td>"."<td>".$row[4]."</td>"."<td>".$row[5]."</td>"."<td>".$row[6]."</td>");	   

		echo("</tr>");    
	  }
	

	echo("</table>");
	echo("<input type='submit' value='Schedule' >");
	echo("</form>");
}
	//assigns the unique id of the appointment chosen
	$picked = $_GET['chosenAppt'];


//if the student has picked a value this will check to make sure they do not already have an appointment
// and ask if they you like to delete their first appointment and make another one
if($picked)
{


  $valid = true;
  $sql = "select * from `student Appts` where `Student ID` = '$studID'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $row = mysql_fetch_row($rs);
  if($row[0])
  {
    $valid = false;
	echo($valid."<br>");
  }
 


if($valid == false)
{
echo("You already have an advising appointment!!!"."<br>");
echo("Would you like to delete your current appointment and pick another?");

echo("<form action='studentScheduler' method='POST'>");

echo("<input type='submit' value='yes' name='delChoice' >");
echo("<input type='submit' value='no'  name='delChoice' >");
echo("</form>");
}


else
{

//collects the data from the advising information
$sql = "select * from `Adv_made_Appts` WHERE `id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);

//inserts collected data into student appts for the student's viewing
$sql=
"INSERT INTO `student Appts` (`Appt_id`,`Student ID`,`Date`, `Time`,`type`, `Advisor`, `Advisor E-mail`) 
VALUES ('$picked','$studID','$row[2]','$row[1]','$row[3]', '$row[5]','$row[6]')"; 
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//removes a slot from that advising appointment
$sql = "UPDATE `Adv_made_Appts` SET `Slots`=`Slots` - 1 WHERE `date` = '$row[2]' AND `time` = '$row[1]' AND `Advisor`= '$row[5]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

}

//an assignment of choice whether to delete the appointment or not and IF so uses the conditional below
$rmvAppt = $_POST['delChoice'];
echo($rmvAppt);
if ($rmvAppt == 'yes'){

//selects the appointment ID and matches it to the unique ID of the advising appointment
$sql = "select * from `student Appts` WHERE `Student ID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

//adds a lots back because the student has removed their appointment
$sql = "UPDATE `Adv_made_Appts` SET `Slots`=`Slots` + 1 WHERE `id` = '$row[1]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//deletes the appointment
$sql = "Delete from `student Appts` where `Student ID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}





?>