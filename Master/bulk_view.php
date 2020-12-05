<?php
require ("../configuration.php");
require ("../user.php");
date_default_timezone_set("Asia/Kolkata");
$curdate=date("d-m-y");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$dep=$_SESSION['dpt'];
?>
<html lang="en">
<head>
 <title><?php echo TITLE ;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome-animation.css">
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css">  
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap-select.min.css" />
	
	 <script src="js/canvasjs.min.js"></script>
  <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript" src="../script.js"></script>
  <script src="multi/jquery.js"></script>
  <link rel="stylesheet" href="multi/bootstrap.min.css">
  <script type="text/javascript" src="multi/bootstrap.min.js"></script>
  <script src="multi/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="multi/bootstrap-multiselect.css">
  <script src="<?php echo URL;?>js/bootstrap-select.min.js"></script>
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
  <style>
  .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){
	  width:200px;
  }
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
  
.mas {
    white-space: pre-wrap;
}
.canvasjs-chart-container{
	height: 400px;
}
.icon {
    vertical-align: bottom;
    margin-top: 2px;
    margin-bottom: 3px;
    cursor: pointer;
}

.icon:active {
    opacity: .5;
}

.demo.button input {
    margin-right: 2px;
}

.demo.button .ui-button-text {
    padding: .4em .6em;
    line-height: 0.8;
}

input[type='text'] {
  
  width: 70%;
    padding: 8px;
    border-radius: 5px;
}
</style>
</head>
 <body class="skin-blue fixed sidebar-mini">
  	 <div class="wrapper1">
	 <?php
			require ("../header.php");
	?>
	 </div>
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <h1>
         Employee Profile
          </h1>
          <ol class="breadcrumb">
            <li><a href="../menu/index.php"><i class="fa fa-dashboard"></i> Back</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
		<div class="row">
          <div class="col-xs-12">
          <div class="box">
			   	<div class="box-body">
				<div class="row">
				
				<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr id="row2">
					<td> <label> Select Department : </label><select class="selectpicker" data-show-subtext="true" data-live-search="true" name="department[]" id="department"
					class="form-control" autocomplete="off" multiple>
										<option value="All">All</option>
        <?php
		  										$co_row=mssql_query("select distinct department from employee_master");
 	 										
 												 while($co_res=mssql_fetch_array($co_row))
  													{
  											?>
    												<option  value="<?php echo $co_res['department']; ?>"><?php echo ucwords(strtolower($co_res['department'])); ?></option>
  										<?php
  													}
  											?>
  
 										 </select></td>
					<td> <label> Select Employee : </label><select class="selectpicker" data-show-subtext="true" data-live-search="true" name="employee_id[]" id="employee_id"
					class="form-control" autocomplete="off" multiple>
										<option value="All">All</option>
        <?php
		  										$co_row=mssql_query("select top 10 employee_id,Name from employee_master");
 	 										
 												 while($co_res=mssql_fetch_array($co_row))
  													{
  											?>
    												<option  value="<?php echo $co_res['employee_id']; ?>"><?php echo ucwords(strtolower($co_res['Name'])); ?></option>
  										<?php
  													}
  											?>
  
 										 </select></td>
										 
										 <td> <label> Select Category : </label><select class="selectpicker" data-show-subtext="true" data-live-search="true" name="employee_id[]" id="employee_id"
					class="form-control" autocomplete="off" multiple>
										<option value="All">All</option>
        <?php
		  										$co_row=mssql_query("select top 10 proof_code,proof_name from proofupload_master");
 	 										
 												 while($co_res=mssql_fetch_array($co_row))
  													{
  											?>
    												<option  value="<?php echo $co_res['proof_code']; ?>"><?php echo ucwords(strtolower($co_res['proof_name'])); ?></option>
  										<?php
  													}
  											?>
  
 										 </select></td>
										 <td><input type="button" value="Get Profile" onclick="show()" class="btn btn-primary"/></td>
										 </tr>
										  
                      </tbody>
                    </table><!-- /.table -->
					 </form>
				
				<?php
 if(isset($_REQUEST['msent']))
{
	
}?>

</div>
			</div>	
				
				</div>
				</div>
				</div>
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
		 
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect();
    });
</script>

<script>
function get_emp(r,s)
	{
		var rs=$("#university_name1").val();
		 $.ajax
		({
			type: "GET",
			url: "education.php",
			data: "name=" + r + "&tp=" + rs + "&dep=<?php echo $dep; ?>",		 
			success: function(data)
			{
				$('#Branch_of_Education').html(data);
			}
		});	
	}
</script>
<script>
function get_emp1(r,s)
	{
		var gra=$("#graduction_name").val();
		var uni=$("#university_name1").val();
		var tp="<?php echo $dep; ?>";
		 $.ajax
		({
			type: "GET",
			url: "dep.php",
			data: "Branch=" + r + "&uni=" + uni + "&graduction=" + gra + "&tp=" + tp,		 
			success: function(data)
			{
				$('#department').html(data);
			}
		});	
	}
</script>
<script>
function show()
{
	$("#hide").show();
	var rs=$("#university_name1").val();
		 $.ajax
		({
			type: "GET",
			url: "get_uni.php",
			data: "uni=" + rs + "&dep=<?php echo $dep; ?>",		 
			success: function(data)
			{
				$('#graduction_name').html(data);
			}
		});	
}
</script>
</body>
</html>