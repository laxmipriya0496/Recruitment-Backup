<?php
require ("../configuration.php");
require ("../user.php");
$name=str_replace(" ","_",$_REQUEST['name']);
echo "<option value=''> Select</option>";
	$cus=mssql_query("select * from field_mapping f join type_mapping t on f.type=t.type  where f.field_name='$name' ");
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['functions']; ?>"><?php echo $c['functions'];?></option><?php
		}
	?>