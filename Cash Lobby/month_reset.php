 <?php
require 'connect.inc.php';
$reset_query="UPDATE  `earnings` SET  `Months_Earnings`='0'";
@mysql_query($reset_query);
mysql_close();
?>