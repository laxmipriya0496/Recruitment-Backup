<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=$_REQUEST['id'];
$sterm=$_REQUEST['sterm'];
$key=$_REQUEST['key'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../images/favicon.ico" type="image/gif" sizes="16x16"> 
	<link href="<?php echo URL;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/blue/blue.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>/css/jquery-ui.css" rel="stylesheet" />  
	<link href="<?php echo URL;?>css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo URL;?>css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
<style>

.content-header {
    margin-top: 45px;
}
.input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
    z-index: 0!important;
    margin-left: -1px;
}
	#xx
	{
		float:right;
	}
	.box-header a
	{
		padding: 5px 5px 5px 0px;
		background: #fff;
		color: #444;
		border-radius: 5px;
	}
	.box-header a.red
	{
		border:1px solid #dd4b39;
	}
	.box-header a.green
	{
		border:1px solid #14a225;
	}
	.box-header a i
	{
		color:#fff;
	}
	.box-header .pencil
	{
		padding: 5px;
		background: #14a225;
		margin-right: 5px;
	}
	.box-header .pencil1 
	{
		padding: 5px;
		background: #dd4b39;
		margin-right: 5px;
	}
	#dark
	{
		background:#a9a9a9;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 4px;
	}
	#dark{
		background-color:#a9a9a9!important;
	}
	ul{
	list-style-type: disc!important;
	}
	p{
		    text-align: justify;
	}

	body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 10%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 50px;
  bottom: 50px;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
	
</style>
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
           Documents
          </h1>
          <ol class="breadcrumb">
            <li><a href="../Menu/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Documents</li>
          </ol>
        </section>
		<?php
		/* /* Create Folder 
		$rs="raja";
		$rs1="images/$rs";
		$rs2="raja";
		if (!file_exists($rs1)) 
		{
			mkdir($rs1, 0777, true);
		}
		/* Rename The Folder 
		rename('images/'.$rs.'/', 'images/'.$rs2.'/');
		
		copy('Documents/RAVI.jpg', 'images/'.$rs.'/RAVI.jpg'); */
		?>
		<!-- Main content -->
		<section class="content"  style="margin-bottom:15%;">
			<!-- Default box -->
		<div class="row" style="font-family:'Times New Roman', Times, serif">
		<?php   
		$emp=mssql_fetch_array(mssql_query("select * from employee_master where id='$id'"));
		$ename=$emp['Name'];
		$ecode=$emp['employee_id'];
		?>
		
		<h2 style="text-align:center"><?php echo "Employee Name - <span style='color:blue;text-transform: uppercase;'> $ename </span> and Code - <span style='color:blue;'> $ecode </span>"  ?></h2>
		 <a href="doucuments.php?id=<?php echo $id;?>" target="_blank">
						<input style="float:right;"type="button" value="View All Documents" class="btn btn-primary"/></a><br><br>
		<div class="row" style="margin:1%;">
<?php
if($sterm=="University")
{
	$emp1=mssql_fetch_array(mssql_query("select * from employee_details where emp_id='$ecode' and (University like '%$key%' or Graduation='$key')"));
	//echo "select * from employee_details where emp_id='$ecode' and (University like '%$key%' or Graduation='$key')";
	/* while($c11=mssql_fetch_array($emp1))
	{ */
		$Graduation=$emp1['Graduation'];
		$emp11=mssql_fetch_array(mssql_query("select * from [dbo].[search_doc_mapping] where degree like '%,$Graduation,%'"));
		//echo "select * from [dbo].[search_doc_mapping] where degree like '%,$Graduation,%'";
	$na=explode(",",$emp11['filepath']);
	$cnt=count($na);
		for($i=0;$i<$cnt;$i++)
		{
			$na[$i];
			$fn=$ecode."-".$na[$i];
			$emp2=mssql_query("select * from upload_master where filepath like '%$fn%'");
			while($c111=mssql_fetch_array($emp2))
			{
				$img=$c111['filepath'];
				$description=$c111['description'];
				?>
 <div class="column" style="width: 100%;">
 <span style="width: 100%;margin-left:50%;"><?php echo $description; ?></span>

    <img src="<?php echo $rs=$img; ?>" alt="img"  style="width: 100%;"> <br> <br>
</div>
<?php 
			}
		}
				if(!isset($rs))
				{
					$img="Documents/".$ecode."/".$ecode."-PRO1.jpg";
					$img1="Documents/".$ecode."/".$ecode."-PRO2.jpg";
					?>
 <div class="column" style="width: 100%;">
 <span style="width: 100%;margin-left:50%;"><?php echo "Profile Page1"; ?></span>

    <img src="<?php echo $img; ?>" alt="img"  style="width: 100%;"> <br> <br>
 <span style="width: 100%;margin-left:50%;"><?php echo "Profile Page2"; ?></span>

    <img src="<?php echo $img1; ?>" alt="img"  style="width: 100%;"> <br> <br>
</div>
<?php 
				}
	/* } */
	
	
}
else
{
$emp1=mssql_fetch_array(mssql_query("select * from [dbo].[search_doc_mapping] where degree like '%,$sterm,%'"));
$na=$emp1['filepath'];
$fn=$ecode."-".$na;
$emp2=mssql_fetch_array(mssql_query("select * from upload_master where filepath like '%$fn%'"));
$img=$emp2['filepath'];
$description=$emp2['description'];
?>
 <div class="column" style="width: 100%;">
 <span style="width: 100%;margin-left:50%;"><?php echo $description; ?></span>
    <img src="<?php echo $img; ?>" alt="img"  style="width: 100%;"> 
</div>
<?php 
} ?>
</div>

			</div>
          </div>
			<script src="../js/jquery-1.7.2.js"></script>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
<?php
require ("../footer.php");
?> 
</body>
</html>
