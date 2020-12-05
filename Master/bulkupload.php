<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ;?></title>
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	 <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome-animation.css">
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css">  
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap-select.min.css" />
	
	 <script src="js/canvasjs.min.js"></script>
  <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript" src="../script.js"></script>
  <script src="multi/jquery.js"></script>
  <link rel="stylesheet" href="multi/bootstrap.min.css">
  <script type="text/javascript" src="multi/bootstrap.min.js"></script>
  <script src="multi/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="multi/bootstrap-multiselect.css">
  <script src="<?php echo URL;?>js/bootstrap-select.min.js"></script>
  </head>
  <body class="skin-blue fixed sidebar-mini">
  <div class="wrapper">
  	<?php
			require ("../header.php");
	?>  
	 </div>
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
         <section class="content-header">
          <h1>
           Document Upload Details
          </h1>
          <ol class="breadcrumb">
            <li><a href="../menu/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Document Upload</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-md-3">
              <?php
			 $cus=mssql_query("select * from upload_master order by 1 desc");
			 $cn=mssql_num_rows($cus);
			 ?>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Document Upload</h3>
                  <div class='box-tools'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li ><a href="#"><i class="fa fa-file-text-o"></i>Document Upload List<span class="label label-primary pull-right"><?php echo $cn;?></span></a></li>
                 </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              
            </div><!-- /.col -->
			 <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Document Upload</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <a href="docuploadmaster.php">
						<input type="button" value="Individual Upload" class="btn btn-primary"/></a>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
				  <form action='' method='POST' enctype='multipart/form-data'>
	<table width="100%"  class="table table-striped" id="upload">
				  <tbody>
	<tr id="rw1">
	<td>Select Files</td><td>
<input name="upload[]" type="file" multiple="multiple" /> </td> </tr>
<tr><td><div style="float:right;"><input type="submit" value="Upload" class="btn btn-success"/></td></tr>
		
				</tbody>
				<input type="hidden" name="test">
			   </table>	
      </form>
				  </div>
				</div>
			</div>
			</div>
			</div>
			
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 	<?php
			require ("../footer.php");
	?> 
	<script src="/../js/jQuery-2.1.4.min.js"></script>
    <script src="/../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/../js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='/../js/fastclick.min.js'></script>
    <script src="/../js/app.min.js" type="text/javascript"></script>
    <script src="/../js/demo.js" type="text/javascript"></script>
 </body>
</html> 
	<?php
if(isset($_REQUEST['test']))
	{
		$total = count($_FILES['upload']['name']);
		$datee=date("Y-m-d");
		for($i=0; $i<$total; $i++) 
		{
			$tmpFilePath = $_FILES['upload']['name'][$i];
			$emp=explode("-",$tmpFilePath);
			$filename = $emp[0];
			//echo "<br>";
			if(isset($emp[1]))
			{
				$dirname1 = explode(".",$emp[1]);
				$tp = $dirname1[0];
				//echo "<br>";
				
				$emp_st=mssql_num_rows(mssql_query("select * from employee_id_master where $filename between employee_id_from and employee_id_to and status=0"));
				$cat_st=mssql_num_rows(mssql_query("select * from proofupload_master where proof_code like '%$tp%'"));
				
				if($emp_st==0 && $cat_st==0)
				{
					$un_upload[]=$filename;
					?><script>
					var emp="<?php echo $filename; ?>";
					var tp="<?php echo $tp; ?>";
					alert("Employee Code - " + emp +" and Category Code - " + tp + " are not Match");</script><?php
				}
				elseif($cat_st==0)
				{
					$un_upload[]=$filename;
					?><script>
					var tp="<?php echo $tp; ?>";
					alert("Category Code - " + tp + " is not Match");</script><?php
				}
				elseif($emp_st==0)
				{
					$un_upload[]=$filename;
					?><script>
					var emp="<?php echo $filename; ?>";
					alert("Employee Code - " + emp +" is not Match");</script><?php
				}
				else
				{
					if (!file_exists("Documents/" . $filename)) {
					mkdir("Documents/" . $filename, 0777);
					}
					$tmpFilePath = $_FILES['upload']['tmp_name'][$i];
					if ($tmpFilePath != "")
					{
						$newFilePath = "Documents/".$filename."/" . $_FILES['upload']['name'][$i];
						$ex=explode("/",$newFilePath);
						$ex1=explode("-",$ex[2]);
						$string = preg_replace('/[0-9]+/', '', $ex1[1]);
						$st1=$ex1[0]."-".$string;
						$newFilePath=$ex[0]."/".$ex[1]."/".$st1;
						$rs=explode(".",$newFilePath);
		$ct=mssql_num_rows(mssql_query("select * from upload_master where filepath like '%$rs[0]%' order by id desc"));
		$newFilePath=$rs[0].($ct+1).".".$rs[1];
						if(move_uploaded_file($tmpFilePath, $newFilePath)) 
						{
							$cs=mssql_fetch_array(mssql_query("select * from proofupload_master where proof_code='$tp'"));
							$type=$cs['proof_name'];
							$ins=mssql_query("INSERT INTO upload_master	(emp_id,description,filepath,created_by,created_on)
									VALUES
										('$filename','$type','$newFilePath','$user','$datee')
										");
						}
					}
				}
			}
			else
			{
				?><script>
					var emp="<?php echo $tmpFilePath; ?>";
					alert(emp +" is not a standard Format");</script><?php
					$un_upload[]=$tmpFilePath;
			}
			

			
		}
if(isset($un_upload))
{
	$un_up_cnt=implode(", ",$un_upload);	
}
else
{
	$un_up_cnt='';
}	
	
	if($un_up_cnt=='')
	{				
	?>
	<script>
    setTimeout(function() {
        swal({
            title:  "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "bulkupload.php";
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
            title: "<?php echo $un_up_cnt;  ?>",
            text: "These Employee numbers are Not Updated!",
            type: "error"
        }, function() {
           window.location = "bulkupload.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}
?>	