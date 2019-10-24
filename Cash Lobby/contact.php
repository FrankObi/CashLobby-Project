<?php
require 'connect.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css">
<link href="contact.css" rel="stylesheet" type="text/css">
</head>
<div id="container">
<div id="header">
<img style="padding-left: 70px;" src="images/logo.png" height="130px" />
</div>
<div id="nav" >
	<ul>
	<?php
    if($loggedin){echo
	'<li><a id="nav_links" href="index.php">Home</a></li>
	<li><a  id="nav_links" href="home.php">Account</a></li>
	<li><a id="nav_links"  href="logout.php">Log Out</a></li>
	<li><a  id="nav_links" href="about.php">About Us</a></li>
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
	<li><a  id="nav_links" href="about.php">About Us</a></li>
	<li><a id="nav_links"  href="contact.php">Contact Us</a></li>
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
<div class="form">
   
      <h2>Contact Us</h2><hr/>
	  <p>Send us a feedback on what you think about CashLobby and what we can do to improve it</p>
   
   <div id="return_div"><img id="red_x" src="images/red_x.png"></img><img id="check" src="images/check.png"></img><h4 id="return"></h4></div>
   <table>
	<tr>
	 <td>Your Email:</td>
	 <td><input id="email"></input></td>
	</tr>
	<tr>
	<td>Subject:</td>
	<td><input id="subject"></input></td>
	</tr>
	<tr>
	<td>Reason:</td>
	<td>
		<select id="reason">
			<option value="feedback">Feedback</option>
			<option value="report">Report File</option>
		</select>
	</td>
	</tr>
	<tr id="report_text">
	<td>File Url:</td>
	<td><input id="link"></input></td>
	</tr>
	<tr>
	<td>Message:</td>
	</tr>
	<tr>
	<td></td>
	 <td><textarea id="message"></textarea></td>
	</tr>
	<tr>
	<td></td>
	 <td><input id="send" type="button" value="Send Message"></input></td>
	</tr>
	</table>
</div>
<div id="footer">
<br class="clear" />
<br class="clear" />
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="contact.js"></script>
</div>
</html>