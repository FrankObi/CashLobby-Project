<?php
require 'connect.inc.php';
if(!$loggedin){
header('Location:index.php');
}  
?>
<?php
function getinfo($field){
	$check_user_query="SELECT `$field` FROM `earnings` WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."'";
	$check_query=@mysql_query($check_user_query)or die($error);
	$fetch=@mysql_fetch_assoc($check_query)or die($error);
	return $fetch[$field];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css"/>
<link href="home.css" rel="stylesheet" type="text/css"/>
</head>
<body>
 <div id="container">
<div id="header">
<img style="padding-left: 70px;" src="images/logo.png" height="130px" />
</div>
<div id="nav" >
	<ul>
	<li><a id="nav_links" href="index.php">Home</a></li>
	<li><a  id="nav_links" href="home.php">Account</a></li>
	<li><a id="nav_links"  href="logout.php">Log Out</a></li>
	<li><a  id="nav_links" href="about.php">About Us</a></li>
	<li><a id="nav_links"  href="contact.php">Contact Us</a></li>
	</ul>
	<table id="logged_table">
	  <tr>
		  <td>
		  <h2>User:<?php echo $_SESSION['user']?></h2>
		  </td>
	  </tr>
	  
	  <tr><td><h5>Date:<?php echo Date('d/m/Y')?></h5></td></tr>
	  <tr><td><h5>Current Time:<?php echo Date('h-i-s')?></h5></td></tr>
	  
	</table>
	</ul>
</div>
<div id="stats">
  <h2 id="earnings_text">Your Earnings</h2>
<div class="earnings">
<table id="table">
	<tr>
	<td><h3><img style="width:30px" src="images/icon.png"></img>Todays Total Earnings:$<?php echo $total=getinfo('Downloads_Earnings')+getinfo('Refferer_Earnings');?></h3></td>
	<td><h3><img style="width:30px" src="images/icon.png"></img>Current Earnings:$<?php echo getinfo('Current_Earnings'); ?></h3></td>
	</tr>
	<tr>
	<td><h3><img style="width:30px" src="images/icon.png"></img>Todays Download Earnings:$<?php echo getinfo('Downloads_Earnings'); ?></h3></td>
	<td><h3><img style="width:30px" src="images/icon.png"></img>Last Payment:$<?php echo getinfo('last_payment'); ?></h3></td>
	</tr>
	<tr>
	<td><h3><img style="width:30px" src="images/icon.png"></img>Todays Referral Earnings:$<?php echo getinfo('Refferer_Earnings'); ?></h3></td>
	<td><h3><img style="width:30px" src="images/icon.png"></img>All Time Earnings:$<?php echo getinfo('Total_Earnings'); ?></h3></td>
	</tr>
	<tr>
	<td><h3><img style="width:30px" src="images/icon.png"></img>Months Total Earnings:$<?php echo getinfo('Months_Earnings');?></h3></td>
	<td><h3><img style="width:30px" src="images/icon.png"></img>All Time Downloads:<?php echo getinfo('total_downloads'); ?></h3></td>
	</tr>
</table>
<hr/>
</div>
</div>
<div id="footer">
<br class="clear" />
<br class="clear" />
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</div>
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
</body>
</html>