<?php
 require("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];

   if(isset($_FILES['image'])){
      $errors= array();
	  $dir = 'upload/';
foreach(glob($dir.'*.*') as $v){
    unlink($v);
}
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("xlsx","xls","csv");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 55097152){
         $errors[]='File size must be excately 5 MB';
      }
      
      if(empty($errors)==true)
	  {
         move_uploaded_file($file_tmp,"upload/".$file_name);
		
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$excelFile = "upload/After Verification.xlsx";
 
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load($excelFile);
 
//Itrating through all the sheets in the excel workbook and storing the array data
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $arrayData[$worksheet->getTitle()] = $worksheet->toArray();
}

$sheet_count=count($arrayData['After Verification']);
//$sheet_count=$sheet_count-1;

for($j=1;$j<$sheet_count;$j++)
{
//echo $arrayData['After Verification'][$j][8];
$Name=str_replace("'","''",$arrayData['After Verification'][$j][0]);
$Pan_Number=str_replace("'","''",$arrayData['After Verification'][$j][1]);
$Phone_Number=str_replace("'","''",$arrayData['After Verification'][$j][2]);
$Address=str_replace("'","''",$arrayData['After Verification'][$j][3]);
$Joined_As=str_replace("'","''",$arrayData['After Verification'][$j][4]);
$Basic_Salary=str_replace(",","",$arrayData['After Verification'][$j][5]);
$Marks_Percentage=str_replace("%","",$arrayData['After Verification'][$j][6]);
$Organisation=str_replace("'","''",$arrayData['After Verification'][$j][7]);
$Date=$arrayData['After Verification'][$j][8];
echo $Date1=date("Y-m-d",strtotime($Date));
$Place=str_replace("'","''",$arrayData['After Verification'][$j][9]);
$Reg_No=str_replace("'","''",$arrayData['After Verification'][$j][10]);
$Degree=str_replace("'","''",$arrayData['After Verification'][$j][11]);

$date=date("Y-m-d");

  $sql= mssql_query("insert into employee_master(Name,Pan_Number,Phone_Number,Address,Joined_As,Basic_Salary,Marks_Percentage,Organisation,Date,Place,Reg_No,Degree,created_by,created_on) values('$Name','$Pan_Number','$Phone_Number','$Address','$Joined_As','$Basic_Salary','$Marks_Percentage','$Organisation','$Date1','$Place','$Reg_No','$Degree','$user','$date')");  

/* echo "insert into employee_master(Name,Pan_Number,Phone_Number,Address,Joined_As,Basic_Salary,Marks_Percentage,Organisation,Date,Place,Reg_No,Degree,created_by,created_on) values('$Name','$Pan_Number','$Phone_Number','$Address','$Joined_As','$Basic_Salary','$Marks_Percentage','$Organisation','$Date1','$Place','$Reg_No','$Degree','$user','$date')"; 
echo "<br>";  */
 }


      }else{
         print_r($errors);
      }
   }

   if($sql)
	{				
		?>
	<script> alert("sucessfully Uploaded");</script>	 
    <?php
	}	
else
	{
	?>
	<script> alert("Not Uploaded");</script>	 
    <?php
	}
	?>
	<script>window.location ="uploadmaster.php"</script> 
	<?Php
?>