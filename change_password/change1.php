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
         <!-- <h1>
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
		 
		 	<div class="col-md-12" style="padding-right: 1px;padding-left: 0px;">
			<div class="box box-primary" style="width:100%">
				<form class="form-horizontal">
			
					<div class="form-group" style="margin: 20px 0px 0px 0px;">
						<table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Old Password</td>
							<td><input type="text" class="form-control" id="oldpassword" name="oldpassword" onChange="oldPass(this.value)" required></td>
						</tr>
						<tr>
							<td>New Password</td>
							<td><input type="text" class="form-control" id="newpassword" name="newpassword" onChange=""></td>
						</tr>
						<tr>
							<td>Re-Enter New Password</td>
							<td><input type="text" class="form-control" id="password" name="password" onChange="checkpass(this.value)"></td>
						</tr>
						<tr>
						<td><button type="button" class="btn btn-info pull-right" style="float: left!important;" onClick="getrav()">Change Password</button></td>
						</tr>
						</table>
							<div class="alert alert-danger">Note : <ul><li>Your password must be 8 to 16 characters.</li>
							<li>It must contain one Uppercase and Lowercase Alphabets.</li>
							<li>It must also contain numbers and any one special characters ( @ _ ! . , $ )</li></div>
					    <span id="result"></span>
                    </div>
                    <!--<div class="box-footer" style="border-top:none;">
                    <input type="hidden" name="msentPass3">
					</div><!--->
                    </div>
					<?php echo $user; ?>
				</form>
				
				<!--<div class="ouput-data" id="outputdata" style='overflow:auto; width:900px;height:400px;'>
				</div>-->
		</div>

		 

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
 	<?php
			require ("../../COMMUTATION/footer.php");
	?>
	
	<script type="text/javascript">
		function oldPass(x)
		{
			//var md5 = $.md5('x');
			//alert(md5); 
			$.ajax({ 
        type: "GET",
        url:'check.php?nop='+x,
		
        success: function(data)
		{
			
			if(data!='')
			{
				$("#oldpassword").val("");
				alert(data);
			}
			
        }
    });
		}
   
</script>

<script type="text/javascript">
		function checkpass(x)
		{
			var newpass=$("#newpassword").val();
			//alert(newpass);
			if(newpass!=x)
			{
				alert("Passwords Not Match");
			}
		}
   
</script>

<script>
function newpass()
{
//alert("test");
var password=document.getElementById('newpassword').value;
//var regularExpression  =^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$;
var minNumberofChars = 8;
    var maxNumberofChars = 16;
    var regularExpression  = /^[a-zA-Z0-9!@#$%^&*]{8,16}$/;
//alert(password); 
    if(!regularExpression.test(password)) {
        alert("password should contain atleast one number and one special character");
       // return false;
    }
    if(password.length < minNumberofChars || password.length > maxNumberofChars){
       // return false;
	   alert("password should contain atleast 8 charcters");
    }
     if(!regularExpression.test(password)) {
        alert("password should contain atleast one number and one special character");
       // return false;
    }
//if(password==^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$)
//{
//alert("sucess");
//}
//else{
//alert("Fail");
//}
}
</script>


<script> 
function getrav()
{
//alert (r);
//$("#employee_name").attr('readonly', 'true');
var pass=$("#password").val();

//alert(pass);
$.ajax
({
type: "GET",
url: "getdata.php",
data: "name=" + pass,
success: function(data)
{
//$('#rav13').html(data);
alert(data);

   }
});
}
</script>




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
