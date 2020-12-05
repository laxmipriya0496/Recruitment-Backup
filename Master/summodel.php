<?php
 require("../configuration.php");
 $category_name=$_REQUEST['category_name'];
 $po_number=$_REQUEST['po_number'];
 ?>
 <table border="1" class="table table-hover" id="summarySplitTable" style="font-family:'Times New Roman', Times, serif;">
<thead>
			<CAPTION>	<center><h2>Employee Downloads</h2>
				<h5> Employee Code : <?php echo $category_name;?> &emsp;&emsp;&emsp;Employee Name : <?php echo $po_number;?> &emsp;&emsp;&emsp; </h5>
				</center></CAPTION>
					<tr style="color:blue;">
						<th>S.No</th>
						<th>Description</th>
						<th></th>
					</tr>
			</thead>
<tbody>	
<?php $s=1; $sql=mssql_query("select * from upload_master where emp_id='$category_name'");
while($re1=mssql_fetch_array($sql))
{
	?>
<tr>
<td><?php echo $s++;?></td>
<td><?php echo $re1['description'];?></td>
<td><a href='<?php echo $re1['filepath']; ?>' style="color:blue;" target="_blank">Download</a></td>
</tr><?php
}
?>
</tbody>
</table>