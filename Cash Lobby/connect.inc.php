<?php

	$ip = $_SERVER['REMOTE_ADDR'];
	if(isset($_SERVER['HTTP_CLIENT_IP'])&&!empty($_SERVER['HTTP_CLIENT_IP'])){
	$ip=$client;
	}else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])&&!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$ip=$Forward;
	}
	
ob_start();
session_start();
@mysql_connect('localhost','root','')or die('Could not connect');
@mysql_select_db('first')or die('Could not connect to database');
$error='Processing Error';
$loggedin=isset($_SESSION['user'])&&!empty($_SESSION['user'])&&$_SESSION['user_ip']==$ip;
if(isset($_SESSION['user'])&&!empty($_SESSION['user'])){
$_SESSION['user']=strtolower($_SESSION['user']);
}
ob_get_clean();
?>

<?php 

//header("Location:maintenance.php");

if($loggedin && !strpos($_SERVER['SCRIPT_NAME'],'index.php',0)){
 include 'all_otherpages_logged.php';
 echo '<link href="all_otherpages_logged.css" rel="stylesheet" type="text/css"/>';
}
?>
<script type="text/javascript" src="Jquery.js"></script>
<script type="text/javascript" src="login.js"></script>
