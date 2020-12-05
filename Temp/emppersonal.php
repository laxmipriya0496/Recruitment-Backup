 <?php
 require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$ava=mssql_fetch_array(mssql_query("select COUNT(USER_ID) as entered,(select nos from temp_user_master where USER_ID='$user') as tot,
((select nos from temp_user_master where USER_ID='$user')-COUNT(USER_ID)) as balance
from temp_employee_master where USER_ID='$user'"));	
if($ava['balance']!=0)
{
		?>
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tbody>
						<tr>
							<td>Name</td>
							<td><input type="text" name="Name" id="Name" class="form-control"    required></td>
							<td>Position Applied For</td>
							<td><input type="text" name="applied_for" id="applied_for" class="form-control"   ></td>
						</tr>
						<tr>
							<td>Department</td>
							<td><input type="text" name="Department" id="Department" class="form-control" value=""  ></td>
							<td>Pan Number</td>
							<td><input type="text" name="Pan_Number" id="Pan_Number" class="form-control" value=""  ></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><input type="text" name="Phone_Number" id="Phone_Number" class="form-control" onchange="phone(this.value,this.id);" value="" ></td>
							<td>Aadhar Number</td>
							<td><input type="text" name="Aadhar_Number" id="Aadhar_Number" class="form-control" onchange="phone(this.value,this.id);" value="" ></td>
							
						</tr>
						<tr>
							<td>E-Mail</td>
							<td><input type="text" name="email" id="email" class="form-control" value=""  onchange="mail(this.value,this.id);" ></td>
								
							<td>Religion</td>
							<td><input type="text" name="Religion" id="Religion" class="form-control" value=""></td>
						</tr>
						<tr>
							<td>Present Address</td>
							<td><textarea name="Present_Address" id="Present_Address" rows="3" cols="40" class="form-control" style="resize:none;"></textarea></td>
							<td>Permanent Address</td>
							<td><textarea name="Permanent_Address" id="Permanent_Address" rows="3" cols="40" class="form-control" style="resize:none;"></textarea></td>
						
							</tr>
						<tr>
							<td>Date Of Birth</td>
							<td><input type="text" name="Date_Of_Birth" id="Date_Of_Birth" class="form-control" value=""></td>
						
							
							<td>Gender</td>
							<td>
							<input type="radio" name="Gender" value="Male" />&emsp;Male &emsp;   <input type="radio" name="Gender" value="Female" />&emsp;Female</td>
							</tr>
						<tr>
							<td>State of Origin</td>
							<td><select name="State_of_Origin" id="State_of_Origin"  class='form-control'>
							<option value="">Select State</option>
				<?php
				$state=mssql_query("select id,name from state_master where status='0'");
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
	<option value="">Select Blood Group</option>
	<?php
	$blood=mssql_query("select id,bloodgroup_name from bloodgroup_master where status='0'");
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
					</table><br>
					 <div class="box-footer">
					   <input type="hidden" name="formsent" value='0'/>
						<input type="submit" class="btn btn-primary" value="Save" name="submit">
					  </div>
					  
					  
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
				
<?php  }
else
{
	?>
	 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif" border=1>
	 <tr><td colspan="11" style="text-align:center;color:#d41235;"><h4>You Have Entered Maximum Number of Registration</h4></td></tr>
	 <tr style="color:blue;">
	 <th>ID</th>
	 <th>Name</th>
	 <th>Applied For</th>
	 <th>Phone Number</th>
	 <th>Gender</th>
	 <th>Date Of Birth</th>
	 <th>E-mail</th>
	 <th>State of Origin</th>
	 <th>Blood Group</th>
	 <th>Edit</th>
	 <th>Submit</th>
	 </tr>
	 <?php 
	 $per=mssql_query("select *,em.id as id1,sm.name as state,em.flag as flg from temp_employee_master em
join state_master sm on sm.id=em.State_of_Origin where em.user_id='$user' order by em.id");
	 while($per1=mssql_fetch_array($per))
	 {
		 ?>
		 <tr>
		 <td><?php echo $per1['temp_employee_id'];?></td>
		 <td><?php echo $per1['Name'];?></td>
		 <td><?php echo $per1['applied_for'];?></td>
		 <td><?php echo $per1['Phone_Number'];?></td>
		 <td><?php echo $per1['Gender'];?></td>
		 <td><?php echo date("d-m-Y",strtotime($per1['Date_Of_Birth']));?></td>
		 <td><?php echo $per1['email'];?></td>
		 <td><?php echo $per1['state'];?></td>
		 <td><?php echo $per1['Blood_Group'];?></td>
		 <?php if($per1['flg']!=1) 
		 {?>
		 <td><input type="button" class="btn btn-info" onclick="ravi(<?php echo $per1['id1']; ?>)" value="Edit" name="edit"></td>
		 <td><input type="button" class="btn btn-success" onclick="sub(<?php echo $per1['id1']; ?>)" value="Submit" name="Submit"></td><?php } ?>
		 </tr>
		 <?php
	 }
	 ?></table>
	
	
	<?php
}	?>
