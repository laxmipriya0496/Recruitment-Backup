<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$search1=$_REQUEST['employee_name'];

 $cus=mssql_query("select * from employee_master where Name like '%$search1%' or employee_id like '%$search1%' or Phone_Number like '%$search1%'");
$cn=mssql_num_rows($cus);
$rs1=1;
?>
			 <ul class="nav nav-pills" style="float:left;max-height:450px;overflow-y:scroll; width:100%; " >
				  <?php 
				  while($item_res=mssql_fetch_array($cus))
				  {
				  ?>
                  <li style="border-top:1px solid #ddd; cursor:pointer;width:97%;"  class="active1" onClick="clicked(this.id);" id="<?php echo $rs1;?>" > 
							<input type="hidden" name="invoice" id="invoice<?php echo $rs1;?>" value="<?php echo $item_res['id'];?>"  />
							<?php $rs1++;?>
							<div id="attrib-advanced" class="tab-pane active">
								<div style="position:relative; color:blue; float:left; line-height: 80px;">
									<b><img alt=" img" class="user-image" src="../images/profile/user.png" height="70" width="80"></b>
								</div><br>
					 			<div style="text-transform: uppercase;font-size: 16px;padding-top: 1px;color: #000;line-height: 18px; font-weight:bold;float:right; position:relative;" >
									<span style="font-weight:bold;font-size:13px;">
									<?php 
										echo $item_res['employee_id'];
									?>
								</div><br>
								<div class="emp_name">
									<div style="text-transform: uppercase;line-height: 18px; font-weight:bold;float:right; position:relative;" >&nbsp;||
										<span style="font-weight:normal;font-size:12px; color:#0000ff;">
										<?php echo $item_res['Name'];?> </span>
									</div>
								</div><br>		
								<div class="date">
									<div style="text-transform: uppercase;line-height: 18px; font-weight:bold;float:right; position:relative;" >&nbsp;||
										<span style="font-weight:normal;font-size:12px; color:#0000ff;">
										<?php echo $item_res['Phone_Number'];?> </span>
									</div>
								</div>								
							</div>
							</li>
				  <?php }
		   ?>
      
                  
                 </ul>

