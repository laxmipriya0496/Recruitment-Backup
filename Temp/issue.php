<?php
require ("../configuration.php");
require ("../user.php");
$emp_id=$_REQUEST['emp_id'];
		$cus=mssql_query("select * from temp_employee_master where id='$emp_id'");
		while($item1=mssql_fetch_array($cus))
		{
		?>
				<div id="rav" style="margin:5px;">
                <div id="rs">
				
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-family:Times New Roman;font-weight:bold;">Temprory Employee Master</h3>
	  					<div id="xx">
						<a href="doucuments.php?id=<?php echo $emp_id;?>">
						<input type="button" value="View Documents" class="btn btn-primary"/></a>
						<a class="red" href="employeemasternew.php">
						<span class="pencil1"><i class="fa fa-plus"></i></span>New</a>
						<a class="yellow" href="employeemasteredit.php?id=<?php echo $emp_id;?>">
						<span class="pencil"><i class="fa fa-plus"></i></span>Edit</a>
						<!--<input type="button" onclick="printDiv('rav')" value="Print" class="btn btn-primary"/>
						<input type="submit" name="myButtonControlID" id="myButtonControlID" class="btn btn-primary" value="EXCEL">-->
						</div>
						
                </div><!-- /.box-header -->
				<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif">
					<tbody>
						<tr>
							<td>Temprory ID</td>
							<td><input type="text" name="emp_id" id="emp_id" class="form-control" value="<?php echo $eid=$item1['temp_employee_id']; ?>" readonly ></td>
							<td>Name</td>
							<td><input type="text" name="Name" id="Name" class="form-control" value="<?php echo $item1['Name']; ?>" readonly ></td>
						</tr>
						<tr>
							<td>Department</td>
							<td><input type="text" name="Department" id="Department" class="form-control" value="<?php echo $item1['Department']; ?>" readonly ></td>
							<td>Pan Number</td>
							<td><input type="text" name="Pan_Number" id="Pan_Number" class="form-control" value="<?php echo $item1['Pan_Number']; ?>" readonly ></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><input type="text" name="Phone_Number" id="Phone_Number" class="form-control" value="<?php echo $item1['Phone_Number']; ?>" readonly ></td>
							<td>Aadhar Number</td>
							<td><input type="text" name="Aadhar_Number" id="Aadhar_Number" class="form-control" value="<?php echo $item1['Aadhar']; ?>" readonly ></td>
							
						</tr>
						<tr>
							<td>Gender</td>
							<td><input type="text" name="Gender" id="Gender" class="form-control" value="<?php echo $item1['Gender']; ?>" readonly ></td>
							<td>Religion</td>
							<td><input type="text" name="Religion" id="Religion" class="form-control" value="<?php echo $item1['Religion']; ?>" readonly ></td>
							
						</tr>
						<tr>
							<td>Blood Group</td>
							<td><input type="text" name="Blood_Group" id="Blood_Group" class="form-control" value="<?php echo $item1['Blood_Group']; ?>" readonly ></td>
							<td>E-Mail</td>
							<td><input type="text" name="email" id="email" class="form-control" value="<?php echo $item1['email']; ?>" readonly ></td>
							</tr><tr>
							<td>State of Origin</td>
							<td><input type="text" name="State_of_Origin" id="State_of_Origin" class="form-control" value="<?php echo $item1['State_of_Origin']; ?>" readonly ></td>
						</tr>
					</tbody>
				</table>
				
				<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif">
					<tbody>
					<tr style="color:blue;">
						<th style="text-align:center;">Branch of Education</th>
						<th style="text-align:center;">Type of Education</th>
						<th style="text-align:center;">University</th>
						<th style="text-align:center;">Graduation</th>
					</tr>
					<?php  
					$empde=mssql_query("select * from employee_details where emp_id='$eid'");
					while($empde1=mssql_fetch_array($empde))
					{
						?>
						<tr>
							<td><input type="text" name="Branch_of_Education" id="Branch_of_Education" class="form-control" value="<?php echo $eid=$empde1['Branch_of_Education']; ?>" readonly ></td>
							<td><input type="text" name="type_of_education" id="type_of_education" class="form-control" value="<?php echo $empde1['type_of_education']; ?>" readonly ></td>
							<td><input type="text" name="University" id="University" class="form-control" value="<?php echo $eid=$empde1['University']; ?>" readonly ></td>
							<td><input type="text" name="Graduation" id="Graduation" class="form-control" value="<?php echo $empde1['Graduation']; ?>" readonly ></td>
						</tr>
						<?php
					}
					?>
					
					</tbody>
				</table>
		<?php } ?>