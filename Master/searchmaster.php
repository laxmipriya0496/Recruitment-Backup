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
	<link rel="icon" href="<?php echo URL;?>images/favicon.ico" type="image/gif" sizes="16x16"> 
	<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo URL;?>js/jquery.min.js"></script>
	

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
       Employee Details
          </h1>
          <ol class="breadcrumb">
            <li><a href="../menu/menu.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
			 
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Employee List</h3>
                  <div class="box-tools pull-right">
                    <!--<div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Category Name"/>
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
					  
                    </div>-->
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
				<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr id="row2">
                      	<td>Field Name</td>
                      	<td id="emp"><input list="browsers1" name="employee_name" id="employee_name" class="form-control" value="" onchange="get_emp(this.value,this.id)" autocomplete="off" placeholder="<-- Select Field Name -->" >
							<datalist id="browsers1">
							<?php 
						$employee_row=mssql_query("select field_name from field_mapping order by 1 asc");
						?>
						<select class="form-control" id="rs">
								<?php
									while($employee_res=mssql_fetch_array($employee_row))
									{
								?>
									<option><style><?php echo ucwords(str_replace("_"," ",$employee_res['field_name']));?></style></option>
									
								<?php
									
									}
									?>
							</datalist></td>
                      	<td>Condition</td><td>
<input list="browsers3" name="condition" id="condition" class="form-control" onchange="get_cat(this.value,this.id)" value="" autocomplete="off">
						<datalist id="browsers3">
							<select class="form-control" id="ss3">
								<option >Select</option>
							</select>			
						</datalist>
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
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->
			  <?php
			  }
			  ?>
            </div><!-- /.col -->
         
		 
          </section><!-- /.content -->
     </div> <!-- /.content-wrapper -->
 	<?php
			require ("../footer.php");
	?> 
	<?php 
	/* $cus=mssql_query("
							WITH CTE AS
							(
								SELECT *,ROW_NUMBER() OVER (PARTITION BY category_code,category_name,items ORDER BY category_code,category_name,items) AS RN
								FROM category_master1
							)
							DELETE FROM CTE WHERE RN<>1
					");			//	delete with keeping original
					
		without keeping original
WITH CTE AS
(SELECT *,R=RANK() OVER (ORDER BY category_code,category_name,items)
FROM category_master1)
 DELETE CTE
WHERE R IN (SELECT R FROM CTE GROUP BY R HAVING COUNT(*)>1)*/
	?>
	

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
<div class="col-md-12" style="overflow:scroll;margin-bottom:55px;">
<div id="printableArea">
<div id="divTableDataHolder">
 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;width: 1650px;">
 <tr style="color:blue;">			
	<th>#</th>
	<?php $cus21=mssql_query("SELECT UPPER(REPLACE(name,'_',' ')) as allup,upper(substring(REPLACE(name,'_',' '), 1, 1)) + substring(REPLACE(name,'_',' '),2,LEN(name)) as firstup FROM sys.columns WHERE object_id = OBJECT_ID('dbo.emp_details') and name not in ('id','created_by','created_on','modified_by','modified_on')");
	//SELECT UPPER(REPLACE(name,'_',' ')) as allup,upper(substring(REPLACE(name,'_',' '), 1, 1)) + substring(REPLACE(name,'_',' '),2,LEN(name)) as firstup FROM sys.columns WHERE object_id = OBJECT_ID('dbo.emp_details') and name not in ('id','created_by','created_on','modified_by','modified_on')
		while($c21=mssql_fetch_array($cus21))
		{ ?>
	<th><?php echo $c21['allup'];  ?></th>
			<?php
			}?>
			<th>Upload Document</th>
</tr>

<?php
$s=1;
//echo "select * from emp_details where $field_name $sea";
$cus=mssql_query("select * from emp_details where $field_name $sea");
		while($c=mssql_fetch_array($cus))
		{?>
			<tr>
				<td><?php echo $s++;?> </td>
				<td>
				<a href="#" style="cursor:pointer;" id="<?php ?>" name="<?php ?>" ><label onClick="open_container('<?php echo $c['id']; ?>','<?php echo $c['Name']; ?>');"><?php echo $c['Name']; ?></label></a></td>
				<td><?php echo $c['salary']; ?></td>
				<td><?php echo $c['blood']; ?></td>
				<td><?php echo $c['father']; ?></td>
				<td><?php echo $c['month']; ?></td>
				<td><?php echo $c['percentage']; ?></td>
				<td><?php echo $c['present']; ?></td>
				<td><?php echo $c['mother']; ?></td>
				<td><?php echo $c['phone']; ?></td>
				<td><?php echo $c['pan']; ?></td>
				<td><?php echo $c['mobile']; ?></td>
				<td style="width:100px;"><?php echo date ("d-m-Y",strtotime($c['dob'])); ?></td>
				<td><?php echo $c['place']; ?></td>
				<td><?php echo $c['state']; ?></td>
				<td><div style=" white-space: nowrap;"><a href="docuploadmaster.php?id=<?php echo $c['id'].":".$c['Name'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil icon-white"></i></a></div></td>
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
					$('#ss3').html(data);
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
</html>