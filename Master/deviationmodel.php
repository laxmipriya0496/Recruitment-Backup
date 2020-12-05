<?php
 require("../configuration.php");
 $dept=$_REQUEST['dept'];
 $from_date=$_REQUEST['exp'];
 $to_date=$_REQUEST['type'];
 
 if($dept!="")
{
	$ps="and v.pass_no='$dept'";
}
else
{
	$ps="";
}
 if($from_date=="1970-01-01" or $to_date=="1970-01-01")
 {
	 $dt="";
 }
 else
 {
	 $dt="and v.date between '$from_date' and '$to_date'";
 }
 if($from_date=="1970-01-01" or $to_date=="1970-01-01")
 {
	 $dt="";
 }
 else
 {
	 $dt="and v.date between '$from_date' and '$to_date'";
 }
		$sql="select e.emp_code,e.emp_name,v.reasons,v.date,v.intime,v.outtime from vehicle_transactions v join employee_master e on v.pass_no=e.pass_no where 1=1 $dt $ps and v.reasons is not null and v.reasons<>'Allowed'";
$rs=mssql_query($sql);
if($rs!='')
{
 ?>
  <div class="printview" style="font-family:'Times New Roman', Times, serif">
					<td width="10%" ><input type="button" onclick="printDiv('printableArea1')" value="Print" class="btn btn-primary"/></td>
					<td width="10%"><input type="submit" name="myButtonControlID" id="myButtonControlID" class="btn btn-primary" value="EXCEL"></td>
				</div>
				
				<div id="printableArea1">
					<div id="divTableDataHolder1">
 <table border="1" class="table table-hover" id="summarySplitTable" style="font-family:'Times New Roman', Times, serif;">
                   <thead>
								<CAPTION>	<center><h2>Deviation Detailed Reports</h2>
										<tr style="color:blue;">
											
											<th>S.No</th>
											<th>Emp Code</th>
											<th>Emp Name</th>
											<th>Reason</th>
											<th>Date</th>
											<th>In Time</th>
											<th>Out Time</th>
					<?php 
$s=1;					
			while($re1=mssql_fetch_array($rs))
			 {
				 $emp_code=$re1['emp_code'];
				  $emp_name=$re1['emp_name'];
				   $reasons=$re1['reasons'];
				    $date=$re1['date'];
					 $intime=$re1['intime'];
					  $outtime=$re1['outtime'];
				?> <tr>
					
				<td><?php echo $s++; ?></td>
				<td><?php echo $emp_code; ?></td>
				<td><?php echo $emp_name; ?></td>
				<td><?php echo $reasons; ?></td>
				<td><?php echo $date; ?></td><td>
				<?php echo date("H:i",strtotime($intime)); ?>
				</td>
				<td><?php echo date("H:i",strtotime($outtime)); ?></td>
		 
				 </tr><?php
			 }
					?>
					
                    </tbody>
					
					</table>
<?php } 
else
{
	Echo "<h2>No Records Found</h2>";
}
	
?>
</div>
					</div>
					