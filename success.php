<?php
include("style2.html");

?>

<h2>Thank you. Your Appointment has been Scheduled for:</h2>
<br>



<?php

include("CommonMethods.php");

$COMMON = new Common($debug); 

$studID   = $_POST['studID'];
$studFName = $_POST['studFName'];
$studLName = $_POST['studLName'];
$studMaj  = $_POST['studMaj'];
$studEmail= $_POST['studEmail'];
$date = date("m/d/Y");
if($studID){
$sql= 
"INSERT INTO Students(`Student ID`,`Major`, `firstname`, `lastname`,`Email`) 
 VALUES ('$studID','$studMaj', '$studFName', '$studLName','$studEmail')";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}

$sql = "SELECT`Student ID` FROM `Students` ORDER BY `id` DESC LIMIT 1";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$studID =  $row[0];


$sql= "select * from `Appts` where `Student ID` = '$studID'";
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


<br>
<form action="logOut.php">
<input type='submit' value="Log Out">
</form>


<?php
include('footer.html');
?>
