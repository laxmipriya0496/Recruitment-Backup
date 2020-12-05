<?php
require ("../configuration.php");
require ("../user.php");

$password=$_REQUEST['name'];
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
//$menu_id=$_SESSION['menu_id'];
//$submenu_id=$_SESSION['submenu_id'];
$md5 = md5($password);
$max_length=16;
$min_length=8;
if(strlen($password)>=$min_length&&strlen($password)<=$max_length)
{
	if(preg_match('/[a-z]/',$password))
	{
		if(preg_match('/[A-Z]/',$password))
		{
			if(preg_match('/[0-9]/',$password))
			{
				if(preg_match('/[@_!.,$]/',$password))
				{
					$sql=mssql_query("update user_master set password='$md5'  WHERE  user_id='$user'");
					echo "Password changed successfully";
				}
				else
				{
					echo "your password does not meet the requirement.";
				}
			}
			else
			{
				echo "your password does not meet the requirement.";
			}
		}
		else
		{
			echo "your password does not meet the requirement.";
		}
	}
	else
	{
		echo "your password does not meet the requirement.";
	}
}
else
{
	echo "your password does not meet the requirement.";
}
?>

	



