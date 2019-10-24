<?
ob_start();
session_start();
@mysql_connect('localhost','root','')or die('Could not connect');
@mysql_select_db('first')or die('Could not connect to database');
$error='Processing Error';
$loggedin=isset($_SESSION['user'])&&!empty($_SESSION['user']);
if(isset($_SESSION['user'])&&!empty($_SESSION['user'])){
$_SESSION['user']=strtolower($_SESSION['user']);
}
ob_get_clean();

if(!$loggedin){
header('Location:index.php');
die();
}
if(Date('d')<15){
	if(isset($_POST['amount'])&&!empty($_POST['amount'])&& (int)$_POST['amount']){
	  if($_POST['amount']>=5.00){
		if(isset($_POST['type'])&&!empty($_POST['type'])){
			if(isset($_POST['email'])&&!empty($_POST['email'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				if(isset($_POST['password'])&&!empty($_POST['password'])){
					$username=$_SESSION['user'];
					$amount=$_POST['amount'];
					$type=$_POST['type'];
					$email=$_POST['email'];
					$password=md5($_POST['password']);
					$check_pass="SELECT `Pass` FROM `usings` WHERE `User`='".mysql_real_escape_string($username)."'";
					$run_check=@mysql_query($check_pass);
						if(@mysql_result($run_check,0,'Pass')==$password){
						  $check_earnings="SELECT `Current_Earnings` FROM `earnings` WHERE `User`='".mysql_real_escape_string($username)."'";
						  $run_check=@mysql_query($check_earnings);
						  if(@mysql_result($run_check,0,'Current_Earnings')>=$amount){
							$request_query="INSERT INTO `request` VALUES('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string($amount)."','".mysql_real_escape_string($type)."','".Date('d/m/Y')."')";
							$run_request=@mysql_query($request_query)or die('Processing Error');
							$dec_query="SELECT `Current_Earnings` FROM `earnings` WHERE `User`='".mysql_real_escape_string($username)."'";
							$run_dec=@mysql_query($dec_query);
							$user_amount=@mysql_result($run_dec,0,'Current_Earnings');
							$new_amount=$user_amount-$amount;
							$edit_amount="UPDATE  `earnings` SET `Current_Earnings`='".mysql_real_escape_string($new_amount)."' WHERE  `User` ='".mysql_real_escape_string($username)."'";
							$run_edit=@mysql_query($edit_amount);
							echo 'Request Sent';
							}else{
							echo 'The amount you have requested is more than the amount available in your account';
							}
						}else{
						echo 'Password Incorrect';
						}
				}else{
				echo 'Please enter your current pasword';
				}
			}else{
			echo 'Please enter a valid email address you want the payment to be sent too';
			}	
		}else{
		echo 'Please Select a payment type';
		}	
	  }else{
	  echo 'Amount cannot be less than $5.00';
	  }	
	}else{
	echo 'Please Input the amout of money you want';
	}
}else{
	echo 'You must request a payment before the 15th of the month';
}
?>