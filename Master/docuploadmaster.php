<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));

if($dep!="All")
	{
		$dt="where Department in ('$dep')";
	}
	else
	{
		$dt="";
	}
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
			 $cus=mssql_query("select * from upload_master  order by 1 desc");
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
			 <div class="col-md-9" style="height: 500px;">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Document Upload</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <a href="bulkupload.php">
						<input type="button" value="Bulk Upload" class="btn btn-primary"/></a>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
				  <form action='' method='POST' enctype='multipart/form-data'>
				  <table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
				  <tbody>
				  <?php 
				  if(isset($_REQUEST['id']))
				  {
					  $id=explode(":",$_REQUEST['id']);
				  }
				  else
				  {
					  $id='';
				  }
  ?>
        <tr>
		<td>Employee Name </td>
		
		
		<td><select class="selectpicker" data-show-subtext="true" data-live-search="true" name="emp_name" id="emp_name1" class="form-control" value="" autocomplete="off" multiple required onchange="get_gra()">
		<?php if($id!='') 
		{
			?><option value="<?php  echo $id[0];?>"><?php  echo $id[1];?></option><?php
		}
			?>
	<option value="">SELECT</option>
	<?php
	$Name=mssql_query("select distinct Name,id,employee_id from employee_master $dt order by Name"); 
			while($Name1=mssql_fetch_array($Name))
			{
				?> <option value="<?php echo $Name1['employee_id']; ?>">  <?php echo $Name1['employee_id']."-".$Name1['Name']; ?> </option><?php
			}				?>
	</select></td>
	</tr></table>
	<table width="100%"  class="table table-striped" id="upload">
				  <tbody>
	<tr id="rw1">
		<td>Type</td>
	<td><select name="type[]" id="type1" class="form-control" onchange="change(this.value,this.id)" required>
	<option value="">SELECT</option>
	<?php $rs=mssql_query("
select distinct a.proof_code,a.proof_name from (
select id,case when isnumeric(RIGHT(proof_code,1))=1 then left(proof_code,(LEN(proof_code)-1)) else ''  end as proof_code,
case when isnumeric(RIGHT(proof_code,1))=1 then left(proof_name,(LEN(proof_name)-1)) end as proof_name
from proofupload_master  ) a where a.proof_code <>'' order by a.proof_code "); 
			while($rs1=mssql_fetch_array($rs))
			{
				?> <option value="<?php echo $rs1['proof_name']; ?>">  <?php echo $rs1['proof_name']; ?> </option><?php
			}				?>
	</select></td>
	<td>Upload</td><td>
<input type='file' name='userFile1' id='userFile1' required> </td> </tr>
		<div style="float:right;"><input type="submit" value="Upload" class="btn btn-success"/>&nbsp;
				<input type="button" class=" btn btn-success add_new" value="Add new" > </div>
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
		$emp_name=$_REQUEST['emp_name'];
		$type=$_REQUEST['type'];
		$datee=date("Y-m-d");
		$cnt=count($type);
		$r=0;
		for($i=1;$i<=$cnt;$i++)
		{
			if (!file_exists("Documents/" . $emp_name)) {
				mkdir("Documents/" . $emp_name, 0777);
			}
		$fileName="userFile".$i;
		$target_Path_aggrement="Documents/$emp_name/";
		$filepath="Documents/$emp_name/".basename( $_FILES[$fileName]['name']);
		$target_Path_aggrement=$target_Path_aggrement.basename( $_FILES[$fileName]['name']);
		$rs=explode(".",$target_Path_aggrement);
		
		$ct=mssql_num_rows(mssql_query("select * from upload_master where filepath like '%$rs[0]%' order by id desc"));
		$target_Path_aggrement=$rs[0].($ct+1).".".$rs[1];
							/******File Upload***/
		move_uploaded_file( $_FILES[$fileName]['tmp_name'],$target_Path_aggrement);
		
		$ins=mssql_query("INSERT INTO upload_master	(emp_id,description,filepath,created_by,created_on)
							VALUES
								('$emp_name','$type[$r]','$target_Path_aggrement','$user','$datee')
								");
								$r++;
		}					
		
	if($ins)
	{				
	?>
	<script>
    setTimeout(function() {
        swal({
            title: "Successfully",
            text: "Completed!",
            type: "success"
        }, function() {
            window.location = "docuploadmaster.php";
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
           window.location = "docuploadmaster.php";
        });
    }, 100);
</script> 	  
	<?Php
	}
}
?>	
<script language="javascript">
 $('.add_new').click(function(){
	var len=$('#upload tr').length;
	alert(len);
	len=len+1;
	
	 $('.table-striped').append('<tr class="row_'+len+'"><td>Type</td>	<td><select name="type[]" id="type'+len+'" class="form-control" onchange="change(this.value,this.id)" required>	<option value="">SELECT</option>	<?php $rs=mssql_query("select distinct a.proof_code,a.proof_name from (select id,case when isnumeric(RIGHT(proof_code,1))=1 then left(proof_code,(LEN(proof_code)-1)) else ''  end as proof_code,case when isnumeric(RIGHT(proof_code,1))=1 then left(proof_name,(LEN(proof_name)-1)) end as proof_namefrom proofupload_master  ) a where a.proof_code <>'' order by a.proof_code "); 	while($rs1=mssql_fetch_array($rs))	{?> <option value="<?php echo $rs1['proof_name']; ?>">  <?php echo $rs1['proof_name']; ?> </option><?php }	?>	</select></td>	<td>Upload</td><td><input type="file" name="userFile'+len+'" id="userFile'+len+'" required> </td></tr>');
	//alert("test");
});
</script> 
<script type="text/javascript">
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect();
    });
</script>