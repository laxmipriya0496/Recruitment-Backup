<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
	$rs="and id='$id'";
}
else
{
	$rs="";
	$id="";
}
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
	<link href="<?php echo URL;?>css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
<style>

.content-header {
    margin-top: 45px;
}
.input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
    z-index: 0!important;
    margin-left: -1px;
}
	#xx
	{
		float:right;
	}
	.box-header a
	{
		padding: 5px 5px 5px 0px;
		background: #fff;
		color: #444;
		border-radius: 5px;
	}
	.box-header a.red
	{
		border:1px solid #dd4b39;
	}
	.box-header a.green
	{
		border:1px solid #14a225;
	}
	.box-header a i
	{
		color:#fff;
	}
	.box-header .pencil
	{
		padding: 5px;
		background: #14a225;
		margin-right: 5px;
	}
	.box-header .pencil1 
	{
		padding: 5px;
		background: #dd4b39;
		margin-right: 5px;
	}
	#dark
	{
		background:#a9a9a9;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 4px;
	}
	#dark{
		background-color:#a9a9a9!important;
	}
	ul{
	list-style-type: disc!important;
	}
	p{
		    text-align: justify;
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
           Employee Master
          </h1>
          <ol class="breadcrumb">
            <li><a href="../Menu/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee Master</li>
          </ol>
        </section>
		<!-- Main content -->
		<section class="content">
			<!-- Default box -->
		<div class="row" style="margin-right:10%; width:112%; font-family:'Times New Roman', Times, serif">
            <div class="col-xs-3" style="padding-right:5px;">
			 <?php
				$item_row12=mssql_fetch_array(mssql_query("select department from dbo.department_mapping where USER_ID='$user'"));
				$dpt=explode(",",$item_row12['department']);				
				$dpt1=implode("','",$dpt);		

				if($dpt1!="All")
				{
					$dt="and department in ('$dpt1')";
				}
				else
				{
					$dt="";
				}				
				$item_row=mssql_query("select top 10 * from employee_master where 1=1 $dt order by employee_id desc");			
				$s1=1;
			 ?>
				<div class="box box-primary">
					<div class="box-header with-border">
						<div class="" style="width:100%;float:left;" >
							<div class="input-group" style="width:100%;float:left;">
								<input type="hidden" name="filter" id="fil" value=""/>
								<input type="hidden" name="sort" id="st" value=""  />
								<input id="search1" class="form-control" type="text" placeholder="Enter Search Name..." value="" onChange="rs1()" name="filter[search]" style="width:100%;"/>
								<span class="input-group-btn"  >
								<button class="btn btn-flat" id="search-btn" name="search" onClick="rs1()"  type="submit" style="background-color:#0000ff;"><i class="fa fa-search" style="color: #fff;"></i></button>
								</span>
							</div>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body" id="box-body" style="font-family:'Times New Roman', Times, serif">
						<ul class="nav nav-pills" style="float:left;max-height:450px;overflow-y:scroll; width:100%; " >
						<?php 
							while($item_res=mssql_fetch_array($item_row))
							{
							?>
							<li style="border-top:1px solid #ddd; cursor:pointer;width:97%;"  class="active1" onClick="clicked(this.id);" id="<?php echo $s1;?>" > 
							<input type="hidden" name="invoice" id="invoice<?php echo $s1;?>" value="<?php echo $item_res['id'];?>"  />
							<?php $s1++;?>
							<div id="attrib-advanced" class="tab-pane active">
								<div style="position:relative; color:blue; float:left; line-height: 80px;">
									<b><img alt=" img" class="user-image" src="../images/profile/user.png" height="70" width="80"></b>
								</div><br>
					 			<div style="text-transform: uppercase;font-size: 16px;padding-top: 1px;color: #000;line-height: 18px; font-weight:bold;float:right; position:relative;" >
									<span style="font-weight:bold;font-size:13px;">
									<?php 
										echo $item_res['employee_id'];
									?>
								</div><br>
								<div class="emp_name">
									<div style="text-transform: uppercase;line-height: 18px; font-weight:bold;float:right; position:relative;" >&nbsp;||
										<span style="font-weight:normal;font-size:12px; color:#0000ff;">
										<?php echo $item_res['Name'];?> </span>
									</div>
								</div><br>		
								<div class="date">
									<div style="text-transform: uppercase;line-height: 18px; font-weight:bold;float:right; position:relative;" >&nbsp;||
										<span style="font-weight:normal;font-size:12px; color:#0000ff;">
										<?php echo $item_res['Phone_Number'];?> </span>
									</div>
								</div>								
							</div>
							</li>
							<?php
							}
							?>      
							</ul>
					</div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
		
        <div class="col-md-8" style="" style="font-family:'Times New Roman', Times, serif">
		<?php  
		$item1=mssql_fetch_array(mssql_query("select top 1 * from employee_master where 1=1 $dt $rs ORDER BY employee_id DESC"));
		if($id=="")
		{
			$id=$item1['id'];
		}
		?>
		<div class="ravi">
			 <div class="box box-primary box-primary7">
			 <div id="getemp">
				
				<div id="rav" style="margin:5px;">
                <div id="rs">
				
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-family:Times New Roman;font-weight:bold;">Employee Master</h3>
	  					<div id="xx">
						<?php  
						$emp=mssql_fetch_array(mssql_query("select d.view_only from role_detail d 
join role_master m on m.code=d.code
join role_mapping rm on rm.code=m.code
join user_master um on um.user_id=rm.user_id
join menu_master mm on mm.id=d.menu_id
where um.user_id='$user' and d.view_only in ('All','View','') and mm.menu_name='EMPLOYEE MASTER'"));
$view=$emp['view_only'];
						if($view=="All" || $view=="View")
						{
						?>
						<a href="doucuments.php?id=<?php echo $id;?>" target="_blank">
						<input type="button" value="View Documents" class="btn btn-primary"/></a>
						<?php
						}						
						if($view=="All")
						{
						?>
						<a class="red" href="employeemasternew.php">
						<span class="pencil1"><i class="fa fa-plus"></i></span>New</a>
						<a class="green" href="employeemasteredit.php?id=<?php echo $id;?>">
						<span class="pencil"><i class="fa fa-pencil"></i></span>Edit</a>
						<a class="red" href="delete.php?id=<?php echo $id;?>">
						<span class="pencil1"><i class="fa fa-trash"></i></span>Remove</a>
						<?php } ?>
						</div>
						
                </div><!-- /.box-header -->
				<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif">
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
						<?php if($col1['type']=="date") 
						{
							?>
						<td><input type="text" name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" class="form-control" value="<?php echo date("d-m-Y",strtotime($item1[$col1['name']])); ?>" readonly ></td>
						
						<?php
						}
						elseif($col1['name']=="employee_id") 
						{
							?>
						<td><input type="text" name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" class="form-control" value="<?php echo $eid=$item1[$col1['name']]; ?>" readonly ></td>
						
						<?php
						}
						elseif(stripos($col1['name'], 'address') !== FALSE)
						{?>
						<td><textarea name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" rows="3" cols="40" readonly class="form-control" style="resize:none;"><?php echo $item1[$col1['name']]; ?></textarea></td>
<?php
						}
						else
						{?>
						<td><input type="text" name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" readonly class="form-control" value="<?php echo $item1[$col1['name']]; ?>"  ></td>
						
						<?php }if($r%2==0)
					{
						?>
						</tr><tr>
						<?php
					}
						$r++;
	
						}?>
						</tr>
					</tbody>
				</table>
				
				<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif">
					<tbody>
					<tr style="color:blue;">
						<th style="text-align:center;">Branch of Education</th>
						<th style="text-align:center;">Type of Education</th>
						<th style="text-align:center;">University</th>
						<th style="text-align:center;">Graduation</th>
					</tr>
					<?php  
					$empde=mssql_query("select * from employee_details where emp_id='$eid'");
					while($empde1=mssql_fetch_array($empde))
					{
						?>
						<tr>
							<td><input type="text" name="Branch_of_Education" id="Branch_of_Education" class="form-control" value="<?php echo $eid=$empde1['Branch_of_Education']; ?>" readonly ></td>
							<td><input type="text" name="type_of_education" id="type_of_education" class="form-control" value="<?php echo $empde1['type_of_education']; ?>" readonly ></td>
							<td><input type="text" name="University" id="University" class="form-control" value="<?php echo $eid=$empde1['University']; ?>" readonly ></td>
							<td><input type="text" name="Graduation" id="Graduation" class="form-control" value="<?php echo $empde1['Graduation']; ?>" readonly ></td>
						</tr>
						<?php
					}
					?>
					
					</tbody>
				</table>
			</div>
			
    </div>
			   </div>
			   </div>
				</div> <!-- col 8 close-->
				</div>
			</div>
          </div>
			<script src="../js/jquery-1.7.2.js"></script>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
<?php
require ("../footer.php");
?> 
	<script src="../js/jQuery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo URL;?>js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="<?php echo URL;?>js/bootstrap-datetimepicker.pt-BR.js">
    </script>
	
	<script>
function rs1()
{
 var search = document.getElementById('search1').value; 			
	$.ajax
	({
		type: "GET",
		url: "search.php",
		data: "employee_name=" + search,		 
		success: function(data)
		{
			$('.box-body').html(data);
		}
	});	
}
</script>
<script>
		 function clicked(e) 
 {
	//alert(e);
	var rr="invoice"+e;
	var r=document.getElementById(rr).value;
	//alert(r);
		$.ajax
			({
				type: "GET",
				url: "issue.php",
				data: "emp_id=" + r,		 
				success: function(data)
				{
					$('#rs').html(data);
   				}
			});	
	
}
</script>
<script>
function changeNew()
{
 	//alert(data);
	 $.ajax({
		type: "GET",
		url: "employeedetails.php?id=1",
		success: function(data){
					$('.box-primary7').html(data);					
							 }
		});
}
</script>
<script>
$("[id$=myButtonControlID]").click(function(e) {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=rs]').html()));
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
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

</body>
</html>
