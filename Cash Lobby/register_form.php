 <?php
ob_start();
session_start();
@mysql_connect('localhost','root','')or die('Could not connect');
@mysql_select_db('first')or die('Could not connect to database');
$error='Processing Error';
$loggedin=isset($_SESSION['user'])&&!empty($_SESSION['user']);
if(isset($_SESSION['user'])&&!empty($_SESSION['user'])){
$_SESSION['user']=strtolower($_SESSION['user']);
}

 if($loggedin){
 header('Location:home.php');
 }
 if(isset($_POST['username'])&&!empty($_POST['username'])){
  $username=$_POST['username'];
  $check_user_query="SELECT `User` FROM `usings` WHERE `User`='".mysql_real_escape_string($username)."'";
  $check_query=@mysql_query($check_user_query)or die();
  if(mysql_num_rows($check_query)==0){
	echo 'Username Available';
  }else{
	echo 'Username Unavailable';
 }
} 
 if(isset($_POST['email'])&&!empty($_POST['email'])){
 $email=$_POST['email'];
   if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	$check_user_query="SELECT `Email` FROM `usings` WHERE `Email`='".mysql_real_escape_string($email)."'";
	$check_query=@mysql_query($check_user_query)or die();
	if(mysql_num_rows($check_query)==0){
	echo 'Email Available';
  }
 }else{
	echo 'Invalid Email Address';
 }
}
 ?>