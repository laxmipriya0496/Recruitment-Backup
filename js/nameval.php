<?php
require ("../configuration.php");
require ("../user.php");
$val=$_REQUEST['val'];
$val=str_replace("positive","+",$val);
$val=str_replace("negative","-",$val);
$table=$_REQUEST['table'];
$colname=$_REQUEST['colname'];
$cus=mssql_num_rows(mssql_query("select * from $table where $colname='$val'"));
echo $cus;
?>