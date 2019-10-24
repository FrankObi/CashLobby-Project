<?php
require 'connect.inc.php';

?>
<html>
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css">
<link href="tos.css" rel="stylesheet" type="text/css">
</head>
<div id="container">
<header id="header">
<img style="padding-left: 70px;" src="images/logo.png" height="130px" />
</header>
<body>
<div id="nav" >
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
	  
	  <tr><td><h5>Date:'.Date('d/m/Y').'<h5></td></tr>
	  <tr><td><h5>Current Time:'.Date('h-i-s').'<h5></td></tr>
	  
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
<div class="tos">
<h2>Terms of Service</h2><hr/>
<p>CashLobby Terms of Service describes the terms and conditions 
on which CashLobby offers service to you. Your should carefully read the CashLobby TOS before
using CashLobby. Note by registering a CashLobby Account you are in an agreement with
CashLobby to follow this terms and conditions. Going against or disobeying the Terms of Service 
of CashLobby can lead to banning of the User's account.</p>
<h2>User Terms</h2><hr/>
<p>CashLobby requires all user information to be accurate upon User registration,
  the User also agrees to update this information keep the information  true, accurate, current and complete.
  A user is permited to only one CashLobby account multiple accounts is strictly against the rules and can lead to banning. 
  CashLobby Users are responsibly for their account information such as username and password.
  CashLobby has the right to close the account Users that have become inactive</p>
<h2>Payment Terms</h2><hr/>
<p>Payment must be requested be for the 15th of the month the minimum amount of money you are allowed to request is $5.00.
All requested payments will be sent the following month.
</p>
<h2>Upload Terms</h2><hr/>
<p>Users are permited to upload any files they want as long as they do not contain any adult files,
 pornography, pornography passwords, nudity/semi-nudity, suggestive images/videos,
 files with sexual filenames, or anything remotely adult-related. 
 Copyrighted files such as movies can also not be uploaded. </p>

<h2>Misuse of CashLobby Resources</h2><hr/>
<p>CashLobby is strictly against the misuse of it's recources CashLobby Users are not allowed to 
misuse our resource such as bandwidth, storage, space, and so on any misuse of our resources will lead to banning</p>
</div>

<footer id="footer">
<br class="clear" />
<br class="clear" />
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</footer>
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
</body>
</html>