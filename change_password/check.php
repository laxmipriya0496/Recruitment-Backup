<?php
	require ("../configuration.php");
	require ("../user.php");
	$user=$_SESSION['user'];
	$username=$_SESSION['user_name'];
	//$_SESSION['menu_id']=$_REQUEST['menu_id'];
	//$_SESSION['submenu_id']=$_REQUEST['sub_menu'];
	$pass=$_REQUEST['nop'];
	//$menu_id=$_SESSION['menu_id'];
	//$submenu_id=$_SESSION['submenu_id'];	
	
	$pass1=md5($pass);
	
	 $employee=mssql_fetch_array(mssql_query("select password from user_master where user_id='$user'"));
	 $old=$employee['password'];
	if($pass1!=$old)
	{
		echo "Your Password Does't match";
	}
	
	
	?>