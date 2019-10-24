<?php
require 'connect.inc.php';
function getinfo($field){
if(isset($_GET['file'])&&!empty($_GET['file'])){
 $exit_query="SELECT `User`,`file_name`,`size`,`Id`,`downloads`,`upload_date` FROM files WHERE Id='".mysql_real_escape_string($_GET['file'])."'";
 $run_query=@mysql_query($exit_query);
 if(@mysql_num_rows($run_query)!=0){
	if(@mysql_result($run_query,0,'User')==$_SESSION['user']){
	 return @mysql_result($run_query,0,$field);
	}else{
	header('Location:manager.php');
	} 
 }else{
 header('Location:manager.php');}
}else{
header('Location:manager.php');
}
}
$file=$_GET['file'];
function get_exten($field){
	$len=strlen($field);
	$x=$len-1;
	$ex='';
	while($field[$x]!=='.'){
	    $let=$field[$x];
		$ex=$ex.$let;
		$x--;
	}
	$rex='';
	while($x!==$len){
		$rex=$rex.$field[$x];
		$x++;
	}
	return $rex;
}
$_SESSION['file']=$file;
$_SESSION['exten']=get_exten(getinfo('file_name'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css"/>
  <link href="managefile.css" rel="stylesheet" type="text/css"/>
 </head>
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
<h5 id="detail">Veiw and Edit your file details</h5>
<div id="manager_table">
<table >
<tr>
   <td><img  width=30px height 30px src="folder.png"></img></td>
   <td><h4 id="file_details" >File Details</h4></td>
</tr>
<tr>
 <td></td>
</tr>
<tr>
 <td></td>
</tr>
 <tr>
    <td><h3 id="new_name">file name:<?php echo "  ".getinfo('file_name');?></h3><br/></td>
	<td><img id="manage_file_img" width=60px height 50px src="list.png"></img></td>
 </tr>
 <tr>
 <td><strong id="file_size">file size:<?php echo "  ".getinfo('size')." ";?></strong></td>
 </tr>
 <tr>
 <td><strong id="file_downloads">Upload Date:<?php echo "  ".getinfo('Upload_Date')."";?></strong></td>
 </tr>
 <tr>
 <td><strong id="file_date">Downloads:<?php echo "  ".getinfo('downloads')."";?></strong></td>
 </tr>
 <tr>
  <td id="link_text">Download Link:</td>
 </tr>
 <tr>
 <td>
  <input id="link_text" type="text" value="download.php?Id=<?php echo getinfo('Id');?>" readonly="readonly"></input>
 </td>
 </tr>
 <tr>
  <td>
 <input type="button" id="rename_file" value="Rename File"></input>
 </td>
  <td>
 <a href="manager.php?delete=<?php echo $_GET['file'];?>" style="text-decoration:none"><input type="button" id="Delete_link" value="Delete File"></input></a>
 </td>
 </tr>
</table>
</div>
<div id="rename_box" style="display:none">
<h4>File Name:</h4>
<input id="rename_text" maxlength="30"></input>
<input id="rename_button" type="button" value="Rename"></input>
<input id="close_rename" type="button" value="X"></input>
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