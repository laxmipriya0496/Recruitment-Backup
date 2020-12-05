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
</head>
<body>
	<?php
		require ("../header.php");
		require ("checkbox.js");
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
				<span class="front" style="background-color:#313131;">Role Mapping</span>
				<span class="back" style="background-color:#3db2e1;">Role Mapping</span>
			</span>
		</a></li>
		<li><a href="department_mapping.php" class="three-d">Department Mapping
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Department Mapping</span>
				<span class="back" style="background-color:#3db2e1;">Department Mapping</span>
			</span>
		</a></li>
<!-- more items here -->
	</ul>
</div>
		</div>
		<div class="col-md-6" style="margin-bottom:50px;">
		 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>User Name</td>
							<td><select name="user_name" id="user_name" class="form-control"  class='chosen-select' required>
							<option value="">Select User</option>
				<?php
				$usergroup1=mssql_query("select user_name,full_name,user_id from user_master where user_name not in (select user_id from role_mapping)");
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
							<td>Department</td>
							<td><select name="department_name" id="department_name" class="form-control"  class='chosen-select' required>
							<option value="">Select Department</option>
							<option value="">Select Department</option>
				<?php
				$dep=mssql_query("select distinct Department from employee_master");
					while($dep1=mssql_fetch_array($dep))
					{
				?>
							<option value="<?php echo $dep1['Department'];?>"><?php echo $dep1['Department'];?></option>
				<?php
					}
				?>							
			</select></td>
						</tr>
						
					</table>					   
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					  </div>
					  <input type="hidden" name="formsent">
                </form>
		</div>
		
			<div class="col-md-6"  style="margin-bottom:50px;">
			<form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;margin-bottom:50px;">
						<tr style="color:blue;">
							<th>Role Code</th>
							<th>Role Name</th>
							<th>Approval</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select *,case when (status=0) then 'Active' else 'Inactive' end as sta,case when (approval=0) then 'Yes' else 'No' end as app from role_master order by id asc");
					while($row=mssql_fetch_array($uni))
					{
				?>
						<tr>
						<td><?php echo $row['code']; ?></td>
						<td><?php echo $row['role_name']; ?></td>
						<td><?php echo $row['app']; ?></td>
						<td><?php echo $row['sta']; ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="role_masteredit.php?id=<?php echo $row['code'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
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
	$user_name=explode("-",$_REQUEST['user_name']);
	$menu=$_REQUEST['menu'];
	$cnt=count($menu);
	$check=mssql_num_rows(mssql_query("SELECT code FROM department_mapping ORDER BY code desc"));
	//$tab_id=$_REQUEST['id'];
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
	for($r=0;$r<$cnt;$r++)
	{
		$ra="new".($r+1);
		$new=$_REQUEST[$ra];
		$me=explode(":",$menu[$r]);
		$n=mssql_query("insert into department_mapping (user_id,code,menu_id,submenu_id,view_only,edit_only,all_only,created_by)
		values ('$user_name[0]','$role_code','$me[0]','$me[1]','$new','','','$user')");/* 
		
		echo "insert into department_mapping (user_id,code,menu_id,submenu_id,view_only,edit_only,all_only,created_by)
		values ('$user_name[0]','$role_code','$me[0]','$me[1]','$new','','','$user')<br><br><br><br><br><br><br><br>"; */
	}
if($n)
	{?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
          // window.location = "department_mapping.php";
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
           //window.location = "department_mapping.php";
        });
    }, 100);
</script> 	 
    <?php
	}	
}  
?>  