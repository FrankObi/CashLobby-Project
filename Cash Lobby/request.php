<?php
require 'connect.inc.php';
if($loggedin){

}else{
   header('Location:index.php');
}

if(isset($_GET['del'])&&!empty($_GET['del'])){
$earn="SELECT `Amount` FROM `request` WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."' AND `Id`='".mysql_real_escape_string($_GET['del'])."'";
$run_earn=@mysql_query($earn);
$req_earn=@mysql_result($run_earn,0,'Amount');
$cur="SELECT `Current_Earnings` FROM `earnings` WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."'";
$run_cur=@mysql_query($cur);
$current=@mysql_result($run_cur,0,'Current_Earnings')+$req_earn;
echo $current;
$delete="DELETE FROM `request` WHERE `id` = '".mysql_real_escape_string($_GET['del'])."' AND `request`.`User` = '".mysql_real_escape_string($_SESSION['user'])."'";
$run_del=@mysql_query($delete)or die($error);
$update="UPDATE `earnings` SET `Current_Earnings`='".mysql_real_escape_string($current)."' WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."'";
$run_update=@mysql_query($update);
header('Location:request.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css">
<link href="request.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<header id="header">
	<img style="padding-left: 70px;" src="images/logo.png" height="130px" />
</header>
<div id="nav" >
	<ul>
	<li><a id="nav_links" href="index.php">Home</a></li>
	<li><a  id="nav_links" href="home.php">Account</a></li>
	<li><a id="nav_links"  href="logout.php">Log Out</a></li>
	<li><a id="nav_links"  href="about.php">About Us</a></li>
	<li><a id="nav_links"  href="contact.php">Contact us</a></li>
	</ul>
	<table id="logged_table" >
	  <tr>
		  <td>
		  <h2>User:<?php echo $_SESSION['user']?></h2>
		  </td>
	  </tr>
	  
	  <tr><td><h5>Date:<?php echo Date('d/m/Y')?></h5></td></tr>
	  <tr><td><h5>Current Time:<?php echo Date('h-i-s')?></h5></td></tr>
	</table>
</div>

<div class="request">
<h2>Request A Payment</h2><hr/>
<p>Request a payment to your paypal or alert pay account which will be sent to you
the following month but you must request a payment before the 15th of the month.
The minimum amount of money you are allowed to request for is 5 dollars.</p>	
<h4 id="return" style="display:none"></h4>
	<table>
	  <tr>
		<td>Amout:</td>
		<td><input id="amount"></input></td>
	  </tr>
	  <tr>
	    <td>Payment Type:</td>
		<td>
		<select id="type">
		<option value="P" >Paypal</option>
		<option value="A" >Alert Pay</option>
		</select>
		</td>
	   </tr>
	   <tr>
		<td>Email:</td>
		<td><input id="email"></input></td>
	  </tr>
	   <tr>
		<td>Your Password:</td>
		<td><input id="password" type="password"></input></td>
	  </tr>
	   <tr>
	    <td></td>
		<td><input type="button" id="submit" value="Submit Request"></input></td>
	   </tr>
	</table>
</div>
<div class="request_list">
	<table>
	<tr ><td colspan="4"><h3>Requests</h3></td></tr>
	<tr><td cellspacing="50">Amount</td><td>To</td><td>Option</td><td>Date</td></tr>
	<?php
		$req="SELECT `id`,`Email`,`Amount`,`Date` FROM `request` WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."' ORDER BY `id` DESC";
		$req_res=@mysql_query($req);
		$rows=@mysql_num_rows($req_res);
		if($rows!=0){
			while($info=@mysql_fetch_assoc($req_res)){
				echo '<tr><td>$'.$info['Amount'].'</td><td>'.$info['Email'].'</td><td><a href="request.php?del='.$info['id'].'"><input type="button" value="Delete Request"/></a></td><td>'.$info['Date'].'</td></tr>';
			}
		}else{
			echo '<tr><td colspan="4"><h2>No requests have been made for this month<h2><td></tr>';
		}
	?>
	</table>
</div>
<div id="footer">
<br class="clear" />
<br class="clear" />
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</div>
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="request.js"></script>
</body>
</html>