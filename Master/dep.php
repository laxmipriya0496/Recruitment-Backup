<?php
require ("../configuration.php");
require ("../user.php");
$uni1=$_REQUEST['uni'];
$tp=$_REQUEST['tp'];
$Branch=$_REQUEST['Branch'];
$graduction=$_REQUEST['graduction'];
$uni2=explode(",",$uni1);
$uni=implode("','",$uni2);

if($tp!="All")
	{
		$dt="and Department in ('$tp')";
	}
	else
	{
		$dt="";
	}
	
if($uni!="All")
{
	$ui="and University in ('$uni')";
}
else
{
	$ui="";
}
if($Branch!="All")
{
	$br="and Branch_of_Education='$Branch'";
}
else
{
	$br="";
}
if($graduction!="All")
{
	$gra="and Graduation='$graduction'";
}
else
{
	$gra="";
}
	echo '<option value="All">All</option>';
	$cus=mssql_query("select distinct Department from employee_master where employee_id in (
select distinct emp_id from employee_details where 1=1 $dt $ui $br $gra)");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['Department']; ?>"><?php echo ucfirst($c['Department']);?></option><?php
		}
	?>