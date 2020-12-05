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
 
  
<style>

.info-box-text:hover {
    text-transform: uppercase;
    text-decoration: none;
	color: #333;
}
a:hover {
    color: #545454;
    text-decoration: none!important;
}

			
.box.box-info {
    display: none;
}
.box.box-primary {
    display: none;
}
.content-wrapper, .right-side, .main-footer{
	margin-left:0;
}
.fixed .content-wrapper, .fixed .right-side{
	padding-top:0;
}

span.info-box-icon.bg-aqua,span.info-box-icon.bg-navy,span.info-box-icon.bg-red,span.info-box-icon.bg-green,span.info-box-icon.bg-yellow,
span.info-box-icon.bg-purple,span.info-box-icon.bg-purple,span.info-box-icon.bg-maroon,span.info-box-icon.bg-blue,span.info-box-icon.bg-orange,span.info-box-icon.bg-grey,span.info-box-icon.bg-olive{
	min-height:150px;
	width:50%;
	    padding: 27px;
}

.info-box {
    min-height: 150px;
   
}
.info-box-content {
    padding: 52px 0px;
    text-align: center;
}
.head_breadcrumb
{
	background-color: #fff;
    border-bottom: 1px solid #333;
    box-shadow: 2px 1px 2px 1px rgba(51, 51, 51, 0.42);
    float: left;
    width: 100%;
    margin-bottom: 20px;
}
.table {
    width: 86%;
    max-width: 100%;
    margin-bottom: 20px;
    margin-left: 41px;
}
	</style>
</head>

<body>
	 	
	 <?php
			require ("../header.php");
	
	$menu=mssql_query("select distinct mm.* from role_detail d 
join role_master m on m.code=d.code
join role_mapping rm on rm.code=m.code
join user_master um on um.user_id=rm.user_id
join menu_master mm on mm.id=d.menu_id
where um.user_id='$user' and d.view_only in ('All','View')");
   
 
	?>
     
<div class="wrapper" style=" width: 90%; margin:0 auto;">    
	<div class="row">
		<div class="col-md-12" style="margin-top:6%;">
			<?php $r=1; while($c111=mssql_fetch_array($menu))
			{?>
				<div class="col-md-3">
				<a href="<?php echo $c111['menu_url'];  ?>">
					<div class="info-box">
					<span class="info-box-icon <?php echo $c111['color_class'];  ?>"><i class="<?php echo $c111['m_class'];  ?>"></i></span>
						<div class="info-box-content">
						<span class="info-box-text" title="<?php echo $c111['menu_description'];  ?>"><?php echo $c111['menu_code'];  ?></span>
						</div></a><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div><!-- /.col -->
			<?php
if($r%4==0)
{
	?>
		</div>
	 <div class="col-md-12">
	<?php
}

			$r++;} ?>
	</div>
</div>
</div>
<?php include('../footer.php'); ?></div>

</body>
</html>
