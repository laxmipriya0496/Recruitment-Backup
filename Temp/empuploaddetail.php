 <?php
 require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$id=explode("-",$_REQUEST['id']);
$em_id=$id[0];
$rs=mssql_fetch_array(mssql_query("select * from temp_employee_master where temp_employee_id='$em_id'"));
$flag=$rs['flag'];
if($flag==null)
{
?>
<table width="100%"  class="table table-striped" id="upload">
				  <tbody>
	<tr id="rw1">
		<td>Type</td>
	<td><select name="type[]" id="type1" class="form-control" onchange="change(this.value,this.id)" required>
	<option value="">SELECT</option>
	<?php $rs=mssql_query("select * from proofupload_master order by id desc"); 
			while($rs1=mssql_fetch_array($rs))
			{
				?> <option value="<?php echo $rs1['proof_name']; ?>">  <?php echo $rs1['proof_name']; ?> </option><?php
			}				?>
	</select></td>
	<td>Upload</td><td>
<input type='file' name='userFile1' id='userFile1' required> </td> </tr>
		<div style="float:right;"><input type="submit" value="Upload" class="btn btn-success"/>&nbsp;
				<input type="button" class=" btn btn-success add_new" value="Add new" > </div>
				</tbody>
				<input type="hidden" name="test">
			   </table>
<?php } ?>
 <script language="javascript">
 $('.add_new').click(function(){
	var len=$('#upload tr').length;
	//alert(len);
	len=len+1;
	
	 $('.table-striped').append('<tr class="row_'+len+'"><td>Type</td><td><select name="type[]" id="type'+len+'" class="form-control" onchange="change(this.value,this.id)" required>	<option value="">SELECT</option><?php $rs=mssql_query("select * from proofupload_master order by id desc"); while($rs1=mssql_fetch_array($rs)){?> <option value="<?php echo $rs1['proof_name']; ?>">  <?php echo $rs1['proof_name']; ?> </option><?php }?></select></td><td>Upload</td><td><input type="file" name="userFile'+len+'" id="userFile'+len+'" required> </td> </tr></tr>');
	//alert("test");
});
</script>