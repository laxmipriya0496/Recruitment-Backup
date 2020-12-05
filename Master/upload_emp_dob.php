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
	 
	 
	 <section class="content">
			  
			   
				  <div class="col-md-12" style="margin-top:100px;"></div>
				  <div class="col-md-12">
				  <div class="box box-primary">
					
					<div class="box-body no-padding">
					  <div class="mailbox-controls">
		
					  <form name="area"  method="post" enctype="multipart/form-data">
					  <div class="box-body">
					   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Employee DOB Upload</td>
							<td> 
			<input type="file" name="file" id="file"  /></br>

						</tr>
					
						
					  </table>
					   
					  </div><!-- /.box-body -->

						<div class="box-footer">
							<input type="submit" name="upload" value="Upload" /> </b></td>
							
						</div>
					  <input type="hidden" name="formsent">
					</form> 
					
					  </div>
					</div>
				</div>
				</div>
				
				
			  </section><!-- /.content -->
	 
			
      </body> 
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
	
	<?php
	
	if(isset($_REQUEST['upload']))
	{
			$filename=$_FILES["file"]["tmp_name"];
			  $file = fopen($filename, "r");
			$heading=true;
		while (($emapData = fgetcsv($file)) !== FALSE)
		{
			 // check if the heading row
			if($heading) 
			{
				// unset the heading flag
				$heading = false;
				// skip the loop
				continue;
			}
			$emapData[0];
			$con_dob=$emapData[1];
			$dob=date("Y-m-d",strtotime($con_dob));
			$con_doj=$emapData[2];
			$doj=date("Y-m-d",strtotime($con_doj));
			
$q=mssql_query("update employee_master set Date_Of_Birth='$dob',Date_of_Joining='$doj' where employee_id='$emapData[0]'");
	
		}
	
	
if($q)
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "upload_emp_dob.php";
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
           window.location = "upload_emp_dob.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}
?>  
  </body>
 <script>