<?php
session_start();
$studID = $_SESSION["student"];
include('studStyle.html');
echo("<br>");
include("CommonMethods.php");

$debug="true";
$COMMON = new Common($debug); 

if ($_GET['delete']){

	$sql="Delete from `student Appts` where `Student ID` = '$studID'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}
$sql= "select * from `student Appts` where `Student ID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
echo("<form action='studentInfo.php' method=GET>");
echo("<table border='3px'>");
echo("<th align='center' colspan = '5'> <strong> Your upcoming appointments  </th>");
        echo("<tr>");
        echo("<td>" . "<strong>Date" . "</td>");
        echo("<td>" . "<strong>Time" . "</td>");
        echo("<td>" . "<strong>Type" . "</td>");
	echo("<td>" . "<strong>Advisor" . "</td>");
    	echo("<td>" . "<strong>Advisor E-mail" . "</td>");
        echo("</tr>");
while($row = mysql_fetch_row($rs))
  {
    echo("<tr>");
    echo("<td>". $row[3] . "</td>");
    echo("<td>". $row[4] . "</td>");
    echo("<td>". $row[5] . "</td>");
    echo("<td>". $row[6] . "</td>");
    echo("<td>". $row[7] . "</td>");
    echo("</tr>");
    echo("</table>");
    echo("<input type='submit' value='delete' name='delete'>" . "</form>");
  }

?>

