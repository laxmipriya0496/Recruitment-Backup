<?php
require ("../configuration.php");
require ("../user.php");
?>
<?php
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$menu_id=$_SESSION['menu_id'];
$submenu_id=$_SESSION['submenu_id'];
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
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo URL;?>css/bootstrap-datetimepicker.min.css">

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
          <!--<h1>
           <?php echo TITLE;?>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
		  <?php
		  	if(isset($_REQUEST['msg']))
				{	
					$msg=$_REQUEST['msg'];
					if($msg==13)
					{
					?>
					<script>
						alert("Please Try Again");
					</script>
					<?php
					}
					else
					{
					?>
					<script>
						alert("Sucess");
					</script>
					<?php
					}
				}
		  ?>
			<div class="box">
				 <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
				<div style="width:35%;border:1px solid #000;border-width: 4px 30px 4px 30px;border-color: #56c6d9 #56c6d9 #fe2192 #fe2192;border-radius: 0 120px 0 120px; -moz-border-radius: 0 120px 0 120px;-webkit-border-radius: 0 120px 0 120px;padding:50px;margin:70px auto;">
			<div class="col-md-5" height="100" width="20" style="width:100%">
					<form  action="outvalidate.php" onSubmit="return validateForm()" name="myForm" autocomplete="off">
					<div class="barcode_logo" style="width: 100%;text-align: center;"><img src="../images/profile/toshiba.png"/></div>
						<h4 style="text-align:center;">Vehicle Out </h4>
						<input type="password" name="pass_no" autofocus="autofocus" placeholder="" id="pass_no" style="width: 100%;text-align:center;" onChange="outvalidate(this.value)"/>
					</form>
			</div>
			<div class="box-body"></div>

			</div><!-- /.box-body -->
				<div class="box-footer">
				</div><!-- /.box-footer-->
			</div><!-- /.box -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
 	<?php
			require ("../../COMMUTATION/footer.php");
	?> 
	<script src="/COMMUTATION/js/jQuery-2.1.4.min.js"></script>
    <script src="/COMMUTATION/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/COMMUTATION/js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='/COMMUTATION/js/fastclick.min.js'></script>
    <script src="/COMMUTATION/js/app.min.js" type="text/javascript"></script>
    <script src="/COMMUTATION/js/demo.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo URL;?>js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="<?php echo URL;?>js/bootstrap-datetimepicker.pt-BR.js">
    </script>
	
 </body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('body').click(function(){
		$('#empcode').focus();	
	});
	$('#empcode').focus();	
	$('body').append('<div id="mask"></div>');
	//$('mask').fadein(300);
	$('#empcode').show();
  $(".clocker").click(function(){
    $(".foot").slideUp(2000);
  });
});
</script>
<script>
function validateForm() {
    var x = document.forms["myForm"]["empcode"].value;
    if (x == null || x == "") {
		alert("Enter valid employee code");
        return false;
    }
}
</script>
<!--<script>
  function employeedetails(v)
  {
 
  $.get("/COMMUTATION/Barcode/employeedetails.php?empcode="+v, function(data) {
			$('.box-body').html(data);
  		});
  }	
  </script>	-->