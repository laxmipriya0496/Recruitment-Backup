<?php
require ("../configuration.php");
require ("../user.php");
date_default_timezone_set("Asia/Kolkata");
header( "refresh:10;url=barcode.php" );

?>
<?php
//$user=$_SESSION['user'];
//$username=$_SESSION['user_name'];
$emp_code=$_REQUEST['pass_no'];
									
													
//echo $emp_code;
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
	<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo URL;?>css/bootstrap-datetimepicker.min.css">
				
	</head>
	<body >
					<?php
					$select_table=mssql_fetch_array(mssql_query("select e.emp_name,e.emp_code,e.pass_no,e.permit_to,e.mobile_no,e.blood_group,d.license_no,d.license_valid_to,
					v.vehicle_regn_no,e.emp_sign 
					from employee_master e left join driving_master d on d.pass_no=e.pass_no 
					left join vehicle_master
					 v on v.pass_no=e.pass_no WHERE e.pass_no='$emp_code'"));
					$check=mssql_num_rows(mssql_query("SELECT pass_no FROM employee_master WHERE pass_no='$emp_code' "));
					if($check==0)
					{
						//header("location:/COMMUTATION/Barcode/barcode.php?msg=1");
					}
					
					
					else
					{
				  // echo "sucess";
				   $check_condition=mssql_num_rows(mssql_query("select permit_to from employee_master where permit_to >=getdate() and pass_no='$emp_code' "));
					
					//$check_status=$check_condition['permit_to'];
					
					//echo $check_condition;
					//echo "select permit_to from employee_master where permit_to >=getdate() and pass_no='$emp_code' ";
					if($check_condition==0)
					
					{
					
					
					$reasons="Permit Expired";
					}
					else
					{
					
					//echo "Permit allowed";
					 $check_condition1=mssql_num_rows(mssql_query("select license_valid_to from driving_master where license_valid_to >=getdate() and pass_no='$emp_code' "));
					// echo $check_condition1;
					 if($check_condition1==0)
					
					{
						$reasons="License Expired";	
					}
					else
					{
					
					//echo "License allowed";
					 $check_condition2=mssql_num_rows(mssql_query("select vehicle_valid_to from vehicle_master where vehicle_valid_to >=getdate() and pass_no='$emp_code' "));
					// echo $check_condition1;
					 if($check_condition2==0)
					
					{
							$reasons="Vechile Expired";	
					}
					else
					{
					
					//echo "Insurence allowed";
					 $check_condition3=mssql_num_rows(mssql_query("select to_date from safty_training where to_date >=getdate() and pass_no='$emp_code' "));
					// echo $check_condition1;
					 if($check_condition3==0)
					
					{
					$reasons="Training Expired";
					}
					else
					{
					$check_condition4=mssql_fetch_array(mssql_query("select COUNT(v.date)as nooftimes from vehicle_transactions v
join employee_master e on e.pass_no=v.pass_no where v.pass_no='$emp_code' and e.type_of_permit='Temparory' "));
                   $test=$check_condition4['nooftimes'];
				   //echo $test;
					//echo "Training allowed";
					if($test>2)
					
					{
					?>
					<script>
						alert("No of time Exceed, Your Entered <?php echo $test;?> times");
					</script>
					<?php
					//echo "NO of Times exceede".$test;
					}
					}
					}
					}
					}
					}
					 $employee=mssql_fetch_array(mssql_query("select pass_no from employee_master where pass_no='$emp_code'"));
						$emp_code=$employee['pass_no'];
						$w_row=mssql_query("select e.emp_name,e.emp_code,e.pass_no,e.permit_to,e.mobile_no,e.blood_group,d.license_no,d.license_valid_to,
 v.vehicle_regn_no,e.emp_sign 
 from employee_master e left join driving_master d on d.pass_no=e.pass_no 
 left join vehicle_master
  v on v.pass_no=e.pass_no WHERE e.pass_no='$emp_code'");
						/*echo "select e.emp_name,e.emp_code,e.pass_no,e.permit_to,e.mobile_no,e.blood_group,d.license_no,d.license_valid_to,
 v.vehicle_regn_no,e.emp_sign 
 from employee_master e left join driving_master d on d.pass_no=e.pass_no 
 left join vehicle_master
  v on v.pass_no=e.pass_no WHERE e.pass_no='$emp_code'";*/
						$i=1;
						while($w_res=mssql_fetch_array($w_row))
						{?>
					<div style="width:100%;">
					
							<div class="div1" style="width: 100%;">
							<div style="width: 50%;margin: 0 auto;padding: 30px;border: 1px solid #000;">							
							<div style="width: 100%;text-align: center;font-size: 20px;font-weight: bold;color: #ff0000;">TOSHIBA-JSW Vehicle Entry </div>
							<table style="">
								<tbody style=" line-height: 25px;">
									<tr><td>Emp No:<?php echo $w_res['emp_code'];?><tr><td>
									<tr><td>Name: <?php echo $w_res['emp_name'];?><tr><td>
									<tr><td>Permit NO:<?php echo $w_res['pass_no'];?><tr><td>
									<tr><td>Permin Expire Date:<?php echo $w_res['permit_to'];?><tr><td>
									<tr><td>Mobile NO:<?php echo $w_res['mobile_no'];?><tr><td>
									<tr><td>Blood Group :<?php echo $w_res['blood_group'];?><tr><td>
									<tr><td>License NO:<?php echo $w_res['license_no'];?><tr><td>
									<tr><td>License Valid To:<?php echo $w_res['license_valid_to'];?><tr><td>
									<tr><td>Vehicle NO:<?php echo $w_res['vehicle_regn_no'];?><tr><td>
							
								</tbody>
							</table>
							</div>
							</div>
							
							
								 <?php
								 if(isset($reasons))
								 {
								 ?>
							<div style="width: 50%;margin: 0 auto;padding: 30px;border: 1px solid #000;background:#FF0000;">
							<?php
							}
							else
							{
							?>
							<div style="width: 50%;margin: 0 auto;padding: 30px;border: 1px solid #000;background:#00CC66;">
							<?php
							}
							?>
								<div style="text-align: center;font-size: 60px;font-weight: bold; text-decoration:blink">
								
								
								
								 <?php
								 if(isset($reasons))
								 {
		  	echo $reasons;
			}
			else
			{
				echo "Allowed";
			
			}	
		  ?>
								
								</div>
							 </div>
							</div>
							<?php 
								}
									
									

						mssql_query("insert into vehicle_transactions (date,pass_no,intime,entry_flag,reasons) values (getdate(),'$emp_code',CURRENT_TIMESTAMP,'0','$reasons')");
						
						
					
						
						//echo "insert into vehicle_transactions (date,pass_no,intime,entry_flag,reasons) values (getdate(),'$emp_code',CURRENT_TIMESTAMP,'0','$reasons')";


//echo "insert into transaction_attendance (emp_code,shift_code,in_time,out_time) values ('$emp_code','SHIFT A',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";							
						
					 
					//}
					
						
?>

		
		
	</body>
</html>
<script>
 function prev()
 	{
	window.location ="/COMMUTATION/Barcode/barcode.php"; 
	}
 </script>