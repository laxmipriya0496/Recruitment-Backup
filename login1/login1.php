<?php
require ("../configuration.php");
session_start();
  if (isset($_SESSION['user'])) {
      //header('Location:/asset/login/login.php'); 
    }
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <script src='js/jquery.min.js'></script>
  <script src='js/jquery-1.8.2.min.js'></script>
  <script src='js/bootstrap.min.js'></script>
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
       				 $('#msg').html('<div style="color:red;margin-bottom:20px;">Password cannot be blank</div>');
       				 return false;
    		 }
		else  if ((password == null || password == "")&&(username == null || username == ""))
			{
					 $('#msg').html('<div style="color:red;margin-bottom:20px;">User Name and Password cannot be blank</div>');
       				 return false;
			}
		else
			{
			document.getElementById("loginval").submit();
			}
		
	}
	</script>
<style>
.login-logo {
    text-align: center;
	margin-bottom: 20px;
}
</style>
  
</head>

<body>
  <div class="form">
      <div id="login">   
          
		  <div class="login-logo">
         <!--<a href="#"><img src="../images/logo.png" /></a>-->
		 <h1><a class="navbar-brand" href="#">Document</a></h1>
     	 </div><!-- /.login-logo -->
		 
		<div id="msg"  style="text-align:center;"></div>
          
          <form method="post" id="loginval" onSubmit="return loginval()"  action="loginval.php" >
          
            <div class="field-wrap">
			 <i class="fa fa-user"></i>
            <label>
              User Name<span class="req">*</span>
            </label>
            <input name="user_name" id="user_name" type="text"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
		   <i class="fa fa-key"></i>
            <label>
              Password<span class="req">*</span>
            </label>
            <input name="password" id="password" type="password"required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="../login/forgetpassword.php">Forgot Password?</a></p>
          
          <button class="button button-block">Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
	<script src="js/index.js"></script>
	

</body>
<?php
	if(isset($_REQUEST['p']))
	{
		if(isset($_REQUEST['p'])==1)
		{
	?>
	<script type="text/javascript">
		$('#msg').html('<div style="color:red;margin-bottom:20px;">Invalid Password</div>');
		
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
	?>
</html>
