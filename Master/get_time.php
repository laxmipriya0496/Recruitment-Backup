<?php
require ("../configuration.php");
require ("../user.php");
$name=date("Y-m-d",strtotime($_REQUEST['name']));
	$cus=mssql_query("select time from back_up where date='$name' order by time desc");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo date("H:i:s",strtotime($c['time'])); ?>"><?php echo date("H:i:s",strtotime($c['time']));?></option><?php
		}
	?>