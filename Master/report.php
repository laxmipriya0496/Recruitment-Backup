<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$cus12=mssql_query("SELECT UPPER(REPLACE(a.name,'_',' ')) as allup,upper(substring(REPLACE(a.name,'_',' '), 1, 1)) + substring(REPLACE(a.name,'_',' '),
2,LEN(a.name)) as firstup,a.name FROM sys.columns a
join field_configure s on a.name=s.name WHERE object_id = OBJECT_ID('dbo.employee_master') and a.name  in 
(select name from field_configure) order by s.order_by");
$cus121=mssql_query("SELECT UPPER(REPLACE(a.name,'_',' ')) as allup,upper(substring(REPLACE(a.name,'_',' '), 1, 1)) + substring(REPLACE(a.name,'_',' '),
2,LEN(a.name)) as firstup,a.name FROM sys.columns a
join field_configure s on a.name=s.name WHERE object_id = OBJECT_ID('dbo.employee_master') and a.name  in 
(select name from field_configure) order by s.order_by");
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>MRF</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo URL;?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL;?>css/font-awesome-animation.css">
  <link rel="stylesheet" href="<?php echo URL;?>menu/style.css">  
  <link rel="stylesheet" href="<?php echo URL;?>css/w3.css"> 
  <link href="<?php echo URL;?>css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/easyui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/demo.css">
    <script type="text/javascript" src="<?php echo URL;?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>js/jquery.easyui.min.js"></script>
	<style>
	.panel.panel-htop.easyui-fluid {
    width: 100%!important;
	}
	.easyui-panel.panel-body.panel-body-noheader{
		width:8%!important;
	}
	</style>
</head>
<body>
	<?php
		require ("../header.php");
	?>
<div class="wrapper" style=" width: 98%; margin:0 auto;">
	<div class="row">
		<div class="col-md-12" style="margin-top:3%;margin-bottom:3%;">
    <div class="easyui-panel" style="padding:5px;width:10%;float:right;">
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-more'">Column</a>
    </div>
    <div id="mm1" style="width:200px;">
	<?php
	while($rs1=mssql_fetch_array($cus121))
		{
			?>
			&nbsp;<input type="checkbox" name="<?php echo $rs1['name']; ?>" id="<?php echo $rs1['name']; ?>">&emsp;<?php echo $rs1['name']; ?><br>
			<?php
		}
	?>
	&nbsp;<input type="checkbox" name="Age" id="Age">&emsp;Age<br>
	&nbsp;<input type="checkbox" name="Experience" id="Experience">&emsp;Experience<br>
	<!--&nbsp;<input type="checkbox" name="University" id="University">&emsp;University<br>
	&nbsp;<input type="checkbox" name="Graduation" id="Graduation">&emsp;Graduation<br>-->
		<br>&emsp;&emsp;&emsp;<input type="button" name="check_box" id="check_box" value="Submit" class="btn btn-info btn-sm" >
	
    </div><input type="hidden" name="val" id="val">
           <table id="dg" title="DataGrid" style="width:100%;height:540px;" data-options="data:data,
				rownumbers:true,
				singleSelect:true,toolbar:toolbar">
        <thead>
		<!--<tr> <td COLSPAN=12 data-options="field:'S.No',width:30">Print</td></tr>-->
		<tr>
		<?php
		while($rs=mssql_fetch_array($cus12))
		{
			if($rs['name']=="Date_Of_Birth")
			{
				?><th data-options="field:'<?php echo $rs['name']; ?>',width:100" sortable="true" ><?php echo $rs['allup']; ?></th>
				<th data-options="field:'Age',width:100" sortable="true" >AGE</th>
				<?php
			}
			else
			{
				?>
			<th data-options="field:'<?php echo $rs['name']; ?>',width:100" sortable="true" ><?php echo $rs['allup']; ?></th>
			<?php
			}
			
			$fidnam[]=$rs['name'];
		}
		?>
		
		<th data-options="field:'Experience',width:100" sortable="true" >EXPERIENCE</th>
		<th data-options="field:'view',width:100">VIEW</th>
            </tr>
			<?php 
			$allname1=implode(",",$fidnam);
			$allname=$allname1.",Age,Experience";
				?>
        </thead>
    </table>
		</div>
	</div>
	<div id="excel" style="display:none;"></div>
</div>
<?php include('../footer.php'); 
$dataPoints1='[';
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
$dep=implode("','",explode(",",$u['department']));

	if($dep!="All")
	{
		$dt="where Department in('$dep')";
	}
	else
	{
		$dt="";
	}
$u1=mssql_query("select *,id as did from employee_master $dt order by id desc");
$r=1;
$s=0;
while($c=mssql_fetch_array($u1))
{
	if($r==1)
	{
		$dataPoints1.='{"S.No":"'.$r++.'"';
	}
	else
	{
		$dataPoints1.=',{"S.No":"'.$r++.'"';
	}
	$cnt=count($fidnam);
	for($i=0;$i<$cnt;$i++)
	{
		if($fidnam[$s]=="Date_Of_Birth")
		{
			$va=$c[$fidnam[$s]];
			if($va!=null)
			{
				$dataPoints1.=',"'.$fidnam[$s].'":"'.date("d-m-Y",strtotime($c[$fidnam[$s++]])).'"';
				$y=date_diff(date_create($va), date_create('today'))->y;
				$m=date_diff(date_create($va), date_create('today'))->m;
				$d=date_diff(date_create($va), date_create('today'))->d;
				$dt=str_pad($y, 2, '0', STR_PAD_LEFT)."Y ".str_pad($m, 2, '0', STR_PAD_LEFT)."M ".str_pad($d, 2, '0', STR_PAD_LEFT)."D ";
				//$dt=$y."Y ";
				$dataPoints1.=',"Age":"'.$dt.'"';
			}
			else
			{
				$dataPoints1.=',"'.$fidnam[$s].'":"'.$c[$fidnam[$s++]].'"';
				$dataPoints1.=',"Age":""';
			}
		}
		elseif($fidnam[$s]=="Date_of_Joining")
		{
			$va=$c[$fidnam[$s]];
			if($va!=null)
			{
				$dataPoints1.=',"'.$fidnam[$s].'":"'.date("d-m-Y",strtotime($c[$fidnam[$s++]])).'"';
				$y=date_diff(date_create($va), date_create('today'))->y;
				$m=date_diff(date_create($va), date_create('today'))->m;
				$d=date_diff(date_create($va), date_create('today'))->d;
				$dt=str_pad($y, 2, '0', STR_PAD_LEFT)."Y ".str_pad($m, 2, '0', STR_PAD_LEFT)."M ".str_pad($d, 2, '0', STR_PAD_LEFT)."D ";
				$dataPoints1.=',"Experience":"'.$dt.'"';
			}
			else
			{
				$dataPoints1.=',"'.$fidnam[$s].'":"'.$c[$fidnam[$s++]].'"';
				$dataPoints1.=',"Experience":""';
			}
		}
		else
		{
			$dataPoints1.=',"'.$fidnam[$s].'":"'.$c[$fidnam[$s++]].'"';
		}
		
	}
	$dataPoints1.=',"view":"<a href=' . "doucuments.php?id=".$c['did'].'>All Document</a>"';
	$dataPoints1.='}';
	$s=0;
}
$dataPoints1.=']';
//$dataPoints1='';
/* 
[{"S.No":"1","employee_id":"50296","Name":"G.Selva Kumar","Department":"Human Resources","Phone_Number":" ","Pan_Number":" ","Date_Of_Birth":"1982-05-30","Aadhar":"","Gender":"Male","Religion":"Hindu","Blood_Group":" ","State_of_Origin":"Tamilnadu"}] */
 ?>
 
<script type="text/javascript" src="datagrid-filter.js"></script>
    <script type="text/javascript">
        var data = <?php echo $dataPoints1; ?>;
        $(function(){
            var dg = $('#dg').datagrid({pagination:true,remoteSort:false});
            dg.datagrid('enableFilter', [{
                field:'Gender',
                type:'combobox',
                options:{
                    panelHeight:'auto',
                    data:[{value:'',text:'All'},{value:'Male',text:'Male'},{value:'Female',text:'Female'}],
                    onChange:function(value){
                        if (value == ''){
                            dg.datagrid('removeFilterRule', 'Gender');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'Gender',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                    }
                }
            }]);
        });
    </script>
</body>
</html>
	<script type="text/javascript">
	 var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','New User');
            $('#fm').form('clear');
            url = 'save_user.php';
        }
		var toolbar = [{
			text:'Print',
			iconCls:'icon-print',
			handler:function()
			{
				var field=$("#val").val();
				var val=[];
				var name='<?php echo $allname; ?>';
				if(field=="")
				{
					field=name;
				}
				var result = name.split(',');
				var cnt=result.length;
				for(var i=0;i<cnt;i++)
				{
					var temp=$("input[name="+result[i]+"]").val();
					val.push(temp);
				}
				$.ajax
				({
					type: "GET",
					url: "print.php",
					data: "name=" + name + "&value=" + val + "&field=" + field,		 
					success: function(data)
					{
						 var printContents = data;
						 var originalContents = document.body.innerHTML;
						 document.body.innerHTML = printContents;
						 window.print();
						 document.body.innerHTML = originalContents;
						 location.reload();
					}
				});	
			}
		},'-',{
			text:'Excel',
			iconCls:'icon-save',
			handler:function()
			{
				var field=$("#val").val();
				var val=[];
				var name='<?php echo $allname; ?>';
				if(field=="")
				{
					field=name;
				}
				var result = name.split(',');
				var cnt=result.length;
				for(var i=0;i<cnt;i++)
				{
					var temp=$("input[name="+result[i]+"]").val();
					val.push(temp);
				}
				$.ajax
				({
					type: "GET",
					url: "excel.php",
					data: "name=" + name + "&value=" + val + "&field=" + field,		 
					success: function(data)
					{
						$("#excel").html(data);
					}
				}); 
				
						//location.reload();
			}
		}];
	</script>
	<script>
		$("[id$=myButtonControlID]").click(function(e) {
			
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=divTableDataHolder]').html()));
			e.preventDefault();
			
		});
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
<script> 
function hidden() {
	alert("test");
    $('#dg').datagrid('hideColumn', 'Date_Of_Birth');
}

function showColumn() {
    $('#dg').datagrid('showColumn', 'ck');
}
</script>
<script>
$(document).ready(function() {
    $("#check_box").click(function()
	{
		var rs="";
		var name='<?php echo $allname; ?>';
		//alert(name);
		var result = name.split(',');
		var cnt=result.length;
		for(var i=0;i<cnt;i++)
		{
			if ($("#"+result[i]).prop('checked')==true)
			{ 
				$('#dg').datagrid('showColumn', result[i]);
				rs=rs+result[i]+",";
			}
			else
			{
				$('#dg').datagrid('hideColumn', result[i]);
			}
		}
		$("#val").val(rs);
		//alert("test");
    }); 
});
</script>