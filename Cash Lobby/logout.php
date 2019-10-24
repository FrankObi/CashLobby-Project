<?php
require 'connect.inc.php';
if($loggedin){
session_start();
session_destroy();
header('Location:index.php');
}
?>