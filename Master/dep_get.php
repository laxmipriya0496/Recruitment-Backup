<?php
require ("../configuration.php");
require ("../user.php");
$education=$_REQUEST['education'];
$graduction_name=$_REQUEST['graduction_name'];
$tp=$_REQUEST['tp'];

if($education!="All")
{
	$ed="and Branch_of_Education='$education'";
}
else
{
	$ed="";
}
if($graduction_name!="All")
{
	$gr=" and Graduation='$graduction_name'";
}
else
{
	$gr="";
}

	echo '<option value="All">All</option>';
	$cus=mssql_query("select distinct Department from employee_master where employee_id in (select distinct emp_id from employee_details where University='$tp' $gr $ed )");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['Department']; ?>"><?php echo ucfirst($c['Department']);?></option><?php
		}
	?>