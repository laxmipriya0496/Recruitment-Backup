<?php
require ("../configuration.php");
session_start();
  if (isset($_SESSION['user'])) {
      //header('Location:/asset/login/lockscreen.php'); 
    }
			$user_name=$_REQUEST['user_name'];
			//$full_name=$_REQUEST['full_name'];
			$email_id=$_REQUEST['email_id'];
			$usermaster=mssql_query("select email_id,full_name from user_master where user_name='$user_name'");
			//echo "select user_id,password from user_master where user_name='$user_name'";
			$ucount=mssql_num_rows($usermaster);
			if($ucount!=0)
			{
				$user=mssql_fetch_array($usermaster);
				$email=$user['email_id'];
				$full_name=$user['full_name'];
				if($email==$email_id)
				{
					$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
					$pass = array(); //remember to declare $pass as an array
					$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
					for ($i = 0; $i < 10; $i++) 
					{
						$n = rand(0, $alphaLength);
						$pass[] = $alphabet[$n];
					}
					$auto=implode($pass); //turn the array into a string
					$automd5=md5 ($auto);
	
					$up=mssql_query("update user_master set password='$automd5' where user_name='$user_name'");
					echo "hasghj".$email;
												
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
$mail->addAddress($email_id);
//$mail->addAddress('ravi@bluebase.in');
//$mail->addCC($ccmail);
//$mail->addCC('vikraman@bluebase.in');
$mail->isHTML(true);
//Set the subject line
$mail->Subject = 'New Password';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->Body    = 'Respected '.$full_name.' San,<br><h1>Your IT Asset System New Password Is</h1><br><b>'.$auto.'</b><br>

Please Change your Password after the login.
<br><br><br>Regrads,<br>IT Team,<br>Toshiba-Chennai<br>';
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
   // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}
					echo "Your User Name and Password has been send to your registered Email Id.";
					header('Location: ../login/login.php?s=1');
				}
				else
				{
					echo "Invalid Email Id";
					header('Location: ../login/login.php?p=1');
				}
			}
			else
			{
			echo "User Doesnot exists";
			header('Location: ../login/login.php?u=1');
			}		
?>
