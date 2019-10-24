 <?php
 @mysql_connect('localhost','root','')or die('Could not connect');
 @mysql_select_db('first')or die('Could not connect to database');
 $to="catlet_1@hotmail.com";
 if($_POST['reason']=='feedback'){
  if(isset($_POST['email'])&&!empty($_POST['email'])&& filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	$headers="From: ".$_POST['email'];
	if(isset($_POST['subject'])&&!empty($_POST['subject'])){
		if(isset($_POST['message'])&&!empty($_POST['message'])){
			mail($to,$_POST['subject'],$_POST['message'],$headers)or die('Processing error');
			echo 'message sent';
		}else{
			echo 'Please fill in your message';
		}	
	}else{
		echo 'Please fill in the subject field';
	}  
  }else{
	echo 'Please fill in a valid email address';
  }
 }else{
  if(isset($_POST['email'])&&!empty($_POST['email'])&& filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	if(isset($_POST['subject'])&&!empty($_POST['subject'])){
	  if(isset($_POST['link'])&&!empty($_POST['link'])){
	   if(strpos($_POST['link'],'ocalhost/lessons/cash%20lobby/download.php?Id=')){
		if(isset($_POST['message'])&&!empty($_POST['message'])){
			$email=$_POST['email'];
			$link=$_POST['link'];
			$subject=$_POST['subject'];
			$message=$_POST['message'];
			$report_query="INSERT INTO `report` VALUES('','".mysql_real_escape_string($email)."','".mysql_real_escape_string($subject)."','".mysql_real_escape_string($link)."','".mysql_real_escape_string($message)."','".Date('d/m/Y')."')";
			$run_report=@mysql_query($report_query)or die('Processing Error');
			echo 'Report Sent';
	    }else{
			echo 'Please fill in your message';
		}
	   }else{
		echo 'Invalid CashLobby download link';
	   }
      }else{
		echo 'Please enter the url of the file you want to report';
	  }		
	}else{
		echo 'Please fill in the subject field';
	}  
  }else{
	echo 'Please fill in a valid email address';
  }
 } 
  @mysql_close();
 ?>