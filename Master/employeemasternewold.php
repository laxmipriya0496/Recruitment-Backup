<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
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
           Employee Master New
          </h1>
          <ol class="breadcrumb">
            <li><a href="../menu/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee Master New</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-md-3">
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
			 <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">New Employee</h3>
                  <div class="box-tools pull-right">
                   
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
				  <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tbody>
						<tr>
							<td>Employee ID</td>
							<td><input type="text" name="emp_id" id="emp_id" class="form-control" value=""  ></td>
							<td>Employee Name</td>
							<td><input type="text" name="Name" id="Name" class="form-control" value=""  ></td>
						</tr>
						<tr>
							<td>Department</td>
							<td><input type="text" name="Department" id="Department" class="form-control" value=""  ></td>
							<td>Pan Number</td>
							<td><input type="text" name="Pan_Number" id="Pan_Number" class="form-control" value=""  ></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><input type="text" name="Phone_Number" id="Phone_Number" class="form-control" onchange="phone(this.value,this.id);" value="" ></td>
							<td>Aadhar Number</td>
							<td><input type="text" name="Aadhar_Number" id="Aadhar_Number" class="form-control" onchange="phone(this.value,this.id);" value="" ></td>
							
						</tr>
						<tr>
							<td>E-Mail</td>
							<td><input type="text" name="email" id="email" class="form-control" value=""  onchange="mail(this.value,this.id);" ></td>
								
							<td>Religion</td>
							<td><input type="text" name="Religion" id="Religion" class="form-control" value=""></td>
						</tr>
						<tr>
							<td>Present Address</td>
							<td><textarea name="Present_Address" id="Present_Address" rows="3" cols="40" class="form-control" style="resize:none;"></textarea></td>
							<td>Permanent Address</td>
							<td><textarea name="Permanent_Address" id="Permanent_Address" rows="3" cols="40" class="form-control" style="resize:none;"></textarea></td>
						
							</tr>
						<tr>
							<td>Date Of Birth</td>
							<td><input type="text" name="Date_Of_Birth" id="Date_Of_Birth" class="form-control" value=""></td>
						
							
							<td>Gender</td>
							<td>
							<input type="radio" name="Gender" value="Male" />&emsp;Male &emsp;   <input type="radio" name="Gender" value="Female" />&emsp;Female</td>
							</tr>
						<tr>
							<td>State of Origin</td>
							<td><select name="State_of_Origin" id="State_of_Origin"  class='form-control'>
							<option value="">Select State</option>
				<?php
				$state=mssql_query("select id,name from state_master where status='1'");
					while($row=mssql_fetch_array($state))
					{
				?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
				<?php
					}
				?>							
				</select></td>
							<td>Blood Group</td>
							<td><select name="Blood_Group" id="Blood_Group"  class='form-control'>
								<option value="">Select Blood Group</option>
	<?php
	$blood=mssql_query("select id,bloodgroup_name from bloodgroup_master where status='0'");
	while($blood1=mssql_fetch_array($blood))
	{
	?>
		<option value="<?php echo $blood1['bloodgroup_name'];?>"><?php echo $blood1['bloodgroup_name'];?></option>
	<?php
	}
	?>							
</select></td>
						</tr>
					</tbody>			
					</table><br>
 <h4 class="box-title" style="font-weight: 600;text-transform: uppercase;">Educational Qualification</h4>
				  <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
		<thead style="color:#0033FF">
			<tr id="row9">	
				<th style="width:3%;">#</th>
				<th style="width:18%;">Type of Education</th>
				<th style="width:33%;">University</th>
				<th style="width:23%;">Branch of Education</th>
				<th style="width:23%;">Graduation</th>
			</tr>
		</thead> </table>					
	<table class="table table-striped" id="rsa">
<tr class="row_1" id="row10">
<td style="width:3%;">
<input type="checkbox" name="chk[]" id="chk_1" value="1" class=" chk" style="width:15px;height:20px;"/>
</td>
<td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_1" class="form-control" value="" autocomplete="off" placeholder="---Select---">
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
<input list="browsers2" name="University[]" id="University_1" class="form-control"value="" autocomplete="off" placeholder="---Select---">
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
<td style="width:23%;"><input type="text" name="Branch_of_Education[]" id="Branch_of_Education_1" class="form-control" value=""></td>
<td style="width:23%;"><input type="text" name="Graduation[]" id="Graduation_1" class="form-control" value=""></td>
</tr>
</table><div class="addline" id="row11">
<input type="button" class=" btn btn-success add_new" value="Add new"> 
<input type="button" class=" btn btn-danger delete" value="Delete"> 
                   </div>					
					  </div><!-- /.box-body -->
					
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
	$Present_Address=$_POST["Present_Address"];
	$Permanent_Address=$_POST["Permanent_Address"];
	$Religion=$_POST["Religion"];
	$Date_Of_Birth=$_POST["Date_Of_Birth"];
	$Gender=$_POST["Gender"];
	$State_of_Origin=$_POST["State_of_Origin"];
	$Blood_Group=$_POST["Blood_Group"];
	$Type_of_Education=$_POST["Type_of_Education"];
	$Aadhar_Number=$_POST["Aadhar_Number"];
	$University=$_POST["University"];
	$Branch_of_Education=$_POST["Branch_of_Education"];
	$Graduation=$_POST["Graduation"];
	$date=date("Y-m-d h:i:s");
	
	
		/* Create Folder */
		/* $rs="shankar";
		$rs1="images/$rs";
		$rs2="raja";
		if (!file_exists($rs1)) 
		{
			mkdir($rs1, 0777, true);
		} */
		/* Rename The Folder */
		/* rename('images/'.$rs.'/', 'images/'.$rs2.'/'); */
		/* Copy and Paste File into Folder */
		/* copy('Documents/RAVI.jpg', 'images/'.$rs.'/RAVI.jpg'); */
	
	
	
	$n=mssql_query("insert into employee_master (Name,emp_id,Department,Pan_Number,Phone_Number,Aadhar,Present_Address,Permanent_Address,Gender,Religion,Date_Of_Birth,email,State_of_Origin,Blood_Group,created_by,created_on)
	values ('$Name','$emp_id','$Department','$Pan_Number','$Phone_Number','$Aadhar_Number','$Present_Address','$Permanent_Address','$Gender','$Religion','$Date_Of_Birth','$email','$State_of_Origin','$Blood_Group','$username','$date')");
	
	
	$cnt=count($Type_of_Education);
	for($i=0;$i<$cnt;$i++)
				{
					$n=mssql_query("insert into employee_details (emp_id,Name,Branch_of_Education,type_of_education,University,Graduation,created_by,created_on)
	values ('$emp_id','$Name','$Branch_of_Education[$i]','$Type_of_Education[$i]','$University[$i]','$Graduation[$i]','$username','$date')");
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
            window.location = "employeemaster.php";
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
           window.location = "employeemaster.php";
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

 <script language="javascript">
 $('.add_new').click(function(){
	var len=$('#rsa tr').length;
	//alert(len);
	len=len+1;
	
	 $('.table-striped').append('<tr class="row_'+len+'"><td style="width:3%;"><input type="checkbox" name="chk[]" id="chk_'+len+'" value="'+len+'" class=" chk" style="width:15px;height:20px;"/></td><td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_'+len+'" class="form-control" value="" autocomplete="off" placeholder="---Select---"></td><td style="width:33%;"><input list="browsers2" name="University[]" id="University_'+len+'" class="form-control"value="" autocomplete="off" placeholder="---Select---"></td><td style="width:23%;"><input type="text" name="Branch_of_Education[]" id="Branch_of_Education_'+len+'" class="form-control" value=""></td><td style="width:23%;"><input type="text" name="Graduation[]" id="Graduation_'+len+'" class="form-control" value=""></td></tr>');
	
	
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
</html>