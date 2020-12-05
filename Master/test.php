<?php
require ("../configuration.php");
require ("../user.php");
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
										<option value="All">All</option>
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
  
 										 </select></td>
										 <td><input type="button" value="Get Graduation" onclick="show()" class="btn btn-primary"/></td>
										 </tr>
                      </tbody>
                    </table><!-- /.table -->
					 </form>

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
</body>
</html>