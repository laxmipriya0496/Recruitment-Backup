<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=$_REQUEST['id'];
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title><?php echo TITLE;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome-animation.css">
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css">   
  <link rel="stylesheet" href="<?php echo URL;?>css/navcss.css"> 
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" /> 
<script src="<?php echo URL;?>js/sweet-alert.js"></script>
<link rel="stylesheet" href="<?php echo URL;?>css/sweet-alert.css" />  
</head>
<body>
	<?php
		require ("../header.php");
	?>
<div class="wrapper" style=" width: 97%; margin:0 auto;">
	<div class="row">
		<div class="col-md-12" style="margin-top:5%;">
		<div>
	<ul class="block-menu">
		<li><a href="university_master.php" class="three-d">University
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">University</span>
				<span class="back" style="background-color:#3db2e1;">University</span>
			</span></a>
		</li>
		<li><a href="state_master.php" class="three-d">State
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">State</span>
				<span class="back" style="background-color:#3db2e1;">State</span>
			</span>
		</a></li>
		<li><a href="department_master.php" class="three-d">Department
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Department</span>
				<span class="back" style="background-color:#3db2e1;">Department</span>
			</span>
		</a></li>
		<li><a href="bloodgroup_master.php" class="three-d">Blood Group
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Blood Group</span>
				<span class="back" style="background-color:#3db2e1;">Blood Group</span>
			</span>
		</a></li>
		<li><a href="location_master.php" class="three-d">Location
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Location</span>
				<span class="back" style="background-color:#3db2e1;">Location</span>
			</span>
		</a></li>
		<li><a href="category_master.php" class="three-d">Category
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Category</span>
				<span class="back" style="background-color:#3db2e1;">Category</span>
			</span>
		</a></li>
		<li><a href="employee_code.php" class="three-d">Employee Code Configure
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Employee Code Configure</span>
				<span class="back" style="background-color:#3db2e1;">Employee Code Configure</span>
			</span>
		</a></li>
<!-- more items here -->
	</ul>
</div>
			<?php
				$uni1=mssql_fetch_array(mssql_query("select * from employee_id_master where id='$id'"));
			?>
			<div class="col-md-4">
				 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Employee Code Start</td>
							<td><input type="text" class="form-control" name="start" id="start" value="<?php echo $uni1['employee_id_from']; ?>" required></td>
						</tr>
						<tr>
							<td>Employee Code End</td>
							<td><input type="text" class="form-control" name="end" id="end" value="<?php echo $uni1['employee_id_to']; ?>" required></td>
						</tr>				
						<tr>
							<td>Status</td>
							<?php if($uni1['status']==0)
							{
								?>
								<td> 
								<input type="radio" name="status" id="status" value="0" checked>&emsp;Active&emsp;
								<input type="radio" name="status" id="status" value="1" >&emsp;Inactive
								</td>
								<?php
							}
							else
							{
								?>
								<td> 
								<input type="radio" name="status" id="status" value="0" >&emsp;Active&emsp;
								<input type="radio" name="status" id="status" value="1" checked>&emsp;Inactive
								</td>
								<?php
							}
							?>
						</tr>
					</table>					   
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					  </div>
					  <input type="hidden" name="formsent">
                </form>
			</div>
			<div class="col-md-8">
			<form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;margin-bottom:50px;">
						<tr style="color:blue;">
							<th>#</th>
							<th>Employee Code Start</th>
							<th>Employee Code End</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select *,case when (status=0) then 'Active' else 'Inactive' end as sta from employee_id_master");
						$r=1;
					while($row=mssql_fetch_array($uni))
					{
				?>
						<tr>
						<td><?php echo $r++; ?></td>
						<td><?php echo $row['employee_id_from']; ?></td>
						<td><?php echo $row['employee_id_to']; ?></td>
						<td><?php echo $row['sta']; ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="employee_codeedit.php?id=<?php echo $row['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
						</tr>	
				<?php
					}
					?>
					</table>					   
					  </div><!-- /.box-body -->
                </form>
			</div>
		</div>
	</div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>
<?php
if(isset($_POST['formsent']))  
{  
	$start=$_POST["start"];
	$end=$_POST["end"];
	$status=$_POST["status"];
	$date=date("Y-m-d h:i:s");
	
	$old_det=mssql_fetch_array(mssql_query("select * from employee_id_master where id='$id'"));
	$oid_employee_id_from=$old_det['employee_id_from'];
	$oid_employee_id_to=$old_det['employee_id_to'];
	$oid_status=$old_det['status'];
	
	$old=array($oid_employee_id_from,$oid_employee_id_to,$oid_status);
	
	$new=array($start,$end,$status);
	
	$field=array("employee_id_from","employee_id_to","status");
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$tottt=count($old);
	$d=date("Y-m-d");
	for($r=0;$r<$tottt;$r++)
	{
		if($old[$r]!=$new[$r])
		{
			if($field[$r]=="status")
			{
				if($old[$r]=="0")
				{
					$old[$r]="Active";
				}
				else
				{
					$old[$r]="Inactive";
				}
				if($new[$r]=="0")
				{
					$new[$r]="Active";
				}
				else
				{
					$new[$r]="Inactive";
				}
			}
			$ins=mssql_query("INSERT INTO updated_data(column_name,old_value,new_value,master_name,ip_address,created_by,created_on) VALUES ('$field[$r]','$old[$r]','$new[$r]','Employee Code Master','$ip','$user','$d')");
			//echo "INSERT INTO updated_data(column_name,old_value,new_value,master_name,ip_address,created_by,created_on) VALUES ('$contractor_code','$field[$r]','$old[$r]','$new[$r]','Employee Master','$ip','$user','$d')";
		}
	}
	if($status==0)
	{
		$n1=mssql_query("update employee_id_master set status=1");
	}
	
	$n=mssql_query("update employee_id_master set employee_id_from='$start',employee_id_to='$end',status='$status',modified_by='$user',modified_on='$date' where id='$id'");
if($n)
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "employee_code.php";
        });
    }, 100);
</script>  
    <?php
	}	
	else
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Not",
            text: "Completed!",
            type: "error"
        }, function() {
          window.location = "employee_code.php";
        });
    }, 100);
</script> 	  
	<?Php
	}	
}  
?>  
