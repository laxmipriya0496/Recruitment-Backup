<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$database_name="excel";
date_default_timezone_set('Asia/Calcutta'); 
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
<script src="<?php echo URL;?>js/sweet-alert.js"></script>
<link rel="stylesheet" href="<?php echo URL;?>css/sweet-alert.css" /> 
  <link rel="stylesheet" href="<?php echo URL;?>css/navcss.css">
	
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
				<span class="front" style="background-color:#313131;">Temporary User Register</span>
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
				<span class="front" style="background-color:#313131;">Field Configuration</span>
				<span class="back" style="background-color:#3db2e1;">Field Configuration</span>
			</span>
		</a></li>
		<li><a href="backup.php" class="three-d">Backup
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#3db2e1;">Backup</span>
				<span class="back" style="background-color:#3db2e1;">Backup</span>
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
		<div class="col-md-6">
		<h3>Backup</h3>
		<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr id="row2">
					<td>File Name</td>
					<td><input type="text" class="form-control" name="file_name" id="file_name" autocomplete="off"></td>
					</tr><tr>
					<td>Password</td>
					<td>
					<div class="input-group" style="width:90%;float:left;">
     				<input type="password" class="add-on form-control" id="password" name="password" autocomplete="off">
					</div>
					<div class="" id="show" onclick="show()"><i class="fa fa-eye" style="padding:8px 12px 9px 12px;
					border: 1px solid #bdb6b6;"></i></div>
					<div class="" id="hide" onclick="hide()" hidden><i class="fa fa-eye-slash" style="padding:8px 12px 9px 12px;
					border: 1px solid #bdb6b6;"></i></div>
					</td>
					</tr><tr>
					<input type="hidden" name="msent" id="msent" />
						<td><input type="submit" name="Backup" id="Backup" class="btn btn-success" value="Backup"></td><td></td>
                  </tr>
                      </tbody>
                    </table><!-- /.table -->
				</form>
					 
		</div>
		<div class="col-md-6">
		<h3>Restore</h3>
		<form method="post">
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr>
					<td>Date</td>
					<td><input list="browsers1" name="date" id="date" class="form-control" value="" autocomplete="off" placeholder="---Select Date---" onchange="get_time(this.value)">
						<datalist id="browsers1">
<?php $employee_row1=mssql_query(" select distinct date from back_up order by 1 desc");?>
						<select class="form-control" id="rs">
								<?php
									while($employee_res1=mssql_fetch_array($employee_row1))
									{
								?>
									<option><style><?php echo date("d-m-Y",strtotime($employee_res1['date']));?></style></option>
								<?php
									}
									?>
							</datalist></td>
					</tr>
					<tr>
					<td>time</td><td>
<input list="browsers2" name="time" id="time" class="form-control"  value="" autocomplete="off" placeholder="---Select Time---" onchange="get_filename(this.value)"  autocomplete="off">
						<datalist id="browsers2">
							<select class="form-control" id="ss3">
								<option >Select</option>
							</select>			
						</datalist>
</td></tr>
					<tr>
					<td>File name</td>
					<td><input type="text" name="filename" id="filename" class="form-control" readonly>
					<input type="hidden" name="id" id="id" class="form-control" readonly></td>
					</tr>
					<tr>
					<td>Password</td>
					<td>
					<div class="input-group" style="width:90%;float:left;">
     				<input type="password" class="add-on form-control" id="password1" name="password1" autocomplete="off" onkeyup="error(this.value);">
					</div>
					<div class="" id="show1" onclick="show1()"><i class="fa fa-eye" style="padding:8px 12px 9px 12px;
					border: 1px solid #bdb6b6;"></i></div>
					<div class="" id="hide1" onclick="hide1()" hidden><i class="fa fa-eye-slash" style="padding:8px 12px 9px 12px;
					border: 1px solid #bdb6b6;"></i></div>
					<label id="error" style="color:red;align:center;margin-top:5px;margin-left:30%;"></label>
					</td>
					</tr><tr>
					<input type="hidden" name="msent1" id="msent1" />
						<td><input type="submit" name="restore" id="restore" class="btn btn-success" value="Restore" hidden></td><td></td>
                  </tr>
                      </tbody>
                    </table><!-- /.table -->
					 </form>
					 
		</div>
		<div class="col-md-6" style="margin-bottom:50px;">
		<h3>Revert</h3>
		<form method="post">
		<?php 
		$cus=mssql_fetch_array(mssql_query("select * from Re_store order by 1 desc"));
		$fi=explode("--",$cus['filename']);
		?>
				 <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
					<tr>
					<td>Date</td>
					<td><input type="text" name="date2" id="date2" class="form-control" value="<?php echo date ("d-m-Y",strtotime($cus['date'])); ?>" readonly></td>
					</tr>
					<tr>
					<td>time</td><td><input type="text" name="time2" id="time2" class="form-control" value="<?php echo date ("H:i:s",strtotime($cus['time'])); ?>" readonly></td></tr>
					<tr>
					<td>File name</td>
					<td><input type="text" name="filename2" id="filename2" class="form-control" readonly  value="<?php echo $fi[0]; ?>">
					<input type="hidden" name="id2" id="id2" class="form-control" readonly  value="<?php echo $cus['id']; ?>"></td>
					</tr>
					<tr>
					<td>Password</td>
					<td>
					<div class="input-group" style="width:90%;float:left;">
     				<input type="password" class="add-on form-control" id="password2" name="password2" autocomplete="off" onkeyup="error1(this.value);">
					</div>
					<div class="" id="show2" onclick="show2()"><i class="fa fa-eye" style="padding:8px 12px 9px 12px;
					border: 1px solid #bdb6b6;"></i></div>
					<div class="" id="hide2" onclick="hide2()" hidden><i class="fa fa-eye-slash" style="padding:8px 12px 9px 12px;
					border: 1px solid #bdb6b6;"></i></div>
					<label id="error1" style="color:red;align:center;margin-top:5px;margin-left:30%;"></label></td>
					</tr>
					<tr>
					<input type="hidden" name="msent2" id="msent2" />
						<td><input type="submit" name="Revert" id="Revert" class="btn btn-success" value="Revert" hidden></td><td></td>
                  </tr>
                      </tbody>
                    </table><!-- /.table -->
					 </form>
					 
		</div>
		
</div>
</div>
	</div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>
<?php
 if(isset($_REQUEST['msent']))
{
	$file_name=$_REQUEST['file_name'];
	$password=$_REQUEST['password'];
	$date=date("Y-m-d--H-i-s");
	$date1=date("Y-m-d H:i:s");
	$time=date("H:i:s");
	$file=$file_name."--".$date;
	$path="\\"."\\192.168.200.53\www\document\db\back_up\\".$file.".bak";
	
	mssql_query("BACKUP DATABASE $database_name TO DISK = '$path' with password='$password'");
	
	$n=mssql_query("insert into back_up (filename,password,filepath,date,time,created_by,created_on)
	values ('$file','$password','$path','$date1','$time','$username','$date1')");

	if($n)
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "backup.php";
        });
    }, 100);
</script>  
    <?php
	}	
	else
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Not",
            text: "Completed!",
            type: "error"
        }, function() {
           window.location = "backup.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}
 if(isset($_REQUEST['msent1']))
{
	$file_name=$_REQUEST['filename'];
	$id=$_REQUEST['id'];
	$old=mssql_fetch_array(mssql_query("select * from back_up where id='$id'"));
	$password1=$_REQUEST['password1'];
	$date=date("Y-m-d--H-i-s");
	$date1=date("Y-m-d H:i:s");
	$time=date("H:i:s");
	$file_name1=$old['filename'];
	$file=$file_name1."--".$date;
	$path="\\"."\\192.168.200.53\www\document\db\Re_store\\".$file.".bak";
	$path1=$old['filepath'];
	
	mssql_query("BACKUP DATABASE $database_name TO DISK = '$path' with password='$password1'");
	
	mssql_query("drop database $database_name");
	
	mssql_query("RESTORE database $database_name FROM DISK = '$path1' with password='$password1'");
	
	//echo "RESTORE database $database_name FROM DISK = '$path1' with password='$password1'<br><br><br><br><br><br>";
	
	$n=mssql_query("insert into Re_store (filename,password,filepath,date,time,created_by,created_on)
	values ('$file','$password1','$path','$date1','$time','$username','$date1')");

if($n)
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "backup.php";
        });
    }, 100);
</script>  
    <?php
	}	
	else
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Not",
            text: "Completed!",
            type: "error"
        }, function() {
           window.location = "backup.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}
 if(isset($_REQUEST['msent2']))
{
	$filename2=$_REQUEST['filename2'];
	$id2=$_REQUEST['id2'];
	$old=mssql_fetch_array(mssql_query("select * from Re_store where id='$id2'"));
	$password2=$_REQUEST['password2'];
	$path1=$old['filepath'];
	
	mssql_query("drop database $database_name");
	
	$n=mssql_query("RESTORE database $database_name FROM DISK = '$path1' with password='$password2'");
	
	//echo "RESTORE database $database_name FROM DISK = '$path1' with password='$password2'<br><br><br><br><br><br><br><br>";

if($n)
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
           window.location = "backup.php";
        });
    }, 100);
</script>  
    <?php
	}	
	else
	{
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Not",
            text: "Completed!",
            type: "error"
        }, function() {
           window.location = "backup.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}
?>
<script>
	function get_time(r)
	{
	 $.ajax
		({
			type: "GET",
			url: "get_time.php",
			data: "name=" + r,		 
			success: function(data)
			{
				$('#ss3').html(data);
				//alert(data);
			}
		});	
	}
</script>
<script>
	function get_filename(r)
	{
	 $.ajax
		({
			type: "GET",
			url: "get_filename.php",
			data: "name=" + r,		 
			success: function(data)
			{
				var rs=data.split("-");
				$('#filename').val(rs[0]);
				$('#id').val(rs[1]);
			}
		});	
	}
</script>
<script>
	function show()
	{
		$('#password').attr('type','text');
		$("#show").hide();
		$("#hide").show();
	}
</script>
<script>
	function hide()
	{
		$('#password').attr('type','password');
		$("#show").show();
		$("#hide").hide();
	}
</script>
<script>
	function show1()
	{
		$('#password1').attr('type','text');
		$("#show1").hide();
		$("#hide1").show();
	}
</script>
<script>
	function hide1()
	{
		$('#password1').attr('type','password');
		$("#show1").show();
		$("#hide1").hide();
	}
</script>
<script>
	function error(r)
	{		
		var id=$("#id").val();
		$.ajax
		({
			type: "GET",
			url: "get_pass.php",
			data: "name=" + r + "&id=" + id + "&type=restore",		 
			success: function(data)
			{
				//alert(data);
				if(data==0)
				{
					$("#error").show();
					$("#error").text("Password Not Match!");
					$("#restore").hide();
				}
				else
				{
					$("#restore").show();
					$("#error").hide();
				}
			}
		});	
	}
</script>
<script>
	function show2()
	{
		$('#password2').attr('type','text');
		$("#show2").hide();
		$("#hide2").show();
	}
</script>
<script>
	function hide2()
	{
		$('#password2').attr('type','password');
		$("#show2").show();
		$("#hide2").hide();
	}
</script>
<script>
	function error1(r)
	{	
		var id=$("#id2").val();
		//alert(id);
		$.ajax
		({
			type: "GET",
			url: "get_pass.php",
			data: "name=" + r + "&id=" + id + "&type=revert",		 
			success: function(data)
			{
				if(data==0)
				{
					$("#error1").show();
					$("#error1").text("Password Not Match!");
					$("#Revert").hide();
				}
				else
				{
					$("#Revert").show();
					$("#error1").hide();
				}
			}
		});	
	}
</script>