<?php
require ("../configuration.php");
require ("../user.php");
$uni=implode("','",explode(",",$_REQUEST['uni']));
if($uni!="All")
{
	$u= "and d.University in ('$uni')";
}
else
{
	$u="";
}
$dep=$_REQUEST['dep'];
if($dep!="All")
	{
		$dt=" and m.Department in('$dep')";
	}
	else
	{
		$dt="";
	}
	echo '<option value="">Select</option>';
	echo '<option value="All">All</option>';
	$cus=mssql_query("select distinct d.Graduation from employee_master m join employee_details d on m.employee_id=d.emp_id
where 1=1 $dt $u");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['Graduation']; ?>"><?php echo ucfirst($c['Graduation']);?></option><?php
		}
	?>