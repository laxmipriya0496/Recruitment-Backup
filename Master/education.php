<?php
require ("../configuration.php");
require ("../user.php");
$name=$_REQUEST['name'];
$uni=implode("','",explode(",",$_REQUEST['uni']));
if($uni!="All")
{
	$ui="and d.University in ('$uni')";
}
else
{
	$ui="";
}
//echo $dep=implode("','",explode(",",$_REQUEST['dep']))."<br>";
$dep=$_REQUEST['dep'];
if($dep!="All")
{
	$dep="and m.Department in ('$dep')";
}
else
{
	$dep="";
}
if($name!="All")
{
	$gra="and Graduation='$name'";
}
else
{
	$gra="";
}
echo "select distinct d.Branch_of_Education from employee_master m join employee_details d on m.employee_id=d.emp_id where 1=1 $ui $dep $gra";
	echo '<option>Select</option>';
	echo '<option value="All">All</option>';
	$cus=mssql_query("select distinct d.Branch_of_Education from employee_master m join employee_details d on m.employee_id=d.emp_id where 1=1 $ui $dep $gra");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['Branch_of_Education']; ?>"><?php echo ucfirst($c['Branch_of_Education']);?></option><?php
		}
	?>