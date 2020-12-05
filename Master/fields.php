<?php
require ("../configuration.php");
require ("../user.php");
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
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/w3.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>menu/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.min.js"></script>
<script src="js/sweet-alert.js"></script>
<link rel="stylesheet" href="css/sweet-alert.css" />
<style>
#div1,#column_div {
        width: 25%;
    height: 489px;
    padding: 10px;
    border: 1px solid #aaaaaa;
}
.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #fff;
    border-bottom: 1px solid #333;
    box-shadow: 2px 1px 2px 1px rgba(51, 51, 51, 0.42);
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    vertical-align: middle!important;
}
.box{
	margin-bottom:40px!important;
}
</style>
<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("Text", ev.target.id);
}

function drop(ev) {
    var data = ev.dataTransfer.getData("Text");
    ev.target.appendChild(document.getElementById(data));
    ev.preventDefault();
}
</script>
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
          Dynamic Reports
          </h1>
          <ol class="breadcrumb">
            <li><a href="../Menu/index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Dynamic Reports</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="row">
            
			 <div class="col-md-12">
              <div class="box box-primary">
               
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
				  <form role="form" name="area"  method="post">
                  <div class="box-body">
                    <div class="form-group">
                     
						<tr>
                    </div>
					<div id="column_div" name="column_div" class="col-md-3" style="border:2px solid black;" ondrop="drop(event)" ondragover="allowDrop(event)">
					
					<table class="table table-hover table-striped" id="tb" name="tb">
			<?php	
$toshiba_employee_res=mssql_query("select * from field_mapping");
						$field_name=$toshiba_employee_res['field_name'];
						$i=1;
while($user_group=mssql_fetch_array($toshiba_employee_res))
					{ 
				$tbl="";
						$r=$tbl.$i;
						//$a="rs".$i;
		echo '<tr id="'.$i.'" draggable="true" ondragstart="drag(event)" style="font-size: 10px;" ><td>'.$user_group['field_name'].'</td></tr>';
					$i++; }
			?></table>
					
					</div>
					
					<div id="div1" class="col-md-5" ondrop="drop(event)" ondragover="allowDrop(event)" style="border:2px solid black;margin-left:125px;"><table class="table table-hover table-striped" id="tb1" name="tb1"></table></div>
					<input type="button" class="btn btn-primary" value="Submit" name="submit" onclick="rs()">
				  <input type="hidden" name="formsent">
                </form>
			
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
	<script src="<?php echo URL;?>js/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo URL;?>js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL;?>js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='<?php echo URL;?>js/fastclick.min.js'></script>
    <script src="<?php echo URL;?>js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo URL;?>js/demo.js" type="text/javascript"></script>
	
 </body>
</html> 
<?php  
if(isset($_REQUEST['formsent']))
{
	$role_name=$_REQUEST['role_name'];
	//$user_name=$_REQUEST['user_name'];
	$user_name1=explode(":",$_REQUEST['user_name']);
 $user_name=$user_name1[0];

	$detail=mssql_query("insert into role_mapping (code,user_id,status,created_by)
	values ('$role_name','$user_name','0','1')");
	if($detail)
	{?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "../role/dynamicreports.php";
        });
    }, 100);
</script> 
    <?php
	}	
	else
	{
	?><script>
    setTimeout(function() {
        swal({
            title: "Not",
            text: "Completed!",
            type: "error"
        }, function() {
            window.location = "../role/dynamicreports.php";
        });
    }, 100);
</script> 	 
    <?php
	}
}
?>
<script>
function rs()
{
	var rowCount = $(".table tr").not(":has(th)").length;
	var allDivTd = document.getElementById("column_div").getElementsByTagName("TD");
	for(var i = 0; i < allDivTd.length; i++)
	{
		var td = allDivTd[i];
		var rs = td.innerHTML;
		$.ajax
		({
			type: "GET",
			url: "field_con.php",
			data: "fields=" + rs ,		 
			success: function(data)
			{
				//$('#department').html(data);
			}
		});
	} 
}
</script>