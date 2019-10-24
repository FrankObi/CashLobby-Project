<?php
require 'connect.inc.php';
if($loggedin){
//delete
 if(isset($_GET['delete'])&&!empty($_GET['delete'])){
    $check_query="SELECT `User` FROM files WHERE `Id`='".mysql_real_escape_string($_GET['delete'])."'";  
    $run_check=@mysql_query($check_query);
	if(@mysql_num_rows($run_check)!==0){
	   $result=@mysql_result($run_check,0,'User');
	  if($result==$_SESSION['user']){
		$check_query="DELETE FROM `files` WHERE `Id`='".mysql_real_escape_string($_GET['delete'])."'";  
		$run_check=@mysql_query($check_query);
		$deleted = 'File Successfully Deleted';
		}
	}else{	
    $deleted='Error Deleting File';
    }
 }
 //delete
function show(){
$get_files_query="SELECT `file_name`,`Id`,`downloads` FROM files WHERE `User`='".mysql_real_escape_string($_SESSION['user'])."' ORDER BY `Id` DESC";
$run_get_files=@mysql_query($get_files_query)or($error);
  	if(@mysql_num_rows($run_get_files)!==0){	
	while($files=mysql_fetch_assoc($run_get_files)){
		  echo '<article id="article">
		  <h3><li id="manager_file"><a id="file" href="managefile.php?file='.$files['Id'].'">
		  <img src="list.png" width=30px height=30px></img>'.$files['file_name'].'
		  </h3><a/>
		  <h5>Downloads:  '.$files['downloads'].'</h5>
		  <a   href="manager.php?delete='.$files['Id'].'" style="text-decoration:none"><input type="button" id="Delete_link1" value="Delete File"></input></a>
		  
		  </article>';
		   }
		}else{
		echo '<li><h2>You have no uploaded files.</h2></li>';
		}
	}
}else{
header('Location:index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css"/>
<link href="manager.css" rel="stylesheet" type="text/css"/>
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
<h5 id="manage">Manage Your Uploaded Files</h5>
<div id="delete_text">
<h4><?php if(isset($deleted)&&!empty($deleted))echo $deleted ?></h4>
</div>
	<ul id="manager_files">
	<h3 style="width:200px;"><li><img id="folder_image" src="folder.png" width=70px height 70px></img>File Manager</li></h3><br/><br/>
	 <?php show(); ?><br/>
	 <li><table><br/><br/></table></li>
	</ul>
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