<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=$_REQUEST['id'];
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
  <link rel="stylesheet" href="<?php echo URL;?>css/navcss.css"> 
	<script src="<?php echo URL;?>js/jquery.min.js"></script>
<script src="js/sweet-alert.js"></script>
<link rel="stylesheet" href="css/sweet-alert.css" />
</head>
<body>
	<?php
		require ("../header.php");
	?>
<div class="wrapper" style=" width: 97%; margin:0 auto;">
	<div class="row">
		<div class="col-md-12" style="margin-top:5%;">
		<div>
	<ul class="block-menu">
		<li><a href="register_master.php" class="three-d">Register
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Register</span>
				<span class="back" style="background-color:#3db2e1;">Register</span>
			</span></a>
		</li>
		<li><a href="role_master.php" class="three-d">Role Master
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Role Master</span>
				<span class="back" style="background-color:#3db2e1;">Role Master</span>
			</span>
		</a></li>
		<li><a href="role_mapping.php" class="three-d">Role Mapping
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Role Mapping</span>
				<span class="back" style="background-color:#3db2e1;">Role Mapping</span>
			</span>
		</a></li>
		<li><a href="temp_register_master.php" class="three-d">Temporary User Register
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Temporary User Register</span>
				<span class="back" style="background-color:#3db2e1;">Temporary User Register</span>
			</span>
		</a></li>
		<li><a href="search_configure.php" class="three-d">Search Configuration
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Search Configuration</span>
				<span class="back" style="background-color:#3db2e1;">Search Configuration</span>
			</span>
		</a></li>
		<li><a href="field_configure.php" class="three-d">Field Configuration
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Field Configuration</span>
				<span class="back" style="background-color:#3db2e1;">Field Configuration</span>
			</span>
		</a></li>
		<li><a href="mac_config.php" class="three-d">MAC Configuration
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">MAC Configuration</span>
				<span class="back" style="background-color:#3db2e1;">MAC Configuration</span>
			</span>
		</a></li>
<!-- more items here -->
	</ul>
</div>
<?php
	$reg=mssql_fetch_array(mssql_query("select * from temp_user_master where user_id='$id'"));
?>
		</div>
		<div class="col-md-4" style="margin-bottom:50px;">
		 <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Full Name</td>
							<td><input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo $reg['full_name']; ?>" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>User Name</td>
							<td><input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $reg['user_name']; ?>" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>Mobile Number</td>
							<td><input type="text" class="form-control" name="mobile_no" id="mobile_no" value="<?php echo $reg['mobile_no']; ?>"onchange="mobile(this.value,this.id)" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>E-Mail</td>
							<td><input type="text" class="form-control" name="e_mail" id="e_mail" value="<?php echo $reg['email_id']; ?>" onchange="email(this.value,this.id)" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>Re Enter E-Mail</td>
							<td><input type="password" class="form-control" name="e_mail1" id="e_mail1" onchange="checkemail(this.value,this.id)" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" class="form-control" name="password" id="password" onchange="pass(this.value,this.id)" autocomplete="off" required></td>
						</tr>
						<tr>
							<td>Re Enter Password</td>
							<td><input type="password" class="form-control" name="password1" id="password1" onChange="checkpass(this.value,this.id)"  autocomplete="off" required></td>
						</tr>
						<tr>
							<td>From Date</td>
							<td><input type="text" class="add-on form-control" id="from_date" name="from_date" placeholder="From Date" value="<?php echo $reg['from_date']; ?>"required></td>
						</tr>
						<tr>
							<td>To Date</td>
							<td><input type="text" class="add-on form-control" id="to_date" name="to_date" placeholder="To Date" value="<?php echo $reg['to_date']; ?>"required></td>
						</tr>
						<tr>
							<td>Total Numbers</td>
							<td><input type="number" class="form-control" name="number" id="number" value="<?php echo $reg['nos']; ?>" required></td>
						</tr>
						<tr>
							<td>Status</td>
							<?php if($reg['status']==0)
							{
								?>
								<td> 
								<input type="radio" name="status" id="status" value="0" checked>&emsp;Active&emsp;
								<input type="radio" name="status" id="status" value="1" >&emsp;Inactive
								</td>
								<?php
							}
							else
							{
								?>
								<td> 
								<input type="radio" name="status" id="status" value="0" >&emsp;Active&emsp;
								<input type="radio" name="status" id="status" value="1" checked>&emsp;Inactive
								</td>
								<?php
							}
							?>
						</tr>
					</table>					   
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					  </div>
					  <div class="alert alert-danger">Note : <ul><li>1) Your password must be 8 to 16 characters.</li>
							<li>2) It must contain one Uppercase in Middle and Lowercase Alphabets.</li>
							<li>3) It must also contain numbers and any one special characters ( @ _ ! . , $ )</li></div>
					  <input type="hidden" name="formsent">
                </form>
		</div>
		
			<div class="col-md-8" style="margin-bottom:50px;">
			<form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;margin-bottom:50px;">
						<tr style="color:blue;">
							<th>Full Name</th>
							<th>User Name</th>
							<th>Mobile Number</th>
							<th>E-Mail</th>
							<th>From Date</th>
							<th>To Date</th>
							<th>Total Numbers</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>
						<?php $uni=mssql_query("select *,case when (status=0) then 'Active' else 'Inactive' end as sta from temp_user_master order by user_id asc");
					while($row=mssql_fetch_array($uni))
					{
				?>
						<tr>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $row['user_name']; ?></td>
						<td><?php echo $row['mobile_no']; ?></td>
						<td><?php echo $row['email_id']; ?></td>
						<td><?php echo date("d-m-Y",strtotime($row['from_date'])); ?></td>
						<td><?php echo date("d-m-Y",strtotime($row['to_date'])); ?></td>
						<td><?php echo $row['nos']; ?></td>
						<td><?php echo $row['sta']; ?></td>
						<td  align="center"><div style=" white-space: nowrap;"><a href="temp_register_masteredit.php?id=<?php echo $row['user_id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
						</tr>	
				<?php
					}
					?>
					</table>					   
					  </div><!-- /.box-body -->
                </form>
			</div>
	</div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>
<script>
function email(email,s)
{
 var email_regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

 if(email_regex.test(email)==false)
 {
  alert("Please Enter Correct Email");
  $("#"+s).val("");
  return false;	
 }
}
</script>
<script>
function pass(pass,s)
{
 
 var password_regex1=/([a-z].*[A-Z])|([A-Z].*[a-z])([0-9])+([!,%,&,@,#,$,^,*,?,_,~])/;
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
<script>
function mobile(phoneNumber,s)
{
	
	var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;

	if (filter.test(phoneNumber)) {
	  if(phoneNumber.length==10){
		   var validate = true;
	  } else {
		  alert('Please put 10  digit mobile number');
		  var validate = false;
		  $("#"+s).val("");
	  }
	}
	else {
	  alert('Not a valid number');
	  var validate = false;
	  $("#"+s).val("");
	}

}
</script>
<script type="text/javascript">
		function checkemail(x,y)
		{
			var newpass=$("#e_mail").val();
			//alert(newpass);
			if(newpass!=x)
			{
				alert("E-Mail Not Match");
				$("#"+y).val("");
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
<link rel="stylesheet" href="css/kendo.common-material.min.css" />
    <link rel="stylesheet" href="css/kendo.material.min.css" />
    <script src="js/kendo.all.min.js"></script>
	<script>
	$(document).ready(function() {
		// create DatePicker from input HTML element
		$("#from_date").kendoDatePicker({
		format: "dd-MM-yyyy"
		});
	});	
	$(document).ready(function() {
		// create DatePicker from input HTML element
		$("#to_date").kendoDatePicker({
		format: "dd-MM-yyyy"
		});
	});	
	</script>
<?php

if(isset($_POST['formsent']))  
{  
	$full_name=$_POST["full_name"];
	$user_name=$_POST["user_name"];
	$password1=$_POST["password1"];
	$e_mail=$_POST["e_mail1"];
	$mobile_no=$_POST["mobile_no"];
	$status=$_POST["status"];
	$from_date=date("Y-m-d",strtotime($_POST["from_date"]));
	$to_date=date("Y-m-d",strtotime($_POST["to_date"]));
	$number=$_POST["number"];
	$date=date("Y-m-d h:i:s");	
	$password=md5 ($password1);
	
	$n=mssql_query("update temp_user_master set full_name='$full_name',user_name='$user_name',password='$password',email_id='$e_mail',mobile_no='$mobile_no',status='$status',from_date='$from_date',nos='$number',to_date='$to_date',modified_by='$user',modified_on='$date' where user_id='$id'");	
	
	
/* date_default_timezone_set('Etc/UTC');
require '../phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "smail.sys.toshiba.co.jp";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = false;
//$mail->SMTPDebug = false;
//Set who the message is to be sent from
$mail->setFrom('Sridhar.raju@toshiba-tjps.in');
//Set an alternative reply-to address
$mail->addReplyTo('Sridhar.raju@toshiba-tjps.in');
//Set who the message is to be sent to
$mail->addAddress($e_mail);
//$mail->addAddress('ravi@bluebase.in');
//$mail->addCC($ccmail);
//$mail->addCC('vikraman@bluebase.in');
$mail->isHTML(true);
//Set the subject line
$mail->Subject = 'New Registration';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->Body    = 'Respected Sir/Madam,<br><h1>CLMS Login Details</h1><br>IP :
http://172.16.2.129:8081/COMMUTATION/ <br>
Your User Name is :<b>'.$user_name.'</b><br>Your Password is :<b>'.$mailpassword.'</b><br>

Please Change your Password after the login.
<br><br><br>Regrads,<br>Admin Team,<br>COMMUTATION-Chennai<br>';
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
   // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
} */
if($n)
	{?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
         window.location = "temp_register_master.php";
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
           window.location = "temp_register_master.php";
        });
    }, 100);
</script> 	 
    <?php
	}	
}  
?>  