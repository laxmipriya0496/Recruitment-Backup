
<?php
require('../configuration.php');
$id=$_REQUEST['id'];
$tbl=$_REQUEST['tbl'];

		//$s=explode("-",$id);
		//$test=$s[0];
		//echo $test;
		$toshiba_employee_res=mssql_query("SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '$id'");
												
												
						
						$COLUMN_NAME=$toshiba_employee_res['COLUMN_NAME'];
						//$email_id=$toshiba_employee_res['mail'];
						//$head=$toshiba_employee_res['head'];
						//$thosiba_emp_department=$toshiba_employee_res['thosiba_emp_department'];
						//$company=$toshiba_employee_res['company'];
				//echo $department;
				//echo $mobile_no."=".$mail."=".$thosiba_emp_department."=".$head."=".$company;  
//echo $.mobile_no"=".$mail."=".$thosiba_emp_department."=".$head."=".$company."=".$head_mail;
//echo $mobile_no."=".$email_id."=".$head."=".$thosiba_emp_department."=".$company;
?><div class="col-md-3">
					<h2 style="color:red">Column Name</h2>
					<table class="table table-hover table-striped" id="tb" name="tb">
			<?php		$i=1;
while($user_group=mssql_fetch_array($toshiba_employee_res))
					{ 
						$r=$tbl.$i;
						//$a="rs".$i;
		echo '<tr><td id="'.$tbl.$i.'" draggable="true" ondragstart="drag(event)" style="font-size: 10px;" >'.$tbl.".".$user_group['COLUMN_NAME'].',<p class="btn btn-sm " style=" background-color:white;color:red;border-radius: 25px;" onclick="del(\''.$r.'\')"><i class="fa fa-times icon-white" ></i></p></td></tr>';
					$i++; }
			?></table></div>
			
			
			<?php
?>