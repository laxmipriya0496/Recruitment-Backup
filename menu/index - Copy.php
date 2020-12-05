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
			//require ("asidemenu.php");
		  
	$emp=mssql_query("select (select COUNT(Gender) as Male from employee_master where Gender='Male' group by Gender) as Male,
(select COUNT(Gender) as Female from employee_master where Gender='Female' group by Gender) as Female,
(select COUNT(employee_id) as Total from employee_master) as Total");
	$uni=mssql_fetch_array(mssql_query("select COUNT(distinct University) as uni from employee_details"));
	$state=mssql_fetch_array(mssql_query("select COUNT (distinct State_of_Origin) as state from employee_master"));
	$Department=mssql_fetch_array(mssql_query("select COUNT (distinct Department) as Department from employee_master"));
	
	$emp=mssql_query("select mm.* from role_detail d 
join role_master m on m.code=d.code
join role_mapping rm on rm.code=m.code
join user_master um on um.user_id=rm.user_id
join menu_master mm on mm.id=d.menu_id
where um.user_id='$user' and d.view_only in ('All','View')");
   
	?>
     
	<div class="wrapper" style=" width: 90%; margin:0 auto;">
    
<div class="row">

            <div class="col-md-12" style="margin-top:6%;">
			<?php while($c111=mssql_fetch_array($emp2))
			{?>
            <div class="col-md-3">
			<a href="../Master/university.php">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-university"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="NO OF UNIVERSITY">UNIVERSITY</span>
                  <span class="info-box-number"><?php echo $uni['uni'];?></span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
			<?php } ?>
            <div class="col-md-3">
			<a href="../Master/state.php">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-globe"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="NO OF STATES">STATES</span>
                  <span class="info-box-number"><?php echo $state['state'];?></span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3">
			<a href="../Master/department.php">
              <div class="info-box">
                <span class="info-box-icon bg-olive"><i class="fa fa-th"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="NO OF DEPARTMENT">&nbsp;DEPARTMENT </span>
                  <span class="info-box-number"><?php echo $Department['Department'];?></span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div>
			
             <div class="col-md-3">
			<a href="../Master/searchmasternew.php">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-search"></i></span>
                <div class="info-box-content">
                 <span class="info-box-text" title="SEARCH MASTER">SEARCH</span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
			</div><!-- /.col -->

            <!-- fix for small devices only -->
 <div class="col-md-12">
  
			<div class="col-md-3">
			<a href="../Master/docuploadmaster.php">
              <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-upload"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="UPLOAD MASTER">UPLOAD</span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
		
			<div class="col-md-3">
			<a href="../Master/university_master.php">
              <div class="info-box">
                <span class="info-box-icon bg-maroon"><i class="fa fa-wrench"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="MASTERS">MASTERS</span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
			
            <div class="col-md-3">
			<a href="../Master/employeemaster.php">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-male"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="EMPLOYEE MASTER">&emsp;EMPLOYEE MASTER</span>
				  <?PHP /* while($c=mssql_fetch_array($emp))
		{ ?>
				   <table class="table table-hover" style="font-family:'Times New Roman', Times, serif;">
				   <tr>
				   <td><?php echo "Male - <b style='color:#660000;'>".$c['Male']."</b>";?></td>
				   <td><?php echo "Female - <b style='color:#96b711;'>".$c['Female']."</b>";?></td>
				   </tr>
				   <tr>
				   <td colspan=2><?php echo "Total - <b style='color:#179b77;'>".$c['Total']."</b>";?></td>
				   </tr>
				   </table>
		<?php } */ ?>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
			<div class="col-md-3">
			<a href="../Master/register_master.php">
              <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-cogs"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="SETTINGS">SETTINGS</span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  
 <div class="col-md-12">
 <div class="col-md-3">
			<a href="../Master/change_password.php">
              <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fa fa-key"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text" title="CHANGE PASSWORD">CHANGE PASSWORD</span>
                </div></a><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
 </div>
</div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>
