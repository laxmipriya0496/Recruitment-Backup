<?php 
/* Count Files */
$i = -1; 
$dir = new DirectoryIterator('Master/Documents');
foreach ($dir as $fileinfo) 
{
    if ($fileinfo->isDir() && !$fileinfo->isDot()) 
	{
        $fileinfo->getFilename().'<br>';
		$dir = 'Master/Documents/'.$fileinfo;
		if ($handle = opendir($dir)) 
		{
			while (($file = readdir($handle)) !== false)
			{
				if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
				$i++;
			}
		}
    }
}
echo "There were $i files<br>";


echo $total_items  = count( glob("Master/Documents/*", GLOB_ONLYDIR) );
echo "<br>";

/* get file name */
/* foreach(glob('images/*.*') as $filename)
{
echo "<br>";
echo $filename;
} */
?>