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
    <script src="js/jquery.min.js"></script>
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
				<span class="front" style="background-color:#3db2e1;">University</span>
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
				<span class="front" style="background-color:#313131;">Employee Code Configure</span>
				<span class="back" style="background-color:#3db2e1;">Employee Code Configure</span>
			</span>
		</a></li>
<!-- more items here -->
	</ul>
</div>
			<?php
				$uni1=mssql_fetch_array(mssql_query("select * from university_master where id='$id'"));
			?>
			<div class="col-md-4">
				 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>University Code</td>
							<td><input type="text" class="form-control" name="university_code" readonly id="university_code" value="<?php echo $uni1['university_code']; ?>" required></td>
						</tr>	
						<tr>
							<td>University Name</td>
							<td><input type="text" class="form-control" name="university_name" id="university_name" value="<?php echo $uni1['university_name']; ?>" required></td>
						</tr>						
						<tr>
							<td>Unversity Address</td>
							<td><textarea name="university_address" class="form-control" id="university_address" style="resize:none;" rows="4" cols="40"><?php echo $uni1['university_address']; ?></textarea></td>
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
			<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr id="row2">
					<td>Search University</td>
					<td><input type="text" name="search" id="search" onkeyup="rs(this.value);"class="form-control" placeholder="Type Here"></td>
                  </tr>
                      </tbody>
                    </table><!-- /.table -->
					 </form>
			<form role="form" name="area"  method="post">
                  <div class="box-body">
				   <div id="change">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr style="color:blue;">
							<th>Unversity Code</th>
							<th>Unversity Name</th>
							<th>Unversity Address</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select *,case when (status=0) then 'Active' else 'Inactive' end as sta from university_master order by university_code asc");
					while($row=mssql_fetch_array($uni))
					{
				?>
						<tr>
						<td><?php echo $row['university_code']; ?></td>
						<td><?php echo $row['university_name']; ?></td>
						<td><?php echo $row['university_address']; ?></td>
						<td><?php echo $row['sta']; ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="university_masteredit.php?id=<?php echo $row['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
						</tr>	
				<?php
					}
					?>
					</table>					   
					  </div>
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
	$university_code=$_POST["university_code"];
	$university_name=$_POST["university_name"];
	$university_address=$_POST["university_address"];
	$status=$_POST["status"];
	$date=date("Y-m-d h:i:s");
	
	$old_det=mssql_fetch_array(mssql_query("select * from university_master where id='$id'"));
	$oid_university_name=$old_det['university_name'];
	$oid_university_address=$old_det['university_address'];
	$oid_status=$old_det['status'];
	
	$old=array($oid_university_name,$oid_university_address,$oid_status);
	
	$new=array($university_name,$university_address,$status);
	
	$field=array("name","university_address","status");
	
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
			$ins=mssql_query("INSERT INTO updated_data(employee_id,column_name,old_value,new_value,master_name,ip_address,created_by,created_on) VALUES ('$university_code','$field[$r]','$old[$r]','$new[$r]','University Master','$ip','$user','$d')");
		}
	}
	
	$rs=mssql_fetch_array(mssql_query("select * from university_master where id='$id'"));
	$old_un=$rs['university_name'];
	
	$n=mssql_query("update university_master set university_name='$university_name',university_address='$university_address',status='$status',modified_by='$username',modified_on='$date' where id='$id'");
	
	$n1=mssql_query("update employee_details set University='$university_name' where University='$old_un'");
if($n1)
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "university_master.php";
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
           window.location = "university_master.php";
        });
    }, 100);
</script> 	  
	<?Php
	}	
}  
?>  

<script>
function rs(name)
{
	$.ajax
	({
		type: "GET",
		url: "table.php",
		data: "name=" + name,		 
		success: function(data)
		{
			$('#change').html(data);
			//alert(data);
		}
	});	
}
</script>