<?php
	require ("../../TOSHIBA/configuration.php");
	require ("../../TOSHIBA/user.php");
?>
<?php
	$user=$_SESSION['user'];
	$username=$_SESSION['user_name'];
	//$_SESSION['menu_id']=$_REQUEST['menu_id'];
	//$_SESSION['submenu_id']=$_REQUEST['sub_menu'];
	$menu_id=$_SESSION['menu_id'];
	$submenu_id=$_SESSION['submenu_id'];
	$emp_code=$_REQUEST['emp_code'];
	$check=mssql_query("select * from contractor_employee_master where emp_code='$emp_code' and status=0");
	$condition=mssql_num_rows($check);
		if ($condition==0)
			{
				echo "No User";
				//header("location:index.php?fail=1");
				
			}
			else
			{
				$validation=mssql_fetch_array($check);
				//$_SESSION['emp']=$validation['emp_code'];
				//$_SESSION['timeout']=time();
				$emp_code=$_SESSION['emp'];
				$emp_role=mssql_query("select * from contractor_employee_master where emp_code='$emp_code' and status=0");
				$erf=mssql_fetch_array($emp_role);
				if($erf!=0)
				{
					//header("location:index.php");
				
					
					//mssql_query("insert into transaction_attendance (emp_code,shift_code,in_time,out_time) values ('$emp_code','SHIFT A',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)");
					
				}
				else
				{
					echo "Not a Valid User";
				}
			}
?>