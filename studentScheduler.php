<?php

session_start();
$studID = $_SESSION["student"];

if ($_POST['monthChange']){
	$_SESSION["CurrMonth"]= $_POST['monthChange'];
}
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
	include($currentMonth . ".html");
?>

</form>
<br>

<?php
	include("CommonMethods.php");

  	$COMMON = new common($debug);	
 	$date =$_POST['calDate'];
	$type = $_POST['appointment'];
	$monthChange = $_POST['prev'];

   	echo("<table border='3px'>");
	echo("<br>");
	echo("<form action='studentScheduler.php' method='post' name='form2'>");

	

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
	echo("<input type='submit' value='Schedule' >");
	echo("</form>");


if($picked)
{

echo($studID);
  $valid = true;
  $sql = "select * from `student Appts` where `Student ID` = '$studID'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $row = mysql_fetch_row($rs);
	echo("value is: ".$row[0]."<br>");
  if($row[0])
  {
    $valid = false;
	echo($valid."<br>");
  }
 


if($valid == false)
{
echo("YOu already have an advising appointment!!!");
}
else
{
$sql = "select * from `Adv_made_Appts` WHERE `id` = '$picked'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);
$sql=
"INSERT INTO `student Appts` (`Appt_id`,`Student ID`,`Date`, `Time`,`type`, `Advisor`, `Advisor E-mail`) 
VALUES ('$picked','$studID','$row[2]','$row[1]','$row[3]', '$row[5]','$row[6]')"; 
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$sql = "UPDATE `Adv_made_Appts` SET `Slots`=`Slots` - 1 WHERE `date` = '$row[2]' AND `time` = '$row[1]' AND `Advisor`= '$row[5]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}
}

?>