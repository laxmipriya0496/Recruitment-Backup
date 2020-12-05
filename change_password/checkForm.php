<?php
require("../configuration.php");
require("../user.php");
$old=$_REQUEST['oldPassword'];
$new=$_REQUEST['newPassword'];
$retype=$_REQUEST['retypePassword'];

$password=md5($old);

$user=$_SESSION['user'];

	
		
		$sql=mysql_query("select password from user where id='$user'");
		$sql_row=mysql_fetch_array($sql);
		
		$oldp=$sql_row['password'];
		
		
		if($password!=$oldp)
		{
			echo "False"; 
			
			
			} 
			?>
		
		
		
		
		
		
		










?>