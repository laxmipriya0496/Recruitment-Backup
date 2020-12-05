<?php
require ("../configuration.php");
require ("../user.php");
$name=$_REQUEST['field'];
$value=$_REQUEST['value'];
//$field=$_REQUEST['field'];

$name1=explode(",",$name);
$value1=explode(",",$value);
$cnt=count($name1)-1;
?>
<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif" border=1>
<thead>
	<tr style="color:blue;">
	<th>S.No</th>
	<?php
	for($r=0;$r<$cnt;$r++)
	{
		?>
		<th><?php echo ucwords(str_replace("_"," ",$name1[$r])); ?></th>
		<?php
	}
	?>
	</tr>
	</thead>
<?php

for($i=0;$i<$cnt;$i++)
{
	if($value1[$i]!="")
	{
		$con[]="and ".$name1[$i]." like '%".$value1[$i]."%'";
	}
	else
	{
		$con[]="";
	}
}
$rs=implode(" ",$con);
$cus=mssql_query("select * from employee_master m join employee_details d on m.employee_id=d.emp_id
where 1=1 $rs order by Graduation desc");
//echo "select * from employee_master m join employee_details d on m.employee_id=d.emp_id 	where 1=1 $rs";
$v=1;
while($c=mssql_fetch_array($cus))
{
	?><tr>
	<td><?php echo $v++; ?></td><?php
	for($a=0;$a<$cnt;$a++)
	{
	?>
		<td><?php echo $c[$name1[$a]]; ?></td>
	<?php
	}?>
	
	</tr><?php
}
?></table>