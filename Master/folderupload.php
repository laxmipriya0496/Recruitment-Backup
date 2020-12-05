<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$datee=date("Y-m-d");
$Mydir = 'Documents/'; ### OR MAKE IT 'yourdirectory/';

foreach(glob($Mydir.'*', GLOB_ONLYDIR) as $dir) {
    $dir = str_replace($Mydir, '', $dir);
	foreach(glob('Documents/'.$dir.'/*.*') as $filename)
	{
	$ca=explode("/",$filename);
	$cat_name=explode("-",$ca[2]);
	$emp_code=$cat_name[0];
	$cat_name1=explode(".",$cat_name[1]);
	$cat_name2=$cat_name1[0];
	
	$rs=mssql_num_rows(mssql_query("select * from upload_master where filepath='$filename'"));
	
	if($rs!=1)
	{
		$rs=mssql_fetch_array(mssql_query("select * from proofupload_master where proof_code='$cat_name2'"));
		$rs1=$rs['proof_name'];
		mssql_query("INSERT INTO upload_master	(emp_id,description,filepath,created_by,created_on) VALUES ('$emp_code','$rs1','$filename','$user','$datee')");
	}
	}
}
?>