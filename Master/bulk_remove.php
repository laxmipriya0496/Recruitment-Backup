<?php
 
$old = "Documents/614882";
$new = "Deleted_Profile/614882";

if (file_exists($old)) {
	if (file_exists($new)) {		
		$obj=scanDirectories($old);

			$count= count($obj);
			if($count==0){
				echo "No Data Available";
			}else{
			
				 for($i=0;$i<$count;$i++)
				 {
					//Get EXTENSION
					$oldfile_dir=$obj[$i];
					$file_name=explode('/',$obj[$i]);
					$dir=$new;
						
					if(is_dir($dir)){											
						  $newfile_dir=$dir.$file_name[2];
					}else{						 
						mkdir($dir,755);				
						$newfile_dir=$dir.$file_name[2];
					}
					
					chmod($newfile_dir,755)or die('Unable to Change Access');
					rename($oldfile_dir, $newfile_dir) or die('Unable to rename '.$oldfile_dir .' to '. $newfile_dir);			 
				 
				 }	
			
			}
	}
	else{
		echo "File Not Exists ".$new;
	}
}else{
	
	echo "File Not Exists ".$old;
} 

function scanDirectories($rootDir, $allData=array()) {
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
	if (file_exists($rootDir)) {
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) {
        // filter all files not accessible
        $path = $rootDir.'/'.$content;
        if(!in_array($content, $invisibleFileNames)) {
            // if content is file & readable, add to array
            if(is_file($path) && is_readable($path)) {
                // save file name with path
                $allData[] = $path;
            // if content is a directory and readable, add path and name
            }elseif(is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return  $allData;
	
}
 else {
    echo '<div class="alert alert-danger alert-dismissable">
  <a href="employeemaster.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Warning!</strong> The file <b>'.$rootDir. ' </b>does not exist.
</div>';
}
}


?>