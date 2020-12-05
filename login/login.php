<?php
require ("../configuration.php");
//require ("ipconfig.php");
session_start();
  if (isset($_SESSION['user'])) {
     header('Location:../Menu/index.php'); 
    }
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Digitization Login Form</title>
  <link rel="stylesheet" href="../css/reset.min.css">
  <link rel='stylesheet prefetch' href='../css/css.css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='../css/font-awesome.min.css'>
      <link rel="stylesheet" href="css/style.css">
</head>
<style>
h1.title {
    font-size: 20px!important;
}
</style>
<body>
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
<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Digitization Login Form</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Employee Login</h1>
	<div id="msg"  style="text-align:center;"></div>
    <form method="post" id="loginval" onSubmit="return loginval()"  action="loginval.php" >
      <div class="input-container">
        <input type="#{type}" id="#{label}"  name="user_name" required="required" autocomplete="off"/>
        <label for="#{label}">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="#{label}" name="password" required="required" autocomplete="off"/>
        <label for="#{label}">Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span>Go</span></button>
      </div>
    </form>
  </div>
  <div class="card alt">
    <div class="toggle"> </div><div style="float:right;margin-right: -185%;margin-top: -70%; color:#1860d0;"><h3>&#9668 Click Here for Temporary Users</h3></div>
    <h1 class="title">Temporary User Login
      <div class="close"></div>
    </h1>
    <form method="post" id="loginval" onSubmit="return loginval()"  action="temploginval.php" >
      <div class="input-container">
        <input type="#{type}" id="#{label}" name="user_name" required="required" autocomplete="off"/>
        <label for="#{label}">User name</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="#{label}" name="password" required="required" autocomplete="off"/>
        <label for="#{label}">Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span>Next</span></button>
      </div>
    </form>
  </div>
</div>
  <script src='../js/jquery.min.js'></script>
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
		$u=$_REQUEST['u'];
		
		if($u==1)
		{
	?>
	<script type="text/javascript">
		$('#msg').html('<div style="color:red;margin-bottom:20px;">User Doesnot exists</div>');
		
	</script>
	<?php
		}
		if($u==3)
		{
	?>
	<script type="text/javascript">
		$('#msg').html('<div style="color:red;margin-bottom:20px;">Your Account Has been expired</div>');
		
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
	
 <script>
 $('html').bind('keypress', function(e)
{
   if(e.keyCode == 13)
   {
      return false;
   }
});
</script>
</html>
