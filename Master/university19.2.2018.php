<?php
require ("../configuration.php");
require ("../user.php");
date_default_timezone_set("Asia/Kolkata");
$curdate=date("d-m-y");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));
	
	if($dep!="All")
	{
		$dt="and m.Department in ('$dep') ";
	}
	else
	{
		$dt="";
	}
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
          UNIVERSITY DETAILS
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
					<td colspan=8><select class="selectpicker" data-show-subtext="true" data-live-search="true" name="university_name1[]" id="university_name1" class="form-control" value="" autocomplete="off" multiple  onchange="get_gra()">
										<option value="Select University">Select University</option>
        <?php
		  										$co_row=mssql_query("select distinct University from employee_master m join employee_details d on m.employee_id=d.emp_id
 where 1=1 $dt and d.University like '%University%'");
 	 										
 												 while($co_res=mssql_fetch_array($co_row))
  													{
  											?>
    													<option  value="<?php echo $co_res['University']; ?>"><?php echo $co_res['University']; ?></option>
  										<?php
  													}
  											?>
  
 										 </select></td><td><input type="button" value="Get Graduation" onclick="show()" class="btn btn-primary"/></td>
										 </tr><tr id="hide" hidden>
										 <td>Graduation Name</td>
                      	<td id="emp">
						<select  name="graduction_name" id="graduction_name" class="form-control" value="" onchange="get_emp(this.value,this.id)" autocomplete="off">
						<option value="">Select</option>
							</select></td>
							<td>Branch of Education</td><td>
						<select  name="Branch_of_Education" id="Branch_of_Education" class="form-control" value=""autocomplete="off" onchange="get_emp1(this.value,this.id)">
								<option >Select</option>
							</select>
</td>
<td>Department</td>
                      	<td>
						<select  name="department" id="department" class="form-control" value=""autocomplete="off" >
								<option >Select</option>
							</select></td>
					<input type="hidden" name="msent" id="msent" />
						<td><input type="submit" name="addBranch" id="addBranch" class="btn btn-success" value="SEARCH" onClick="addBranch()"></td>
						<td><input type="button" onClick="printDiv('printableArea')" value="Print" class="btn btn-primary"/></td>
						<td><input type="submit" name="myButtonControlID" id="myButtonControlID" class="btn btn-primary" value="EXCEL"></td>
                  </tr>
                      </tbody>
                    </table><!-- /.table -->
					 </form>
				
				<?php
 if(isset($_REQUEST['msent']))
{
	$graduction_name=$_REQUEST['graduction_name'];
	$category=$_REQUEST['Branch_of_Education'];
	$department=$_REQUEST['department'];
	$uni=implode("','",$_REQUEST['university_name1']);
	if($graduction_name=="All")
	{
		$grd="";
	}
	else
	{
		$grd=" and Graduation='$graduction_name'";
	}
	if($category=="All")
	{
		$cat="";
	}
	else
	{
		$cat=" and Branch_of_Education='$category'";
	}
	if($department=="All")
	{
		$dep1="";
	}
	else
	{
		$dep1=" and Department='$department'";
	}
	?>
			
			<div id="printableArea">
<div id="divTableDataHolder">
			<table class="table table-hover" style="font-family:'Times New Roman', Times, serif;">
 <tr style="color:blue;">			
	<th>#</th>
	<th>Employee Code</th>
	<th>Employee Name</th>
	<th>Branch of Education</th>
	<th>Graduation</th>
	<th>View/Edit Details</th>
</tr>

<?php
$s=1;
$cus=mssql_query("select *,m.id as eid from employee_details d join employee_master m on d.emp_id=m.employee_id
 where d.University in('$uni') $grd $cat $dep1 order by employee_id");
		while($c=mssql_fetch_array($cus))
		{?>
			<tr>
				<td><?php echo $s++;?> </td>
				<td><a href="employeemaster.php?id=<?php echo  $c['eid'];?>"><?php echo $c['emp_id']; ?></a></td>
				<td><?php echo $c['Name']; ?></td>
				<td><?php echo ucfirst($c['Branch_of_Education']); ?></td>
				<td><?php echo $c['Graduation']; ?></td>
				<td  align="center"><div style=" white-space: nowrap;"><a href="viewdou.php?id=<?php echo $c['id'];?>&sterm=University&key=<?php echo $c['Graduation'];?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-eye fa-lg icon-white"></i></a></div></td>
			</tr>
			<?php
}}
?> </table>

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
		<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>  
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