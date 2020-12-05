<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
	$date=date("Y-m-d h:i:s");

$univ1=mssql_query("select distinct University from employee_master m join employee_details d on m.employee_id=d.emp_id
 where d.University like '%University%'");
 while($univ2=mssql_fetch_array($univ1))
 {
	$un=$univ2['University'];
	$cnt=mssql_num_rows(mssql_query("select * from university_master where university_name='$un'"));
	if($cnt==0)
	{
		$sql=mssql_query("select * from university_master order by 1 desc");
		$cnt1=mssql_num_rows($sql);
		if($cnt1!=0)
		{
			$sql1=mssql_fetch_array($sql);
			$university_code=$sql1['university_code'];
			$rs=explode("-",$university_code);
			$number=$rs[1]+1;
			$code=$rs[0]."-".str_pad($number, 3, '0', STR_PAD_LEFT);
		}
		else
		{
			$code="UNI-001";
		}
		mssql_query("insert into university_master (university_code,university_name,status,created_by,created_on)
	values ('$code','$un',0,'$username','$date')");
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
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap-select.min.css" />
	<script src="<?php echo URL;?>js/nameval.js"></script>
	
	 <script src="js/canvasjs.min.js"></script>
  <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript" src="../script.js"></script>
  <script src="multi/jquery.js"></script>
  <link rel="stylesheet" href="multi/bootstrap.min.css">
  <script type="text/javascript" src="multi/bootstrap.min.js"></script>
  <script src="multi/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="multi/bootstrap-multiselect.css">
  <script src="<?php echo URL;?>js/bootstrap-select.min.js"></script>
  <link rel="stylesheet" href="<?php echo URL;?>css/navcss.css"> 
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
			<div class="col-md-4">
				 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>University Name</td>
							<td><input type="text" class="form-control" name="university_name" id="university_name" onchange="nameval(this.value,this.id,'university_master','university_name','University Name')" required></td>
						</tr>						
						<tr>
							<td>University Address</td>
							<td><textarea name="university_address" class="form-control" id="university_address" style="resize:none;" rows="4" cols="40"></textarea></td>
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
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;margin-bottom:50px;">
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
	$sql=mssql_query("select * from university_master order by 1 desc");
	$cnt=mssql_num_rows($sql);
	if($cnt!=0)
	{
		$sql1=mssql_fetch_array($sql);
		$university_code=$sql1['university_code'];
		$rs=explode("-",$university_code);
		$number=$rs[1]+1;
		$code=$rs[0]."-".str_pad($number, 3, '0', STR_PAD_LEFT);
	}
	else
	{
		$code="UNI-001";
	}
	
	$university_name=$_POST["university_name"];
	$university_address=$_POST["university_address"];
	$n=mssql_query("insert into university_master (university_code,university_name,university_address,status,created_by,created_on)
	values ('$code','$university_name','$university_address',0,'$username','$date')");
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
            window.location = "masters_configure.php";
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
           window.location = "masters_configure.php";
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