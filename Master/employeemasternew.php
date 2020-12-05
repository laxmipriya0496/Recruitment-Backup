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
            <li><a href="employeemaster.php">Back</a></li>
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
						<?php
				$col=mssql_query("SELECT name,type FROM sys.columns n join field_mapping f on n.name=f.field_name WHERE object_id = OBJECT_ID('dbo.employee_master') and name not in 
('id','created_by','created_on','modified_by','modified_on') and f.status=0 order by f.order_by");
$r=1;
					while($col1=mssql_fetch_array($col))
					{
				?>
						<td><?php echo ucfirst(str_replace("_"," ",$col1['name'])); ?></td>
						<?php if($col1['name']=="State_of_Origin") 
						{
							?>
							<td><select name="State_of_Origin" id="State_of_Origin"  class='form-control' required>
							<option value="">Select State</option>
							<?php
							$st=mssql_query("select id,name from state_master where status='0' and name!=''");
								while($st1=mssql_fetch_array($st))
								{
							?>
										<option value="<?php echo $st1['id'];?>"><?php echo $st1['name'];?></option>
							<?php
								}
							?>							
							</select></td>
							<?php
						}
						elseif($col1['name']=="Blood_Group") 
						{
							?>
							<td><select name="Blood_Group" id="Blood_Group"  class='form-control' required>
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
							<?php
						}
						elseif(stripos($col1['name'], 'address') !== FALSE)
						{?>
						<td><textarea name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" rows="3" cols="40" class="form-control" style="resize:none;" required></textarea></td>
<?php
						}
						else
						{?>
						<td><input type="text" name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" class="form-control" value=""  required ></td>
						
						<?php }if($r%2==0)
					{
						?>
						</tr><tr>
						<?php
					}
						$r++;
						if($col1['type']=="date")
						{ ?>
							<script>
								$(document).ready(function() {
									$('#<?php echo $col1['name'];  ?>').kendoDatePicker({
									format: "dd-MM-yyyy"
									});
								});
							
							</script><?php
						}
	
						}?>
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
<td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_1" class="form-control" value="" autocomplete="off" placeholder="---Select---" required>
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
<input list="browsers2" name="University[]" id="University_1" class="form-control"value="" autocomplete="off" placeholder="---Select---" required>
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
<td style="width:23%;"><input type="text" name="Branch_of_Education[]" id="Branch_of_Education_1" class="form-control" value="" required></td>
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
	
<link rel="stylesheet" href="css/kendo.common-material.min.css" />
    <link rel="stylesheet" href="css/kendo.material.min.css" />
	<script src="js/kendo.all.min.js"></script>
	
	<?php
if(isset($_POST['formsent']))  
{  
$col2=mssql_query("SELECT name,type FROM sys.columns n join field_mapping f on n.name=f.field_name WHERE object_id = OBJECT_ID('dbo.employee_master') and name not in 
('id','created_by','created_on','modified_by','modified_on') and f.status=0 order by name");
$r=1;
while($col21=mssql_fetch_array($col2))
{
	$type[]=$col21['type'];
	$sr[]=$col21['name'];
	$r=$_POST[$col21['name']];
	$rs[]=$r;
}
$tot_cnt= count($rs);
	$Type_of_Education=$_POST["Type_of_Education"];
	$University=$_POST["University"];
	$Branch_of_Education=$_POST["Branch_of_Education"];
	$Graduation=$_POST["Graduation"];
	$date=date("Y-m-d h:i:s");
	
	$query="insert into employee_master (";
	
	for($i=0;$i<$tot_cnt;$i++)
	{
		$query.=$sr[$i].',';
	}
	$query.="created_by,created_on)values ('";
	
	for($i=0;$i<$tot_cnt;$i++)
	{
		if($type[$i]=="date")
		{
			$query.=date("Y-m-d",strtotime($rs[$i]))."','";
		}
		else
		{
			$query.=$rs[$i]."','";
		}
		
		if($sr[$i]=="employee_id")
		{
			$emp_id=$rs[$i];
		}
		
	}
	$query.="$user','$date')";
	//echo $query;
	
	$n=mssql_query($query);
	
	echo $n;
	echo "<br><br><br><br><br><br><br><br><br><br>";
	
	
	$cnt=count($Type_of_Education);
	for($i=0;$i<$cnt;$i++)
				{
					$n=mssql_query("insert into employee_details (emp_id,Branch_of_Education,type_of_education,University,Graduation,created_by,created_on)
	values ('$emp_id','$Branch_of_Education[$i]','$Type_of_Education[$i]','$University[$i]','$Graduation[$i]','$username','$date')");
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
            //window.location = "employeemaster.php";
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
           //window.location = "employeemaster.php";
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
	
	 $('.table-striped').append('<tr class="row_'+len+'"><td style="width:3%;"><input type="checkbox" name="chk[]" id="chk_'+len+'" value="'+len+'" class=" chk" style="width:15px;height:20px;"/></td><td style="width:18%;"><input list="browsers1" name="Type_of_Education[]" id="Type_of_Education_'+len+'" class="form-control" value="" autocomplete="off" placeholder="---Select---"></td><td style="width:33%;"><input list="browsers2" name="University[]" id="University_'+len+'" class="form-control"value="" autocomplete="off" placeholder="---Select---" required></td><td style="width:23%;"><input type="text" name="Branch_of_Education[]" id="Branch_of_Education_'+len+'" class="form-control" value="" required></td><td style="width:23%;"><input type="text" name="Graduation[]" id="Graduation_'+len+'" class="form-control" value="" required></td></tr>');
	
	
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