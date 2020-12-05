<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$fields=$_REQUEST['fields'];
$date=date("Y-m-d");
$detail=mssql_query("insert into field_configure (name,created_by,created_on)
	values ('$fields','$user','$date')");
	?>