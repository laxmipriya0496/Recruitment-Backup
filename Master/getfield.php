<?php
require ("../configuration.php");
require ("../user.php");
//$name=$_REQUEST['name'];
echo "<option value='All'>All</option>";
	$cus=mssql_query("select distinct m.user_name,m.user_id from user_log l join user_master m on l.user_id=m.user_id");
	//echo "select * from updated_data where master_name='$name'";
		while($c=mssql_fetch_array($cus))
		{
			?> <option value="<?php  echo $c['user_id']; ?>"><?php echo $c['user_name'];?></option><?php
		}

	?>