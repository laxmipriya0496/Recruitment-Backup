<?php
require ("../configuration.php");
session_start();
  if (isset($_SESSION['user'])) {
      header('Location:../login/lockscreen.php'); 
    }
			$user_name=$_REQUEST['user_name'];
			$password=md5($_REQUEST['password']);
			$usermaster=mssql_query("select * from user_master where user_name='$user_name' and status='0'");
			//echo "select * from user_master where user_name='$user_name' and status='0'";
			$ucount=mssql_num_rows($usermaster);
			if($ucount!=0)
			{
				$user=mssql_fetch_array($usermaster);
				$pwd=$user['password'];
				if($pwd==$password)
				{
					$usr_id=$user['user_id'];
					$_SESSION['user'] = $user['user_id'];
					$_SESSION['user_group_code'] = $user['user_group_code'];
					$_SESSION['full_name'] = $user['full_name'];
					$_SESSION['user_name']=$user_name;
           			$_SESSION['start'] = time(); // Taking now logged in time.
            		// Ending a session in 30 minutes from the starting time.
           			$_SESSION['expire'] = $_SESSION['start'] + (60*30);
					//header('Location:../menu/menu.php');
					
					date_default_timezone_set('Asia/Calcutta'); 
					$ip=$_SERVER['REMOTE_ADDR'];
					$date=date("Y-m-d H:i:s");
					$ins=mssql_query("INSERT INTO user_log(user_id,ip_address,login,created_by,created_on) VALUES ('$usr_id','$ip','$date','$usr_id','$date')");
					
					header('Location:../Menu/index.php');
				}
				else
				{
					echo "Invalid Password";
					header('Location: ../login/login.php?p=1');
				}
			}
			else
			{
			echo "User Doesnot exists";
			header('Location: ../login/login.php?u=1');
			}		
				
		
?>
	
