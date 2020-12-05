<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Remote Filtering on DataGrid - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Remote Filtering on DataGrid</h2>
    <div class="demo-info" style="margin-bottom:10px">
        <div class="demo-tip icon-tip">&nbsp;</div>
        <div>This sample shows how to apply remote filtering and pagination on a datagrid component.</div>
    </div>
    
    <table id="dg" title="DataGrid" style="width:700px;height:250px">
        <thead>
            <tr>
                <th data-options="field:'itemid',width:80">Item ID</th>
                <th data-options="field:'productid',width:100">Product</th>
                <th data-options="field:'listprice',width:80,align:'right'">List Price</th>
                <th data-options="field:'unitcost',width:80,align:'right'">Unit Cost</th>
                <th data-options="field:'attr1',width:250">Attribute</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript" src="datagrid-filter.js"></script>
    <script type="text/javascript">
        $(function(){
            var dg = $('#dg').datagrid({
                url: 'datagrid33_getdata.php',
                pagination: true,
                remoteFilter: true,
                rownumbers: true
            });
            dg.datagrid('enableFilter', [{
                field:'listprice',
                type:'numberbox',
                options:{precision:1},
                op:['less','greater']
            },{
                field:'unitcost',
                type:'numberbox',
                options:{precision:1},
                op:['less','greater']
            }]);
        });
    </script>
</body>
</html>