<?php
require ("../configuration.php");
require ("../user.php");
?>
<?php
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ;?></title>
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
				<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
				<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
				<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="skin-blue fixed sidebar-mini">
  <div class="wrapper">
  	<?php
			require ("../header.php");
	?>
    <?php
			require ("../asidemenu.php");
	?>  
	 </div>
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
         <section class="content-header">
          <h1>
           Employee Upload Details
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee Upload</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-md-3">
              <?php
			 $cus=mssql_query("select * from employee_master  order by 1 desc");
			 $cn=mssql_num_rows($cus);
			 ?>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Employee Upload</h3>
                  <div class='box-tools'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li ><a href="#"><i class="fa fa-file-text-o"></i>Employee Upload List<span class="label label-primary pull-right"><?php echo $cn;?></span></a></li>
                 </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              
            </div><!-- /.col -->
			 <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Employee Upload</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <!--<a href='mail_upload.xlsx' target="_blank" style="color:blue;">Mail Templete</a>-->
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
				  <form action="mailupload.php" method="POST" enctype="multipart/form-data">
				  <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
				  <tbody>
        <tr><td>Employee Upload</td><td> <input type="file" name="image"  class="form-control"/></td>
         <tr><td colspan=2><input type="submit" value="Upload" class="btn btn-success"/></td></tr>
				</tbody>
			   </table>	
      </form>
				  </div>
				</div>
			</div>
			</div>
			</div>
			
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 	<?php
			require ("../../TOSHIBA/footer.php");
	?> 
	<script src="/TOSHIBA/js/jQuery-2.1.4.min.js"></script>
    <script src="/TOSHIBA/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/TOSHIBA/js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='/TOSHIBA/js/fastclick.min.js'></script>
    <script src="/TOSHIBA/js/app.min.js" type="text/javascript"></script>
    <script src="/TOSHIBA/js/demo.js" type="text/javascript"></script>
 </body>
</html> 
<?php  
if(isset($_REQUEST['formsent']))
{
	$group_name1=explode(":",$_REQUEST['group_name']);
	$group_code=$group_name1[0];
	$group_name=$group_name1[1];
	$name=$_REQUEST['name'];
	$mail=$_REQUEST['mail'];
	$date=date("Y-m-d");
	
	
	$n=mssql_query("insert into mailgroupupload_master(group_code,group_name,name,mail,status,created_by,created_on) values('$group_code','$group_name','$name','$mail','0','$user','$date')");
	//echo "insert into proofupload_master (proof_name,status,created_by)
	//values ('$proof_name','0','$user')";
	
	if($n)
	{				
		?>
	<script> alert("sucessfully Completed");</script>	 
    <?php
	}	
else
	{
	?>
	<script> alert("Not Completed");</script>	 
    <?php
	}
	?>
	<script> window.location ="../Master/mailgroupupload.php"</script> 
	<?Php
	
}