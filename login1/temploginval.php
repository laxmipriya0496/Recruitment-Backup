<?php
require ("../configuration.php");
session_start();
  if (isset($_SESSION['user'])) {
     header('Location:../login/lockscreen.php'); 
    }
			$user_name=$_REQUEST['user_name'];
			echo $password=md5($_REQUEST['password']);
			echo "<br>";
			$usermaster=mssql_query("select user_id,password,user_group_code from temp_user_master where user_name='$user_name' and status='0' ");
			$ucount=mssql_num_rows($usermaster);
			if($ucount!=0)
			{
				$usermaster1=mssql_query("select user_id,password,user_group_code from temp_user_master where user_name='$user_name' and status='0' and Convert(date, getdate()) between from_date and to_date  ");
				$ucount1=mssql_num_rows($usermaster1);
				if($ucount1!=0)
				{
					$user=mssql_fetch_array($usermaster);
					echo $pwd=$user['password'];
					if($pwd==$password)
					{
						$_SESSION['user'] = $user['user_id'];
						$_SESSION['user_group_code'] = $user['user_group_code'];
						$_SESSION['full_name'] = $user['full_name'];
						$_SESSION['user_name']=$user_name;
						$_SESSION['start'] = time(); // Taking now logged in time.
						// Ending a session in 30 minutes from the starting time.
						$_SESSION['expire'] = $_SESSION['start'] + (60*30);
						//header('Location:../menu/menu.php');
						header('Location:../Temp/index.php');
					}
					else
					{
						echo "Invalid Password";
						header('Location: ../login/login.php?p=1');
					}
				
				}
				else
				{
					header('Location: ../login/login.php?u=3');
				}
				
			}
			else
			{
				echo "User Doesnot exists";
				header('Location: ../login/login.php?u=1');
			}		
				
		
?>
	
