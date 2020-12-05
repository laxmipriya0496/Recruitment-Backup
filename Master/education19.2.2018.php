<?php
require ("../configuration.php");
require ("../user.php");
$name=$_REQUEST['name'];
$tp=implode("','",explode(",",$_REQUEST['tp']));
//echo $dep=implode("','",explode(",",$_REQUEST['dep']))."<br>";
$dep=$_REQUEST['dep'];
if(isset($_REQUEST['tp']))
{
	$uni="and m.Department in ('$dep')";
}
else
{
	$uni="";
}
if($name!="All")
{
	$gra="and Graduation='$name'";
}
else
{
	$gra="";
}

	echo '<option>Select</option>';
	echo '<option value="All">All</option>';
	$cus=mssql_query("select distinct d.Branch_of_Education from employee_master m join employee_details d on m.employee_id=d.emp_id where 1=1 and d.University in ('$tp') $uni $gra");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['Branch_of_Education']; ?>"><?php echo ucfirst($c['Branch_of_Education']);?></option><?php
		}
	?>