<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=$_REQUEST['id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
	<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>/css/jquery-ui.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
<script src="<?php echo URL;?>js/jquery.min.js"></script>
<script src="<?php echo URL;?>js/sweet-alert.js"></script>
<link rel="stylesheet" href="<?php echo URL;?>css/sweet-alert.css" />  
 <style>
  .k-autocomplete, .k-colorpicker, .k-combobox, .k-datepicker, .k-datetimepicker, .k-dropdown, .k-numerictextbox, .k-selectbox, .k-textbox, .k-timepicker, .k-toolbar .k-split-button
{
	width:100%!important;
}
</style>
  </head>
  <body class="skin-blue fixed sidebar-mini" scroll="no">
  	
  	 <div class="wrapper">
	 	
	 <?php
			require ("../header.php");
	?>  
	 </div>
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
         <section class="content-header">
          <h1>
           Employee Edit
          </h1>
          <ol class="breadcrumb">
            <li><a href="../menu/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="employeemaster.php">Back</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-md-2">
			<div class="box box-primary">
              <?php
			
			 $cus=mssql_query("select * from employee_master  order by 1 asc");
			 $cn=mssql_num_rows($cus);
			 ?>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Employee Master</h3>
                  <div class='box-tools'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li ><a href="employeemaster.php?menu_id=<?php ////echo $menu_id;?>&sub_menu=<?php ////echo $submenu_id;?>"><i class="fa fa-file-text-o"></i>Employee List<span class="label label-primary pull-right"><?php echo $cn;?></span></a></li>
                   
                 </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              </div><!-- /. box -->
              
            </div><!-- /.col -->
			 <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Edit Employee</h3>
                  <div class="box-tools pull-right">
                   
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
				  <?php $item1=mssql_fetch_array(mssql_query("select * from employee_master where id='$id'")); ?>
				  <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tbody>
						<tr>
							<td>Employee ID</td>
							<td><input type="text" name="emp_id" id="emp_id" class="form-control" readonly value="<?php echo $eid=$item1['employee_id']; ?>"  ></td>
							<td>Employee Name</td>
							<td><input type="text" name="Name" id="Name" class="form-control" value="<?php echo $item1['Name']; ?>"  ></td>
						</tr>
						<tr>
							<td>Department</td>
							<td><input type="text" name="Department" id="Department" class="form-control" value="<?php echo $item1['Department']; ?>"  ></td>
							<td>Pan Number</td>
							<td><input type="text" name="Pan_Number" id="Pan_Number" class="form-control" value="<?php echo $item1['Pan_Number']; ?>"  ></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><input type="text" name="Phone_Number" id="Phone_Number" class="form-control" onchange="phone(this.value,this.id);" value="<?php echo $item1['Phone_Number']; ?>" ></td>
							<td>Aadhar Number</td>
							<td><input type="text" name="Aadhar_Number" id="Aadhar_Number" class="form-control" value="<?php echo $item1['Aadhar']; ?>" ></td>
							
						</tr>
						<tr>
							<td>E-Mail</td>
							<td><input type="text" name="email" id="email" class="form-control" value="<?php echo $item1['email']; ?>"  onchange="mail(this.value,this.id);" ></td>
							
							<td>Religion</td>
							<td><input type="text" name="Religion" id="Religion" class="form-control" value="<?php echo $item1['Religion']; ?>"></td>
							
						</tr>
						<tr>
							
							<td>Blood Group</td>
							<td><input type="text" name="Blood_Group" id="Blood_Group" class="form-control" value="<?php echo $item1['Blood_Group']; ?>"></td>
							<td>Gender</td>
							<td>
							<?php if($item1['Gender']=="Male")  
							{
								?><input type="radio" name="Gender" value="Male" checked />&emsp;Male &emsp;   <input type="radio" name="Gender" value="Female" />&emsp;Female</td><?php
							}
							else
							{ ?>
							<input type="radio" name="Gender" value="Male" />&emsp;Male &emsp;   <input type="radio" name="Gender" value="Female" checked />&emsp;Female</td>
							<?php } ?>
							</tr><tr>
							<td>State of Origin</td>
							<td><select name="State_of_Origin" id="State_of_Origin"  class='form-control'>
							<option value="<?php echo $item1['State_of_Origin']; ?>"><?php echo $st=$item1['State_of_Origin']; ?></option>
				<?php
				$state=mssql_query("select id,name from state_master where status='0' and name!='$st' order by name ");
					while($row=mssql_fetch_array($state))
					{
				?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
				<?php
					}
				?>							
				</select></td>
				<td>Date of Joining</td>
							<td><input type="date" name="date_of_joining" id="date_of_joining"  class='form-control' value="<?php echo $item1['Date_of_Joining']; ?>"></td>
						</tr>
					</tbody>			
					</table><br>
 <h4 class="box-title" style="font-weight: 600;text-transform: uppercase;">Educational Qualification</h4>
				  <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
		<thead style="color:#0033FF">
			<tr id="row9">	<th style="width:3%;">#</th>
				<th style="width:23%;">Branch of Education</th>
				<th style="width:18%;">Type of Education</th>
				<th style="width:33%;">University</th>
				<th style="width:23%;">Graduation</th>
			</tr>
		</thead> </table>					
	<table class="table table-striped" id="rsa">
	<?php  $s=1;$r=1;$a=1;
					$empde=mssql_query("select * from employee_details where emp_id='$eid'");
					while($empde1=mssql_fetch_array($empde))
					{
						?>
<tr><td style="width:3%;"></td>
<td style="width:23%;"><input type="text" name="Branch_of_Education[]" id="Branch_of_Education_<?php echo $s; ?>" class="form-control" value="<?php echo $eid=$empde1['Branch_of_Education']; ?>" ></td>
<td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_<?php echo $s; ?>" class="form-control" value="<?php echo $empde1['type_of_education']; ?>" autocomplete="off" placeholder="---Select---">
						<datalist id="browsers1">
<?php $employee_row1=mssql_query(" select distinct proof_name from proofupload_master order by 1 asc");?>
						<select class="form-control" id="rs">
								<?php
									while($employee_res1=mssql_fetch_array($employee_row1))
									{
								?>
									<option><style><?php echo $employee_res1['proof_name'];?></style></option>
								<?php
									}
									?>
							</datalist>
</td>
<td style="width:33%;">
<input list="browsers2" name="University[]" id="University_<?php echo $s; ?>" class="form-control" value="<?php echo $eid=$empde1['University']; ?>" autocomplete="off" placeholder="---Select---">
<datalist id="browsers2">
<?php $employee_row=mssql_query("select distinct university_name from university_master order by 1 asc");?>
						<select class="form-control" id="rs">
								<?php
									while($employee_res=mssql_fetch_array($employee_row))
									{
								?>
									<option><style><?php echo $employee_res['university_name'];?></style></option>
								<?php
									}
									?>
							</datalist></td>
<td style="width:23%;"><input type="text" name="Graduation[]" id="Graduation_<?php echo $s++; ?>" class="form-control" value="<?php echo $empde1['Graduation']; ?>"></td>
<input type="hidden" name="edid[]" id="edid_<?php echo $r++; ?>" class="form-control" value="<?php echo $empde1['id']; ?>">
<input type="hidden" name="check[]" id="check_<?php echo $a++; ?>" class="form-control" value="old">
</tr>

<?php
}
?>
</table>			
					  </div><!-- /.box-body -->
					<div class="addline" id="row11">
<input type="button" class=" btn btn-success add_new" value="Add new"> 
<input type="button" class=" btn btn-danger delete" value="Delete"> 
                   </div>
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					  </div>
					  <input type="hidden" name="formsent">
                </form>
				  </div>
				</div>
			</div>
			</div>
			</div>
			
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 	<?php
			require ("../footer.php");
	?> 
	<!--<script src="../js/jQuery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='../js/fastclick.min.js'></script>
    <script src="../js/app.min.js" type="text/javascript"></script>
    <script src="../js/demo.js" type="text/javascript"></script>-->
	
<link rel="stylesheet" href="css/kendo.common-material.min.css" />
    <link rel="stylesheet" href="css/kendo.material.min.css" />
	<script src="js/kendo.all.min.js"></script>
	
	<script>
		$(document).ready(function() {
			// create DatePicker from input HTML element
			$("#Date_Of_Birth").kendoDatePicker({
			format: "dd-MM-yyyy"
			});
		});
	
	</script>
	<?php
if(isset($_POST['formsent']))  
{  
	$emp_id=$_POST["emp_id"];
	$Name=$_POST["Name"];
	$Department=$_POST["Department"];
	$Pan_Number=$_POST["Pan_Number"];
	$Phone_Number=$_POST["Phone_Number"];
	$email=$_POST["email"];
	$Religion=$_POST["Religion"];
	$Gender=$_POST["Gender"];
	$State_of_Origin=$_POST["State_of_Origin"];
	$Blood_Group=$_POST["Blood_Group"];
	$Type_of_Education=$_POST["Type_of_Education"];
	$Aadhar_Number=$_POST["Aadhar_Number"];
	$University=$_POST["University"];
	$Branch_of_Education=$_POST["Branch_of_Education"];
	$Graduation=$_POST["Graduation"];
	$date_of_join=$_REQUEST["date_of_joining"];
	$edid=$_POST["edid"];
	$check=$_POST["check"];
	$date=date("Y-m-d h:i:s");
	$date_of_joining=date('Y-m-d',strtotime($date_of_join));
	
	$user_name=mssql_fetch_array(mssql_query("select * from user_master where user_id='$user'"));
	$user_na=$user_name['full_name'];
	
	/* $oldd=mssql_query("SELECT name FROM sys.columns WHERE object_id = OBJECT_ID('dbo.employee_master') and name 
not in ('id','created_by','created_on','modified_by','modified_on','Present_Address','Permanent_Address','Date_Of_Birth')");
while($old1=mssql_fetch_array($oldd))
{
	$old2[]=$old1['name'];
} */
$old_det=mssql_fetch_array(mssql_query("select * from employee_master where id='$id'"));
	$old_emp_id=$old_det["employee_id"];
	$old_Name=$old_det["Name"];
	$old_Department=$old_det["Department"];
	$old_Pan_Number=$old_det["Pan_Number"];
	$old_Phone_Number=$old_det["Phone_Number"];
	$old_email=$old_det["email"];
	$old_Religion=$old_det["Religion"];
	$old_Gender=$old_det["Gender"];
	$old_State_of_Origin=$old_det["State_of_Origin"];
	$old_Blood_Group=$old_det["Blood_Group"];
	$old_Aadhar_Number=$old_det["Aadhar"];
	$Date_of_Joinings=$old_det["Date_of_Joining"];

	$old=array($old_emp_id,$old_Name,$old_Department,$old_Pan_Number,$old_Phone_Number,$old_email,$old_Religion,$old_Gender,$old_State_of_Origin,$old_Blood_Group,$old_Aadhar_Number,$Date_of_Joinings);
	
	$new=array($emp_id,$Name,$Department,$Pan_Number,$Phone_Number,$email,$Religion,$Gender,$State_of_Origin,$Blood_Group,$Aadhar_Number,$date_of_joining);
	
	$field=array("employee_id","Name","Department","Pan_Number","Phone_Number","email","Religion","Gender","State_of_Origin","Blood_Group","Aadhar_Number","Date_of_Joining");
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$tottt=count($old);
	$d=date("Y-m-d");
	for($r=0;$r<$tottt;$r++)
	{
		if($old[$r]!=$new[$r])
		{
			$ins=mssql_query("INSERT INTO updated_data(employee_id,column_name,old_value,new_value,master_name,ip_address,created_by,created_on) VALUES ('$emp_id','$field[$r]','$old[$r]','$new[$r]','Employee Master','$ip','$user','$d')");
			//echo "INSERT INTO updated_data(column_name,old_value,new_value,master_name,ip_address,created_by,created_on) VALUES ('$contractor_code','$field[$r]','$old[$r]','$new[$r]','Employee Master','$ip','$user','$d')";
		}
	}
	
	$n=mssql_query("update employee_master  set Name='$Name',employee_id='$emp_id',Department='$Department',Pan_Number='$Pan_Number',Phone_Number='$Phone_Number',Gender='$Gender',Religion='$Religion',Aadhar='$Aadhar_Number',State_of_Origin='$State_of_Origin',Blood_Group='$Blood_Group',Date_of_Joining='$date_of_joining',modified_by='$username',modified_on='$date' where id='$id'");
	
	
	$cnt=count($Type_of_Education);
	for($i=0;$i<$cnt;$i++)
				{
					$old_det1=mssql_fetch_array(mssql_query("select * from employee_details where id='$edid[$i]'"));
					$old_emp_id1=$old_det1["emp_id"];
					$old_Branch_of_Education=$old_det1["Branch_of_Education"];
					$old_type_of_education=$old_det1["type_of_education"];
					$old_University=$old_det1["University"];
					
					$old1=array($old_emp_id1,$old_Branch_of_Education,$old_type_of_education,$old_University);
					$new1=array($emp_id,$Branch_of_Education[$i],$Type_of_Education[$i],$University[$i],$Graduation[$i]);
	
					$field=array("emp_id","Branch_of_Education","Type_of_Education","University","Graduation");
	$tottt=count($old1);
	$d=date("Y-m-d");
	for($r=0;$r<$tottt;$r++)
	{
		if($old1[$r]!=$new1[$r])
		{
			$ins=mssql_query("INSERT INTO updated_data(employee_id,column_name,old_value,new_value,master_name,ip_address,created_by,created_on) VALUES ('$emp_id','$field[$r]','$old1[$r]','$new1[$r]','Employee Details','$ip','$user','$d')");
			//echo "INSERT INTO updated_data(column_name,old_value,new_value,master_name,ip_address,created_by,created_on) VALUES ('$contractor_code','$field[$r]','$old[$r]','$new[$r]','Employee Master','$ip','$user','$d')";
		}
	}
	
	if($check[$i]=="old")
	{
		$n=mssql_query("update employee_details set emp_id='$emp_id',Branch_of_Education='$Branch_of_Education[$i]',type_of_education='$Type_of_Education[$i]',University='$University[$i]',Graduation='$Graduation[$i]',modified_by='$username',modified_on='$date' where id='$edid[$i]'");
	}
	else
	{
		$n=mssql_query("insert into employee_details (emp_id,Branch_of_Education,type_of_education,University,Graduation,created_by,created_on)
	values ('$emp_id','$Branch_of_Education[$i]','$Type_of_Education[$i]','$University[$i]','$Graduation[$i]','$username','$date')");
	}
	
				}
	
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
            window.location = "employeemaster.php?id=<?php echo $id;  ?>";
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
           window.location = "employeemaster.php?id='<?php echo $id;  ?>'";
        });
    }, 100);
</script> 	  
	<?Php
	}
}  
?>  
  </body>
 <script>
 $('html').bind('keypress', function(e)
{
   if(e.keyCode == 13)
   {
      return false;
   }
});
</script>

<script>
	function phone(str,d)
	{
		var a = /^(1\s|1|)?((\(\d{3}\))|\d{3})(\-|\s)?(\d{3})(\-|\s)?(\d{4})$/.test(str);
		if(a==false)
		{
			alert("Please Enter Valid Phone Number");
			$("#"+d).val("");
		}
	}
</script>
<script>
	function mail(str,d)
	{
		var a = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(str);
		if(a==false)
		{
			alert("Please Enter Valid E-Mail ID");
			$("#"+d).val("");
		}
	}
</script>
</html> <script language="javascript">
 $('.add_new').click(function(){
	var len=$('#rsa tr').length;
	len=len+1;
	
	 $('.table-striped').append('<tr class="row_'+len+'"><td style="width:3%;"><input type="checkbox" name="chk[]" id="chk_'+len+'" value="'+len+'" class=" chk"/></td><td style="width:23%;"><input type="text" name="Branch_of_Education[]" id="Branch_of_Education_'+len+'" class="form-control" value=""></td><td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_'+len+'" class="form-control" value="" autocomplete="off" placeholder="---Select---"></td><td style="width:33%;"><input list="browsers2" name="University[]" id="University_'+len+'" class="form-control"value="" autocomplete="off" placeholder="---Select---"></td><td style="width:23%;"><input type="text" name="Graduation[]" id="Graduation_'+len+'" class="form-control" value=""><input type="hidden" name="check[]" id="check_'+len+'" class="form-control" value="new"></td></tr>');
	
	
});
$('.delete').click(function()

{
	$('input:checkbox:checked.chk').map(function(){
	
	var id=$(this).val();
	var rs=$('#rsa tr').length;
	if(rs==1)
	{
		alert("You Can't Delete All the Rows");
		//alert(rs);
	}
	else
	{
		//alert(rs);
		$('.row_'+id).remove();
	}
	
	});
});
 </script>