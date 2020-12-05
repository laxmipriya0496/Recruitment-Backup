<?php
$r = 0; 
$dir = new DirectoryIterator('../Master/Documents');
foreach ($dir as $fileinfo) 
{
    if ($fileinfo->isDir() && !$fileinfo->isDot()) 
	{
        $fileinfo->getFilename().'<br>';
		$dir = '../Master/Documents/'.$fileinfo;
		if ($handle = opendir($dir)) 
		{
			while (($file = readdir($handle)) !== false)
			{
				if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
				$r++;
			}
		}
    }
}
$total_items  = count( glob("../Master/Documents/*", GLOB_ONLYDIR) );
mssql_query("update profile_count set profile_count='$total_items',page_count='$r'");
$uni=mssql_fetch_array(mssql_query("select * from profile_count"));
$profile_count=$uni['profile_count'];
$page_count=$uni['page_count'];

$uni=mssql_fetch_array(mssql_query("select COUNT(distinct University) as uni from employee_details d
join employee_master m on d.emp_id=m.employee_id
where m.Department in ('$dpt1')"));
$university=$uni['uni'];
mssql_query("update menu_master set nos='$university' where menu_code='UNIVERSITY'");
$state=mssql_fetch_array(mssql_query("select COUNT (distinct State_of_Origin) as state from employee_master"));
$state1=$state['state'];
mssql_query("update menu_master set nos='$state1' where menu_code='STATES'");
$Department=mssql_fetch_array(mssql_query("select COUNT (distinct Department) as Department from employee_master"));
$Department1=$Department['Department'];
mssql_query("update menu_master set nos='$Department1' where menu_code='DEPARTMENT'");


?>
<footer class="w3-container w3-teal" style="position: fixed;width: 100%;z-index: 99999;bottom: 0;height: 40px;">
       
        <center style="margin:10px;"><strong>Copyright © 2017-2018 <a href="http://www.bluebase.in" target="_Blank" style="color:white;">Bluebase Software Services Pvt. Ltd. </a> </strong><?php echo "<span style='color:white;float:right;'>Profile Count - <b>$profile_count</b>, Page Count - <b>$page_count</b></span>"; ?></center>
		
</footer>