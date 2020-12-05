<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$emp_id=$_REQUEST['emp_id'];
		$cus=mssql_query("select * from employee_master where id='$emp_id'");
		while($item1=mssql_fetch_array($cus))
		{
		?>
				<div id="rav" style="margin:5px;">
                <div id="rs">
				
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-family:Times New Roman;font-weight:bold;">Employee Master</h3>
	  					<div id="xx">
						<?php  
						$emp=mssql_fetch_array(mssql_query("select d.view_only from role_detail d 
join role_master m on m.code=d.code
join role_mapping rm on rm.code=m.code
join user_master um on um.user_id=rm.user_id
join menu_master mm on mm.id=d.menu_id
where um.user_id='$user' and d.view_only in ('All','View','') and mm.menu_name='EMPLOYEE MASTER'"));
$view=$emp['view_only'];
						if($view=="All" || $view=="View")
						{
						?>
						<a href="doucuments.php?id=<?php echo $emp_id;?>" target="_blank">
						<input type="button" value="View Documents" class="btn btn-primary"/></a>
						<?php
						}						
						if($view=="All")
						{
						?>
						<a class="red" href="employeemasternew.php">
						<span class="pencil1"><i class="fa fa-plus"></i></span>New</a>
						<a class="green" href="employeemasteredit.php?id=<?php echo $emp_id;?>">
						<span class="pencil"><i class="fa fa-pencil"></i></span>Edit</a>
						<a class="red" href="delete.php?id=<?php echo $emp_id;?>">
						<span class="pencil1"><i class="fa fa-trash"></i></span>Remove</a>
						<?php } ?>
						</div>
                </div><!-- /.box-header -->
				<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif">
					<tbody>
						<tr>
						<?php
				$col=mssql_query("SELECT name,type FROM sys.columns n join field_mapping f on n.name=f.field_name WHERE object_id = OBJECT_ID('dbo.employee_master') and name not in 
('id','created_by','created_on','modified_by','modified_on') and f.status=0 order by f.order_by");
$r=1;
					while($col1=mssql_fetch_array($col))
					{
				?>
						<td><?php echo ucfirst(str_replace("_"," ",$col1['name'])); ?></td>
						<?php if($col1['type']=="date") 
						{
							?>
						<td><input type="text" name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" class="form-control" value="<?php echo date("d-m-Y",strtotime($item1[$col1['name']])); ?>" readonly ></td>
						
						<?php
						}
						elseif($col1['name']=="employee_id") 
						{
							?>
						<td><input type="text" name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" class="form-control" value="<?php echo $eid=$item1[$col1['name']]; ?>" readonly ></td>
						
						<?php
						}
						elseif(stripos($col1['name'], 'address') !== FALSE)
						{?>
						<td><textarea name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" rows="3" cols="40" readonly class="form-control" style="resize:none;"><?php echo $item1[$col1['name']]; ?></textarea></td>
<?php
						}
						else
						{?>
						<td><input type="text" name="<?php echo $col1['name']; ?>" id="<?php echo $col1['name']; ?>" readonly class="form-control" value="<?php echo $item1[$col1['name']]; ?>"  ></td>
						
						<?php }if($r%2==0)
					{
						?>
						</tr><tr>
						<?php
					}
						$r++;
	
						}?>
						</tr>
					</tbody>
				</table>
				
				<table class="table table-hover table-bordered" style="font-family:'Times New Roman', Times, serif">
					<tbody>
					<tr style="color:blue;">
						<th style="text-align:center;">Branch of Education</th>
						<th style="text-align:center;">Type of Education</th>
						<th style="text-align:center;">University</th>
						<th style="text-align:center;">Graduation</th>
					</tr>
					<?php  
					$empde=mssql_query("select * from employee_details where emp_id='$eid'");
					while($empde1=mssql_fetch_array($empde))
					{
						?>
						<tr>
							<td><input type="text" name="Branch_of_Education" id="Branch_of_Education" class="form-control" value="<?php echo $eid=$empde1['Branch_of_Education']; ?>" readonly ></td>
							<td><input type="text" name="type_of_education" id="type_of_education" class="form-control" value="<?php echo $empde1['type_of_education']; ?>" readonly ></td>
							<td><input type="text" name="University" id="University" class="form-control" value="<?php echo $eid=$empde1['University']; ?>" readonly ></td>
							<td><input type="text" name="Graduation" id="Graduation" class="form-control" value="<?php echo $empde1['Graduation']; ?>" readonly ></td>
						</tr>
						<?php
					}
					?>
					
					</tbody>
				</table>
		<?php } ?>