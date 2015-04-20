<?php
session_start();
include('baseStyle.html');
$currentDate = getdate(date("U"));
$_SESSION["CurrMonth"] = $currentDate[month];
?>
<br>
<h2> Welcome to the UMBC ITE advising Sign-up web Application! </h2>
<form action='studentInfo.php' method='post' name='info1'>
E-mail:<br><input type='text' name='studEmail'><br>
Password:<br><input type='text' name='studEmail'><br>

<input type='submit'>

</form>

<?php
include('footer.html');
?>
