<!DOCTYPE HTML>
<html>
<head></head>
<body>
<?php include("baseStyle.html"); ?>
<h1> Hello and welcome to the UMBC advising program </h1>
<br>

<form name="choice">

<input type="submit" value="Student" onclick="choice.action='studLogin.php'">
<input type="submit" value="Advisor" onclick="choice.action='AdviLogin.php'">
</form>