<?php
require ("../configuration.php");
require ("../user.php");
$name=$_REQUEST['name'];
if($name!="")
{
	$cus=mssql_fetch_array(mssql_query("select filename,id from back_up where time like '%$name%'"));
	$rs=explode("--",$cus['filename']);
	echo $rs[0]."-".$cus['id'];
}
	
	?>