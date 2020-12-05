<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>MRF</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome-animation.css">
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo URL;?>js/jquery.min.js"></script>
<script src="js/sweet-alert.js"></script>
<link rel="stylesheet" href="css/sweet-alert.css" />
</head>
<body>
	<?php
		require ("../header.php");
	?>
<div class="wrapper" style=" width: 90%; margin:0 auto;">
	<div class="row">
		<div class="col-md-6" style="margin-top:10%;">
		<div class="box" style="border-top: 3px solid #0f40a2;">
           <form role="form" name="area"  method="post"  style="margin-bottom:50px;">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;">
						<tr>
							<td>Old Password</td>
							<td><input type="password" class="form-control" name="old_password" id="old_password" onchange="old(this.value,this.id)" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" class="form-control" name="password" id="password" onchange="pass(this.value,this.id)" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>Re Enter Password</td>
							<td><input type="password" class="form-control" name="password1" id="password1" onChange="checkpass(this.value,this.id)"  autocomplete="off" required></td>
						</tr>
					</table>					   
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					  </div>
					  <div class="alert alert-danger">Note : <ul><li>1) Your password must be 8 to 16 characters.</li>
							<li>2) It must contain one Uppercase and Lowercase Alphabets.</li>
							<li>3) It must also contain numbers and any one special characters ( @ _ ! . , $ )</li></div>
					  <input type="hidden" name="formsent">
                </form>
				</div>
		</div>
	</div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>

<script>
function old(pass,s)
{
	$.ajax
	({
		type: "GET",
		url: "check_pass.php",
		data: "old_pass=" + pass,		 
		success: function(data)
		{
			if(data=="no")
			{
				alert("Old Password Is incorrect");
				$("#"+s).val("");
			}
		}
	});
}
</script>
<script>
function pass(pass,s)
{
 var password_regex1=/([A-Z].*[a-z])|([A-Z].*[a-z])([0-9])+([!,%,&,@,#,$,^,*,?,_,~])/;
 var password_regex2=/([0-9])/;
 var password_regex3=/([!,%,&,@,#,$,^,*,?,_,~])/;

 if(pass.length<8 || password_regex1.test(pass)==false || password_regex2.test(pass)==false || password_regex3.test(pass)==false)
 {
  alert("Please Enter Strong Password");
  $("#"+s).val("");
  return false;
 }
 else
 {
  return true;
 }
}
</script>
<script type="text/javascript">
		function checkpass(x,y)
		{
			var newpass=$("#password").val();
			//alert(newpass);
			if(newpass!=x)
			{
				alert("Passwords Not Match");
				$("#"+y).val("");
			}
		}
   
</script>

<?php

if(isset($_POST['formsent']))  
{  
	$password1=$_POST["password1"];
	$date=date("Y-m-d h:i:s");	
	$password=md5 ($password1);
		
	$n=mssql_query("update user_master set password='$password',modified_by='$user',modified_on='$date' where user_id='$user'");	

if($n)
	{?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
           window.location = "change_password.php";
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
           window.location = "change_password.php";
        });
    }, 100);
</script> 	 
    <?php
	}	
}  
?>  