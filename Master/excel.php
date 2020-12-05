<?php
require ("../configuration.php");
require ("../user.php");
$name=$_REQUEST['field'];
$value=$_REQUEST['value'];

$name1=explode(",",$name);
$value1=explode(",",$value);
//print_r($name1);
$cnt=count($name1)-1;
?>
    <script src="<?php echo URL;?>js/jquery.min.js"></script>
<div id="divTableDataHolder">
<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif" border=1 name="excel" id="excel">
<thead>
	<tr style="color:blue;">
	<th>S.No</th>
	<?php
	for($r=0;$r<$cnt;$r++)
	{
		?>
		<th><?php echo ucwords(str_replace("_"," ",$name1[$r])); ?></th>
		<?php
	}
	?>
	</tr>
	</thead>
<?php

for($i=0;$i<$cnt;$i++)
{
	if($value1[$i]!="")
	{
		$con[]="and ".$name1[$i]." like '%".$value1[$i]."%'";
	}
	else
	{
		$con[]="";
	}
}
echo $con;
$rs=implode(" ",$con);
$cus=mssql_query("select * from employee_master m join employee_details d on m.employee_id=d.emp_id
where 1=1 $rs order by Graduation desc");
$v=1;
while($c=mssql_fetch_array($cus))
{
	?><tr>
	<td><?php echo $v++; ?></td><?php
	for($a=0;$a<$cnt;$a++)
	{
	?>
		<td><?php echo $c[$name1[$a]]; ?></td>
	<?php
	}?>
	
	</tr><?php
}
?></table>
</div>
	<script>
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=divTableDataHolder]').html()));
			e.preventDefault();
</script>

<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worsheet', table: table.innerHTML}
	
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script> 