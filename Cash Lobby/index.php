<?php
require 'connect.inc.php';
$login="";

function getlastuser(){
$get_query="SELECT `User` FROM `usings` ORDER BY `Id` DESC";
$run_get=mysql_query($get_query);
$result=mysql_result($run_get,0,'User');
echo $result;
}

 if(!$loggedin){
   if(isset($_POST['username'])&&!empty($_POST['username'])&&isset($_POST['password'])&&!empty($_POST['password'])){
   $username=$_POST['username'];
   $password=md5($_POST['password']);
   $check_user_query="SELECT `Id`,`Band` FROM `usings` WHERE `User`='".mysql_real_escape_string($username)."' AND `Pass`='".mysql_real_escape_string($password)."'";
   $run_check_user_query=@mysql_query($check_user_query)or die($error);
    if(@mysql_num_rows($run_check_user_query)==1){
	  $result=@mysql_result($run_check_user_query,0,'Band');
	  if($result=='N'){
		$_SESSION['user']=$username;
		$_SESSION['user_ip']=$ip;
		header('Location:home.php');
		}else{
		$login="You've been banned!";
		}
	 }else{
	 $login= 'Invalid Login Cridentials';
   }
  }
 } 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<link href="index_style.css" rel="stylesheet" type="text/css"/>

<head>
<title></title>
</head>
<body>
<div id="container">
<div id="header">
<img style="padding-left: 70px;" src="images/logo.png" height="130px" />
</div>
<div id="nav">
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
	  
	  <tr><td><h5>Date:'.Date('d/m/Y').'</h5></td></tr>
	  <tr><td><h5>Current Time:'.Date('h-i-s').'</h5></td></tr>
	  
	</table>';
	}else{echo'
	<li><a id="nav_links"  href="index.php">Home</a></li>
	<li><a  id="nav_links" href="register.php">Register</a></li>
	<li><a  id="nav_links" href="about.php">About Us</a></li>
	<li><a  id="nav_links" href="contact.php">Contact Us</a></li>
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
';	
	
	} ?>
</div>
<h4 id="login_text1" style="color:red;"><?php echo $login; ?></h4>
<a href="register.php"><div id="figure"></div></a>
<div class="side">
<table>
<tr>
	<td>
		<div id="member_stat">Member Stats:</div>
		<p>Welcome our latest member:</p><hr/><br/>
		<h4 id="new_member"><?php getlastuser() ?></h4>
	</td>
</tr>
<tr>
  <td>
	   <div id="member_stat">More Info:</div>
	   <h4 id="new_member"><div><a href="about.php">About Us</a></div><hr/>
	   <div><a href="tos.php">TOS</a></div><hr/>
	   <div><a href="contact.php">Contact Us</a></div><hr/>
	   <div><a href="http://forum.cashlobby.org/">Forum</a></div></h4>
   </td>
</tr>
<tr>
	<td>
		<div id="member_stat">CashLobby News:</div>
	    <h3>No news yet</h3>
	</td>
</tr>
</table>
</div>
<div class="welcome">
<table>
<tr>
  <td>
	<div>
	<h2>What is CashLobby</h2>
	</div>
	<br/>
	<p>Welcome to CashLobby,</p>
	<br/>
	<p>CashLobby is a pay per download site meaning you get 
	paid for every download your uploaded file gets. 
	CashLobby pays you an average of 1 dollar per download.
	To get your money all you have to do is request a payment which will be sent to you
	the following month but you must request a payment before the 15th of the month.
	The minimum amount of money you are allowed to request for is 5 dollars start uploading now <a href="register.php"> register</a></p>
  </td>
  <td>
	<div >
	<h2>Why should you choose Cash Lobby?</h2>
	</div>
	<br/><p>I know what you're thinking, just another pay per download site.</p><br/>
	<p>No, we are not just another pay per download site we are a new upcoming change to pay per download.
	CashLobby doesn't just pay you for your downloaded files we pay higher than any other pay per download site.
	 We at CashLobby do not deprive our members from there earnings we garantee and average of 1 dollar per download.
	 We may be new to the pay per download game but we are quickly expanding in members and files and we hope that we can help expand your wallet as well so stop reading and <a href="register.php"> register</a></p>
  </td>
</tr>
<tr>
<td colspan="2">
</div>
<div>
<h2>CashLobby Efficiency</h2>
</div><br/>
<p>CashLobby is still working on making sure it's systems are working efficiently, If you notice any bugs/problems while using CashLobby Please report them <a href="contact.php">here</a>
To help us improve CashLobby's efficiency</p>
</td>
</tr>
</table>
<div  id="footer">
<br class="clear" />
<br class="clear" />
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</div>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
</div>
</body>
</html>