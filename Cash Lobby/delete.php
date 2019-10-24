<?php
require'connect.inc.php';
if($loggedin){
 if(isset($_GET['file'])&&!empty($_GET['file'])){
    $check_query="SELECT `User` FROM files WHERE `Id`='".mysql_real_escape_string($_GET['file'])."'";  
    $run_check=@mysql_query($check_query);
		if(@mysql_num_rows($run_check)!==0){
		   $result=@mysql_result($run_check,0,'User');
		  if($result==$_SESSION['user']){
			$check_query="DELETE FROM `files` WHERE `files`.`Id`='".mysql_real_escape_string($_GET['file'])."'";  
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