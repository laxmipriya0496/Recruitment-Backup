<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$name=$_REQUEST['name'];
?>
<table class="table table-hover" style="font-family:'Times New Roman', Times, serif;margin-bottom:50px;">
		<tr style="color:blue;">
			<th>Unversity Code</th>
			<th>Unversity Name</th>
			<th>Unversity Address</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
		<?php $uni=mssql_query("select *,case when (status=0) then 'Active' else 'Inactive' end as sta from university_master where university_name like ('%$name%') order by university_code asc");
	while($row=mssql_fetch_array($uni))
	{
?>
		<tr>
		<td><?php echo $row['university_code']; ?></td>
		<td><?php echo $row['university_name']; ?></td>
		<td><?php echo $row['university_address']; ?></td>
		<td><?php echo $row['sta']; ?></td>
		<td  align="center"><div style=" white-space: nowrap;"><a href="university_masteredit.php?id=<?php echo $row['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil fa-lg icon-white"></i></a></div></td>
		</tr>	
<?php
	}
	?>
	</table>