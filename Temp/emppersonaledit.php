 <?php
 require ("../configuration.php");
require ("../user.php");
$id=$_REQUEST['id'];

$emp=mssql_fetch_array(mssql_query("select *,sm.name as state,sm.id as state_id from temp_employee_master em
join state_master sm on sm.id=em.State_of_Origin where em.id='$id'"));
 ?>
  <form role="form" name="area" action=""  method="post" style="margin:0;">
 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
<tbody>
<tr>
	<td>Name</td>
	<td><input type="text" name="Name" id="Name" class="form-control" value="<?php echo $emp['Name'];  ?>"   required>
	<input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id;?>"></td>
	<td>Position Applied For</td>
	<td><input type="text" name="applied_for" id="applied_for" class="form-control" value="<?php echo $emp['applied_for'];  ?>"   ></td>
</tr>
<tr>
	<td>Department</td>
	<td><input type="text" name="Department" id="Department" class="form-control" value="<?php echo $emp['Department'];  ?>" ></td>
	<td>Pan Number</td>
	<td><input type="text" name="Pan_Number" id="Pan_Number" class="form-control" value="<?php echo $emp['Pan_Number'];  ?>" ></td>
</tr>
<tr>
	<td>Phone Number</td>
	<td><input type="text" name="Phone_Number" id="Phone_Number" class="form-control" onchange="phone(this.value,this.id);" value="<?php echo $emp['Phone_Number'];  ?>" ></td>
	<td>Aadhar Number</td>
	<td><input type="text" name="Aadhar_Number" id="Aadhar_Number" class="form-control" onchange="phone(this.value,this.id);" value="<?php echo $emp['Aadhar'];  ?>" ></td>
	
</tr>
<tr>
	<td>E-Mail</td>
	<td><input type="text" name="email" id="email" class="form-control" value="<?php echo $emp['email'];  ?>"  onchange="mail(this.value,this.id);" ></td>
		
	<td>Religion</td>
	<td><input type="text" name="Religion" id="Religion" class="form-control" value="<?php echo $emp['Religion'];  ?>" ></td>
</tr>
<tr>
	<td>Present Address</td>
	<td><textarea name="Present_Address" id="Present_Address" rows="3" cols="40" class="form-control" style="resize:none;"><?php echo $emp['Present_Address'];  ?></textarea></td>
	<td>Permanent Address</td>
	<td><textarea name="Permanent_Address" id="Permanent_Address" rows="3" cols="40" class="form-control" style="resize:none;"><?php echo $emp['Permanent_Address'];  ?></textarea></td>

	</tr>
<tr>
	<td>Date Of Birth</td>
	<td><input type="text" name="Date_Of_Birth" id="Date_Of_Birth" class="form-control" value="<?php echo date("d-m-Y",strtotime($emp['Date_Of_Birth']));  ?>" ></td>

	<td>Gender</td>
	<?php if($emp['Gender']=="Male")
	{
		?><td>
	<input type="radio" checked name="Gender" value="Male" />&emsp;Male &emsp;   <input type="radio" name="Gender" value="Female"/>&emsp;Female</td><?php
	}
else
{
	?><td>
	<input type="radio"  name="Gender" value="Male" />&emsp;Male &emsp;   <input type="radio" name="Gender" checked value="Female"/>&emsp;Female</td><?php
}	?>
	
	</tr>
<tr>
	<td>State of Origin</td>
	<td><select name="State_of_Origin" id="State_of_Origin"  class='form-control'>
	<option value="<?php echo $state_id=$emp['state_id']; ?>"><?php echo $emp['state']; ?></option>
	<?php
	$state=mssql_query("select id,name from state_master where status='0' and id!='$state_id'");
	while($row=mssql_fetch_array($state))
	{
	?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
	<?php
	}
	?>							
</select></td>
	<td>Blood Group</td>
	<td><select name="Blood_Group" id="Blood_Group"  class='form-control'>
	<option value="<?php echo $bg=$emp['Blood_Group']; ?>"><?php echo $emp['Blood_Group']; ?></option>
	<?php
	$blood=mssql_query("select id,bloodgroup_name from bloodgroup_master where status='0' and bloodgroup_name!='$bg'");
	while($blood1=mssql_fetch_array($blood))
	{
	?>
		<option value="<?php echo $blood1['bloodgroup_name'];?>"><?php echo $blood1['bloodgroup_name'];?></option>
	<?php
	}
	?>							
</select></td>
</tr>
</tbody>			
</table>
	 <div class="box-footer">
	   <input type="hidden" name="updateper" value='0'/>
		<input type="submit" class="btn btn-primary" value="Update" name="submit">
	  </div>
</form>

<link rel="stylesheet" href="<?php echo URL;?>css/kendo.common-material.min.css" />
    <link rel="stylesheet" href="<?php echo URL;?>css/kendo.material.min.css" />
	<script src="<?php echo URL;?>js/kendo.all.min.js"></script>
	
	<script>
		$(document).ready(function() {
			// create DatePicker from input HTML element
			$("#Date_Of_Birth").kendoDatePicker({
			format: "dd-MM-yyyy"
			});
		});
	
	</script>