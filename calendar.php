<!DOCTYPE HTML>
<html>
<head>
<link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
   <form action="calendar.php" method='GET'>

<table id="march15">
<tr>
   <th colspan="7"> March 2015 </th>
</tr>

<tr>
   <td>Sun</td>
   <td>Mon</td>
   <td>Tue</td>
   <td>Wed</td>
   <td>Thu</td>
   <td>Fri</td>
   <td>Sat</td>
</tr>
<tr>
   <td>1</td>
   <td><button type='submit' value="2015-03-02" name="calDate">02</button></td>
   <td><button type='submit' value="2015-03-03" name="calDate">03</button></td>
   <td><button type='submit' value="2015-03-04" name="calDate">04</button></td>
   <td><button type='submit' value="2015-03-05" name="calDate">05</button></td>
   <td><button type='submit' value="2015-03-06" name="calDate">06</button></td>
   <td>7</td>
</tr>
<tr>
   <td>8</td>
   <td><button type='submit' value="2015-03-09" name="calDate">09</button></td>
   <td><button type='submit' value="2015-03-10" name="calDate">10</button></td>
   <td><button type='submit' value="2015-03-11" name="calDate">11</button></td>
   <td><button type='submit' value="2015-03-12" name="calDate">12</button></td>
   <td><button type='submit' value="2015-03-13" name="calDate">13</button></td>
   <td>14</td>
</tr>
<tr>
   <td>15</td>
   <td><button type='submit' value="2015-03-16" name="calDate">16</button></td>
   <td><button type='submit' value="2015-03-17" name="calDate">17</button></td>
   <td><button type='submit' value="2015-03-18" name="calDate">18</button></td>
   <td><button type='submit' value="2015-03-19" name="calDate">19</button></td>
   <td><button type='submit' value="2015-03-20" name="calDate">20</button></td>
   <td>21</td>
</tr>
<tr>
   <td>22</td>
   <td><button type='submit' value="2015-03-23" name="calDate">23</button></td>
   <td><button type='submit' value="2015-03-24" name="calDate">24</button></td>
   <td><button type='submit' value="2015-03-25" name="calDate">25</button></td>
   <td><button type='submit' value="2015-03-26" name="calDate">26</button></td>
   <td><button type='submit' value="2015-03-27" name="calDate">27</button></td>
   <td>28</td>
</tr>
<tr>
   <td>29</td>
   <td><button type='submit' value="2015-03-30" name="calDate">30</button></td>
   <td><button type='submit' value="2015-03-31" name="calDate">31</button></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
  </tr>
</table>

<table id="april15">
<tr>
   <th colspan="7"> April 2015 </th>
</tr>

<tr>
   <td>Sun</td>
   <td>Mon</td>
   <td>Tue</td>
   <td>Wed</td>
   <td>Thu</td>
   <td>Fri</td>
   <td>Sat</td>
</tr>
<tr>
   <td></td>
   <td></td>
   <td></td>
   <td><button type='submit' value="2015-04-01" name="calDate">01</button></td>
   <td><button type='submit' value="2015-04-02" name="calDate">02</button></td>
   <td><button type='submit' value="2015-04-03" name="calDate">03</button></td>
   <td>4</td>
</tr>
<tr>
   <td>5</td>
   <td><button type='submit' value="2015-04-06" name="calDate">06</button></td>
   <td><button type='submit' value="2015-04-07" name="calDate">07</button></td>
   <td><button type='submit' value="2015-04-08" name="calDate">08</button></td>
   <td><button type='submit' value="2015-04-09" name="calDate">09</button></td>
   <td><button type='submit' value="2015-04-10" name="calDate">10</button></td>
   <td>11</td>
</tr>
<tr>
   <td>12</td>
   <td><button type='submit' value="2015-04-13" name="calDate">13</button></td>
   <td><button type='submit' value="2015-04-14" name="calDate">14</button></td>
   <td><button type='submit' value="2015-04-15" name="calDate">15</button></td>
   <td><button type='submit' value="2015-04-16" name="calDate">16</button></td>
   <td><button type='submit' value="2015-04-17" name="calDate">17</button></td>
   <td>18</td>
</tr>
<tr>
   <td>19</td>
   <td><button type='submit' value="2015-04-20" name="calDate">20</button></td>
   <td><button type='submit' value="2015-04-21" name="calDate">21</button></td>
   <td><button type='submit' value="2015-04-22" name="calDate">22</button></td>
   <td><button type='submit' value="2015-04-23" name="calDate">23</button></td>
   <td><button type='submit' value="2015-04-24" name="calDate">24</button></td>
   <td>25</td>
</tr>
<tr>
   <td>26</td>
   <td><button type='submit' value="2015-04-27" name="calDate">27</button></td>
   <td><button type='submit' value="2015-04-28" name="calDate">28</button></td>
   <td><button type='submit' value="2015-04-29" name="calDate">29</button></td>
   <td><button type='submit' value="2015-04-30" name="calDate">30</button></td>
   <td></td>
   <td></td>
 

  </tr>
</table>


</form>
<br>
<?php
  

   $date =$_GET['calDate'];
echo($date);
?>
<br>
</body>
</html>
