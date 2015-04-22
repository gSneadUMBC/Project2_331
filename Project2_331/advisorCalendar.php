<?php
include('style.html');
?>
<br><br>
<form action="advisorCalendar.php" method='GET'>
    Date of appointment:<br>
  <input type="date" name="appDate" min="2015-03-30" max="2015-04-20" ><br><br>
    Time of appointment:<br>
  <input type="time" name="appTime" min="09:00" max="16:00" value="9:00:00"><br><br>
    Pick an Advisor or Group advising:<br>
  <select name='advisor'>
    <option value="Abrams">Josh Abrams</option>
    <option value="Arey">Anne Arey</option>
    <option value="Abrams-Stephens">Emily Abrams-Stephens</option>
    <option value="Group Advising" selected>Group Advising</option>
  </select><br><br>
<input type="submit">
</form>
<br>
<?php
include("CommonMethods.php");

$COMMON = new Common($debug);

$appDate = $_GET['appDate'];
$appTime = $_GET['appTime'] . ':00';
$advisor = $_GET['advisor'];

$sql = "SELECT `E-mail` FROM `Advisors` WHERE `lname` = '$advisor'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$AdEmail = $row[0];

$sql = "SELECT`Student ID` FROM `Students` ORDER BY `id` DESC LIMIT 1";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$studID =  $row[0];
?>
<form>
Sort by:<br>
 <select name='sort'>
    <option value='date'>Date</option>
    <option value='time'>time</option>
    <option value='advisor'>advisor</option>
  </select><br><br>
<input type="submit" value ='Sort'>
</form>

<?php 
  $option =$_GET['sort'];

echo("<br>");
if ($option == 'date')
  {

    $sql = "select * from `Adv_Made_Appts` ORDER BY `Date`";
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

}
elseif ($option == 'time')
  {
    $sql = "select * from `Adv_Made_Appts` ORDER BY `Time`";
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

  }
elseif ($option == 'advisor')
  {
    $sql = "select * from `Adv_Made_Appts` ORDER BY `Advisor`";
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

  }

if ($appDate){

$sql=
"INSERT INTO `Appts` (`Student ID`,`Date`, `Time`, `Advisor`, `Advisor E-mail`) 
VALUES ('$studID','$appDate','$appTime','$advisor','$AdEmail')"; 
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$sql =
"Delete from `Available Appts` 
WHERE`Date`='$appDate' AND `Time`='$appTime' AND `Advisor`='$advisor'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
echo("Appointment added!!");

  echo("<br>");
}

include('footer.html');
?>
