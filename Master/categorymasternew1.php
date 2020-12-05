<?php
require ("../configuration.php");
require ("../user.php");
?>
<?php
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
//$_SESSION['menu_id']=$_REQUEST['menu_id'];
//$_SESSION['submenu_id']=$_REQUEST['sub_menu'];
//$menu_id=$_SESSION['menu_id'];
//$submenu_id=$_SESSION['submenu_id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
	<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>/css/jquery-ui.css" rel="stylesheet" />  
  </head>
  <body class="skin-blue fixed sidebar-mini" scroll="no">
  	
  	 <div class="wrapper">
	 	
	 <?php
			require ("../header.php");
	?>
    <?php
			require ("../asidemenu.php");
	?>  
	 </div>
	  <div class="content-wrapper1">
        <!-- Content Header (Page header) -->
         <section class="content-header">
          <h1>
       Category Details
          </h1>
          <ol class="breadcrumb">
            <li><a href="../menu/menu.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-md-3">
			<div class="box box-primary">
              <?php
			 $cus=mssql_query("select * from category_master  order by 1 asc");
			 $cn=mssql_num_rows($cus);
			 ?>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Category</h3>
                  <div class='box-tools'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li ><a href="categorymaster.php?menu_id=<?php ////echo $menu_id;?>&sub_menu=<?php ////echo $submenu_id;?>"><i class="fa fa-file-text-o"></i>Category List<span class="label label-primary pull-right"><?php echo $cn;?></span></a></li>
                    
                 </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              </div><!-- /. box -->
              
            </div><!-- /.col -->
			 <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">New Category</h3>
                  <div class="box-tools pull-right">
                    
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
				 
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
					<form role="form" name="area"  method="post">
					<div class="box-body">
						<table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
							<td>Category Code</td>
							<?php
								$cus=mssql_query("select id from category_master");
								$cn=mssql_num_rows($cus);													
								$st="CAT - ";
								$nu=$cn + 01;
								$iss=$st.$nu;
														?> 
							<td><input type="text" name="category_code" id="category_code" class="form-control" value="<?php echo $iss; ?>" readonly>
							</td>
						</tr>
						
						<tr>
							<td>Category Name</td>
							<td><input type="text" name="category_name" id="category_name" onchange="nameval(this.value,this.id,'category_master','category_name','Category Name')"  class="form-control" required autocomplete="off" autofocus="autofocus"></td>						
						</tr>
						<tr>
							<td>Prefix Name</td>
							<td><input type="text" name="prefix_name"  id="prefix_name"  class="form-control" required autocomplete="off" autofocus="autofocus"></td>						
						</tr>
						<tr>
							<td>Category For</td>
							<td><input type="radio" name="q1" value="Individual" />&emsp;Individual &emsp;   <input type="radio" name="q1" value="Cost_Center" />&emsp;Location</td>						
						</tr>
						<tr>
							<td>Category Description</td>
							<td><textarea name="category_description" id="category_description" rows="3" cols="40" class="form-control" style="resize:none;"></textarea></td>						
						</tr>
						<tr><td colspan=2><div id="items"></div></td></tr>
						</table>
						<div id="con"><table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
						<tr>
						<td><h3 class="box-title" style="font-weight: 600;text-transform: uppercase;">Configurations</h3><td><td></td>
						</tr>
						<tr><td>
							
						<?php
								$sal=mssql_query("select configuration_name from configuration_master");
								while($r=mssql_fetch_array($sal))
								{	
									?>
									<div class="" style="float: left;width: 25%;">
									<input type="checkbox" id="check" name="check[]" value="<?php echo $r['configuration_name']?>" style="float:left;"  />&emsp;
									<div class="rs" style="float:left;"><?php echo "&emsp;"   ?><?php echo $r['configuration_name']."<br><br>";?></div> 
									</div>
									<?php
								}
								
								?>
							 </td>
						</tr></div>
						
						
						
					</div><!-- /.box-body -->		  
				</div>			
					</table>
                  <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                  </div>
				  <input type="hidden" name="formsent">
                </form>
				  </div>
				</div>
			</div>
			</div>
			</div>
			
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 	<?php
			require ("../../Asset/footer.php");
	?> 
	<script src="/Asset/js/nameval.js"></script>
	<script src="/Asset/js/jQuery-2.1.4.min.js"></script>
    <script src="/Asset/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Asset/js/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='/Asset/js/fastclick.min.js'></script>
    <script src="/Asset/js/app.min.js" type="text/javascript"></script>
    <script src="/Asset/js/demo.js" type="text/javascript"></script>
	
		
		
 </body>
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

<?php 
if(isset($_REQUEST['formsent']))
{
	$category_code=$_REQUEST['category_code'];
	$category_name=$_REQUEST['category_name'];	
	$prefix_name=$_REQUEST['prefix_name'];	
	$category_for=$_POST['q1'];
	$category_description=$_REQUEST['category_description'];
	$item=$_REQUEST['check'];
	$checked_arr = $_POST['check'];
	$count = count($checked_arr);
	$date=date("Y-m-d h:i:s");
	
	for($i=0;$i<$count;$i++)
				{
					$config_name=$item[$i];
					$n=mssql_query("insert into category_master1 (category_code,category_name,items,created_by,created_on)
	values ('$category_code','$category_name','$config_name','$username','$date')");
				}
	$n=mssql_query("insert into category_master (category_name,category_code,prefix_name,category_for,category_description,created_by,created_on)
	values ('$category_name','$category_code','$prefix_name','$category_for','$category_description','$username','$date')");
	if($p)
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
	<script> window.location ="../Master/categorymaster.php"</script> 
	<?Php
}
?>