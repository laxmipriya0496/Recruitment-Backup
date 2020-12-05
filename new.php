<?php
require ("../configuration.php");
require ("../user.php");
?>
<?php
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
/*$_SESSION['menu_id']=$_REQUEST['menu_id'];
$_SESSION['submenu_id']=$_REQUEST['sub_menu'];
$menu_id=$_SESSION['menu_id'];
$submenu_id=$_SESSION['submenu_id'];*/
/* if(isset!=$rs)
{
	$cus11=mssql_query("SELECT TOP 1 issue_id FROM new_item_issue1 ORDER BY id DESC");
		while($item10=mssql_fetch_array($cus11))
		{
			$rs=$item10['issue_id'];
		}
} */
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
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<style>
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
	.box-header a.yellow
	{
		border:1px solid #f39c12;
	}
	.box-header a i
	{
		color:#fff;
	}
	.box-header .pencil
	{
		padding: 5px;
		background: #f39c12;
		margin-right: 5px;
	}
	.box-header .pencil1 
	{
		padding: 5px;
		background: #dd4b39;
		margin-right: 5px;
	}
</style>
</head>
<body class="skin-blue fixed sidebar-mini">
	<div class="wrapper">
		<?php
		require ("../../Asset/header.php");
		?>
		<?php
		require ("../../Asset/aside.php");
		?>  
	</div>

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<!--<h1>
			<?php echo TITLE;?>
		</section>
		<!-- Main content -->
		<section class="content">
			<!-- Default box -->
		<div class="row" style="margin-right:10%; width:107%; font-family:'Times New Roman', Times, serif">
            <div class="col-xs-4" style="padding-left: 1px;padding-right: 1px; width:28%;">
			 
			 <?php
				$item_row=mssql_query("SELECT distinct issue_id,employee_name,date,location FROM new_item_issue1 order by issue_id desc");			
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
							<input type="hidden" name="invoice" id="invoice<?php echo $s1;?>" value="<?php echo $item_res['issue_id'];?>"  />
							<?php $s1++;?>
							<div id="attrib-advanced" class="tab-pane active">
								<div style="position:relative; color:blue; float:left; line-height: 80px;">
									<b><img alt=" img" class="user-image" src="/Asset/images/profile/user.png" height="70" width="80"></b>
								</div><br>
					 			<div style="text-transform: uppercase;font-size: 16px;padding-top: 1px;color: #000;line-height: 18px; font-weight:bold;float:right; position:relative;" >
									<span style="font-weight:bold;font-size:13px;">
									<?php 
										echo $item_res['issue_id'];
									?>
								</div><br>
								<div class="emp_name">
									<div style="text-transform: uppercase;line-height: 18px; font-weight:bold;float:right; position:relative;" >&nbsp;||
										<span style="font-weight:normal;font-size:12px; color:#0000ff;">
										<?php echo $item_res['employee_name'];echo $item_res['location'];?> </span>
									</div>
								</div><br>		
								<div class="date">
									<div style="text-transform: uppercase;line-height: 18px; font-weight:bold;float:right; position:relative;" >&nbsp;||
										<span style="font-weight:normal;font-size:12px; color:#0000ff;">
										<?php echo $item_res['date'];?> </span>
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
		
        <div class="col-md-8" style="padding-left: 10px;padding-right: 1px;" style="font-family:'Times New Roman', Times, serif">
		
		<div class="ravi">
			 <div class="box box-primary box-primary7">
			 <div id="getemp">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-family:Times New Roman;font-weight:bold;">Item Issue</h3>
	  					<div id="xx">
						<a class="red" href="itemissuenew.php" id="9">
						<span class="pencil1"><i class="fa fa-plus"></i></span>New</a>
						<input type="button" onclick="printDiv('rav')" value="Print" class="btn btn-primary"/>
						<input type="submit" name="myButtonControlID" id="myButtonControlID" class="btn btn-primary" value="EXCEL">
						</div>
						
                </div><!-- /.box-header -->
				<?php  
		//$rs=mssql_query("SELECT TOP 1 issue_id FROM new_item_issue1 ORDER BY id DESC");
		$cus=mssql_query("SELECT top 1 tab1.issue_id,tab1.item_code,tab1.location,tab1.date,tab2.thosiba_emp_name,tab2.thosiba_emp_code,tab2.thosiba_emp_department,tab2.head_name,tab2.head_mobile,tab2.head_mail
FROM  [asset].[dbo].[new_item_issue1] tab1 left JOIN [toshiba_clms].[dbo].[thosiba_employee_master]  tab2   
    ON tab1.employee_name = tab2.thosiba_emp_name  ORDER BY tab1.issue_id  DESC");
		while($item1=mssql_fetch_array($cus))
		{
			$da=$item1['date'];
			$da1=date("d-m-Y",strtotime($da));
		?>
				<div id="rav">
				<div style="margin:20px;">
					<img alt=" img" class="user-image" src="/Asset/images/profile/toshiba-logo.png" height="70" width="140">
					<p style="float:right;color:blue;font-size:20px;"> Date	:	<br><?php echo $da1;?></p>
				</div>
               <div id="rs">
			   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
		<thead style="color:#0033FF">
		</thead> 
		
		<tr>
						
						<td>Issue ID</td>
						<td><label><?php echo $item1['issue_id']; ?></label></td>
					<?php if ($item1['thosiba_emp_name']!=''){ ?>
		<td>Employee Name</td><?php }
		else {?><td>Location Name</td><?php } ?>
						<td><label><?php echo $item1['thosiba_emp_name'].$item1['location']; ?> </label></tr><tr>
						
						<td>Employee Code</td>
						<td><label><?php echo $item1['thosiba_emp_code']; ?> </label></td>
						<td>Employee Department</td>
						<td><label><?php echo $item1['thosiba_emp_department']; ?>  </label></td></tr>
					<tr>
						<td>Head Name</td>
						<td><label><?php echo $item1['head_name']; ?></label></td>
						<td>Head Mobile Number</td>
						<td><label><?php echo $item1['head_mobile']; ?></label></td>
					</tr>
					<tr>
						
						<td>Head E-Mail</td>
						<td><label><?php echo $item1['head_mail']; ?></label></td>
					</tr>
			   </table><?php    
		$rs=$item1['issue_id'];
		$rs1=$item1['item_code'];
		}
					?>
			   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
		<thead style="color:#0033FF">
			<tr>	
				<th rowspan="1">#</th>	
				<th rowspan="1">Category Name</th>
				<th rowspan="1">Item Code</th>
				<?php $ravi1=mssql_fetch_array(mssql_query("SELECT name FROM stock_master where item_code='$rs1'"));
		$name1=$ravi1['name'];
		$sss = explode(",",$name1);
		$cntt=count($sss);
		for($r=0;$r<$cntt;$r++)
{?>
		<th rowspan="1"><?php echo $sss[$r]; ?></th>
		<?php }   ?>
		</thead> 
		<?php
		$cus1=mssql_query("SELECT top 1 sm.category_name,sm.item_code,sm.Value FROM new_item_issue1 n join stock_master sm on n.item_code=sm.item_code order by n.id desc");
		$s=1;
		while($item2=mssql_fetch_array($cus1))
		{$Value=$item2['Value'];
		$ssr = explode(",",$Value);
		$cntr=count($ssr);
			
		?>
			<tr>
				<td><?php echo $s; ?></td>
				<td><?php echo $item2['category_name']; ?></td>
				<td><?php echo $item2['item_code']; ?></td>
				<?php for($a=0;$a<$cntr;$a++)
{?>
		<td><?php echo $ssr[$a]; ?></td>
		<?php }   ?>
			</tr>
			
		
			   <?php  $s++;
		}
					?>
			   </table>
			   </div>
			   <div><br><br>
			   <p style="float:left;font-size:20px;margin:10px;">Signature of the Receiver</p>
			   <p style="float:right;font-size:20px;margin:10px;">Signature of the Issuer</p>
			   </div>
			   </div>
			   </div>
				</div> <!-- col 8 close-->
				</div>
			</div>
          </div>
			<script src="/TOSHIBA/js/jquery-1.7.2.js"></script>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
<?php
require ("../../Asset/footer.php");
?> 
	<script src="/Asset/js/jQuery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo URL;?>js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="<?php echo URL;?>js/bootstrap-datetimepicker.pt-BR.js">
    </script>
	
	<script>
		$(document).ready(function(){
      // var r=$("#issue_id").val();
			alert('<?php echo $rs; ?>');
    });
});
		
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
				data: "issue_id=" + r,		 
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
