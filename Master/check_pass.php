<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$old_pass=md5($_REQUEST['old_pass']);

 $cus=mssql_fetch_array(mssql_query("select * from user_master where user_id='$user'"));
 $pass=$cus['password'];
 if($old_pass==$pass)
 {
	echo "yes";
 }
 else
 {
	echo "no";
 }
?>