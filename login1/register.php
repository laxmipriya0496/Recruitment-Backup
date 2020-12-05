<?php
require ("../configuration.php");
require ("../user.php");
?>
<?php
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$user_group=$_SESSION['user_group_code'];

//$_SESSION['menu_id']='';
//$_SESSION['submenu_id']='';
//echo $_SESSION['expire'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ;?></title>
   	<link rel="icon" href="/TOSHIBA/images/favicon.ico" type="image/gif" sizes="16x16"> 
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.css" rel="stylesheet" type="text/css" />
	<!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
	<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/UCO/js/jquery.min.js"></script>
				
<style type="text/css">
.table
{
line-height:0px!important;
letter-spacing:0px!important;
text-transform:uppercase;
/*font-size:10px !important;
*/padding:.5px;
margin-top:0px;
margin-bottom:0px;
}

.col-sm-4 {
    width: 33.3333%;
}
th,td
{
line-height:20px;
}
th
{
color:#0088cc;
}
h3{
	margin-bottom:5px;
}
p {
    margin: 0 0 5px;
}
.list-group {
    padding-left: 0;
    margin-bottom: 5px;
}
.list-group-item {
    padding: 5px 15px;
	border:0;
}
.content-header>h1 {
    margin: 0;
    font-size: 24px;
    text-align: center;
    color: #3C8DBC;
}
.box-footer {
   
    background: none;
    text-align: right;
}
</style>	
<style type="text/css">
.table
{
line-height:0px!important;
letter-spacing:0px!important;
text-transform:uppercase;
/*font-size:10px !important;
*/padding:.5px;
margin-top:0px;
margin-bottom:0px;
}

.col-sm-4 {
    width: 33.3333%;
}
th,td
{
line-height:20px;
}
th
{
color:#0088cc;
}
h3{
	margin-bottom:5px;
}
p {
    margin: 0 0 5px;
}
.list-group {
    padding-left: 0;
    margin-bottom: 5px;
}
.list-group-item {
    padding: 5px 15px;
	border:0;
}
.content-header>h1 {
    margin: 0;
    font-size: 24px;
    text-align: center;
    color: #3C8DBC;
}
</style>			
				
  </head>
  <body class="skin-blue fixed sidebar-mini" style="font-family:'Times New Roman', Times, serif;">
  
			
  <!-- display pop over content here-->
												 <div id="popover" style="height:1px;">
        															<div id="information">
        															</div>
    											</div>
	  <!-- display pop over content close here-->
  
  	 <div class="wrapper">
	 	
	 <?php
			require ("../header.php");
	?>
    <?php
			require ("../asidemenu.php");
	?>  
	
	 </div>
	  <div class="content-wrapper1" >
        <!-- Content Header (Page header) -->
		<?php 
		
		?>
        <section class="content-header">
			<h1>New User Registration</h1>
		<div style="width:50%;margin:0 auto;">
            <form role="form" name="area"  method="post">
                  <div class="box-body">
                   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Full Name</td>
							<td><input type="text" name="full_name" id="full_name" class="form-control" value=""></td>
						</tr>
						<tr>
							<td>User Name</td>
							<td><input type="text" name="user_name" id="user_name" class="form-control" required autocomplete="off"></td>
						</tr>	
						<tr>
							<td>E Mail</td>
							<td><input type="text" name="e_mail" id="e_mail" class="form-control" required autocomplete="off"></td>
						</tr>
						<tr>
							<td>User Group Code</td>
							<td><select name="user_group_code" id="select" class="form-control"  class='chosen-select' required>
							<option value="">Select User Group</option>
				<?php
				$usergroup=mssql_query("select * from user_group_master order by user_group_id");
					while($user_group=mssql_fetch_array($usergroup))
					{
				?>
							<option value="<?php echo $user_group['user_group_code'];?>"><?php echo $user_group['user_group_code']."-".$user_group['user_group_name'];?></option>
				<?php
					}
				?>							
			</select></td>
						</tr>
						<tr>
							<td>Mobile Number</td>
							<td><input type="text" name="mobile_no" id="mobile_no" class="form-control" required autocomplete="off"></td>
						</tr>							
					</table>		
					<div class="box-footer" align="center" style="width: 13%;margin: 0 auto;">
						<input type="submit" class="btn btn-primary" value="Create User" name="submit">
					  </div>					
					  </div><!-- /.box-body -->
					
					 
					  <input type="hidden" name="formsent">
                </form></div>
			
				 <?php 
		
			 ?><p style="font-size:25px;color:blue;" align="center"><b>Users</b></p><table class="table table-hover">
		  <tr><th>S.No</th>
		  	<th>Employee Name</th>
		  	<th>User Name</th>
			<th>User Group Code</th>
			<th>Status</th>
			<th>Edit </th>
		</tr>	
			
         <?php 
		 $sql="select * from user_master";
		 $query=mssql_query($sql);
		 $s=1;
		 while($row=mssql_fetch_array($query))
		 {$sta=$row['status'];
	 if($sta==0)
	 {
		 $ss="Active";
	 }
	 elseif($sta==1)
	 {
		 $ss="Inactive";
	 }
		 ?>
		<tr> <td><?php echo $s++; ?></td>
				<td><?php echo $row['full_name']; ?></td>
				<td><?php echo $row['user_name']; ?></td>
				<td><?php echo $row['user_group_code']; ?></td>
				<td><?php echo $ss; ?></td> 
				<td><div style=" white-space: nowrap;"><a href="edit_usermaster.php?user_id=<?php echo $row['user_id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil icon-white"></i></a></div></td> 
				</tr>
		 <?php	
		 }
		 ?>
		 </table>
				
				
        </section><!-- /.content -->
		
      </div><!-- /.content-wrapper -->
 	<?php
			require ("../footer.php");
			
	?> 
	<script src="/TOSHIBA/js/jQuery-2.1.4.min.js"></script>
    
	<!-- pop up script src start here-->
	<script type="text/javascript" src="../JQPOPUP/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../JQPOPUP/jqxcore.js"></script>
    <script type="text/javascript" src="../JQPOPUP/jqxpopover.js"></script>
    <script type="text/javascript" src="../JQPOPUP/jqxbuttons.js"></script>
	<!-- pop up script src close here-->
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='../js/fastclick.min.js'></script>
    <script src="../js/app.min.js" type="text/javascript"></script>
    <script src="../js/demo.js" type="text/javascript"></script>
	

 </body>
</html>
<?php
if(isset($_POST['formsent']))  
{  
	$full_name=$_POST["full_name"];
	$user_name=$_POST["user_name"];
	
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 10; $i++) 
	{
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	$mailpassword=implode($pass); //turn the array into a string
	$password=md5 ($mailpassword);
	
	$user_group_code=$_POST["user_group_code"];
	$e_mail=$_POST["e_mail"];
	$mobile_no=$_POST["mobile_no"];
	/*$active1 = isset($_POST['active1']) ? 1 : 0;*/
	$date=date("Y-m-d h:i:s");	
	
	$n=mssql_query("insert into user_master (full_name,user_name,password,email_id,user_group_code,mobile_no,status,created_by,created_on) values ('$full_name','$user_name','$password','$e_mail','$user_group_code','$mobile_no','0','$user','$date')");	
	
	$n1=mssql_fetch_array(mssql_query("select top 1 user_id from user_master order by user_id desc"));	
	$user_id=$n1["user_id"];
	
	if($user_group_code=="BB-002")
	{
		
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','6','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','7','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','8','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','9','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','10','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','11','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','33','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','34','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','3','12','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','3','13','$user','$date')");
		
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','3','15','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','16','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','17','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','31','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','32','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','18','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','19','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','20','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','21','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','22','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','23','$user','$date')");
		
		
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','7','30','$user','$date')");
	}
	
	elseif($user_group_code=="BB-003")
	{
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','1','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','2','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','3','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','4','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','5','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','35','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','36','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','37','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','1','38','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','6','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','7','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','8','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','9','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','10','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','11','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','33','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','2','34','$user','$date')");	
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','3','12','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','3','13','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','3','14','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','3','15','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','16','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','17','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','31','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','4','32','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','18','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','19','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','20','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','21','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','22','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','5','23','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','6','24','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','6','25','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','6','26','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','6','27','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','7','29','$user','$date')");
		mssql_query("insert into menu_access_right (user_id,menu_id,submenu_id,created_by,created_on) values ('$user_id','7','30','$user','$date')");
	}
	else
	{
		
	}
	
	date_default_timezone_set('Etc/UTC');
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
$mail->setFrom('sathish.chandersekar@toshiba-tjps.in');
//Set an alternative reply-to address
$mail->addReplyTo('sathish.chandersekar@toshiba-tjps.in');
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
$mail->Body    = 'Respected '.$full_name.' San,<br><h1>IT Asset Login Details</h1><br>IP :
http://172.16.2.129:8081/Asset/<br>
Your User Name is :<b>'.$user_name.'</b><br>Your Password is :<b>'.$mailpassword.'</b><br>

Please Change your Password after the login.
<br><br><br>Regrads,<br>Admin Team,<br>Toshiba-Chennai<br>';
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
   // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}
	
	//echo "insert into user_master (full_name,user_name,password,email_id,user_group_code,mobile_no,created_by,created_date) values ('$full_name','$user_name','$password','$e_mail','$user_group_code','$mobile_no','$username','$date')";
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
	<script>window.location ="../login/register.php"</script> 
	<?Php	
}  
?>  