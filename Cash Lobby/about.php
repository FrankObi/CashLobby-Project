 <?php
require 'connect.inc.php';
?>
<html>
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css"/>
<link href="about.css" rel="stylesheet" type="text/css"/>
</head>
<div id="container">
<div id="header">
<img style="padding-left: 70px;" src="images/logo.png" height="130px" />
</div>
<body>
<div id="nav">
	<ul>
	<?php
    if($loggedin){echo
	'<li><a id="nav_links" href="index.php">Home</a></li>
	<li><a  id="nav_links" href="home.php">Account</a></li>
	<li><a id="nav_links"  href="logout.php">Log Out</a></li>
	<li><a id="nav_links"  href="about.php">About Us</a></li>
	<li><a id="nav_links"  href="contact.php">Contact Us</a></li>
	</ul>
	<table id="logged_table" align="right">
	  <tr>
		  <td>
		  <h2>User:'.$_SESSION['user'].'</h2>
		  </td>
	  </tr>
	  
	  <tr><td><h5>Date:'.Date('d/m/Y').'</h5></td></tr>
	  <tr><td><h5>Current Time:'.Date('h-i-s').'</h5></td></tr>
	  
	</table>';
	}else{echo'
	<li><a id="nav_links"  href="index.php">Home</a></li>
	<li><a  id="nav_links" href="register.php">Register</a></li>
	<li><a id="nav_links"  href="about.php">About Us</a></li>
	<li><a  id="nav_links" href="contact.php">Contact Us</a></li>
	</ul>
	
<form action="index.php" method="POST">
  <table id="login_table">
  <tr>
  </tr>
  <tr>
      <td align="right">
	  <input id="login_text" type="username" name="username" value="Username"/>
      </td>
	  <td>
	  <input id="login_textpass" type="password" name="password" value="Password"/>
      </td>
	  <td>
	  <input id="login_button" type="submit" value="Log In"/>
      </td>
   </tr>
   <tr>
      <td>
	  <h6 ><a  id="forgot" href="forgot.php" style="color:white;"/>Forgot Your Password?</a></h6>
      </td>
   </tr>
   </table>
 </form>
';	
	} ?>
	</ul>
</div>
<div class="about">
<h2>About Us</h2><hr/><br/>
<p>CashLobby is a pay per download site meaning you get 
paid for every download your uploaded file gets. 
CashLobby pays you an average of 1 dollar per download.
CashLobby doesn't only pay you for you download we also pay you for your referrals,
 you get 10% of the earnings of anyone that your refer to CashLobby, click <a href="referral.php">here</a> for more info.
To get your money all you have to do is request a payment <a href="request.php">here</a> which will be sent to you
before the end of the month but you must request a payment before the 15th of the month.
The minimum amount of money you are allowed to request for is 5 dollars to start uploading now login or <a href="register.php"> register</a></p>
</p>
<h2>Why should you choose us?</h2><hr/><br/>
<p>CashLobby is a new upcoming change to pay per download.
 CashLobby doesn't just pay you for your downloaded files we pay higher than any other pay per download site.
 Here at CashLobby we do not deprive our members from there earnings we garantee an average of 1 dollar per download.
 We may be new to the pay per download game but we are quickly expanding in members and files and we hope that we 
 can help expand your wallet as well, so stop reading and <a href="register.php"> register</a></p>
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