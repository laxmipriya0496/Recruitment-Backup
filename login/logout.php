<?php
session_start();
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];

date_default_timezone_set('Asia/Calcutta'); 
$ip=$_SERVER['REMOTE_ADDR'];
$date=date("Y-m-d H:i:s");
$ins=mssql_query("update user_log set user_id='$user',ip_address='$ip',logout='$date' where user_id='$user' and logout=NULL ");

session_destroy();
header('Location:login.php');
?>