<?php

class PDF extends FPDI
{

} 



    $pdffile = "Puducherry.pdf";
    $pagecount = $pdf->setSourceFile($pdffile);  
    for($i=0; $i<$pagecount; $i++){
        $pdf->AddPage();  
        $tplidx = $pdf->importPage($i+1, '/MediaBox');
        $pdf->useTemplate($tplidx, 10, 10, 200); 
    }

/* $file =  system('pdftotext Puducherry.pdf 2>&1');;
$searchfor = 'S Govindarajan';

// the following line prevents the browser from parsing this as HTML.
header('Content-Type: text/plain');

// get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($file);
// escape special characters in the query
$pattern = preg_quote($searchfor, '/');
// finalise the regular expression, matching the whole line
$pattern = "/^.*$pattern.*\$/m";
// search, and store all matching occurences in $matches
if(preg_match_all($pattern, $contents, $matches)){
   echo "Found matches:\n";
   echo implode("\n", $matches[0]);
}
else{
   echo "No matches found";
} */

?>