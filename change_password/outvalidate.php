<?php
require ("../configuration.php");
require ("../user.php");
date_default_timezone_set("Asia/Kolkata");
?>
<?php
//$user=$_SESSION['user'];
//$username=$_SESSION['user_name'];
$emp_code=$_REQUEST['pass_no'];
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

				
							<?php
								
									$check_condition4=mssql_num_rows(mssql_query("select date from vehicle_transactions where pass_no='$emp_code'"));
								//echo	"select date from vehicle_transactions where pass_no='$emp_code' and date=GETDATE() ";
									//echo $check_condition4;
                   if($check_condition4==0)
					
					{
					header("location:/COMMUTATION/Barcode/out.php?msg=13");
					}
					else
					{				

						mssql_query("update vehicle_transactions set outtime=CURRENT_TIMESTAMP,entry_flag='1' where pass_no='$emp_code'");
						//echo "update vehicle_transactions set outtime=CURRENT_TIMESTAMP,entry_flag='1' where pass_no='$emp_code'";
						header("location:/COMMUTATION/Barcode/out.php?msg=12");
						//echo "insert into vehicle_transactions (date,pass_no,intime,entry_flag) values (getdate(),'$emp_code',CURRENT_TIMESTAMP,'0')";


//echo "insert into transaction_attendance (emp_code,shift_code,in_time,out_time) values ('$emp_code','SHIFT A',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";							
						
					 
					//}
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
	window.location ="/COMMUTATION/Barcode/out.php"; 
	}
 </script>