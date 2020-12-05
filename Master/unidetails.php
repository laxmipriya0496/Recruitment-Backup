<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$uni=$_REQUEST['uni'];
$rs1=$uni;
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));
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
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
  <style>

.content {
    min-height: 800px;
    padding: 15px 15PX 180PX 15px!important;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid #333!important;
}
.table-bordered {
    border: 1px solid #333!important;
}
.modal-lg {
    width: 85%!important;
}
</style>
</head>

<body>
		<div class="wrapper">
	 	
	 <?php
			require ("../header.php");
	?>  
	 </div>
	 <div class="content-wrapper1">
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
		<div class="row">
          <div class="col-xs-12">
          <div class="box box-primary">
			<div style="margin-top:50px;">
			<div>
			<div style="float:left;">
			<h3><?php echo "University : <b style='color:blue;'>$uni</b> " ;  ?></h3></div>
			
			<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr id="row2">
                      	<td>Graduation Name</td>
                      	<td id="emp">
						<select  name="graduction_name" id="graduction_name" class="form-control" value=""  onchange="get_emp(this.value,this.id)" autocomplete="off">
						<option>Select</option>
						<option value="All">All</option>
							<?php 
						$employee_row=mssql_query("select distinct d.Graduation from employee_master m join employee_details d on m.employee_id=d.emp_id
where m.Department in('$dep') and d.University ='$uni'");
						?>
								<?php
									while($employee_res=mssql_fetch_array($employee_row))
									{
								?>
									<option><style><?php echo $employee_res['Graduation'];?></style></option>
									
								<?php
									
									}
									?>
							</select></td><td>Branch of Education</td><td>
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
			</div>
			<?php
 if(isset($_REQUEST['msent']))
{
	$graduction_name=$_REQUEST['graduction_name'];
	$category=$_REQUEST['Branch_of_Education'];
	$department=$_REQUEST['department'];
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
 where d.University='$uni' and m.Department in('$dep') $grd $cat $dep1 order by employee_id");
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
			</section>
			
				
			  </div>
			  
			  </div>
			  
				</div>
				</div>
				</div>

<?php include('../footer.php'); ?>
</body>
</html>
<script>
		$("[id$=myButtonControlID]").click(function(e) {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=divTableDataHolder]').html()));
			e.preventDefault();
		});
</script>
<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worsheet', table: table.innerHTML}
	
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>

	<script>
function printDiv(printableArea) {
     var printContents = document.getElementById(printableArea).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<script>
function get_emp(r,s)
	{
		 $.ajax
		({
			type: "GET",
			url: "education.php",
			data: "name=" + r + "&tp=<?php echo $rs1; ?>",		 
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
		 $.ajax
		({
			type: "GET",
			url: "dep.php",
			data: "Branch=" + r + "&graduction=" + gra + "&tp=<?php echo $rs1; ?>",		 
			success: function(data)
			{
				$('#department').html(data);
			}
		});	
	}
</script>