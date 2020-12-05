
<?Php
$degrees = -90;  //change this to be whatever degree of rotation you want
 
header('Content-type: image/jpg');
 
$filename ="'".$_REQUEST['file']."'";  //this is the original file
 
$source = imagecreatefromjpeg($filename) or notfound();
$rotate = imagerotate($source,$degrees,0);
 
imagejpeg($rotate,$filename); //save the new image
 
imagedestroy($source); //free up the memory
imagedestroy($rotate);  //free up the memory
 
 
?>