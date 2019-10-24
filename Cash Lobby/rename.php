<?php
require'connect.inc.php';
if($loggedin){
 if(isset($_SESSION['file'])&&!empty($_SESSION['file'])&&isset($_POST['name'])&&!empty($_POST['name'])){
     $check_query="SELECT `User` FROM files WHERE `Id`='".mysql_real_escape_string($_SESSION['file'])."'";  
    $run_check=@mysql_query($check_query);
	$name_exten=$_POST['name'].$_SESSION['exten'];
	$name_exten=htmlentities($name_exten);
		if(@mysql_num_rows($run_check)!==0){
		   $result=@mysql_result($run_check,0,'User');
		  if($result==$_SESSION['user']){
			$check_query="UPDATE  `files` SET  `file_name` ='".mysql_real_escape_string($name_exten)."' WHERE  `Id`='".mysql_real_escape_string($_SESSION['file'])."'";  
			$run_check=@mysql_query($check_query);
			header('Location:manager.php');
			}else{
			header('Location:manager.php');
			}
		}else{
		 header('Location:manager.php');
		}
 }else{
 header('Location:manager.php');
 }
}else{
header('Location:index.php');
}
?>