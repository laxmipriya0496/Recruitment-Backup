<?php
//require ("../configuration.php");
$ip=$_SERVER['REMOTE_ADDR'];
//echo "<br>";
$sys_name=gethostbyaddr($ip);

ob_start();  
      
       system('ipconfig /all');  
      
       $mycomsys=ob_get_contents();  
     
       ob_clean();  
       $find_mac = "Physical"; //find the "Physical" & Find the position of Physical text  
       $pmac = strpos($mycomsys, $find_mac);  
      
       $macaddress=substr($mycomsys,($pmac+36),17);  
     
       $mac= $macaddress;
	   
	   $ipadd=mssql_query("select ip_address from mac_master where ip_address='$ip' and status=0");
	  // echo "select ip_address from mac_master where ip_address='$ip'";
	   $cnt=mssql_num_rows($ipadd);
if($cnt==1)

{
	
}	   
else
{
	//ECHO 1;
	header('location:notauthorized.php');
}
?>