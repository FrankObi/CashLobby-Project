<?php
require 'connect.inc.php';
$password = $_GET['password'];
if ($password !='premium1') {
    die('You cannot access this page');
}
$ip=$_GET['user_ip'];
$earn= $_GET['earn'];
$con_query="INSERT INTO `confirm` VALUES('','".mysql_real_escape_string($ip)."','".mysql_real_escape_string($earn)."')";
$run_con=@mysql_query($con_query)or die();
?>