<?php
//echo '<script type="text/javascript">$("remote_upload_buttons").click(function(){alert("r");})</script>';
function ByteSize($bytes)  
    { 
    $size = $bytes / 1024; 
    if($size < 1024) 
        { 
        $size = number_format($size, 2); 
        $size .= ' K.B'; 
        }  
    else{ 
        if($size / 1024 < 1024)  
            { 
            $size = number_format($size / 1024, 2); 
            $size .= ' M.B'; 
            }  
        else if ($size / 1024 / 1024 < 1024)   
            { 
            $size = number_format($size / 1024 / 1024, 2); 
            $size .= ' GB'; 
            }  
        } 
    return $size; 
    } 
$link="Uploaded file's link";
$link1="Uploaded file's link";
require 'connect.inc.php';
require 'remote_upload.php';
if($loggedin){
if(isset($_POST['remote_file'])&&!empty($_POST['remote_file'])){
	$url=$_POST['remote_file'];
	$content = @file_get_contents($_POST['remote_file']);  
	$actual_size=getSizeFile($url);
	if($actual_size<8388608){
	    $remote_url = $_POST['remote_file'];
		$path_parts = pathinfo($remote_url);
		$file=$content;
		$name=str_replace('%20',' ',$path_parts['basename']);
		$size=ByteSize($actual_size);
		$exten=".".@$path_parts['extension'];
		$exten=exten_name($exten);
		if(isset($exten)&&!empty($exten)){
			$upload_query="INSERT INTO `files` VALUES('','".mysql_real_escape_string($_SESSION['user'])."','".mysql_real_escape_string($file)."','".mysql_real_escape_string($name)."','".mysql_real_escape_string($size)."','".mysql_real_escape_string($actual_size)."','".mysql_real_escape_string($exten)."','0','".Date('d/m/Y')."')";
			$run_upload_query=@mysql_query($upload_query) or die($error);
			$return_text_done='File Uploaded';
			$link_query="SELECT `id` FROM `files` WHERE `file_name`='".mysql_real_escape_string($name)."' AND `User`='".mysql_real_escape_string($_SESSION['user'])."' ORDER BY `Id` DESC";
			$run_upload_query=@mysql_query($link_query) or die($error);
			$link1='http://cashlobby.org/download.php?Id='.@mysql_result($run_upload_query,0,`Id`);
		}else{
			$return_text='File extention not allowed';
		}
	}else{
		$return_text='File size cannot be over 8 mb';
	}
}
if(isset($_FILES['file']['tmp_name'])&&!empty($_FILES['file']['tmp_name'])){
  $exten=$_FILES['file']['type'];
  $actual_size=$_FILES['file']['size'];
  
  	if($actual_size<8388608){
	$size=ByteSize($_FILES['file']['size']);
	$name=$_FILES['file']['name'];
	$file=file_get_contents($_FILES['file']['tmp_name']);
    $upload_query="INSERT INTO `files` VALUES('','".mysql_real_escape_string($_SESSION['user'])."','".mysql_real_escape_string($file)."','".mysql_real_escape_string($name)."','".mysql_real_escape_string($size)."','".mysql_real_escape_string($actual_size)."','".mysql_real_escape_string($exten)."','0','".Date('d/m/Y')."')";
	$run_upload_query=@mysql_query($upload_query) or die($error);
	$return_text_done='File Uploaded';
	$link_query="SELECT `id` FROM `files` WHERE `file_name`='".mysql_real_escape_string($name)."' AND `User`='".mysql_real_escape_string($_SESSION['user'])."' ORDER BY `Id` DESC";
	$run_upload_query=@mysql_query($link_query) or die($error);
	$link='http://cashlobby.org/download.php?Id='.@mysql_result($run_upload_query,0,`Id`);
	}else{
	$return_text='File size cannot be over 8 mb';
  }
}
}else{
header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en-US">
<head>
<title>
</title>
<link href="upload.css" rel="stylesheet" type="text/css"/>
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
	<table id="logged_table" >
	  <tr>
		  <td>
		  <h2>User:<?php echo $_SESSION['user']?></h2>
		  </td>
	  </tr>
	  
	  <tr><td><h5>Date:<?php echo Date('d/m/Y')?></h5></td></tr>
	  <tr><td><h5>Current Time:<?php echo Date('h-i-s')?></h5></td></tr>
	  
	</table>
</div>
<img id="loading_gif" src="images/loading_gif.gif"></img>
<div class="form">
<h3 id="upload_text" style="color:red; width:300px;"><?php if(isset($return_text)&&!empty($return_text)){echo $return_text;} ?></h3>
<h3 id="upload_text" style="color:green;"><?php if(isset($return_text_done)&&!empty($return_text_done)){echo $return_text_done;} ?></h3>
<div>
<h3 id="hgroup">Upload Files To CashLobby</h3>
<p id="top_text">The size limit for a file is 8MB, click <a href="manager.php">here</a> to view your uploaded files.</p>
</div>
<h3 id="upload_text">Upload a File</h3>
<div  id="article" >
<form  action="upload.php" method="POST" enctype="multipart/form-data">
	<input id="upload_buttons" type="file" name="file"/>
	<input disabled="disabled" id="upload_button" type="submit" value="   Upload    "/>
</form>
<p id="link">Link: <input readonly="readonly" id="uploaded_link"value="<?php echo $link ?>"></input></p>
</div>
<div>
<h3 id="hgroup">Remotely Upload Files</h3>
<p id="top_text">Upload a file from a direct link without the need for you to download the file yourself</p>
</div>

<h3 id="upload_text">Remote Upload</h3>
<div  id="article" >
<form  action="upload.php" method="POST" enctype="multipart/form-data">
	Url: <input id="remote" name="remote_file"/>
	<input   id="remote_upload_buttons"  type="submit" value="   Upload    "/
<p id="link">Link: <input readonly="readonly" id="uploaded_link"value="<?php echo $link1 ?>"></input></p>
</div>
<div id="article2">
<h3 id="hgroup2">Uploading Rules</h3>
<p id="top_text">Uploading adult files, pornography, pornography passwords, nudity/semi-nudity, suggestive images/videos, files with sexual filenames, or anything remotely adult-related. Copyrighted files such as movies can also not be uploaded.</p>
<p id="top_text">Doing so will result in a ban.</p>
</div>
</div>
<div id="footer">
<br/>
<br/>
<div style="padding-left: 70px;">Copyright © 2011 CashLobby.Org. All rights reserved.</div>
</div>
</div>
	<script type="text/javascript" src="Jquery.js"></script>
	<script type="text/javascript" src="upload.js"></script>
</body>
</html>

