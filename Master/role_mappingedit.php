<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=$_REQUEST['id'];
$user_det=mssql_fetch_array(mssql_query("select *,m.code as codes from role_mapping m join role_master rm on rm.code=m.code join user_master u on m.user_id=u.user_id join department_mapping d on m.user_id=d.user_id  where m.user_id='$id'"));
//echo "<br><br><br><br><br>select * from role_mapping m join role_master rm on rm.code=m.code join user_master u on m.user_id=u.user_id join department_mapping d on m.user_id=d.user_id  where m.user_id='$id'";
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
						<tr><td>User Name</td>
						<td><input type="text" name="user_name" id="user_name" readonly class="form-control" value="<?php echo $user_det['user_name'];
						//$d_list=$user_det['department'];
							//$department_list=explode(",",$d_list);
						?>"></td></tr>
						<tr>
							<td>Role Name</td>
							<td><select name="role_name" id="role_name" class="form-control"  class='chosen-select' required>
							<option value="<?php echo $rs=$user_det['codes'];  ?>"><?php echo $user_det['codes']."-".$user_det['role_name'];  ?></option>
				<?php
				$usergroup=mssql_query("select * from role_master where status='0' and code!='$rs'");
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
						<td>
						<div class="container1">
	Select Department</td><td>
    <select id="multiple-checkboxes" multiple="multiple" name="department_name[]" class="form-control"  style="width:100%;"/>
        <option value="All">All</option>
						<?php 
						$uni=mssql_query("select * from department_master where status=0 ");
						while($uni1=mssql_fetch_array($uni))
						{
						?>
							<option value="<?php echo $uni1['department_name']; ?>" name="<?php echo $uni1['department_name']; ?>" ><?php echo $uni1['department_name']; ?></option>
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
		
			<div class="col-md-8" style="margin-bottom:50px;">
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
						<tr <?php if($row['user_id']==$id) { ?> style="color:green;font-weight:bold;" <?php } ?>>
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
<script>
function email(email,s)
{
 var email_regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

 if(email_regex.test(email)==false)
 {
  alert("Please Enter Correct Email");
  $("#"+s).val("");
  return false;	
 }
}
</script>
<script>
function pass(pass,s)
{
 
 var password_regex1=/([a-z].*[A-Z])|([A-Z].*[a-z])([0-9])+([!,%,&,@,#,$,^,*,?,_,~])/;
 var password_regex2=/([0-9])/;
 var password_regex3=/([!,%,&,@,#,$,^,*,?,_,~])/;

 if(pass.length<8 || password_regex1.test(pass)==false || password_regex2.test(pass)==false || password_regex3.test(pass)==false)
 {
  alert("Please Enter Strong Password");
  $("#"+s).val("");
  return false;
 }
 else
 {
  return true;
 }
}
</script>
<script>
function mobile(phoneNumber,s)
{
	
	var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;

	if (filter.test(phoneNumber)) {
	  if(phoneNumber.length==10){
		   var validate = true;
	  } else {
		  alert('Please put 10  digit mobile number');
		  var validate = false;
		  $("#"+s).val("");
	  }
	}
	else {
	  alert('Not a valid number');
	  var validate = false;
	  $("#"+s).val("");
	}

}
</script>
<script type="text/javascript">
		function checkemail(x,y)
		{
			var newpass=$("#e_mail").val();
			//alert(newpass);
			if(newpass!=x)
			{
				alert("E-Mail Not Match");
				$("#"+y).val("");
			}
		}
   
</script>
<script type="text/javascript">
		function checkpass(x,y)
		{
			var newpass=$("#password").val();
			//alert(newpass);
			if(newpass!=x)
			{
				alert("Passwords Not Match");
				$("#"+y).val("");
			}
		}
   
</script>
<?php

if(isset($_POST['formsent']))  
{  
	$role_name=$_REQUEST['role_name'];
	$date=date("Y-m-d");
	
	if(isset($_REQUEST['department_name']))
	{
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
	}
	else
	{
		$dep=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$id'"));
		$department_name=$dep['department'];
	}
	
		$n1=mssql_query("update department_mapping set department='$department_name',modified_by='$user',modified_on='$date' where user_id='$id'");

	$n=mssql_query("update role_mapping set code='$role_name',modified_by='$user',modified_on='$date' where user_id='$id'");
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
		var dept="<?php echo $user_det['department']; ?>";
    
	<?php 
	$dept=explode(",",$user_det['department']);
	$cnt=count($dept);
	$options1='[';
	for($i=0;$i<$cnt;$i++)
		{
			$not_dep[]=$dept[$i];
			$options1 .= '{label: \'' . $dept[$i] . '\', title: \'' . $dept[$i] . '\', value: \'' . $dept[$i] . '\', selected: true},';
		}
		 $rs123=implode("','",$not_dep);
	$dep_cnt=mssql_query("select * from department_master where department_name not in ('$rs123')");
	while($dp=mssql_fetch_array($dep_cnt))
	{
		$options1 .= '{label: \'' . $dp['department_name'] . '\', title: \'' . $dp['department_name'] . '\', value: \'' . $dp['department_name'] . '\', selected: false},';
	}
	$options1.=']';
	?>
	var options1 =<?php echo $options1; ?>;
    $('#multiple-checkboxes').multiselect('dataprovider', options1);
    });
</script>