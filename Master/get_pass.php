<?php
require ("../configuration.php");
require ("../user.php");
$name=$_REQUEST['name'];
$id=$_REQUEST['id'];
$type=$_REQUEST['type'];
if($name!="")
{
	if($type=="restore")
	{
		$cus=mssql_fetch_array(mssql_query("select password from back_up where id = '$id'"));
	}
	else
	{
		$cus=mssql_fetch_array(mssql_query("select password from Re_store where id = '$id'"));
	}
		
		$pass=$cus['password'];
		if($pass==$name)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
}
	?>