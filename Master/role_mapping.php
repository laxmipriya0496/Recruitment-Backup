<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>MRF</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome-animation.css">
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo URL;?>css/navcss.css"> 
	<script src="<?php echo URL;?>js/jquery.min.js"></script>
<script src="js/sweet-alert.js"></script>
<link rel="stylesheet" href="css/sweet-alert.css" />
  <script src="multi/jquery.js"></script>
  <link rel="stylesheet" href="multi/bootstrap.min.css">
  <script type="text/javascript" src="multi/bootstrap.min.js"></script>
  <script src="multi/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="multi/bootstrap-multiselect.css">
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
		<li><a href="register_master.php" class="three-d">Register
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Register</span>
				<span class="back" style="background-color:#3db2e1;">Register</span>
			</span></a>
		</li>
		<li><a href="role_master.php" class="three-d">Role Master
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Role Master</span>
				<span class="back" style="background-color:#3db2e1;">Role Master</span>
			</span>
		</a></li>
		<li><a href="role_mapping.php" class="three-d">Role Mapping
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Role Mapping</span>
				<span class="back" style="background-color:#3db2e1;">Role Mapping</span>
			</span>
		</a></li>
		<li><a href="temp_register_master.php" class="three-d">Temporary User Register
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Temporary User Register</span>
				<span class="back" style="background-color:#3db2e1;">Temporary User Register</span>
			</span>
		</a></li>
		<li><a href="search_configure.php" class="three-d">Search Configuration
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Search Configuration</span>
				<span class="back" style="background-color:#3db2e1;">Search Configuration</span>
			</span>
		</a></li>
		<li><a href="field_configure.php" class="three-d">Field Configuration
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Field Configuration</span>
				<span class="back" style="background-color:#3db2e1;">Field Configuration</span>
			</span>
		</a></li>
		<li><a href="backup.php" class="three-d">Backup
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Backup</span>
				<span class="back" style="background-color:#3db2e1;">Backup</span>
			</span>
		</a></li>
		<li><a href="mac_config.php" class="three-d">MAC Configuration
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">MAC Configuration</span>
				<span class="back" style="background-color:#3db2e1;">MAC Configuration</span>
			</span>
		</a></li>
<!-- more items here -->
	</ul>
</div>
		</div>
		<div class="col-md-4" style="margin-bottom:50px;">
		 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Role Name</td>
							<td><select name="role_name" id="role_name" class="form-control"  class='chosen-select' required>
							<option value="">Select Role</option>
				<?php
				$usergroup=mssql_query("select * from role_master where status='0'");
					while($user_group=mssql_fetch_array($usergroup))
					{
				?>
							<option value="<?php echo $user_group['code'];?>"><?php echo $user_group['code']."-".$user_group['role_name'];?></option>
				<?php
					}
				?>							
			</select></td>
						</tr>
						<tr>
							<td>User Name</td>
							<td><select name="user_name" id="user_name" class="form-control"  class='chosen-select' required>
							<option value="">Select User</option>
				<?php
				$usergroup1=mssql_query("select user_name,full_name,user_id from user_master where user_id not in (select user_id from role_mapping)");
					while($user_group11=mssql_fetch_array($usergroup1))
					{
				?>
							<option value="<?php echo $user_group11['user_id']."-".$user_group11['full_name'];?>"><?php echo $user_group11['user_name']."-".$user_group11['full_name'];?></option>
				<?php
					}
				?>							
			</select></td>
						</tr>
						<tr>
						<td>
						<div class="container1">
	Select Department</td><td>
    <select id="multiple-checkboxes" multiple="multiple" name="department_name[]" class="form-control"  style="width:100%;" required>
						<?php 
						$uni=mssql_query("select * from department_master where status=0 ");
						while($uni1=mssql_fetch_array($uni))
						{
						?>
							<option value="<?php echo $uni1['department_name']; ?>"><?php echo $uni1['department_name']; ?></option>
						<?php
						}
						?>
    </select>
</div></td></tr>
					</table>					   
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					  </div>
					 
					  <input type="hidden" name="formsent">
                </form>
		</div>
		
			<div class="col-md-8"  style="margin-bottom:50px;">
			<form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;margin-bottom:50px;">
						<tr style="color:blue;">
							<th>Role code</th>
							<th>Role Name</th>
							<th>User Name</th>
							<th>Departments</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select *,case when (r.status=0) then 'Active' else 'Inactive' end as sta,r.code as roles from role_mapping r
join user_master m on r.user_id=m.user_id 
join role_master rm on r.code=rm.code 
join department_mapping dm on dm.user_id=m.user_id order by r.code asc");
					while($row=mssql_fetch_array($uni))
					{
						$dp=$row['department'];
						$dep=mssql_query("SELECT * FROM department_master where status =0");
						while($dep1=mssql_fetch_array($dep))
						{
							$department[]=$dep1['department_name'];
						}
						$department_name=implode(",",$department);
						if($dp==$department_name)
						{
							$dp1="All";
						}
						else
						{
							$dp1=$row['department'];
						}$department="";
				?>
						<tr>
						<td><?php echo $row['roles']; ?></td>
						<td><?php echo $row['role_name']; ?></td>
						<td><?php echo $row['user_name']; ?></td>
						<td><?php echo $dp1; ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="role_mappingedit.php?id=<?php echo $row['user_id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
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

<?php include('../footer.php'); ?>
</body>
</html>
<?php

if(isset($_POST['formsent']))  
{  
	$role_name=$_REQUEST['role_name'];
	$user_name1=explode("-",$_REQUEST['user_name']);
	$user_name=$user_name1[0];

	$n=mssql_query("insert into role_mapping (code,user_id,status,created_by)
	values ('$role_name','$user_name','0','1')");
	
	$department_name=implode(",",$_REQUEST['department_name']);
	if($department_name=="All")
	{
		$dep=mssql_query("SELECT * FROM department_master where status =0");
		while($dep1=mssql_fetch_array($dep))
		{
			$department[]=$dep1['department_name'];
		}
		$department_name=implode(",",$department);
	}
	$date=date("Y-m-d");
	$check=mssql_num_rows(mssql_query("SELECT code FROM department_mapping ORDER BY code desc"));
		if($check==0)
	{
		$role_code="DPM-001";
	}
	else
	{
		$contract_res=mssql_fetch_array(mssql_query("SELECT code FROM department_mapping ORDER BY code desc"));
		$auto_num=$contract_res['code'];
		$no=explode("-",$auto_num);
		 
		$no1=$no[1]+1;
		$sid= str_pad($no1,3,'0',STR_PAD_LEFT);
		$role_code=$no[0]."-".$sid;
	}
	
		$n=mssql_query("insert into department_mapping (user_id,code,department,created_by,created_on)
		values ('$user_name','$role_code','$department_name','$user','$date')");
	
if($n)
	{?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
          window.location = "role_mapping.php";
        });
    }, 100);
</script> 
    <?php
	}	
	else
	{
	?><script>
    setTimeout(function() {
        swal({
            title: "Not",
            text: "Completed!",
            type: "error"
        }, function() {
           window.location = "role_mapping.php";
        });
    }, 100);
</script> 	 
    <?php
	}	
}  
?>  
<script type="text/javascript">
    $(document).ready(function() {
       $('#multiple-checkboxes').multiselect({
            includeSelectAllOption: true,
            onChange: function(option, checked) {
            },
			
        });
    });
</script>