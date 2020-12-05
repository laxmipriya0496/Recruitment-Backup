
<?php
require ("../configuration.php");
require ("../user.php");
$name=str_replace(" ","_",$_REQUEST['category_name']);
//echo "<br>";
$name1=$_REQUEST['condition'];
//echo "<br>";
	$cus=mssql_query("select * from field_mapping where field_name='$name'");
		while($c=mssql_fetch_array($cus))
		{
			$type=$c['type']; 
		}
		if($name=="Blood_Group")
		{
			?><td>Search Term &emsp;</td><td>
			<select  name="search1" id="search1" class="form-control" value="" autocomplete="off">
						<option >Select</option>
							<?php 
						$employee_row=mssql_query("select * from bloodgroup_master where status=0");
						?>
								<?php
									while($employee_res=mssql_fetch_array($employee_row))
									{
								?>
									<option><style><?php echo ucwords(str_replace("_"," ",$employee_res['bloodgroup_name']));?></style></option>
									
								<?php
									
									}
									?>
							</select></td><?php
		}
else if($type=="text")
{
	echo '<td>Search Term &emsp;</td><td><input type="text" class="add-on form-control" id="search1" name="search1" value="" autocomplete="off">';
}
elseif($type=="numeric")
{
	if($name1!="Between")
	{
		echo '<td>Search Term  &emsp; </td><td><input type="text" class="add-on form-control" id="search1" name="search1" value="" autocomplete="off">';
	}
	else
	{
		echo '<td>From  &emsp; </td><td><input type="text" class="add-on form-control" id="search1" name="search1" value="" autocomplete="off"></td>&emsp;
			   <td>&emsp;To  &emsp; </td><td><input type="text" class="add-on form-control" id="search2" name="search2" value="" autocomplete="off">';
	}
}
elseif($type=="date")
{
	if($name1!="Between")
	{
		echo '<td>From &emsp; </td><td><input type="text" class="add-on form-control" id="search11" name="search11" placeholder="From Date" value="" autocomplete="off">';
	}
	else
	{
		echo '<td>From  &emsp; </td><td><input type="text" class="add-on form-control" id="search11" name="search11" placeholder="From Date" value="" autocomplete="off"></td>';
		echo '<td>&emsp;To  &emsp;  </td><td><input type="text" class="add-on form-control" id="search12" name="search12" placeholder="To Date" value="" autocomplete="off"></td>';
	}
}
else
{
	
}
	?>
	<script>
	$(document).ready(function() {
			// create DatePicker1 from input HTML element
			$("#search12").kendoDatePicker({
			format: "dd-MM-yyyy"
			});
		});
		
	$(document).ready(function() {
		// create DatePicker from input HTML element
		$("#search11").kendoDatePicker({
		format: "dd-MM-yyyy"
		});
	});
	
	</script>