<?php
require ("../configuration.php");
require ("../user.php");
$user_id=$_SESSION['user'];
$username=$_SESSION['user_name'];
			$prof=mssql_fetch_array(mssql_query("select profile,full_name,email_id from user_master where user_id='$user_id'"));
$s_menu_id=$_SESSION['menu_id'];
$s_submenu_id=$_SESSION['submenu_id'];
?>			
			

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>MRF</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/font-awesome-animation.css">
  <link rel="stylesheet" href="../css/w3.css">
  <link rel="stylesheet" href="style.css">
  <script src='../js/jquery.min.js'></script>
  <script src='../js/bootstrap.min.js'></script>
  <script src='../js/jquery-1.8.2.min.js'></script>  
</head>

<body>
<div class="outer-wrapper">
	<div class="content-wrapper">
	 	
	<?php
			require ("../../asset/header.php");
	?>
     
	</div>
  <div class="inner-wrapper">
  <div class="container">
	  <div class="row">
		  <div class="inner-container">
		  
		  
		  	<?php
				$menu_master=mssql_query("select distinct m.menu_name,m.id,m.m_class from menu_access_right a left join menu_master m
on m.id=a.menu_id 
 join user_master u on a.user_id=u.user_id
where u.user_id='$user_id' order by m.id");
/* echo "select distinct m.menu_name from menu_access_right a left join menu_master m
on m.id=a.menu_id 
 join user_master u on a.user_id=u.user_id
where u.user_id='$user_id'"; */
$s=1; 


				while($menu=mssql_fetch_array($menu_master))
					
						{ 	
						$subid=$menu['id'];
						$color=mssql_fetch_array(mssql_query("select color_code from color_code where id='$s'"));
						
			?>
			<div class="col-md-3" id="hide<?php echo $s; ?>" onclick="iconhide('#hide<?php echo $s; ?>','#show<?php echo $s; ?>')">
				<nav class="navbar">
				  <div class="container-fluid">
					<ul class="nav navbar-nav" style="background: <?php echo $color['color_code'] ;  ?>;">
					 <li class="dropdown active">
						<div class="icon"><i class="<?php echo $menu['m_class'] ;  ?>"></i></div><?php echo $menu['menu_name'] ;  ?></a>
						
					  </li>
								 
					</ul>
				  </div>
				</nav>
			 </div>
			 
	
			 <div class="col-md-3" id="show<?php echo $s++;  ?>" onclick="iconshow()">
				<nav class="navbar">
				  <div class="container-fluid">
					<ul class="nav navbar-na" style="background: <?php echo $color['color_code'] ;  ?>;">
						<li class="dropdown1">
							<div class="icon"><i class="<?php echo $menu['m_class'] ;  ?>"></i><span class="spane"><?php echo $menu['menu_name'] ;  ?></span></div>
							
									 <?php
			 $submenu_master=mssql_query("select distinct s.submenu_code,s.submenu_order,s.submenu_class,s.submenu_url from menu_access_right a left join menu_master m
on m.id=a.menu_id 
 join user_master u on a.user_id=u.user_id
 join submenu_master s on s.menu_id=m.id
where u.user_id='$user_id' and m.id='$subid' order by s.submenu_order");


while($submenu=mssql_fetch_array($submenu_master))
					
						{ 
						?>
						<ul class="dropdown-menu1">
						  <li><a href="..<?php echo $submenu['submenu_url'] ;  ?>" class="faa-parent animated-hover"><i class="<?php echo $submenu['submenu_class'] ;  ?> faa-shake" aria-hidden="true"></i><span class="span"><?php echo $submenu['submenu_code'] ;  ?></span></a>
						  	</li>
						
						</ul>
						 <?php }  ?>
					  </li>
							 
					</ul>
					
				  </div>
				</nav>
			 </div>
						<?php }  ?>
			</div>
		</div>
	   
		
	 
  </div>
  </div>

 
<?php
	require("../../TOSHIBA/footer.php");
?>
</div> 
<?php 
$submenu_master=mssql_fetch_array(mssql_query("select count(m.id) as cntt from menu_access_right a left join menu_master m
on m.id=a.menu_id 
 join user_master u on a.user_id=u.user_id
 join submenu_master s on s.menu_id=m.id
where u.user_id='$user_id' and m.id='$subid' order by s.submenu_order"));

echo "select count(m.id) as cntt from menu_access_right a left join menu_master m
on m.id=a.menu_id 
 join user_master u on a.user_id=u.user_id
 join submenu_master s on s.menu_id=m.id
where u.user_id='$user_id' and m.id='$subid' order by s.submenu_order";

echo $menu=$submenu_master['cntt'];

  ?>
</body>
<script>
$(document).ready(function()
{
    $("#show1").hide();   
    $("#show2").hide();   
    $("#show3").hide();   
});
</script>
<script>
function iconhide(r,s)
{
	//alert(r);
	//alert(s);
	$(s).show();
	$(r).hide();
}
function iconshow()
{
	$("#show1").hide();
	$("#show2").hide();
	$("#show3").hide();
	$("#hide1").show();
	$("#hide2").show();
	$("#hide3").show();
}
</script>
<script src="../js/jquery.min.js" type="text/javascript"></script>

</html>
