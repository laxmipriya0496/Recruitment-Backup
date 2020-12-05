<?php
require ("../configuration.php");
require ("../user.php");
$name=$_REQUEST['name'];
$tp=$_REQUEST['tp'];
if($tp=="GR")
{
	echo '<option value="">Select</option>';
	$cus=mssql_query("select distinct type from dbo.specialization_mapping where specialization='$name' order by 1 desc");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['type']; ?>"><?php echo $c['type'];?></option><?php
		}
}
elseif($tp=="CT")
{
$gra=$_REQUEST['gra'];
if($gra=="Post Graduation" || $gra=="Graduation")
{
	$rs="and type='$name'";
}
else
{
	$rs="";
}
echo "select distinct degree from dbo.specialization_mapping where specialization='$gra' $rs order by 1 desc";
	echo '<option value="All">All</option>';
	$cus=mssql_query("select distinct degree from dbo.specialization_mapping where specialization='$gra' $rs and degree!='' order by 1 desc");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['degree']; ?>"><?php echo $c['degree'];?></option><?php
		}
}

	?>