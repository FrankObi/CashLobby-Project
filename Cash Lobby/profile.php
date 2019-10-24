<?php
require'connect.inc.php';
$profile_text="";
$profile_correct='';
if($loggedin){
	if(isset($_POST['change_password'])&&!empty($_POST['change_password'])){
	    if(isset($_POST['current_password'])&&!empty($_POST['current_password'])&&
		   isset($_POST['new_password'])&&!empty($_POST['new_password'])&&
		   isset($_POST['new_password1'])&&!empty($_POST['new_password1'])){
		    $cur_password=md5($_POST['current_password']);
			$new_password=md5($_POST['new_password']);
			$new_password1=md5($_POST['new_password1']);
			$check_query="SELECT `User`,`Pass` FROM `usings` WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."'";
			$run_check=mysql_query($check_query);
			if($cur_password==mysql_result($run_check,0,'Pass')){
				if($new_password==$new_password1){
				 $edit_query="UPDATE  `usings` SET `Pass`='".mysql_real_escape_string($new_password)."' WHERE  `User` ='".mysql_real_escape_string($_SESSION['user'])."'";
				 $profile_text = '';
				 $profile_correct= 'Password Successfully Updated';
			     $run_edit=mysql_query($edit_query);	
				}else{
				 $profile_text= "Passwords do not match";
				}
			}else{
			 $profile_text= "Current Password is Incorrect";
			}
		}	
	}
	if (isset($_POST['change'])&&!empty($_POST['change'])){
		if(isset($_POST['name'])&&!empty($_POST['name'])&&
		isset($_POST['email'])&&!empty($_POST['email'])&&
		isset($_POST['number'])&&!empty($_POST['number'])&&
		isset($_POST['password'])&&!empty($_POST['password'])){
		$name=mysql_real_escape_string(htmlentities($_POST['name']));
		$email=mysql_real_escape_string(htmlentities($_POST['email']));
		$number=mysql_real_escape_string(htmlentities($_POST['number']));
		$password=md5($_POST['password']);
		$check_query="SELECT `User`,`Pass` FROM `usings` WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."'";
		$run_check=mysql_query($check_query);
			if($password==mysql_result($run_check,0,'Pass')){
			    $edit_query="UPDATE  `usings` SET `Name`='".mysql_real_escape_string($name)."', `Email` =  '".mysql_real_escape_string($email)."',`Number`='".mysql_real_escape_string($number)."' WHERE  `User` ='".mysql_real_escape_string($_SESSION['user'])."'";
			    $run_edit=mysql_query($edit_query);		
				$profile_text = '';
				$profile_correct = "Profile Successfully Edited";				
			}else{
			$profile_text = "Password is Incorrect";
			}
		}else{
			$profile_text = "fill in all fields to make any changes";
		}
	}
function getinfo($field){
	$check_user_query="SELECT `$field` FROM `usings` WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."'";
	$check_query=@mysql_query($check_user_query)or die($error);
	$fetch=@mysql_fetch_assoc($check_query)or die($error);
	echo $fetch[$field];
 }

}else{
header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<head>
<link href="profile.css" rel="stylesheet" type="text/css">
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css">
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
<div id="article">
<h3 id="hgroup">View and Edit your profile details</h3>
</div>
<h4 id="profile_return"><?echo $profile_text ?></h4>
<h4 id="profile_correct"><?echo $profile_correct ?></h4>
<table id="profile_table">
    <tr>
      <td></td>
	  <td><h2>Profile<h2></td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
   <tr>
      <td>Username:</td>
	  <td> <input id="profile_text" value="<?php getinfo('User') ?>" disabled></input></td>
	</tr>
	<tr></tr>
	<form action="profile.php" method="POST">
    <tr>
     <td>Full Name:</td>
	 <td> <input id="profile_text" name="name" value="<?php getinfo('Name') ?>" ></input></td>
	</tr>
	<tr></tr>
	<tr>
      <td>Email:</td>
	  <td> <input  id="profile_text" name="email" value="<?php getinfo('email') ?>"></input></td>
	</tr>
	<tr></tr>
	<tr>
      <td>Contact Number:</td>
	  <td> <input  id="profile_text" name="number" value="<?php getinfo('Number') ?>"></input></td>
	</tr>
	<tr>
      <td>Currrent Password:</td>
	  <td><input  id="profile_text" name="password" type="password"></input></td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
      <td></td>
	  <td> <input id="login_text2" name="change" type="submit" value="Change Details"></input></td>
	</tr>
	</form >
	<tr>
	<td></td>
      <td><h4>Change Password</h4></td>
	</tr>
	<form action="profile.php" method="POST">
	<tr>
      <td>Currrent Password:</td>
	  <td><input name="current_password" id="profile_text" type="password"></input></td>
	</tr>
	<tr>
      <td>New Password:</td>
	  <td><input  name="new_password" id="profile_text"  type="password"></input></td>
	</tr>
	<tr>
      <td>Confirm Password:</td>
	  <td><input name="new_password1" id="profile_text" type="password"></input></td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
      <td></td>
	  <td> <input name="change_password" id="login_text2" type="submit" value="Submit"></input></td>
	</tr>
	</form>
</table>
</div>
<div id="footer">
<br class="clear" />
<br class="clear" />
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
</div>
</body>
</html>