 <?php
 require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=explode("-",$_REQUEST['id']);
$emp_id=$id[0];
 $state=mssql_query("select * from temp_employee_details d right join temp_employee_master m on d.temp_employee_id=m.temp_employee_id
 where m.temp_employee_id='$emp_id' and m.flag is null");
 $cnt=mssql_num_rows($state);
 if($cnt!=0)
 {
?>

 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
		<thead style="color:#0033FF">
			<tr id="row9">	
				<th style="width:3%;">#</th>
				<th style="width:18%;">Type of Education</th>
				<th style="width:33%;">University</th>
				<th style="width:23%;">Branch of Education</th>
				<th style="width:23%;">Graduation</th>
			</tr>
		</thead> </table>					
	<table class="table table-striped" id="rsa">
<tr class="row_1" id="row10">
<td style="width:3%;">
<input type="checkbox" name="chk[]" id="chk_1" value="1" class=" chk" style="width:15px;height:20px;"/>
</td>
<td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_1" class="form-control" value="" autocomplete="off" required placeholder="---Select---">
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
<td style="width:33%;">
<input list="browsers2" name="University[]" id="University_1" class="form-control"value="" required autocomplete="off" placeholder="---Select---">
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
<td style="width:23%;"><input type="text" name="Branch_of_Education[]" required id="Branch_of_Education_1" class="form-control" value=""></td>
<td style="width:23%;"><input type="text" name="Graduation[]" id="Graduation_1" required class="form-control" value=""></td>
</tr>
</table><div class="addline" id="row11">
<input type="button" class=" btn btn-success add_new" value="Add new"> 
<input type="button" class=" btn btn-danger delete" value="Delete"> 
                   </div>	
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					  </div>
					  <input type="hidden" name="empqualification">
 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
		<thead style="color:#0033FF">
			<tr id="row9">	
				<th style="width:3%;">#</th>
				<th style="width:18%;">Employee Code</th>
				<th style="width:18%;">Type of Education</th>
				<th style="width:33%;">University</th>
				<th style="width:23%;">Branch of Education</th>
				<th style="width:23%;">Graduation</th>
				<th style="width:23%;">Edit</th>
			</tr>
		</thead>
		<?php $s=1;
			while($row=mssql_fetch_array($state))
			{?>
			<tr>
				<td><?php echo $s++; ?></td>
				<td><?php echo $row['temp_employee_id']; ?></td>
				<td><?php echo $row['type_of_education']; ?></td>
				<td><?php echo $row['University']; ?></td>
				<td><?php echo $row['Branch_of_Education']; ?></td>
				<td><?php echo $row['Graduation']; ?></td>
				<td  align="center"><input type="button" class="btn btn-info" onclick="ravi1(<?php echo $row['id']; ?>)" value="Edit" name="edit"></td>
			</tr>

			<?php } ?>			
</table>
 <?php }?>	
 
					  
 <script language="javascript">
 $('.add_new').click(function(){
	var len=$('#rsa tr').length;
	//alert(len);
	len=len+1;
	
	 $('.table-striped').append('<tr class="row_'+len+'"><td style="width:3%;"><input type="checkbox" name="chk[]" id="chk_'+len+'" value="'+len+'" class=" chk" style="width:15px;height:20px;"/></td><td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_'+len+'" required class="form-control" value="" autocomplete="off" placeholder="---Select---"></td><td style="width:33%;"><input list="browsers2" name="University[]" required id="University_'+len+'" class="form-control"value="" autocomplete="off" placeholder="---Select---"></td><td style="width:23%;"><input type="text" name="Branch_of_Education[]" id="Branch_of_Education_'+len+'" required class="form-control" value=""></td><td style="width:23%;"><input type="text" name="Graduation[]" id="Graduation_'+len+'" class="form-control" required value=""></td></tr>');
	
	
});
$('.delete').click(function()

{
	$('input:checkbox:checked.chk').map(function(){
	
	var id=$(this).val();
	var rs=$('#rsa tr').length;
	if(rs==1)
	{
		alert("You Can't Delete All the Rows");
		//alert(rs);
	}
	else
	{
		//alert(rs);
		$('.row_'+id).remove();
	}
	
	});
});
 </script>