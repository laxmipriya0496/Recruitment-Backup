<?php
require ("../configuration.php");
require ("../user.php");
date_default_timezone_set("Asia/Kolkata");
?>
<?php
//$user=$_SESSION['user'];
//$username=$_SESSION['user_name'];
$emp_code=$_REQUEST['empcode'];
//$ip=$_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ;?></title>
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
				<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
				<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
				<link rel="stylesheet" type="text/css" media="screen" href="<?php echo URL;?>css/bootstrap-datetimepicker.min.css">
				<style>
				.div1 
				{
					width: 500px;
					height: 200px;    
					padding: 50px;
					border: 1px solid red;
					
				}
			</style>
	</head>
	<body onKeyPress="prev()">
		<div style="width:100%;margin-left:40%">

				<table class="header">
					<tr>
					<?php
					$select_table=mssql_fetch_array(mssql_query("select m.contractor_code,p.contractor_code,m.emp_code,p.to_date pd,e.to_date ed,g.to_date gd
													from contractor_employee_master m 
													join contract_employee_work_permit p
													on p.contractor_code=m.contractor_code
													join contractor_ec_policy e
													on e.contractor_code=m.contractor_code
													join contractor_gpa_policy g
													on g.contractor_code=m.contractor_code
													where m.emp_code='$emp_code'"));
					
					$work_permit=$select_table['pd'];
					$ec_policy=$select_table['ed'];
					$gpa_plicy=$select_table['gd'];
					
					
					$check_condition=mssql_fetch_array(mssql_query("SELECT status,shift_code FROM contractor_employee_master WHERE emp_code='$emp_code' "));
					
					$check_status=$check_condition['status'];
					$shift_code=$check_condition['shift_code'];
					
					
					if($check_status==1)
					
					{
					header("location:/TOSHIBA/Barcode/barcode.php?msg=11");
					}
					else
					{echo "Active";
					 $contractor_code="CON-001";
					 $check_condition1=mssql_fetch_array(mssql_query("SELECT status FROM contractor_master WHERE contractor_code='$contractor_code' "));
					$check_status1=$check_condition1['status'];
					if($check_status1==1)
					{
						echo "InActive";
						header("location:/TOSHIBA/Barcode/barcode.php?msg=12");

					}
					else
					{
					 echo "AAAAActive";
					 
					 
					 //$contractor_code="CON-001";
					 					 $contractor_code="CON-001";
					 $check_condition3=mssql_fetch_array(mssql_query("SELECT to_date FROM contractor_gpa_policy WHERE contractor_code='$contractor_code' "));
					$check_status3=$check_condition3['to_date'];
					$current_date=date("Y/m/d");
					if(($check_status3<=$current_date))
					{
						echo "InActive";
					header("location:/TOSHIBA/Barcode/barcode.php?msg=13");
					}
					else
					{
					 echo "AAAAActive";
					 $employee=mssql_fetch_array(mssql_query("select emp_code from contractor_employee_master where emp_code='$emp_code'"));
						$emp_code=$employee['emp_code'];
						$w_row=mssql_query("SELECT  emp_code,emp_name,contractor_code,dob,photo_upload FROM contractor_employee_master where emp_code='$emp_code'");
						//echo "SELECT  employee_no,employee_name,contractor_id,dob,upload_employee_photo FROM employee_master where employee_no='$$emp_no'";
						$i=1;
						while($w_res=mssql_fetch_array($w_row))
						{?>
					
							<div class="div1" style="margin-left: -9%; margin-top: 10%;">
								<div style="float:left"><img src="../images/profile/toshiba.png"  style="margin-left:-50px;margin-top:-50px;"></div>
								<div style="float:right;margin-top:13px;margin-right: -9%;">
											<?php 
											if($w_res['photo_upload']==''|| $w_res['photo_upload']=='NULL')
											{
											?>
											<b><img alt=" img" class="user-image" src="/TOSHIBA/images/profile/user.jpg" height="100" width="100"></b>
											 <?php
											 }
											 else
											 {
											 ?>
											
											<b><img alt="" class="user-image" src="<?php echo $w_res['photo_upload'];?>" height="100" width="100"></b>
											 <?php
											 }
											 ?>
								</div>
							</div>
							
							<table style="margin-left: 5%;">
								<tbody style="float: left; line-height: 25px; margin-top: -126px; margin-left: -174px;">
					
									<tr><td>Emp No:<?php echo $w_res['emp_code'];?><tr><td>
									<tr><td>Name: <?php echo $w_res['emp_name'];?><tr><td>
									<tr><td>Category:<?php echo $w_res['contractor_code'];?><tr><td>
									<tr><td>DOB:<?php echo $w_res['dob'];?><tr><td>
							
								</tbody>
							</table>
							<?php
								}
														

						mssql_query("insert into transaction_attendance (emp_code,shift_code,in_time,out_time) values ('$emp_code','SHIFT A',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)");
						
						//echo "insert into transaction_attendance (emp_code,shift_code,in_time,out_time) values ('$emp_code','SHIFT A',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";


//echo "insert into transaction_attendance (emp_code,shift_code,in_time,out_time) values ('$emp_code','SHIFT A',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";							
						
					 
					}
					 
					}
					}
						
?>
</tr>
			</table>
		</div>
	</body>
</html>
<script>
 function prev()
 	{
	window.location ="/TOSHIBA/Barcode/barcode.php"; 
	}
 </script>