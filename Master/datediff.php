<?php
echo $va='2017-01-01';
echo "<br>";
echo $rs="2017-11-01";
echo "<br>";
echo $y=date_diff(date_create($va), date_create($rs))->y;
echo "<br>";
echo $m=date_diff(date_create($va), date_create($rs))->m;
echo "<br>";
echo $d=date_diff(date_create($va), date_create($rs))->d;
?>