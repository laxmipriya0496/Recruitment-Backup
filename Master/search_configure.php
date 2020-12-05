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
		<li><a href="temp_register_master.php" class="three-d">Temporary User Register
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Temporary User Register</span>
				<span class="back" style="background-color:#3db2e1;">Temporary User Register</span>
			</span>
		</a></li>
		<li><a href="search_configure.php" class="three-d">Search Configuration
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Search Configuration</span>
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
							<td>Field Name</td>
							<td><input type="text" class="form-control" name="field_name" id="field_name" onchange="get_state()" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>Type</td>
							<td>
							<select name="type" id="type" class="form-control"  class='chosen-select' required>
							<option value="">Select Type</option>
							<option value="text">Text</option>
							<option value="date">Date</option>
							<option value="int">Number</option>
							</select></td>
						</tr>
						<tr>
							<td>Document</td>
							<td>
							<select name="document" id="document" class="form-control"  class='chosen-select' required title="Select an item in the list or create a new document type">
							<option value="">Select Document</option>
				<?php
				$usergroup1=mssql_query("select * from dbo.proofupload_master");
					while($user_group11=mssql_fetch_array($usergroup1))
					{
				?>
							<option value="<?php echo $user_group11['proof_code'];?>"><?php echo $user_group11['proof_name'];?></option>
				<?php
					}
				?>							
			</select></td>
						</tr>
						<tr><td colspan=2 style="text-align:center;"><a href="category_master.php">Select an item in the Document list or click here to create a new document
						<input type="button" value="Create Documents" class="btn btn-info" title="Select an item in the list or create a new document type"/></a></td></tr>
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
							<th>Field Name</th>
							<th>Type</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select *,case when (status=0) then 'Active' else 'Inactive' end as sta from field_mapping order by id asc");
					while($row=mssql_fetch_array($uni))
					{
				?>
						<tr>
						<td><?php echo ucwords(str_replace('_', ' ',$row['field_name'])); ?></td>
						<td><?php echo $row['type']; ?></td>
						<td><?php echo $row['sta']; ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="search_configureedit.php?id=<?php echo $row['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
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
	$field_name=str_replace(' ', '_',$_POST["field_name"]);
	$type=$_POST["type"];
	$document=$_POST["document"];
	
	$order=mssql_fetch_array(mssql_query("select * from field_mapping order by order_by desc"));
	$order_by=$order['order_by']+1;
	
	$n=mssql_query("insert into field_mapping (field_name,type,status,order_by,created_by,created_on) values ('$field_name','$type','0','$order_by','$user','$date')");
	
	$n1=mssql_query("insert into search_doc_mapping (degree,filepath,created_by,created_on) values (',$field_name,','$document','$user','$date')");
	
	if($type=="text")
	{
		$type="varchar(max)";
	}
	
	$n2=mssql_query("ALTER TABLE employee_master ADD $field_name $type");	

if($n1)
	{?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
          window.location = "search_configure.php";
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
         window.location = "search_configure.php";
        });
    }, 100);
</script> 	 
    <?php
	}	
}  
?>  