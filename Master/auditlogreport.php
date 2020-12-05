<?php
require ("../configuration.php");
require ("../user.php");

date_default_timezone_set("Asia/Kolkata");
//$curdate=date("d-m-y");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$fullname=$_SESSION['full_name'];
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
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
	
	<link rel="stylesheet" href="css/kendo.common-material.min.css" />
    <link rel="stylesheet" href="css/kendo.material.min.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.all.min.js"></script>
	
<script type="text/javascript" src="../script.js"></script>
<script type="text/javascript">
var sorter=new table.sorter("sorter");
sorter.init("sorter",1);
</script>
<style media="print" type="text/css">
 body
{
/*font-size:10px !important;
*/}
.table
{
line-height:0px!important;
letter-spacing:0px!important;
text-transform:uppercase;
/*font-size:10px !important;
*/padding:.5px;
margin-top:0px;
margin-bottom:0px;
}

.col-sm-4 {
    width: 33.3333%;
}
th,td
{
line-height:1px;
}
th
{
color:#0088cc;
}
section
{
line-height:1px!important;
letter-spacing:1px!important;
}
.invoice {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f4f4f4;
    margin: 0px!important;
    padding: 0px!important;
    position: relative;
}
 .mas {
    white-space: pre-wrap!important;
}
</style>
  <input type="hidden" id="menu_id" value="<?php //echo $menu_id;?>">
  <input type="hidden" id="submenu_id" value="<?php //echo $submenu_id;?>">

  <style>
  .k-autocomplete, .k-colorpicker, .k-combobox, .k-datepicker, .k-datetimepicker, .k-dropdown, .k-numerictextbox, .k-selectbox, .k-textbox, .k-timepicker, .k-toolbar .k-split-button
{
	width:100%!important;
}
  .nav-pills > .active1  {
   border-left: 2px solid #3c8dbc;
   padding:2px;
  }
	.btn {
    padding: 9px 15px;
	}
	.form-control {
    height: 40px;
	} 
	.nav>li>a
	{
    padding: 9px 15px;
	} 
	input[type=date]
	{
	line-height: 18px;
    padding: 6px 0px 8px 0px;
	}
.box {
    border-top-color: #3c8dbc;
}
  </style>
  <style>
.mas {
    white-space: pre-wrap;
}
</style>
</head>
  <body class="skin-blue fixed sidebar-mini">
  	 <div class="wrapper">
	 	
	 <?php
			require ("../header.php");
	?>  
	 </div>
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           AUDIT LOG REPORT
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo URL;?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Audit Log Report</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
		<div class="row">
          <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">AUDIT LOG REPORT</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
			<form method="post">
			    <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
			   	<tbody>
					<tr>
					<td>
     				<input type="text" id="datepicker" class="add-on form-control" id="from_date" name="from_date" placeholder="From Date" value="" >
      				</td>
					
					<td>
     				<input type="text" id="datepicker1" class="add-on form-control" id="to_date" name="to_date" placeholder="To Date" value="" onKeyPress="return noPress()" >
      				</td>
					<td>
					<select name="master_name" id="master_name" class="form-control" onchange="get_cost(this.value)">
						<option value="">SELECT</option>
						<?php 
						$employee_row=mssql_query("select distinct master_name from updated_data order by master_name");
						while($employee_res=mssql_fetch_array($employee_row))
									{?>
									 <option value="<?php  echo $employee_res['master_name']; ?>"><?php echo $employee_res['master_name'];?></option><?php
									}?>
									<option value="User Log">User Log</option>
						</select>
						</td>	
						<td>
						<select name="employee_name" id="employee_name" class="form-control" >
						<option value="0">SELECT</option>
						</select>
						</td>								
					<input type="hidden" name="msent" id="msent" />
						<td width="10%" ><input type="submit" name="addBranch" id="addBranch" class="btn btn-success" value="SEARCH" onClick="addBranch()"></td>
						<td width="5%" ><input type="button" onClick="printDiv('printableArea')" value="Print" class="btn btn-primary"/></td>
						<td width="5%"><input type="submit" name="myButtonControlID" id="myButtonControlID" class="btn btn-primary" value="EXCEL"></td>
					</tr>
				</tbody>
			   </table>
			   </form>
			    <?php
			   if(isset($_REQUEST['msent']))
			   {
				   $hd="";
				   $from_date1=$_REQUEST['from_date'];
				   if($from_date1!="")
				   {
						$from_date=date("Y-m-d",strtotime($from_date1));
						$to_date1=$_REQUEST['to_date'];
						$to_date=date("Y-m-d",strtotime($to_date1));
						$dt="and created_on between '$from_date' and '$to_date'";
				   }
				   else
				   {
					  $dt=""; 
				   }
				$master_name=$_REQUEST['master_name'];
				if($master_name!="")
				   {
						$ms="and master_name='$master_name' ";
				   }
				   else
				   {
					  $ms=""; 
				   }
				//$emp=mssql_fetch_array(mssql_query(""));
				?>
			   	<div class="box-body">
				<div class="row">
				<div class="col-xs-12">
				<div id="printableArea">
				<div id="divTableDataHolder">
				<?php if($master_name!="User Log") 
				{?>
				
				<table cellpadding="0" cellspacing="0" border="1" class="sortable table table-bordered table-hover" id="sorter">
					<tr><td colspan="9" align="center"><h3>Audit Log REPORT <?php echo $hd; ?></h3></td></tr>
							<tr style="color: #253aaf;background: #eee;">	
							<th>#</th>	
							<th rowspan="1">Code</th>
							<th rowspan="1">Master Name</th>
				        	<th rowspan="1">Column Name</th>
							<th rowspan="1">Old Value</th>
							<th rowspan="1">New Value</th>
							<th rowspan="1">IP Address</th>
							<th rowspan="1">Modified By</th>
							<th rowspan="1">User Name</th>
							<th rowspan="1">Modified Date</th>
							</tr>	
						
					<?php
				$inndate1=mssql_query("select * from updated_data where 1=1 $dt $ms");
				
$s=1;
		while($indate=mssql_fetch_array($inndate1))
		{	
			$user_id=$indate['created_by'];
			$user_det=mssql_fetch_array(mssql_query("select * from user_master where user_id='$user_id'"));
			$fullname1=$user_det['full_name'];
			$username1=$user_det['user_name'];
				?>	
							<tr>		
							<td><?php echo $s++;?></td>
							<td><?php echo $indate['employee_id']; ?></td>
							<td><?php echo $indate['master_name']; ?></td>
							<td><?php echo $indate['column_name']; ?></td>
							<td><?php echo $indate['old_value']; ?></td>
							<td><?php echo $indate['new_value']; ?></td>
							<td><?php echo $indate['ip_address']; ?></td>
							<td><?php echo $fullname1; ?></td>
							<td><?php echo $username1; ?></td>
							<td><?php echo date("d-m-Y",strtotime($indate['created_on'])); ?></td>
							</tr>	
						
						<?php
				}
			   }
			   else
			   {
				   ?>
				<table cellpadding="0" cellspacing="0" border="1" class="sortable table table-bordered table-hover" id="sorter">
					<tr><td colspan="9" align="center"><h3>Audit Log REPORT <?php echo $hd; ?></h3></td></tr>
							<tr style="color: #253aaf;background: #eee;">	
							<th>#</th>	
							<th rowspan="1">User Name</th>
							<th rowspan="1">Full Name</th>
							<th rowspan="1">IP Address</th>
							<th rowspan="1">Login</th>
							<th rowspan="1">Logout</th>
							</tr>	
						
					<?php
			$employee_name=$_REQUEST['employee_name'];
			if($employee_name=="All" || $employee_name=="0")
			{
				$em="";
			}
			else
			{
				$em="and user_id='$employee_name'";
			}
				$inndate12=mssql_query("select * from user_log where 1=1 $dt $em");
				
$s=1;
		while($indate2=mssql_fetch_array($inndate12))
		{	
			$user_id=$indate2['created_by'];
			$user_det=mssql_fetch_array(mssql_query("select * from user_master where user_id='$user_id'"));
			$fullname1=$user_det['full_name'];
			$username1=$user_det['user_name'];
			if($indate2['logout']=="")
			{
				$out="";
			}
			else
			{
				$out=date("d-m-Y H:i",strtotime($indate2['logout']));
			}
				?>	
							<tr>		
							<td><?php echo $s++;?></td>
							<td><?php echo $username1; ?></td>
							<td><?php echo $fullname1; ?></td>
							<td><?php echo $indate2['ip_address']; ?></td>
							<td><?php echo date("d-m-Y H:i",strtotime($indate2['login'])); ?></td>
							<td><?php echo $out; ?></td>
							</tr>	
						
						<?php
		}
			   ?>
			   </table>
			   <?php
			   } 
			   }
			     
			   ?>
			   
			   
				</div>
				</div>
				</div>
				</div>
				</div>
		 </div>
		 </div>
		 </div>

			
			 
		<script src="../js/jquery.table2excel.js"></script>
			
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 	<?php
			require ("../footer.php");
	?> 
	<script>
		$("[id$=myButtonControlID]").click(function(e) {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=divTableDataHolder]').html()));
			e.preventDefault();
		});
</script> 

	<script>
		$(document).ready(function() {
			// create DatePicker from input HTML element
			$("#datepicker").kendoDatePicker({
			format: "dd-MM-yyyy"
			});
		});
	
		$(document).ready(function() {
			// create DatePicker1 from input HTML element
			$("#datepicker1").kendoDatePicker({
			format: "dd-MM-yyyy"
			});
		});
	</script>
	<script type="text/javascript">
var sorter=new table.sorter("sorter");
sorter.init("sorter",1);
</script>
		
	  
		<script>
function printDiv(divName) { 
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
 
     window.print();

     document.body.innerHTML = originalContents;
}
</script>  
<script>
		function get_cost(r)
		{
			//alert(r);
			if(r=="Employee Master" || r=="User Log")
			{
				$("#employee_name").show();
			}
			else
			{
				$("#employee_name").hide();
			}
			$.ajax
			({
				type: "GET",
				url: "getfield.php",
				data: "name=" + r,		 
				success: function(data)
				{
					$('#employee_name').html(data);
   				}
			});	
		}
	</script>



 </body>
</html>