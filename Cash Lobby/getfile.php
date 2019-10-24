<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	if(isset($_SERVER['HTTP_CLIENT_IP'])&&!empty($_SERVER['HTTP_CLIENT_IP'])){
	$ip=$client;
	}else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])&&!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$ip=$Forward;
	}
ob_start();
session_start();
@mysql_connect('localhost','catlet1_dbuser','myfirstsite1')or die('Could not connect');
@mysql_select_db('db_name')or die('Could not connect to database');
  $confirm="SELECT `IP` FROM `confirm` WHERE `IP`='".mysql_real_escape_string($ip)."'";
  $run_confirm=@mysql_query($confirm);
  if(@mysql_num_rows($run_confirm)<1){die('Invalid session id');}
    $get_amount="SELECT `earn` FROM `confirm` WHERE `IP` = '".mysql_real_escape_string($ip)."'";
	$run_amount=@mysql_query($get_amount);
	$amount=@mysql_result($run_amount,0,'earn');
	$amount=$amount-($amount/10);
	$delete_query="DELETE FROM `confirm` WHERE `IP` = '".mysql_real_escape_string($ip)."'";
	$run_delete=@mysql_query($delete_query);
    $check_user_query="SELECT `User`,`File`,`exten`,`file_name`,`actual_size`,`downloads` FROM `files` WHERE `Id`='".mysql_real_escape_string($_SESSION['file_id'])."'";
	$check_query=@mysql_query($check_user_query)or die('Processing Error');
	  $name = @mysql_result($check_query,0, "file_name");
	  $size = @mysql_result($check_query, 0, "actual_size");
	  $exten = @mysql_result($check_query, 0, "exten");
	  $file = @mysql_result($check_query, 0, "File");
	  $downloads= @mysql_result($check_query, 0, "downloads");
	  $user=@mysql_result($check_query, 0, "User");
       $downlds=$downloads+1;
	   $edit_query="UPDATE  `files` SET `downloads`='$downlds' WHERE  `Id` ='".mysql_real_escape_string($_SESSION['file_id'])."'";
	   $run_add_query=@mysql_query($edit_query)or die('Processing Error');
	   //referral
	   $ref_query="SELECT `Referrer` FROM `usings` WHERE `User`='".mysql_real_escape_string($user)."' AND `Band`='N'";
	   $run_ref=@mysql_query($ref_query);
	   if(@mysql_num_rows($run_ref)==1){
	    $ref=@mysql_result($run_ref, 0, "Referrer");
		if(isset($ref)&&!empty($ref)){
		 $referrer=@mysql_result($run_ref, 0, "Referrer");
		 $user_query="SELECT `User`,`Months_Earnings`,`Current_Earnings`,`Refferer_Earnings`,`Total_Earnings` FROM `earnings` WHERE `User`='".mysql_real_escape_string($referrer)."'";
		 $run_user=@mysql_query($user_query);
		 if(@mysql_num_rows($run_user)==1){
			$part_earn=$amount/10;
			$amount=$amount-($amount/10);
			$month=@mysql_result($run_user, 0, "Months_Earnings")+$part_earn;
			$ref_earn=@mysql_result($run_user, 0, "Refferer_Earnings")+$part_earn;
			$total=@mysql_result($run_user, 0, "Total_Earnings")+$part_earn;
			$cur=@mysql_result($run_user, 0, "Current_Earnings")+$part_earn;
			$edit_query="UPDATE  `earnings` SET `Refferer_Earnings`='$ref_earn',`Months_Earnings`='$month',`Current_Earnings`='$cur',`Total_Earnings`='$total' WHERE  `earnings`.`User` ='".mysql_real_escape_string($referrer)."'";
			$run_edit=@mysql_query($edit_query);
			$user_query="SELECT `earnings` FROM `referral` WHERE `User`='".mysql_real_escape_string($referrer)."'";
		    $run_user=@mysql_query($user_query);
			$ear=@mysql_result($run_user, 0, "earnings");
			$ear=$ear+$part_earn;
			$edit_query="UPDATE  `referral` SET `earnings`='$ear' WHERE  `referral`.`User` ='".mysql_real_escape_string($referrer)."' AND `referral`.`Refferal`='".mysql_real_escape_string($user)."'";
			$run_edit=@mysql_query($edit_query);
			
		 }
		}
	   }
	   //ref end
	   $get_downloads_query="SELECT `Total_Earnings`,`total_downloads`,`Downloads_Earnings`,`Months_Earnings`,`Current_Earnings` FROM `earnings` WHERE `User`='".mysql_real_escape_string($user)."'";
	   $get_downs=@mysql_query($get_downloads_query);
	   $total=@mysql_result($get_downs, 0, "Total_Earnings")+$amount;
	   $downloads=@mysql_result($get_downs, 0, "total_downloads");
	   $down_earn=@mysql_result($get_downs, 0, "Downloads_Earnings")+$amount;
	   $month_earn=@mysql_result($get_downs, 0, "Months_Earnings")+$amount;
	   $cur_earn=@mysql_result($get_downs, 0, "Current_Earnings")+$amount;
	   $downlds=$downloads+1;
	   $edit_query="UPDATE  `earnings` SET `total_downloads`='$downlds',`Total_Earnings`='$total', `Downloads_Earnings`='$down_earn', `Months_Earnings`='$month_earn', `Current_Earnings`='$cur_earn' WHERE  `earnings`.`User` ='".mysql_real_escape_string($user)."'";
	   $check_query=@mysql_query($edit_query);
	  
	  header("Content-type: $exten");
	  header("Content-length: $size");
	  header("Content-Disposition: attachment; filename=$name");
	  header("Content-Description:PHP Generated Data");
	  echo $file;
@mysql_close();
 ?>