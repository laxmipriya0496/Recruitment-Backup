<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
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
 
  
</head>

<body>
	 	
	 <?php
			require ("../header.php"); 
	?>
     
	<div class="wrapper" style=" width: 98%; margin:0 auto;">
    
<div class="row">

            <div class="col-md-12" style="margin-top:-1%;">
           
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
         <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="../menu/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content1">
		  <div class="row">
           
			<div class="col-md-12">
			<?php
			if(isset($_REQUEST['cus']))
			{
			$cus=$_REQUEST['cus'];
				if($cus==1)
				{
			?>
			 <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Employee</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   Updated Successfully.
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			<?php
				}
				else
				{
				?>
			 <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Organisation</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   Not Updated.Please Try Again.
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			<?php
				}
			}
			else
			{
			?>
			 
          <ol class="breadcrumb">
            <li><a href="../menu/index.php"><i class="fa fa-dashboard"></i> Back</a></li>
          </ol>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Graduation Search </h3>
				   <div style="float:right;">
				  	<a href="searchmasternew.php">
						<input type="button" value="FIELDS SEARCH" class="btn btn-primary"/></a>
							<a href="graduationsearch.php">
						<input type="button" value="GRADUATION SEARCH" class="btn btn-info"/></a>
						</div>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
				<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr id="row2">
                      	<td>Graduation</td>
                      	<td id="emp">
						<select  name="graduction" id="graduction" class="form-control" value="" onchange="get_emp(this.value,this.id)" autocomplete="off">
						<option >Select</option>
							<?php 
						$employee_row=mssql_query("select distinct specialization from dbo.specialization_mapping order by 1 desc");
						?>
								<?php
									while($employee_res=mssql_fetch_array($employee_row))
									{
								?>
									<option><style><?php echo $employee_res['specialization'];?></style></option>
									
								<?php
									
									}
									?>
							</select></td>
                      	<td id="cat" hidden>Category</td><td id="cat1" hidden>
						<select  name="category" id="category" class="form-control" value="" onchange="get_cat(this.value,this.id)" autocomplete="off" >
								<option >Select</option>
							</select>
</td>
<td>Degree</td><td>
						<select  name="degree" id="degree" class="form-control" value="" autocomplete="off"  onchange="get_gra(this.value,this.id)">
								<option >Select</option>
							</select>
</td><td id="gra" hidden>Education</td><td id="gra1" hidden>
						<select  name="education" id="education" class="form-control" value="" autocomplete="off" >
								<option >Select</option>
							</select>
</td>
<td><label id="change"></label></td>
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
	$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));
	
	if($dep!="All")
	{
		$dt="and Department in ('$dep')";
	}
	else
	{
		$dt="";
	}
	
	$graduction=$_REQUEST['graduction'];
	$degree=$_REQUEST['degree'];
	if($degree!="All")
	{
		$dg="and Graduation='$degree'";
	}
	else
	{
		$dg="";
	}
	if($graduction=="Professional")
	{
		$cus=mssql_query("select * from employee_master where employee_id in (
select distinct d.emp_id from employee_details d
 where d.Graduation in (select degree from dbo.specialization_mapping where specialization='$graduction' $dg)) $dt order by employee_id asc");
	}
	elseif($graduction=="Post Graduation")
	{
		$category=$_REQUEST['category'];
		$education=$_REQUEST['education'];
		if($education=="All")
		{
			$edu="";
		}
		else
		{
			$edu=" and Branch_of_Education='$education'";
		}
		$cus=mssql_query("select * from employee_master where employee_id in ( select distinct d.emp_id from employee_details d
 where d.Graduation in (select degree from dbo.specialization_mapping where 
 specialization='$graduction' and type='$category' $edu $dg) and d.emp_id not in
 (select m.employee_id from employee_details d
join employee_master m on d.emp_id=m.employee_id
 where d.Graduation in (select degree from dbo.specialization_mapping where specialization='Professional'))) $dt order by employee_id asc");
	}
	elseif($graduction=="Graduation")
	{
		$category=$_REQUEST['category'];
		$education=$_REQUEST['education'];
		if($education=="All")
		{
			$edu="";
		}
		else
		{
			$edu=" and Branch_of_Education='$education'";
		}
		$cus=mssql_query("select * from employee_master where employee_id in (select distinct d.emp_id from employee_details d
join employee_master m on d.emp_id=m.employee_id
 where d.Graduation in (select degree from dbo.specialization_mapping where 
 specialization='$graduction' and type='$category' $edu $dg) and m.employee_id not in
 (select m.employee_id from employee_details d
join employee_master m on d.emp_id=m.employee_id
 where d.Graduation in (select degree from dbo.specialization_mapping where specialization='Professional' or specialization='Post Graduation')
)) $dt order by employee_id asc");
	}
	elseif($graduction=="Diploma")
	{
		$cus=mssql_query(" select * from employee_master where employee_id in (select distinct d.emp_id from employee_details d
join employee_master m on d.emp_id=m.employee_id
 where d.Graduation in (select degree from dbo.specialization_mapping where 
 specialization='$graduction' $dg) and m.employee_id not in
 (select m.employee_id from employee_details d
join employee_master m on d.emp_id=m.employee_id
 where d.Graduation in (select degree from dbo.specialization_mapping where specialization in ('Professional','Post Graduation','Graduation')))) $dt order by employee_id asc");
	}
	elseif($graduction=="Others")
	{
		$cus=mssql_query("select * from employee_master where employee_id in ( select distinct d.emp_id from employee_details d
join employee_master m on d.emp_id=m.employee_id
 where d.Graduation in (select degree from dbo.specialization_mapping where 
 specialization='$graduction' $dg) and m.employee_id not in
 (select m.employee_id from employee_details d
join employee_master m on d.emp_id=m.employee_id
 where d.Graduation in (select degree from dbo.specialization_mapping where specialization in ('Professional','Post Graduation','Graduation','Diploma'))
)) $dt order by employee_id asc");
	}

?>
<section class="content1">
<div class="row">
<div class="col-md-12" style="overflow:scroll;margin-bottom:25px;">
<div id="printableArea">
<div id="divTableDataHolder">
<?php if($graduction=="Post Graduation" || $graduction=="Graduation")
{
	$ca=" - $category";
}
else
{
	$ca="";
}
	?>
<b>Search Result for</b> <?php echo "<span style='color:blue;text-transform: uppercase;font-size:20px;'>$graduction $ca - $degree</span>"; ?>
 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;width: 100%;">
 <tr style="color:blue;">			
	<th>#</th>
	<?php
	$cus12=mssql_query("SELECT UPPER(REPLACE(a.name,'_',' ')) as allup,upper(substring(REPLACE(a.name,'_',' '), 1, 1)) + substring(REPLACE(a.name,'_',' '),
2,LEN(a.name)) as firstup FROM sys.columns a
join field_configure s on a.name=s.name WHERE object_id = OBJECT_ID('dbo.employee_master') and a.name  in 
(select name from field_configure) order by s.order_by");
		while($rs=mssql_fetch_array($cus12))
		{
			?>
			<th><?php echo $rs['firstup']; ?></th>
			<?php
		}
		?>
		<th>View</th>
</tr>

<?php
$s=1;
		while($c=mssql_fetch_array($cus))
		{
			$id=$c['id'];?>
			<tr>
				<td><a href="employeemaster.php?id=<?php echo $id;?>"><?php echo $s++;?></a> </td>
				<?php $cus13=mssql_query("SELECT UPPER(REPLACE(a.name,'_',' ')) as allup,upper(substring(REPLACE(a.name,'_',' '), 1, 1)) + substring(REPLACE(a.name,'_',' '),
2,LEN(a.name)) as firstup,a.name as name,f.type FROM sys.columns a
join field_configure s on a.name=s.name 
join field_mapping f on a.name=f.field_name WHERE object_id = OBJECT_ID('dbo.employee_master') and a.name  in 
(select name from field_configure) order by s.order_by");
while($cus131=mssql_fetch_array($cus13))
		{ 
	?>
				<td><?php if($cus131['type']=="date"){echo date ("d-m-Y",strtotime($c[$cus131['name']])); }else{echo $c[$cus131['name']];}?></td>
		<?php }?>
				<td><div style=" white-space: nowrap;"><a href="viewdou.php?id=<?php echo $c['id'];?>&sterm=University&key=<?php echo $degree;?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-eye icon-white"></i></a></div></td>
			</tr>
			<?php
		}
?> </table> </div></div>
				</div></div>
			</section>
				<?php
}?>
	 </body>
	 
	
    <script src="<?php echo URL;?>js/bootstrap.min.js" type="text/javascript"></script>
  
<script>
function get_emp(r,s)
	{
		if(r=="Post Graduation" || r=="Graduation")
		{
			$("#cat").show();
			$("#cat1").show();
			$("#gra").show();
			$("#gra1").show();
			
			 $.ajax
			({
				type: "GET",
				url: "category.php",
				data: "name=" + r + "&tp=GR",		 
				success: function(data)
				{
					$('#category').html(data);
   				}
			});	
		}
		else
		{
			$("#cat").hide();
			$("#cat1").hide();
			$("#gra").hide();
			$("#gra1").hide();
			
			var gra= $("#graduction").val();
			$.ajax
			({
				type: "GET",
				url: "category.php",
				data: "name=" + r + "&gra=" + gra + "&tp=CT",		 
				success: function(data)
				{
					$('#degree').html(data);
					//alert(data);
   				}
			});	
		}
			
	}
</script>
<script>
function get_cat(r,s)
	{
		var gra= $("#graduction").val();
			$.ajax
			({
				type: "GET",
				url: "category.php",
				data: "name=" + r + "&gra=" + gra + "&tp=CT",		 
				success: function(data)
				{
					$('#degree').html(data);
					//alert(data);
   				}
			});	
	}
</script>
<script>
function get_gra(r,s)
	{
		$.ajax
		({
			type: "GET",
			url: "education.php",
			data: "name=" + r ,		 
			success: function(data)
			{
				$('#education').html(data);
			}
		});	
	}
</script>
            </div><!-- /.col -->
		 
          </section><!-- /.content -->
     </div> <!-- /.content-wrapper -->
          </div><!-- /.row -->
</div>
</div>
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->
			  <?php
			  }
			  ?>


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