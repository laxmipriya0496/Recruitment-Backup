<?php
require ("../configuration.php");
require ("../user.php");
$id=$_REQUEST['id'];
	$cus=mssql_query("update temp_employee_master set flag=1 where id='$id'");
	?>