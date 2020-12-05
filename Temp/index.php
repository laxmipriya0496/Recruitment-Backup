<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$curdate=date("Y-m-d");
$getuser=mssql_num_rows(mssql_query("select user_id,password,user_group_code from temp_user_master where user_id='$user' and status='0' and Convert(date, getdate()) between from_date and to_date "));
if($getuser==0)
{
	 header('Location:../login/logout.php');
}
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
   <link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/style.css" />
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
<script type="text/javascript" src="<?php echo URL;?>js/jquery.js"></script>
<script src="<?php echo URL;?>js/sweet-alert.js"></script>
<link rel="stylesheet" href="<?php echo URL;?>css/sweet-alert.css" />  
</head>
<style>

.info-box-text:hover {
    text-transform: uppercase;
    text-decoration: none;
	color: #333;
}
a:hover {
    color: #545454;
    text-decoration: none!important;
}

			
.box.box-info {
    display: none;
}
.box.box-primary {
    display: none;
}
.content-wrapper, .right-side, .main-footer{
	margin-left:0;
}
.fixed .content-wrapper, .fixed .right-side{
	padding-top:0;
}

span.info-box-icon.bg-aqua,span.info-box-icon.bg-navy,span.info-box-icon.bg-red,span.info-box-icon.bg-green,span.info-box-icon.bg-yellow,
span.info-box-icon.bg-purple,span.info-box-icon.bg-purple,span.info-box-icon.bg-maroon,span.info-box-icon.bg-blue,span.info-box-icon.bg-orange,span.info-box-icon.bg-grey,span.info-box-icon.bg-olive{
	min-height:100px;
	width:50%;
	    padding: 10px;
}

.info-box {
    min-height: 100px;
   
}
.info-box-content {
    padding: 25px 0px;
    text-align: center;
}
.head_breadcrumb
{
	background-color: #fff;
    border-bottom: 1px solid #333;
    box-shadow: 2px 1px 2px 1px rgba(51, 51, 51, 0.42);
    float: left;
    width: 100%;
    margin-bottom: 20px;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}
.table1 {
    width: 87%;
    max-width: 100%;
    margin-bottom: 20px;
    margin-left: 40px;
}
.table2 {
    width: 85%;
    max-width: 100%;
    margin-bottom: 20px;
    margin-left: 50px;
	padding:5px;
}
	</style>
<body>
	<?php
		require ("../header.php");
		
		$menu=mssql_fetch_array(mssql_query("select * from temp_user_master where user_id='$user'"));
   
	?>
<div class="wrapper" style=" width: 95%; margin:0 auto;">
	<div class="row">
		<div class="col-md-12" style="margin-top:6%;">
			<div class="col-md-3" title="Maximum No of Employees">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Total</span>
							<span class="info-box-number"><?php  echo $menu['nos']; ?></span>
						</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			<div class="col-md-3" title="Total No of Employees Registered">
				<div class="info-box">
					<span class="info-box-icon bg-purple"><i class="fa fa-registered"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Registered</span>
							<span class="info-box-number"><?php  echo $menu['entered_nos']; ?></span>
						</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			<div class="col-md-3" title="Available No of Employees">
				<div class="info-box">
					<span class="info-box-icon bg-maroon"><i class="fa fa-balance-scale"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Available</span>
							<span class="info-box-number"><?php  echo $menu['nos']-$menu['entered_nos']; ?></span>
						</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			<div class="col-md-3" title="Your User Account Expires">
				<div class="info-box">
					<span class="info-box-icon bg-olive"><i class="fa fa-calendar"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Expires</span>
							<span class="info-box-number"><?php  echo date("d-m-Y",strtotime($menu['to_date'])); ?></span>
						</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
		</div>
		
		<div class="col-md-12">
			<div class="col-md-3" style="margin-left:-60px;margin-bottom:50px;">
				<div class="box" style="border-top: 3px solid #0f40a2;">
				 <form role="form" name="area"  method="post">
                  <div class="box-body">
                 <!--  <table class="table1 table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
						<th colspan=2 style="text-align:center;color:#0fa29c;padding: 10px;">Select to Register New Employee</th>
						</tr>
						<tr>
							<td>Employee Type</td>
							<td><select name="user_name" id="user_name" class="form-control"  class='chosen-select' required>
							<option value="">Select Type</option>
				<?php
				$usergroup1=mssql_query("select * from temp_new_emp");
					while($user_group11=mssql_fetch_array($usergroup1))
					{
				?>
							<option value="<?php echo $user_group11['id'];?>"><?php echo $user_group11['temp_emp_name'];?></option>
				<?php
					}
				?>							
			</select></td></tr></table> -->
				</div>
                </form>
				<?php $ava=mssql_fetch_array(mssql_query("select COUNT(USER_ID) as entered,(select nos from temp_user_master where USER_ID='$user') as tot,
((select nos from temp_user_master where USER_ID='$user')-COUNT(USER_ID)) as balance
from temp_employee_master where USER_ID='$user'"));
if($ava['balance']!=0)
{
?>
				<table class="table2 table-hover" style="font-family:'Times New Roman', Times, serif">
	 <tr style="color:blue;">
	 <th>Name</th>
	 <th>Edit</th>
	 <th>Submit</th>
	 </tr>
	 <?php 
	 $per=mssql_query("select *,em.id as id1,sm.name as state,em.flag as flg from temp_employee_master em
join state_master sm on sm.id=em.State_of_Origin where em.user_id='$user' and em.flag is null");/* 
echo "select *,em.id as id1,sm.name as state,em.flag as flg from temp_employee_master em
join state_master sm on sm.id=em.State_of_Origin where em.user_id='$user' and em.flag is null"; */
	 while($per1=mssql_fetch_array($per))
	 {
		 ?>
		 <tr>
		 <td><?php echo $per1['Name'];?></td>
		 <td><input type="button" class="btn btn-info" onclick="ravi(<?php echo $per1['id1']; ?>)" value="Edit" name="edit"></td>
		 <?php if($per1['flg']!=1) 
		 {?>
		 <td><input type="button" class="btn btn-success" onclick="sub(<?php echo $per1['id1']; ?>)" value="Submit" name="Submit"></td><?php } ?>
		 </tr>
		 <?php
	 }
	 ?></table>
<?php } ?>
				</div>
			</div>
		<div class="col-md-9" style="width: 79%;">
		<div class="box" style="border-top: 3px solid #0f40a2;">
		
		<section class="tabs" style="height:50px;">
	            <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
		        <label for="tab-1" class="tab-label-1">Personal Details</label>
		
	            <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
		        <label for="tab-2" class="tab-label-2">Qualification</label>
		
	            <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
		        <label for="tab-3" class="tab-label-3">Proof Upload</label>
            
			    <div class="clear-shadow"></div>
			
			</section>
		
		<div id="personal" style="margin-bottom:100px;">
		
		
		 <form role="form" name="area" action=""  method="post" style="margin:0;">
                  <div class="box-body" id="emp_per">
				  <?php 
		
if($ava['balance']!=0)
{
		?>
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tbody>
						<tr>
							<td>Name</td>
							<td><input type="text" name="Name" id="Name" class="form-control"    required></td>
							<td>Position Applied For</td>
							<td><input type="text" name="applied_for" id="applied_for" class="form-control"   ></td>
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
				$state=mssql_query("select id,name from state_master where status='0'");
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
					 <div class="box-footer">
					   <input type="hidden" name="formsent" value='0'/>
						<input type="submit" class="btn btn-primary" value="Save" name="submit">
					  </div>
				
<?php  }
else
{
	?>
	 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif" border=1>
	 <tr><td colspan="11" style="text-align:center;color:#d41235;"><h4>You Have Entered Maximum Number of Registration</h4></td></tr>
	 <tr style="color:blue;">
	 <th>ID</th>
	 <th>Name</th>
	 <th>Applied For</th>
	 <th>Phone Number</th>
	 <th>Gender</th>
	 <th>Date Of Birth</th>
	 <th>E-mail</th>
	 <th>State of Origin</th>
	 <th>Blood Group</th>
	 <th>Edit</th>
	 <th>Submit</th>
	 </tr>
	 <?php 
	 $per=mssql_query("select *,em.id as id1,sm.name as state,em.flag as flg from temp_employee_master em
join state_master sm on sm.id=em.State_of_Origin where em.user_id='$user' order by em.id");
	 while($per1=mssql_fetch_array($per))
	 {
		 ?>
		 <tr>
		 <td><?php echo $per1['temp_employee_id'];?></td>
		 <td><?php echo $per1['Name'];?></td>
		 <td><?php echo $per1['applied_for'];?></td>
		 <td><?php echo $per1['Phone_Number'];?></td>
		 <td><?php echo $per1['Gender'];?></td>
		 <td><?php echo date("d-m-Y",strtotime($per1['Date_Of_Birth']));?></td>
		 <td><?php echo $per1['email'];?></td>
		 <td><?php echo $per1['state'];?></td>
		 <td><?php echo $per1['Blood_Group'];?></td>
		 <?php if($per1['flg']!=1) 
		 {?>
		 <td><input type="button" class="btn btn-info" onclick="ravi(<?php echo $per1['id1']; ?>)" value="Edit" name="edit"></td>
		 <td><input type="button" class="btn btn-success" onclick="sub(<?php echo $per1['id1']; ?>)" value="Submit" name="Submit"></td><?php } ?>
		 </tr>
		 <?php
	 }
	 ?></table>
	
	
	<?php
}	?> </div><!-- /.box-body -->
					
                </form>
		</div>
		</div>
		</div>
		
	</div>
</div>
</div>
<?php include('../footer.php'); ?>
</body>
</html>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tab-1').click(function(e) 
	{ 
		$.ajax
		({
			type: "GET",
			url: "emppersonal.php",
			data: "id=" + e,		 
			success: function(data)
			{
				$('#emp_per').html(data);
			}
		});
    });
    $('#tab-2').click(function(e) 
	{  
		$.ajax
		({
			type: "GET",
			url: "empqualification.php",
			data: "id=" + e,		 
			success: function(data)
			{
				$('#emp_per').html(data);
			}
		});
    });
    $('#tab-3').click(function(e) 
	{  
		$.ajax
		({
			type: "GET",
			url: "empupload.php",
			data: "id=" + e,		 
			success: function(data)
			{
				$('#emp_per').html(data);
			}
		});
    });
});
</script>

<script>
function sub(r)
	{
	 $.ajax
		({
			type: "GET",
			url: "emppersonalflag.php",
			data: "id=" + r,		 
			success: function(data)
			{
				window.location = "index.php";
			}
		});	
	}
</script>
<script>
function ravi(r)
	{
	 $.ajax
		({
			type: "GET",
			url: "emppersonaledit.php",
			data: "id=" + r,		 
			success: function(data)
			{
				$('#emp_per').html(data);
			}
		});	
	}
</script>
<script>
function ravi1(r)
	{
	 $.ajax
		({
			type: "GET",
			url: "empqulificationdetailedit.php",
			data: "id=" + r,		 
			success: function(data)
			{
				$('#emp_per').html(data);
			}
		});	
	}
</script>
	
<link rel="stylesheet" href="<?php echo URL;?>css/kendo.common-material.min.css" />
    <link rel="stylesheet" href="<?php echo URL;?>css/kendo.material.min.css" />
	<script src="<?php echo URL;?>js/kendo.all.min.js"></script>
	
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
	$Name=$_POST["Name"];
	$Department=$_POST["Department"];
	$Pan_Number=$_POST["Pan_Number"];
	$Phone_Number=$_POST["Phone_Number"];
	$email=$_POST["email"];
	$Present_Address=$_POST["Present_Address"];
	$Permanent_Address=$_POST["Permanent_Address"];
	$Religion=$_POST["Religion"];
	$Date_Of_Birth=date("Y-m-d",strtotime($_POST["Date_Of_Birth"]));
	$Gender=$_POST["Gender"];
	$State_of_Origin=$_POST["State_of_Origin"];
	$Blood_Group=$_POST["Blood_Group"];
	$Type_of_Education=$_POST["Type_of_Education"];
	$Aadhar_Number=$_POST["Aadhar_Number"];
	$applied_for=$_POST["applied_for"];
	$date=date("Y-m-d h:i:s");
	
	$sql=mssql_query("select * from temp_employee_master order by 1 desc");
	$cnt=mssql_num_rows($sql);
	if($cnt!=0)
	{
		$sql1=mssql_fetch_array($sql);
		$temp_employee_id=$sql1['temp_employee_id'];
		$rs=explode("_",$temp_employee_id);
		$number=$rs[1]+1;
		$code=$rs[0]."_".str_pad($number, 4, '0', STR_PAD_LEFT);
	}
	else
	{
		$code="TEMP_0001";
	}
	
	$n=mssql_query("insert into temp_employee_master (Name,temp_employee_id,Department,Pan_Number,Phone_Number,Aadhar,Present_Address,Permanent_Address,Gender,Religion,Date_Of_Birth,email,State_of_Origin,Blood_Group,user_id,applied_for,created_by,created_on)
	values ('$Name','$code','$Department','$Pan_Number','$Phone_Number','$Aadhar_Number','$Present_Address','$Permanent_Address','$Gender','$Religion','$Date_Of_Birth','$email','$State_of_Origin','$Blood_Group','$user','$applied_for','$user','$date')");
	
		
if($n)
	{
		mssql_query("update temp_user_master set entered_nos=(entered_nos+1) where USER_ID='$user'");
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "index.php";
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
           window.location = "index.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}	
	
if(isset($_POST['updateper']))  
{  
	$Name=$_POST["Name"];
	$Department=$_POST["Department"];
	$Pan_Number=$_POST["Pan_Number"];
	$Phone_Number=$_POST["Phone_Number"];
	$email=$_POST["email"];
	$Present_Address=$_POST["Present_Address"];
	$Permanent_Address=$_POST["Permanent_Address"];
	$Religion=$_POST["Religion"];
	$Date_Of_Birth=date("Y-m-d",strtotime($_POST["Date_Of_Birth"]));
	$Gender=$_POST["Gender"];
	$State_of_Origin=$_POST["State_of_Origin"];
	$Blood_Group=$_POST["Blood_Group"];
	$Aadhar_Number=$_POST["Aadhar_Number"];
	$applied_for=$_POST["applied_for"];
	$id=$_POST["id"];
	$date=date("Y-m-d h:i:s");
	
	$n=mssql_query("update temp_employee_master set Name='$Name',Department='$Department',Pan_Number='$Pan_Number',Phone_Number='$Phone_Number',Aadhar='$Aadhar_Number',Present_Address='$Present_Address',Permanent_Address='$Permanent_Address',Gender='$Gender',Religion='$Religion',Date_Of_Birth='$Date_Of_Birth',email='$email',State_of_Origin='$State_of_Origin',Blood_Group='$Blood_Group',user_id='$user',applied_for='$applied_for',modified_by='$user',modified_on='$date' where id='$id'");
		
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
            window.location = "index.php";
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
          window.location = "index.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}	
if(isset($_POST['empqualification']))  
{  
	$Name1=explode("-",$_POST["Name"]);
	$Name=$Name1[1];
	$emp_id=$Name1[0];
	$Type_of_Education=$_POST["Type_of_Education"];
	$University=$_POST["University"];
	$Branch_of_Education=$_POST["Branch_of_Education"];
	$Graduation=$_POST["Graduation"];
	$date=date("Y-m-d h:i:s");
		
	$cnt=count($Type_of_Education);
	for($i=0;$i<$cnt;$i++)
				{
					$n=mssql_query("insert into temp_employee_details (temp_employee_id,Branch_of_Education,type_of_education,University,Graduation,created_by,created_on)
	values ('$emp_id','$Branch_of_Education[$i]','$Type_of_Education[$i]','$University[$i]','$Graduation[$i]','$user','$date')");
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
            window.location = "index.php";
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
          window.location = "index.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}	
	
if(isset($_POST['empqualificationedit']))  
{  
	$id=$_POST["id"];
	$Type_of_Education=$_POST["Type_of_Education"];
	$University=$_POST["University"];
	$Branch_of_Education=$_POST["Branch_of_Education"];
	$Graduation=$_POST["Graduation"];
	$date=date("Y-m-d h:i:s");
		
	$n=mssql_query("update temp_employee_details set Branch_of_Education='$Branch_of_Education',type_of_education='$Type_of_Education',University='$University',Graduation='$Graduation',modified_by='$user',modified_on='$date' where id='$id'");
		
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
            window.location = "index.php";
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
          window.location = "index.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}	
if(isset($_REQUEST['test']))
{
	$_REQUEST['Name'];
	$emp_name1=explode("-",$_REQUEST['Name']);
	$emp_name=$emp_name1[1];
	$emp_code=$emp_name1[0];
	$type=$_REQUEST['type'];
	$datee=date("Y-m-d");
	$cnt=count($type);
	$r=0;
	for($i=1;$i<=$cnt;$i++)
	{
		$rs="Documents/" . $emp_code;
		if (!file_exists($rs)) {
				mkdir("Documents/" . $emp_code, 0777);
			}
	$fileName="userFile".$i;
	$target_Path_aggrement="Documents/".$emp_code."/";
	$filepath="Documents/".$emp_code."/".$emp_code.'--'.$type[$r].'--'.basename( $_FILES[$fileName]['name']);
	$target_Path_aggrement=$target_Path_aggrement.$emp_code.'--'.$type[$r].'--'.basename( $_FILES[$fileName]['name']);
						/******File Upload***/
	move_uploaded_file( $_FILES[$fileName]['tmp_name'],$target_Path_aggrement);
	
	$n=mssql_query("INSERT INTO temp_upload_master	(emp_id,description,filepath,created_by,created_on)
						VALUES
							('$emp_code','$type[$r]','$filepath','$user','$datee')
							");
							$r++;
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
            window.location = "index.php";
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
         window.location = "index.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}