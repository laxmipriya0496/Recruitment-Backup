<?php
require ("../configuration.php");
require ("../user.php");

date_default_timezone_set("Asia/Kolkata");
$curdate=date("d-m-y");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
?>
<html lang="en">
<head>
 <title><?php echo TITLE ;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome-animation.css">
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
  <link rel="stylesheet" href="<?php echo URL;?>css/navcss.css">  
<script src="js/sweet-alert.js"></script>
<link rel="stylesheet" href="css/sweet-alert.css" />
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.all.min.js"></script>
	
	 <script src="js/canvasjs.min.js"></script>
  <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript" src="../script.js"></script>
  <script src="multi/jquery.js"></script>
  <link rel="stylesheet" href="multi/bootstrap.min.css">
  <script type="text/javascript" src="multi/bootstrap.min.js"></script>
  <script src="multi/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="multi/bootstrap-multiselect.css">
  <style media="print" type="text/css">
 body
{
/*font-size:10px !important;
*/}
.table
{
line-height:0px!important;
letter-spacing:0px!important;
text-transform:uppercase;
/*font-size:10px !important;
*/padding:.5px;
margin-top:0px;
margin-bottom:0px;
}

.col-sm-4 {
    width: 33.3333%;
}
th,td
{
line-height:1px;
}
th
{
color:#0088cc;
}
section
{
line-height:1px!important;
letter-spacing:1px!important;
}
.invoice {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f4f4f4;
    margin: 0px!important;
    padding: 0px!important;
    position: relative;
}
 .mas {
    white-space: pre-wrap!important;
}
</style>
  <style>
  .k-autocomplete, .k-colorpicker, .k-combobox, .k-datepicker, .k-datetimepicker, .k-dropdown, .k-numerictextbox, .k-selectbox, .k-textbox, .k-timepicker, .k-toolbar .k-split-button
{
	width:100%!important;
}
  .nav-pills > .active1  {
   border-left: 2px solid #3c8dbc;
   padding:2px;
  }
	.btn {
    padding: 9px 15px;
	}
	.form-control {
    height: 40px;
	} 
	.nav>li>a
	{
    padding: 9px 15px;
	} 
	input[type=date]
	{
	line-height: 18px;
    padding: 6px 0px 8px 0px;
	}
.box {
    border-top-color: #3c8dbc;
}
  
.mas {
    white-space: pre-wrap;
}
.canvasjs-chart-container{
	height: 400px;
}
.icon {
    vertical-align: bottom;
    margin-top: 2px;
    margin-bottom: 3px;
    cursor: pointer;
}

.icon:active {
    opacity: .5;
}

.demo.button input {
    margin-right: 2px;
}

.demo.button .ui-button-text {
    padding: .4em .6em;
    line-height: 0.8;
}

input[type='text'] {
  
  width: 70%;
    padding: 8px;
    border-radius: 5px;

}
.btn-group
{
	width: 100%;
}
.multiselect
{
	width: 100%;
}
</style>
</head><body>
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
		<li><a href="department_mapping.php" class="three-d">Department Mapping
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Department Mapping</span>
				<span class="back" style="background-color:#3db2e1;">Department Mapping</span>
			</span>
		</a></li>
		<li><a href="temp_register_master.php" class="three-d">Temprory User Register
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Temprory User Register</span>
				<span class="back" style="background-color:#3db2e1;">Temprory User Register</span>
			</span>
		</a></li>
		<li><a href="search_configure.php" class="three-d">Search Configure
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Search Configure</span>
				<span class="back" style="background-color:#3db2e1;">Search Configure</span>
			</span>
		</a></li>
		<li><a href="field_configure.php" class="three-d">Field Configure
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Field Configure</span>
				<span class="back" style="background-color:#3db2e1;">Field Configure</span>
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
						<td>
						<div class="container1">
	Select Department</td><td>
    <select id="multiple-checkboxes" multiple="multiple" name="department_name[]" class="form-control"  style="width:100%;" required/>
        <option value="All">All</option>
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
</div></td>
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
							<th>User Name</th>
							<th>Full Name</th>
							<th>Departments</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select * from department_mapping dm join user_master um on um.user_id=dm.user_id");
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
						<td><?php echo $row['user_name']; ?></td>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $dp1; ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="department_mappingedit.php?id=<?php echo $row['user_id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
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
				
				<?php
 if(isset($_REQUEST['formsent']))
{
	$user_name=explode("-",$_REQUEST['user_name']);
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
		values ('$user_name[0]','$role_code','$department_name','$user','$date')");
if($n)
	{?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
          window.location = "department_mapping.php";
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
           window.location = "department_mapping.php";
        });
    }, 100);
</script> 	 
    <?php
}}
			require ("../footer.php");
	?> 
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect();
    });
</script>

</body>
</html>