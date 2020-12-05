<?php
require ("../configuration.php");
require ("../user.php");

date_default_timezone_set("Asia/Kolkata");
$curdate=date("d-m-y");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
//$_SESSION['menu_id']=$_REQUEST['menu_id'];
//$_SESSION['submenu_id']=$_REQUEST['sub_menu'];
//$menu_id=$_SESSION['menu_id'];
//$submenu_id=$_SESSION['submenu_id'];
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
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.all.min.js"></script>
	
	 <script src="js/canvasjs.min.js"></script>
  <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript" src="../script.js"></script>
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
  	 <div class="wrapper">
	 <?php
			require ("../header.php");
	?>
	 </div>
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <h1>
          STATE OF ORIGIN DETAILS
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
				<div class="col-xs-12">
				<div id="printableArea">
				<div id="divTableDataHolder">
			<div id="chartContainer"></div>
				<table cellpadding="0" cellspacing="0" border="0" class="sortable table table-bordered table-hover" id="sorter">
							<tr style="color: #253aaf;background: #eee;">	
							<th>#</th>
							<th>STATE</th>
							<th>TOTAL</th>
							</tr>	
					<?php
					$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));
	
	if($dep!="All")
	{
		$dt="where Department in ('$dep')";
	}
	else
	{
		$dt="";
	}
	
					
				$inndate1=mssql_query("select State_of_Origin,COUNT(State_of_Origin) as tot from employee_master $dt
group by State_of_Origin order by State_of_Origin");
$s=1;
		while($c=mssql_fetch_array($inndate1))
		{
				?>
							<tr>		
							<td><?php echo $s++;?></td>
				<td><?php echo $c['State_of_Origin']; ?></td>
				<td>
				<a href="statedetails.php?state=<?php echo $c['State_of_Origin']; ?>" target="_blank"><?php echo $c['tot']; ?></a></td>
							</tr>
						<?php
			   }
			   ?>
								<?php
								$state=mssql_query("select State_of_Origin,count(State_of_Origin) as tot from employee_master $dt group by State_of_Origin");
								$dataPoints1='';
								$count=mssql_num_rows($state);
								$i=1;
								while($state_res=mssql_fetch_array($state)){	
								$dataPoints1.='{"y":'.$state_res['tot'].',"name":"'.$state_res['State_of_Origin'].'"}';
								if($i<$count){
								$dataPoints1.=',';
								}$i++;
								}
								$dataPoints = "[".$dataPoints1 ."]"; 
								//Correct Format: [{"y":1,"name":"Andhra","y":3,"name":"Tamil Nadu"}] 
								$title='STATE OF ORIGIN GRAPH';	       
								?>   
								<script type="text/javascript">
            $(function () {
                var chart = new CanvasJS.Chart("chartContainer",
                {
                    theme: "theme",
                    title:{
                        text: "<?php echo $title; ?>"
                    },
                    exportFileName: "<?php echo $title; ?>",
                    exportEnabled: true,
                    animationEnabled: true,	
					data: [
                    {       
                        type: "pie",
						click: onClick,
                        showInLegend: true,
                        toolTipContent: "{name}: <strong>{y}</strong>",
                        indexLabel: "{name} {y}",
                        dataPoints: <?php echo $dataPoints; ?>
                    }]
                });
                chart.render();
				function onClick(e) {
		window.open("statedetails.php?state=" + e.dataPoint.name, '_blank');
	}
            });
        </script>
				</table>
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
<link href="<?php echo URL;?>css/stylesheet.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/MonthPicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL;?>css/examples.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo URL;?>js/jquery-ui.min.js"></script>
    <script src="<?php echo URL;?>js/jquery.maskedinput.min.js"></script>
	<script src="<?php echo URL;?>js/MonthPicker.min.js"></script>
    <script src="<?php echo URL;?>js/examples.js"></script>
 </body>
</html>