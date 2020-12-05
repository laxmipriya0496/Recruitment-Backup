<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$state=$_REQUEST['state'];
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
  <style>

.content {
    min-height: 800px;
    padding: 15px 15PX 180PX 15px!important;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid #333!important;
}
.table-bordered {
    border: 1px solid #333!important;
}
.modal-lg {
    width: 85%!important;
}
</style>
</head>

<body>
		<div class="wrapper">
	 	
	 <?php
			require ("../header.php");
	?>  
	 </div>
	 <div class="content-wrapper1">
        <!-- Main content --><section class="content-header">
         <h3><?php echo "State : <b style='color:blue;'>$state</b> " ;  ?></h3>
          <ol class="breadcrumb">
            <li><a href="../menu/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="../Master/state.php"><i class="fa fa-dashboard"></i> Back</a></li>
          </ol>
        </section>
        <section class="content">
          <!-- Default box -->
		<div class="row">
          <div class="col-xs-12">
          <div class="box box-primary">
			<div style="margin-top:50px;">
			
			<table class="table table-hover" style="font-family:'Times New Roman', Times, serif;">
 <tr style="color:blue;">			
	<th>#</th>
	<th>Employee Code</th>
	<th>Employee Name</th>
	<th>Pan Number</th>
	<th>Phone Number</th>
	<th>Aadhar</th>
	<th>Gender</th>
	<th>Religion</th>
	<th>State of Origin</th>
	<th>Blood Group</th>
	<th>View/Edit Details</th>
</tr>

<?php
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));

	if($dep!="All")
	{
		$dt="and Department in ('$dep')";
	}
	else
	{
		$dt="";
	}
$s=1;
$cus=mssql_query("select * from employee_master where State_of_Origin='$state' $dt");
		while($c=mssql_fetch_array($cus))
		{?>
			<tr>
				<td><?php echo $s++;?> </td>
				<td><?php echo $c['employee_id']; ?></td>
				<td><?php echo $c['Name']; ?></td>
				<td><?php echo $c['Pan_Number']; ?></td>
				<td><?php echo $c['Phone_Number']; ?></td>
				<td><?php echo $c['Aadhar']; ?></td>
				<td><?php echo $c['Gender']; ?></td>
				<td><?php echo $c['Religion']; ?></td>
				<td><?php echo $c['State_of_Origin']; ?></td>
				<td><?php echo $c['Blood_Group']; ?></td>
				<td align="center"><div style=" white-space: nowrap;"><a href="employeemaster.php?id=<?php echo $c['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-eye fa-lg icon-white"></i></a></div></td>
			</tr>
			<?php
		}
?> </table></div>
			</div>
			</div>
			</section>
			
				
			  </div>
			  
			  </div>
			  
				</div>
				</div>
				</div>

<?php include('../footer.php'); ?>
</body>
</html>
