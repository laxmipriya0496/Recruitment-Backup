<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
	$date=date("Y-m-d h:i:s");

$univ1=mssql_query("select distinct State_of_Origin from employee_master");
 while($univ2=mssql_fetch_array($univ1))
 {
	$un=$univ2['State_of_Origin'];
	$cnt=mssql_num_rows(mssql_query("select * from state_master where name='$un'"));
	if($cnt==0)
	{
		$sql=mssql_query("select * from state_master order by 1 desc");
		$cnt1=mssql_num_rows($sql);
		if($cnt1!=0)
		{
			$sql1=mssql_fetch_array($sql);
			$state_code=$sql1['state_code'];
			$rs=explode("-",$state_code);
			$number=$rs[1]+1;
			$code=$rs[0]."-".str_pad($number, 3, '0', STR_PAD_LEFT);
		}
		else
		{
			$code="STA-001";
		}
		mssql_query("insert into state_master (state_code,name,status,created_by,created_on)
	values ('$code','$un',0,'$user','$date')");
	}
 }

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
  <script src="<?php echo URL;?>js/jQuery-2.1.4.min.js"></script>
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" /> 
<script src="<?php echo URL;?>js/sweet-alert.js"></script>
<link rel="stylesheet" href="<?php echo URL;?>css/sweet-alert.css" />  
	<script src="<?php echo URL;?>js/nameval.js"></script>
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
				<span class="front" style="background-color:#3db2e1;">State</span>
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
			<div class="col-md-4">
				 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>State Name</td>
							<td><input type="text" class="form-control" name="state_name" id="state_name" onchange="nameval(this.value,this.id,'state_master','name','State Name')" required></td>
						</tr>
						<tr>
							<td>Country Name</td>
							<td><input type="text" class="form-control" name="country_name" id="country_name" required></td>
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
							<th>State Code</th>
							<th>State Name</th>
							<th>Country Name</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select *,case when (status=0) then 'Active' else 'Inactive' end as sta from state_master order by state_code asc");
						$r=1;
					while($row=mssql_fetch_array($uni))
					{
				?>
						<tr>
						<td><?php echo $r++; ?></td>
						<td><?php echo $row['state_code']; ?></td>
						<td><?php echo ucwords(strtolower($row['name'])); ?></td>
						<td><?php echo ucwords(strtolower($row['country'])); ?></td>
						<td><?php echo ucwords(strtolower($row['sta'])); ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="state_masteredit.php?id=<?php echo $row['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
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
<script>
function get_state()
	{
		//alert ("test");
	}
</script>
<?php
if(isset($_POST['formsent']))  
{  
	$sql=mssql_query("select * from state_master order by state_code desc");
	$cnt=mssql_num_rows($sql);
	if($cnt!=0)
	{
		$sql1=mssql_fetch_array($sql);
		$state_code=$sql1['state_code'];
		$rs=explode("-",$state_code);
		$number=$rs[1]+1;
		$code=$rs[0]."-".str_pad($number, 3, '0', STR_PAD_LEFT);
	}
	else
	{
		$code="STA-001";
	}
	
	$state_name=$_POST["state_name"];
	$country_name=$_POST["country_name"];
	$n=mssql_query("insert into state_master (state_code,name,country,status,created_by,created_on)
	values ('$code','$state_name','$country_name',0,'$user','$date')");
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
            window.location = "state_master.php";
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
           window.location = "state_master.php";
        });
    }, 100);
</script> 	  
	<?Php
	}	
}  
?>  
