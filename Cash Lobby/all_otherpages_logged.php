<?php 
@mysql_connect('localhost','root','')or die('Could not connect');
@mysql_select_db('first')or die('Could not connect to database');
function getlastuser(){
$get_query="SELECT `User` FROM `usings` ORDER BY `Id` DESC";
$run_get=@mysql_query($get_query);
$result=@mysql_result($run_get,0,'User');
echo $result;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<head>
<title>
</title>
</head>
<body>
<div class="main_menu">
 <h2>Main Menu</h2>
 <div id="menu_list">
	<ul>
	 <li><a href="index.php"><h3>Home</h3></a><hr/></li>
	 <li><a href="home.php"><h3>Account</h3></a><hr/></li>
	 <li><a  href="profile.php"><h3>Profile</h3></a><hr/></li>
	 <li><a  href="upload.php"><h3>Upload</h3></a><hr/></li>
	 <li><a  href="manager.php"><h3>File Manager</h3></a><hr/></li>
	 <li><a  href="request.php"><h3>Request Payout</h3></a><hr/></li>
	 <li><a  href="referral.php"><h3>Referrals</h3></a><hr/></li>
	 <li><a  href="about.php"><h3>About Us</h3></a><hr/></li>
	 <li><a  href="Contact.php"><h3>Contact Us</h3></a><hr/></li>
	 <li><a  href="tos.php"><h3>TOS</h3></a></li>
	</ul>
</div>
<table>
   <tr>
    <td>
	    <div id="aside3">
		<div id="member_stat">Member Stats:</div>
		<p style="margin:0px;">Welcome our latest member:</p><hr/><br/>
		<h4 id="new_member"><?php getlastuser();?></h4>
	    </div>
	</td>
   </tr>
   <tr>
    <td>
	   <div  id="aside4">
	   <div id="member_stat">More Info:</div>
	   <div><h4><a href="about.php" style="color:purple;">About Us</a></h4></div><hr/>
	   <div><h4><a href="tos.php" style="color:purple;">TOS</a></h4></div><hr/>
	   <div><h4><a href="contact.php" style="color:purple;">Contact Us</a></h4></div>
	   <div><h4><a href="http://forum.cashlobby.org/" style="color:purple;">Forum</a></h4></div>
	   </div>
   </td>
   </tr>   
</table>
</div>
	<script type="text/javascript" src="Jquery.js"></script>
	<script type="text/javascript" src="login.js"></script>
</body>
</html>

