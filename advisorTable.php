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
<?php
include('footer.html');
?>

