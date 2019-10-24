<?php
require 'connect.inc.php';
if(isset($_GET['Id'])&&!empty($_GET['Id'])){
 $_SESSION['file_id']=$_GET['Id'];
 function getinfo($field){
	$check_user_query="SELECT `$field` FROM `files` WHERE `Id`='".mysql_real_escape_string($_SESSION['file_id'])."'";
	$check_query=@mysql_query($check_user_query)or die($error);
	$fetch=@mysql_fetch_assoc($check_query)or die('File does not exist');
	if(mysql_num_rows($check_query)==1){
	echo $fetch[$field];}
}
}else{
header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<head>
<link href="download.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">var isloaded = false;</script><script type="text/javascript" src="http://affiliategateways.co/mygateway.php?pub=1337&amp;gateid=MjA5NQ==&amp;action=onclick"></script><script type="text/javascript">if (!isloaded) { window.location = "http://affiliategateways.co/adblock.php?pub=1337"; }</script><noscript><meta http-equiv="refresh" content="0;url=http://affiliategateways.co/nojava.php?pub=1337" /></noscript>
</head>
<body>
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
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
<div class="download_form">
<h1>File Download</h1><hr/>
 <h3 id="h3">File Name:</h3>
 <h2 id="h2"><?php {getinfo('file_name');}?></h2>
 <h4>File Size:</h4>
 <h3 id="h3"><?php echo getinfo('size'); ?></h3>
 <h5><a href="contact.php" id="report">Report File</a></h5>
 <table>
  <tr><td><img src="images/download.png"></img></td></tr>
  <tr><td><input onclick="startGateway();" type="submit" value="Download File"/><td></tr>
 </table>
 <div>
    <p>Welcome to CashLobby your number 1 source for pay per download.
	At CashLobby you earn an average of 1 dollar for each downloaded your uploaded file gets.
	To start earning just <a href="register.php">Register</a> and upload.</p>
 </div>
</div>
  <div id="footer">
	<br class="clear" />
	<br class="clear" />
	<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
  </div>
</div>
</body>
</html>