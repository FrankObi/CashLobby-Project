<?php
require 'connect.inc.php';
if($loggedin){header("Location:index.php");}
if(isset($_POST['email'])&&!empty($_POST['email'])){
$email=trim($_POST['email']);
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$check="SELECT `Email` FROM `usings` WHERE `Email`='".mysql_real_escape_string($email)."'";
		$run_check=@mysql_query($check);
		if(mysql_num_rows($run_check)==1){
		 	$new_pass="newpass".rand(1111111,9999999);
			$make_pass="UPDATE `first`.`usings` SET `Pass`='".md5($new_pass)."' WHERE `usings`.`Email`='".$email."'";
			echo $new_pass;
			$run_pass=mysql_query($make_pass);
			echo $new_pass;
			if(@mail($email,'Password Recovery',"your new password is".$new_pass,'admin@cashlobby.org')){
			$good="Your new password has been sent to your email.";}else{
			$ret_error="An unexpected error occured";
			}			
		}else{
			$ret_error='There is no user registered with that email address';
		}
	}else{
		$ret_error='Invalid Email Address';
	}
}
?>
<html>
	<head>
	
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css"/>
	<link href="forgot.css" rel="stylesheet" type="text/css">
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
	<li><a  id="nav_links" href="contact.php">Contact us</a></li>
	</ul>
	  <form action="index.php" method="POST">
	  <table id="login_table">
	  <tr>
	  </tr>
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
		  <h6 ><a  href="forgot.php" id="forgot" style="color:white;cursor:pointer;"/>Forgot Your Password?</a></h6>
		  </td>
	   </tr>
	   </table>
	 </form>
		</ul>
	</div>
	<div class="form">
	  <form action="forgot.php" method="POST">
		<h2>Password Recovery</h2><hr/><br/>
		Enter Your Account's Email Address:<br/>
		<input name="email" id="email" type="text" value="<?php if(isset($_POST['email'])&&!empty($_POST['email'])){echo $_POST['email'];}?>"/>
		<input  id="send" type="submit" value="Recover"/>
		</form>
	  <br/>
	  <hr/>
	  <h3 id="error_return"><?php if(isset($ret_error)&&!empty($ret_error)){echo $ret_error ;}?></h3>
	   <h3 id="positive_return"><?php if(isset($good)&&!empty($good)){echo $good ;}?></h3>
	</div>
	<div id="footer">
	<br class="clear" />
	<br class="clear" />
	<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
	</div>
	</div>
	</body>
	<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
</html>