<?php
require ("../configuration.php");
$emp_code="EMP-0969";
$check=mssql_num_rows(mssql_query("SELECT status,shift_code FROM contractor_employee_master WHERE emp_code='$emp_code' "));
					if($check==0)
					{
						//header("location:/TOSHIBA/Barcode/barcode.php?msg=2");
					}
					$check_condition=mssql_fetch_array(mssql_query("SELECT status,shift_code FROM contractor_employee_master WHERE emp_code='$emp_code' "));
					$check_status=$check_condition['status'];
					$shift_code=$check_condition['shift_code'];
					if($check_status==1)
					{
					echo "InActive";
					}
					else
					{
					 echo "Active";
					 $contractor_code="CON-001";
					 $check_condition1=mssql_fetch_array(mssql_query("SELECT status FROM contractor_master WHERE contractor_code='$contractor_code' "));
					$check_status1=$check_condition1['status'];
					if($check_status1==1)
					{
						echo "InActive";
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
					}
					else
					{
					 echo "AAAAActive";
					 
					 
					}
					 
					}
					}