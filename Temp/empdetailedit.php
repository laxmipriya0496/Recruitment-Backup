 <?php
 require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=$_REQUEST['id'];
$epu=mssql_fetch_array(mssql_query("select * from temp_employee_details where id='$id'"));
//echo "select * from temp_employee_details where id='$id'";
?>
 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
		<thead style="color:#0033FF">
			<tr id="row9">	
				<th>Employee Code</th>
				<th>Type of Education</th>
				<th>University</th>
				<th>Branch of Education</th>
				<th>Graduation</th>
			</tr>
		</thead>	
</table>
<table class="table table-striped" id="rsa">
<tr class="row_1" id="row10">
<td><input type="text" name="emp_code" id="emp_code" class="form-control" value="<?php echo $epu['temp_employee_id'];?>" readonly>
<input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id;?>" readonly></td>
<td><input list="browsers1" name="Type_of_Education" id="Type_of_Education_1" class="form-control" value="<?php echo $epu['type_of_education'];?>" autocomplete="off">
						<datalist id="browsers1">
<?php $employee_row1=mssql_query(" select distinct proof_name from proofupload_master order by 1 asc");?>
						<select class="form-control" id="rs">
								<?php
									while($employee_res1=mssql_fetch_array($employee_row1))
									{
								?>
									<option><style><?php echo $employee_res1['proof_name'];?></style></option>
								<?php
									}
									?>
							</datalist>
</td>
<td>
<input list="browsers2" name="University" id="University_1" class="form-control"value="<?php echo $epu['University'];?>" autocomplete="off">
<datalist id="browsers2">
<?php $employee_row=mssql_query("select distinct university_name from university_master order by 1 asc");?>
						<select class="form-control" id="rs">
								<?php
									while($employee_res=mssql_fetch_array($employee_row))
									{
								?>
									<option><style><?php echo $employee_res['university_name'];?></style></option>
								<?php
									}
									?>
							</datalist></td>
<td><input type="text" name="Branch_of_Education" id="Branch_of_Education_1" class="form-control" value="<?php echo $epu['Branch_of_Education'];?>"></td>
<td><input type="text" name="Graduation" id="Graduation_1" class="form-control" value="<?php echo $epu['Graduation'];?>"></td>
</tr>
</table>
					  </div><!-- /.box-body -->
					
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Update" name="submit">
					  </div>
					  <input type="hidden" name="empqualificationedit">