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
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Fields Search</h3>
				  <div style="float:right;">
				  <a href="searchmasternew.php">
						<input type="button" value="FIELDS SEARCH" class="btn btn-info"/></a>
				  	<a href="graduationsearch.php">
						<input type="button" value="GRADUATION SEARCH" class="btn btn-primary"/></a>
						</div>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
				<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr id="row2">
                      	<td>Field Name</td>
                      	<td id="emp">
						<select  name="employee_name" id="employee_name" class="form-control" value="" onchange="get_emp(this.value,this.id)" autocomplete="off">
						<option >Select</option>
							<?php 
						$employee_row=mssql_query("select id,field_name from field_mapping where status=0 order by order_by");
						?>
								<?php
									while($employee_res=mssql_fetch_array($employee_row))
									{
								?>
									<option><style><?php echo ucwords(str_replace("_"," ",$employee_res['field_name']));?></style></option>
									
								<?php
									
									}
									?>
							</select></td>
                      	<td>Condition</td><td>
						<select  name="condition" id="condition" class="form-control" value="" onchange="get_cat(this.value,this.id)" autocomplete="off" >
								<option >Select</option>
							</select>			
						</datalist>
</td>
<td><div id="change"></div></td>
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
	$field_name=str_replace(" ","_",$_REQUEST['employee_name']);
	$condition=$_REQUEST['condition'];
/* 
echo "select * from field_mapping f join type_mapping t on f.type=t.type where f.field_name='$field_name' and t.functions='$condition'"; */
$cus11=mssql_query("select * from field_mapping f join type_mapping t on f.type=t.type where f.field_name='$field_name' and t.functions='$condition'");
while($c11=mssql_fetch_array($cus11))
{
	$se= $c11['operations'];
	$type= $c11['type'];
}
if($type=="date")
{
	if($condition=="Between")
	{
		$search1=date ("Y-m-d",strtotime($_REQUEST['search11']));
		$search2=date ("Y-m-d",strtotime($_REQUEST['search12']));
		$sea1=str_replace("*",$search1,"$se");
		$sea=str_replace("#",$search2,"$sea1");
	}
	else
	{
		$search1=date ("Y-m-d",strtotime($_REQUEST['search11']));
		$sea=str_replace("*",$search1,"$se");
	}
}
	else
	{
		$search1=$_REQUEST['search1'];
		if($condition=="Between")
		{
			$search2=$_REQUEST['search2'];
			$sea1=str_replace("*",$search1,"$se");
			$sea=str_replace("#",$search2,"$sea1");
		}
		else
		{
			$sea=str_replace("*",$search1,"$se");
		}
	}
?>
<section class="content1">
<div class="row">
<div class="col-md-12" style="overflow:scroll;margin-bottom:25px;">
<div id="printableArea">
<div id="divTableDataHolder">
<?php $sear=str_replace("_"," ",$field_name) ;
if($type=="date")
{$search1=date("d-m-Y",strtotime($search1));}?>
<b>Search Result for</b> <?php echo "<span style='color:blue;text-transform: uppercase;font-size:20px;'>$sear - $search1</span>"; ?>
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
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));
	
	if($dep!="All")
	{
		$dt="and em.Department in ('$dep')";
		$dt1="and Department in ('$dep')";
	}
	else
	{
		$dt="";
		$dt1="";
		
	}
	
if($field_name=="University")
	{
		$cus=mssql_query("select distinct em.id,em.Name,em.employee_id,em.Department,em.Pan_Number,em.Phone_Number,em.Aadhar,em.Gender,em.Religion,em.State_of_Origin,em.Blood_Group from employee_master em join employee_details ed on em.employee_id=ed.emp_id where $field_name $sea $dt  order by 3 asc");
	}
	else
	{
		$fie=mssql_query("select * from field_configure order by order_by");
		while($fie1=mssql_fetch_array($fie))
		{
			$fields_want[]=$fie1['name'];
		}
		$all=implode(",",$fields_want);
		$cus=mssql_query("select id,$all from employee_master where $field_name $sea $dt1 order by employee_id asc");
		//echo "select id,$all from employee_master where $field_name $sea $dt1 order by employee_id asc";
	}
$s=1;
		while($c=mssql_fetch_array($cus))
		{
			$id=$c['id'];?>
			<tr>
				<td><a href="employeemaster.php?id=<?php echo $id;?>"><?php echo $s++;?></a> </td>
				<?php $cus13=mssql_query("SELECT UPPER(REPLACE(a.name,'_',' ')) as allup,upper(substring(REPLACE(a.name,'_',' '), 1, 1)) + substring(REPLACE(a.name,'_',' '),
2,LEN(a.name)) as firstup,lower(a.name) as l_name,a.name as name,f.type FROM sys.columns a
join field_configure s on a.name=s.name 
join field_mapping f on a.name=f.field_name WHERE object_id = OBJECT_ID('dbo.employee_master') and a.name  in 
(select name from field_configure) order by s.order_by");
while($cus131=mssql_fetch_array($cus13))
		{ if($c[$cus131['name']]=="")
			{
				$name=$c[$cus131['l_name']];
			}else{
			$name=$c[$cus131['name']];
				
			}
	?>
				<td><?php if($cus131['type']=="date"){echo date ("d-m-Y",strtotime($name)); }else{echo $name;}?></td>
		<?php }?>
				<td><div style=" white-space: nowrap;"><a href="viewdou.php?id=<?php echo $c['id'];?>&sterm=<?php echo $field_name;?>&key=<?php echo $search1;?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-eye icon-white"></i></a></div></td>
			</tr>
			<?php
		}
?> </table>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      
                      <div class="modal-body" id="modal-bodyku">
							
                      </div>
                      <div class="modal-footer" id="modal-footerq">
                      </div>
                    </div>
                  </div>
                </div> </div></div>
				</div></div>
			</section>
				<?php
}?>
	 </body>
	 
	
    <script src="<?php echo URL;?>js/bootstrap.min.js" type="text/javascript"></script>
  
<script>
function get_emp(r,s)
	{
			 $.ajax
			({
				type: "GET",
				url: "getcat.php",
				data: "name=" + r,		 
				success: function(data)
				{
					$('#condition').html(data);
					//alert(data);
   				}
			});	
	}
</script>
<script>
function get_cat(r,s)
	{
		//alert(r);
		var field_name=$('#employee_name').val();
			$.ajax
			({
				type: "GET",
				url: "getdata.php",
				data: "category_name=" + field_name + "&condition=" + r,		 
				success: function(data)
				{
					$('#change').html(data);
					//alert(data);
   				}
			});	
	}
</script>
<link rel="stylesheet" href="css/kendo.common-material.min.css" />
    <link rel="stylesheet" href="css/kendo.material.min.css" />
   	<link rel="stylesheet" href="css/kendo.common-material.min.css" />
	<script src="js/kendo.all.min.js"></script>
	<style>
 .k-autocomplete, .k-colorpicker, .k-combobox, .k-datepicker, .k-datetimepicker, .k-dropdown, .k-numerictextbox, .k-selectbox, .k-textbox, .k-timepicker, .k-toolbar .k-split-button
{
	width:100%!important;
}
</style>



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
<script language="javascript">
        function open_container(dept,exp)
        {
            
			//alert (date);
			// alert (exp);
			//alert (dept);
			var size='large';
            var content = '<form role="form"><div class="form-group"><label for="exampleInputEmail1">Email address</label><input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"></div><div class="form-group"><label for="exampleInputPassword1">Password</label><input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"></div><div class="form-group"><label for="exampleInputFile">File input</label><input type="file" id="exampleInputFile"><p class="help-block">Example block-level help text here.</p></div><div class="checkbox"><label><input type="checkbox"> Check me out</label></div><button type="submit" class="btn btn-default">Submit</button></form>';
            var title = 'My dynamic modal dialog form with bootstrap';
            var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary">Save changes</button>';
            setModalBox(title,content,footer,size);
				 $.ajax({
    							type: "GET",
    							url: "summodel.php?category_name="+dept+"&po_number="+exp,   							
		 
    							success: function(data){
        									$('#modal-bodyku').html(data);	
   													 }
								});
			
            $('#myModal').modal('show');
        }
</script>
<script>
 function setModalBox(title,content,footer,$size)
        {
            
            if($size == 'large')
            {
                $('#myModal').attr('class', 'modal fade bs-example-modal-lg')
                             .attr('aria-labelledby','myLargeModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-lg');
            }
            if($size == 'standart')
            {
                $('#myModal').attr('class', 'modal fade')
                             .attr('aria-labelledby','myModalLabel');
                $('.modal-dialog').attr('class','modal-dialog');
            }
            if($size == 'small')
            {
                $('#myModal').attr('class', 'modal fade bs-example-modal-sm')
                             .attr('aria-labelledby','mySmallModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-sm');
            }
        }
        </script>
		<script>
			
$('#example1').DataTable( {

    fixedHeader: true

} );
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