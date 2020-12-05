<?php 

$item_row12=mssql_fetch_array(mssql_query("select department from dbo.department_mapping where USER_ID='$user'"));
$dpt=explode(",",$item_row12['department']);				
$dpt1=implode("','",$dpt); ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URL;?>css/style.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
<style>
.navbar-right {
    float: right!important;
    margin-right: 0px; 
}
</style>
</head>
<body>

  <nav class="navbar navbar-inverse" style="position: fixed;width: 100%;top: 0; z-index: 9999;">
  <div class="container-fluid">
    <div class="navbar-header">
      <p><a class="navbar-brand" href="#">Document</a>
	   <a class="navbar-brand" href="#"></a>
	  <a class="navbar-brand" href="#"> Hi , <?php echo $username; ?></a>
	  </p>
    </div>
    <div>
	<div style="float:right;">
     <a class="navbar-brand" href="../Menu/index.php"><i style="margin: 0px 3px;font-size: 19px;" class="fa fa-tachometer" aria-hidden="true"></i>DASHBOARD</a>
	  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a href="<?php echo URL;?>login/logout.php">
		<i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
      </ul>
	 </div>
     
    </div>
  </div>
</nav>

</body>
</html>