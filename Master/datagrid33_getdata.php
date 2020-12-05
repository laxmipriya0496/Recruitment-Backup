<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$dataPoints1='[';
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
$dep=implode("','",explode(",",$u['department']));
$u1=mssql_query("select * from employee_master where Department in('$dep')");
$r=1;
$s=0;
while($c=mssql_fetch_array($u1))
{
  if($r==1)
	{
		$dataPoints1.='{';
	}
	else
	{
		$dataPoints1.=',{';
	}  
	$cnt=count($fidnam);
	for($i=0;$i<$cnt;$i++)
	{
		 if($i==0)
	{
		$dataPoints1.='"'.$fidnam[$s].'":"'.$c[$fidnam[$s++]].'"';
	}
	else
	{
		$dataPoints1.=',"'.$fidnam[$s].'":"'.$c[$fidnam[$s++]].'"';
	}
	
	}
	$dataPoints1.='},';
	$s=0;
}
$dataPoints1.=']';
?>