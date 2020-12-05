 <?php
 require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
?>
<table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
	<tbody>
		<tr>
			<td>Name</td>
			<td><select name="Name" id="Name"  class='form-control' onchange="emp(this.value);"required>
			<option value="">Select Employee</option>
			<?php
			$state=mssql_query("select * from temp_employee_master where user_id='$user'");
			while($row=mssql_fetch_array($state))
			{
			?>
			<option value="<?php echo $row['temp_employee_id']."-".$row['Name'];?>"><?php echo $row['temp_employee_id']."-".$row['Name'];?></option>
			<?php
			}
			?>							
			</select>
			</td>
		</tr>
	</tbody>			
</table>
<div id="details"></div>
				
					  </div><!-- /.box-body -->
					
 <script>
 function emp(r)
 {
	$.ajax
	({
		type: "GET",
		url: "empqulificationdetail.php",
		data: "id=" + r,		 
		success: function(data)
		{
			$('#details').html(data);
		}
	});	
 }
 </script>