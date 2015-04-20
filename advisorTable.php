<?php
include('style.html');
?>
<br>
<p><a href="http://advising.coeit.umbc.edu/advising-information/">
   <h1> More Advising Information</h1>
</a></p>
<br>
<?php



include('CommonMethods.php');
$COMMON = new Common($debug); // common methods

$sql = "select * from Advisors";

$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

echo("<table border='3px'>");
echo("<th align='center' colspan = '3'> <strong> Advisors  </th>");
        echo("<tr>");
        echo("<td>" . "<strong>First Name" . "</td>");
        echo("<td>" . "<strong>Last Name" . "</td>");
        echo("<td>" . "<strong>E-mail" . "</td>");
        echo("</tr>");
while($row = mysql_fetch_row($rs))
  {

    
    echo("<tr>");
    echo("<td>". $row[2] . "</td>");
    echo("<td>". $row[1] . "</td>");
    echo("<td>". $row[4] . "</td>");
    echo("</tr>");
  }

?>
<?php
include('footer.html');
?>

