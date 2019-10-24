 <?php
require 'connect.inc.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css">
<link href="referral.css" rel="stylesheet" type="text/css">
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
	<table id="logged_table" align="right">
	  <tr>
		  <td>
		  <h2>User:<?php echo $_SESSION['user']?></h2>
		  </td>
	  </tr>
	  
	  <tr><td><h5>Date:<?php echo Date('d/m/Y')?><h5></td></tr>
	  <tr><td><h5>Current Time:<?php echo Date('h-i-s')?><h5></td></tr>
	  
	</table>
	</ul>
</div>
<div class="form">
 <?php
if($loggedin){
$get_files_query="SELECT `Refferal`,`earnings` FROM referral WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."' ORDER BY `id` DESC";
$run_get_files=@mysql_query($get_files_query)or($error);
  	if(@mysql_num_rows($run_get_files)!==0){	
	 $members=@mysql_num_rows($run_get_files);
	  echo '<h4>You have referred '.$members.' members.</h4>';
        while($files=@mysql_fetch_assoc($run_get_files)){
		  echo '<li><div id="article">'.$files['Refferal'].'<h3> Earned you: $'.$files['earnings'].'</h3></div></li>';
		   }
		}else{
		echo '<li><h4>You have not referred anyone.</h4></li>';
		}
}else{
header('Location:index.php');
}
?>
<div class="ref">
	<h3 id="last_h3">Your referral link:<input value="http://localhost/lessons/cash%20lobby/register.php?referrer=<?php echo $_SESSION['user']?>" readonly="readonly"></input></h3>
    <p>refer users with this link and your will earn 10% 
	of what they earn.</p>
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