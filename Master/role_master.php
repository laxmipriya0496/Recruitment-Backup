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
				<span class="front" style="background-color:#3db2e1;">Role Master</span>
				<span class="back" style="background-color:#3db2e1;">Role Master</span>
			</span>
		</a></li>
		<li><a href="role_mapping.php" class="three-d">Role Mapping
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Role Mapping</span>
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
		<div class="col-md-6" style="margin-bottom:50px;">
		 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Role Name</td>
							<td><input type="text" class="form-control" name="role_name" id="role_name" autocomplete="off" required></td>
						</tr>
						
						<?php $menu=mssql_query("select id,menu_code from menu_master order by id");
			  $r=1;
			  $s=1;
			while($menu_code=mssql_fetch_array($menu)) 
			{
				?><tr><td><input class="checkbox" style="float:left;" type="checkbox" name="checkbox<?php echo $r;?>" id="checkbox<?php echo $r;?>" onclick="enablebox(this.id)"/>&emsp;<?php  echo $menu_code['menu_code']; ?></td>
				 <input type="hidden"  id="menu" name="menu[]" class="form-control"  value="<?php echo $menu_code['id'];?>" >
				<td><input type="radio" name="new<?php echo $r ; ?>" id="new<?php echo $r.$s++ ; ?>" value="View" disabled />&emsp;View&emsp;&emsp;
				<?php if($menu_code['id']!="9" && $menu_code['id']!="10" &&$menu_code['id']!="11"){ ?>
				<input type="radio" name="new<?php echo $r ; ?>" id="new<?php echo $r++.$s++ ; $s=1;?>" value="All"  disabled />&emsp;All
				<?php } ?>
				</td>
				</tr>
				<?php
			}
			?>
			<!--<tr><td>Approve</td><td><input type="radio" name="approve" id="approve" value="0" />&emsp;Yes&emsp;&emsp;&emsp;
			   <input type="radio" name="approve" id="approve" value="1" />&emsp;No</td></tr>-->
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
	$role_name=$_REQUEST['role_name'];
	//$approve=$_REQUEST['approve'];
	$approve="";
	$menu=$_REQUEST['menu'];
	$cnt=count($menu);
	$check=mssql_num_rows(mssql_query("SELECT code FROM role_master ORDER BY code desc"));
	//$tab_id=$_REQUEST['id'];
		if($check==0)
	{
		$role_code="ROLE-001";
	}
	else
	{
		$contract_res=mssql_fetch_array(mssql_query("SELECT code FROM role_master ORDER BY code desc"));
		$auto_num=$contract_res['code'];
		$no=explode("-",$auto_num);
		 
		$no1=$no[1]+1;
		$sid= str_pad($no1,3,'0',STR_PAD_LEFT);
		$role_code=$no[0]."-".$sid;
	}
			 
	
	$n=mssql_query("insert into role_master (code,role_name,status,approval,created_by)
	values ('$role_code','$role_name','0','$approve','$user')");
	
	for($r=0;$r<$cnt;$r++)
	{
		$ra="new".($r+1);
		$new=$_REQUEST[$ra];
		$me=explode(":",$menu[$r]);
		$detail=mssql_query("insert into role_detail (code,menu_id,submenu_id,view_only,edit_only,all_only,created_by)
		values ('$role_code','$me[0]','$me[1]','$new','','','$user')");
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
           window.location = "role_master.php";
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
           window.location = "role_master.php";
        });
    }, 100);
</script> 	 
    <?php
	}	
}  
?>  