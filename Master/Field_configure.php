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
  <link rel="stylesheet" href="<?php echo URL;?>css/navcss.css"> 
	<script src="js/jquery.min.js"></script>
<script src="<?php echo URL;?>js/sweet-alert.js"></script>
<link rel="stylesheet" href="<?php echo URL;?>css/sweet-alert.css" />  
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
				<span class="front" style="background-color:#3db2e1;">Field Configuration</span>
				<span class="back" style="background-color:#3db2e1;">Field Configuration</span>
			</span>
		</a></li>
		<li><a href="backup.php" class="three-d">Backup
			<span aria-hidden="true" class="three-d-box">
				<span class="front" style="background-color:#313131;">Backup</span>
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
</div>
		<h4>Field Configuration</h4>
		<div class="box" style="border-top: 3px solid #1854cc;">
			<div class="col-md-4">
				<form role="form" name="area"  method="post">
					<table class="table table-hover table-striped" id="tb" name="tb">
						<tr><td>
							<select name="fields[]" id="fields" class="form-control" multiple style="height:300px;">
							<?php	
								$field_map=mssql_query("select * from field_mapping");
								while($field_map1=mssql_fetch_array($field_map))
								{?>
								<option value="<?php echo $field_map1['field_name']; ?>"><?php echo $field_map1['field_name']; ?></option>
								<?php  }?>
							</select>
						</td></tr>
					</table>
			</div>
			<div class="col-md-1" style="margin-right:6%;margin-left:6%;margin-top:5%;">
				<table class="table table-hover table-striped" id="tb1" name="tb1">
					<tr style="text-align:center;"><td>
						<input type="button" name="right" id="right" value=">>" onclick="rs()" style="width:75px;">
					</td></tr>
					<tr><td></td></tr>
					<tr style="text-align:center;"><td>
						<input type="button" name="left" id="left" value="<<" onclick="rs1()" style="width:75px;">
					</td></tr>
					<tr><td></td></tr>
					<tr style="text-align:center;"><td>
						<input type="button" value="Up" id="up" name="up" style="width:75px;">
					</td></tr>
					<tr><td></td></tr>
					<tr style="text-align:center;"><td>
						<input type="button" value="Down" id="down" name="down" style="width:75px;">
					</td></tr>
				</table>
			</div>
			<div class="col-md-4">
				<table class="table table-hover table-striped" id="tb" name="tb">
					<tr><td><input type="hidden" name="valu" id="valu" class="form-control">
						<select name="fields1" id="fields1" class="form-control" multiple style="height:300px;">
						</select>
					</td></tr>
				</table>
			</div>
			
		</div>
		</div>
		<div class="col-md-12" style="margin-bottom:5%;margin-left:40%;">
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" value="Submit" name="submit">
			</div>
			<input type="hidden" name="formsent">
		</div>
				</form>
	</div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>
<script>
function rs()
{
	var num = [];
	var data = $('#fields').val();
	var da=data.toString().split(',');
	var cnt=da.length;
	for(var i=0;i<cnt;i++)
	{
		$("#fields1").append('<option value="'+ da[i] +'">'+ da[i] +'</option>');
		$("#fields option[value="+ da[i] +"]").remove();
		num.push(da[i]);
	}
	var old_v=$("#valu").val();
	if(old_v=="")
	{
		var new_v=num;
	}
	else
	{
		var new_v=old_v+","+num;
	}
	$("#valu").val(new_v);
}
</script>
<script>
function rs1()
{
	var num = [];
	var data = $('#fields1').val();
	var da=data.toString().split(',');
	var cnt=da.length;
	for(var i=0;i<cnt;i++)
	{
		num=[];
		$("#fields").append('<option value="'+ da[i] +'" >'+ da[i] +'</option>');
		$("#fields1 option[value="+ da[i] +"]").remove();
		
		var re = $('#valu').val();
		var rem=re.toString().split(',');
		var cnt1=rem.length;
		for(var k=0;k<cnt1;k++)
		{
			if(rem[k]!=da[i])
			{
				num.push(rem[k]);
			}
		}
		$("#valu").val(num);
	}
}
</script>

<?php
if(isset($_POST['formsent']))  
{  
	mssql_query("truncate table field_configure");
	$valu=explode(",",$_POST["valu"]);
	$cntt=count($valu);
	$date=date("Y-m-d");
	$s=1;
	for($r=0;$r<$cntt;$r++)
	{
		$n=mssql_query("insert into field_configure (name,order_by,created_by,created_on)
		values ('$valu[$r]','$s','$user','$date')");
		$s++;
	}
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
            window.location = "field_configure.php";
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
           window.location = "field_configure.php";
        });
    }, 100);
</script> 	  
	<?Php
	}	
}  
?>  
<script>
$(document).ready(function(){
    $('#up').click(function(){
        var $op = $('#fields1 option:selected'),
            $this = $(this);
        if($op.length){
            ($this.val() == 'Up') ? 
                $op.first().prev().before($op) : 
                $op.last().next().after($op);
        }
		var values = [];
	$('#fields1 option').each(function() { 
    values.push( $(this).attr('value') );
});
$("#valu").val(values);
    });
	
	 $('#down').click(function(){
        var $op = $('#fields1 option:selected'),
            $this = $(this);
        if($op.length){
            ($this.val() == 'Up') ? 
                $op.first().prev().before($op) : 
                $op.last().next().after($op);
        }
		var values1 = [];
	$('#fields1 option').each(function() { 
    values1.push( $(this).attr('value') );
});
$("#valu").val(values1);
});
});
</script>