<?php
require ("../configuration.php");
//$user=$_SESSION['user_name'];
//session_start();
//  if (isset($_SESSION['user'])) {
     // header('Location:/asset/login/lockscreen.php'); 
   // }
?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
	<title>Login Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="../css/font-awesome.css">
	<script src='../js/jquery.min.js'></script>
	<script src='../js/jquery-1.8.2.min.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src="../js/index.js"></script>
	<script type="text/javascript">
	function loginval()
	{
	
		var username=document.getElementById('user_name').value;
		var password=document.getElementById('password').value;
		if (username == null || username == "")
			 {
       				 $('#msg').html('<div style="color:red;margin-bottom:20px;">User Name cannot be blank</div>');
       				 return false;
    		 }
		else if (password == null || password == "")
			 {
       				 $('#msg').html('<div style="color:red;margin-bottom:20px;">Email ID cannot be blank</div>');
       				 return false;
    		 }
		else  if ((password == null || password == "")&&(username == null || username == ""))
			{
					 $('#msg').html('<div style="color:red;margin-bottom:20px;">User Name and Email ID cannot be blank</div>');
       				 return false;
			}
		else
			{
			document.getElementById("loginval").submit();
			}
		
	}
	</script>
 </head>
 <body>
 <div class="form">
      <div id="login">   
          
		  <div class="login-logo">
         <!--<a href="#"><img src="../images/logo.png" /></a>-->
		 <h1><a class="navbar-brand" style="color:#ca9d18;">TOSHIBA - IT ASSET</a></h1>
     	 </div><!-- /.login-logo -->
        
		 
<div id="msg"  style="text-align:center;"></div>
          
          <form method="post" id="loginval" onSubmit="return loginval()"  action="forgetpassvalidation.php" >
          
            <div class="field-wrap">
			 <i class="fa fa-user"></i>
            <label>
              User Name<span class="req">*</span>
            </label>
            <input name="user_name" id="user_name" type="text"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
		   <i class="fa fa-envelope" aria-hidden="true"></i>
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="email_id" id="password" type="email"required autocomplete="off"/>
          </div>          
		  <p class="forgot"><a href="../login/login.php">Login</a></p>
          <button type="submit" class="button button-block" style="background:#ca9d18;">Verify</button>
          
          </form>		
		</div>
        
      </div><!-- tab-content -->
	  <script src="../js/index.js"></script>
	</body>
</html>
<?php
	if(isset($_REQUEST['p']))
	{
		if(isset($_REQUEST['p'])==1)
		{
	?>
	<script type="text/javascript">
		$('#msg').html('<div style="color:red;margin-bottom:20px;">Invalid Email Id</div>');
		
	</script>
	<?php
		}
		
	}
		if(isset($_REQUEST['u']))
	{
		if(isset($_REQUEST['u'])==1)
		{
	?>
	<script type="text/javascript">
		$('#msg').html('<div style="color:red;margin-bottom:20px;">User Doesnot exists</div>');
		
	</script>
	<?php
		}
		
	}
	if(isset($_REQUEST['s']))
	{
		if(isset($_REQUEST['s'])==1)
		{
	?>
	<script type="text/javascript">
		$('#msg').html('<div style="color:red;margin-bottom:20px;"><?php echo $user_name;?>Your Password has been changed and sent to your  Email Id.</div>');
		
	</script>
	<?php
	
   
		}
		
	}
	
?>
