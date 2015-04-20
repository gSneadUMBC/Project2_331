<?php
<<<<<<< HEAD
include('studStyle.html');
=======
session_start();
$studID = $_SESSION["student"];
include('style.html');
>>>>>>> origin/josh_edits
?>
<br>
<h3> Your upcoming appointments</h3>

<?php

include("CommonMethods.php");

$COMMON = new Common($debug); 


$sql= "select * from `student Appts` where `Student ID` = '$studID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

echo("<table border='3px'>");

while($row = mysql_fetch_row($rs))
  {


    echo("<tr>");
    foreach ($row as $element)
      {
        echo("<td>".$element."</td>");
      }
    echo("</tr>");
  }

?>

