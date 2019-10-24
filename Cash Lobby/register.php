<?php
require 'connect.inc.php';
ob_start();
session_start();
function cap(){
$_SESSION['secure']=rand(11111,99999);
}
if(!$loggedin){
if(!isset($_SESSION['secure'])){
cap();
}
ob_get_clean();
$date=date("d/m/Y");
if(isset($_GET['referrer']) && !empty($_GET['referrer'])){
$referr=$_GET['referrer'];
$check_user_query="SELECT `User` FROM `usings` WHERE `User`='".mysql_real_escape_string($referr)."'";
$check_query=@mysql_query($check_user_query)or die(mysql_error());
@mysql_num_rows($check_query);
 if(mysql_num_rows($check_query)==1){
   $_SESSION['referrer']=$referr;
 }
}
if(isset($_POST['username'])&&
isset($_POST['password'])&&
isset($_POST['password1'])&&
isset($_POST['Email'])&&
isset($_POST['Name'])&&
isset($_POST['captcha'])&&
isset($_POST['Number'])&&
!empty($_POST['username'])&&
!empty($_POST['password'])&&
!empty($_POST['password1'])&&
!empty($_POST['Email'])&&
!empty($_POST['Name'])&&
!empty($_POST['captcha'])&&
!empty($_POST['Number'])){
$username=mysql_real_escape_string(htmlentities($_POST['username']));
$real_pass=$_POST['password'];
$password=md5($_POST['password']);
$password1=md5($_POST['password1']);
$email=mysql_real_escape_string(htmlentities($_POST['Email']));
$name=mysql_real_escape_string(htmlentities($_POST['Name']));
$captcha=mysql_real_escape_string(htmlentities($_POST['captcha']));
$number=mysql_real_escape_string(htmlentities($_POST['Number']));
if($captcha==$_SESSION['secure']){
 if($password==$password1){
  $check_user_query="SELECT `User` FROM `usings` WHERE `User`='".mysql_real_escape_string($username)."'";
  $check_query=@mysql_query($check_user_query)or die(mysql_error());
  if(mysql_num_rows($check_query)==0){
   if(strlen($username)>=5){
     if(strlen($_POST['password'])>=8){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$check_user_query="SELECT `Email` FROM `usings` WHERE `Email`='".mysql_real_escape_string($email)."'";
		$check_query=@mysql_query($check_user_query)or die(mysql_error());
		if(mysql_num_rows($check_query)==0){
		$create_account_query="INSERT INTO `usings` VALUES('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($email)."','$date','".mysql_real_escape_string($_SESSION['referrer'])."','".mysql_real_escape_string($name)."','".mysql_real_escape_string($number)."','N')";
		$run_create_accut_query=mysql_query($create_account_query);
		$create_account_query="INSERT INTO `earnings` VALUES('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($password)."','0','0','0','0','0','0','0')";
		$run_create_accut_query=@mysql_query($create_account_query)or die(mysql_error());
		$_SESSION['user']=$username;
		$_SESSION['user_ip']=$ip;
			if(isset($_SESSION['referrer'])&&!empty($_SESSION['referrer'])){
			$create_account_query="INSERT INTO `referral` VALUES('','".mysql_real_escape_string($_SESSION['referrer'])."','".mysql_real_escape_string($username)."','0')";
			$run_create_accut_query=@mysql_query($create_account_query)or die(mysql_error());
			}
		$message='<h3>Welcome To CashLobby,</h4><br/><p>Please save this message for security reasons</p><br/><h5>Username: '.$username.'</h5><br/><h5>Password: '.$real_pass.'</h5>';
		$headers=array("From: admin@cashlobby.org",'Content-Type: text/html');
		mail($email,'Welcome To CashLobby',$message,implode("\r\n",$headers));
		header('Location:registered.php');
		}else {
		$return_text ='Your email has already been registered';
		cap();
		}
		}else{
		$return_text = 'Please enter a valid email address';
		cap();
		}   
    }else{
    $return_text = 'Password must be 8 or more characters long';
	cap();
   }
   }else{
   $return_text = 'Username must be 5 or more characters long';
   cap();
   }
  }else{
  $return_text ='Username is not available';
  cap();
  }
 }else{
$return_text = 'Passwords do not match';
 cap();
 }
}else{
$return_text = 'Incorrect Captcha Code';
cap();
}
}else{
$return_text = '';
cap();
}
}else{
header('Location:home.php');
} 
?>
<br/>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<head>
<title></title>
<link href="register.css" rel="stylesheet" type="text/css"/>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="container">
<div id="header">
<img style="padding-left: 70px;" src="images/logo.png" height="130px" />
</div>
<div id="nav" >
	<ul>
	<li><a id="nav_links"  href="index.php">Home</a></li>
	<li><a  id="nav_links" href="register.php">Register</a></li>
	<li><a  id="nav_links" href="about.php">About Us</a></li>
	<li><a  id="nav_links" href="contact.php">Contact Us</a></li>
	</ul>
	
<form action="index.php" method="POST">
  <table id="login_table">
  <tr>
      <td align="right">
	  <input id="login_text" type="text" name="username" value="Username"/>
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
	  <h6 ><a  id="forgot" href="forgot.php" style="color:white;">Forgot Your Password?</a></h6>
      </td>
   </tr>
   </table>
 </form>
</div>

<div class="form">
<h3 id="hgroup">CashLobby Account Registration Form</h3><hr/>
<p id="top_text">Register an account now to start making money from your files. Earn an average of 1 dollar per file downloaded. Reffer members and get 10% of their earnings.</p>
<p id="top_text">Registration is quick and easy.</p><hr/>
</div>
<form action="register.php" method="POST">
<table id="register_table" >
<tr>
      <td></td>
	  <td colspan="3"><h4 id="reteurn_value"  style="color:red;"><?php echo $return_text ?></h4></td>
 </tr>
<tr>
<td/>
    <td><img src="reg.png" id="reg" ></img><h3 id="reg_form">Fill In All Fields</h3></td>
</tr>
<tr>
    <td>Username:</td>
    <td><input  id="username" name="username" type="text" maxlength="25" value="<?php if(isset($username)&&!empty($username)){echo $username;} ?>"></input></td><td><h5 id="username1"></h5></td>
  
</tr>
<tr>
  <td >Full Name:</td>
  <td><input id="name" name="Name" type="name" value="<?php if(isset($name)&&!empty($name)){echo $name;} ?>" /></td>
</tr>
<tr>
  <td>Password:</td>
  <td><input id="password" name="password" maxlength="25" type="password"></input></td>
</tr>
 <tr>
  <td >Confirm Password:</td>
  <td><input id="password1" name="password1"  maxlength="25" type="password"></input></td><td><h5 id="password_check"></h5></td>
  </p></td>
</tr>
 <tr>
  <td>Email:</td>
  <td><input id="email" name="Email"  maxlength="45" type="text" value="<?php if(isset($email)&&!empty($email)){echo $email;} ?>"/></td><td><h5 id="email1"></h5></td>
</tr>
<tr>
  <td>Contact Number:</td>
  <td><input id="number" name="Number" type="text" value="<?php if(isset($number)&&!empty($number)){echo $number;}?>"/></td><td><h5 id="number1"></h5></td>
</tr>
<tr>
  <td></td>
  <td><img id="captcha" width="229px" height="50px" src='Captcha.php'/></td>
</tr>
<tr>
  <td>Type Captcha Code:</td>
  <td><input id="login_text1" name="captcha" type="text" /></td>
</tr>
<tr>
  <td/>
  <td><input id="login_text2" type="submit" value="Register"/></td>
</tr>
</table>
</form>
<div id="footer">
<br class="clear" />
<br class="clear" />
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
<script type="text/javascript" src="register.js"></script>
</div>
</body>
</html>

