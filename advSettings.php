<?php
session_start();
include('adviStyle.html');
?>
<!DOCTYPE html>
<html>
<head></head>
<body>

<?php
include("CommonMethods.php");
$COMMON = new common($debug);
$AdEmail = $_SESSION["user"];
if ($_GET['chngPass']){
	if($_GET['newPass1']==$_GET['newPass2']){
		$_SESSION['noMatch']="false";
		if(strlen($_GET['newPass1']) > 6){
			$_SESSION['shortPass']="false";
			$sql= "SELECT * FROM `Advisors` WHERE `E-mail` = '$AdEmail'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
		

			if($row[3]==$_GET['oldPass']){
				$_SESSION['notPass']="false";
				$newPass = $_GET['newPass1'];
				$sql = "UPDATE `Advisors` SET `password` = '$newPass' WHERE `E-mail` = '$AdEmail'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}else
				$_SESSION['notPass']="true";
		}else
			$_SESSION['shortPass']="true";
	}else
		$_SESSION['noMatch']="true";		
}
?>

<br>
<b>Change Password</b>
<br>
****************************************************************************
<form action="advSettings.php" method="get">
Old Password:  <input type="password" name="oldPass"><br>
<?php if($_SESSION['notPass']=="true")
	echo("<font color='red'>*Wrong Password</font>");
?>
<br>New Password: <input type="password" name="newPass1"><br>
<?php if($_SESSION['noMatch']=="true")
	echo ("<font color='red'>*New passwords don't match</font><br>");
if($_SESSION['shortPass']=="true")
	echo("<font color='red'>*Passwords require atleast 7 characters</font><br>");
if(!($_SESSION['noMatch']=="true")&&!($_SESSION['shortPass']=="true"))
	echo("<br>");
?>
New Password: <input type="password" name="newPass2"><br><br>
<input type="submit" name="chngPass" value="Change Password">
</form>

</body>
</html>