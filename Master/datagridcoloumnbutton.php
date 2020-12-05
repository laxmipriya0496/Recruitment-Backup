<?php
require ("../configuration.php");
require ("../user.php");
$user=$_SESSION['user'];
$username=$_SESSION['user_name'];
$u=mssql_fetch_array(mssql_query("select * from department_mapping where user_id='$user'")); 
	$dep=implode("','",explode(",",$u['department']));
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>MRF</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="<?php echo URL;?>js/jquery.min.js"></script>
 
<!--  BOOTSTRAP -->
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/bootstrap.min.css">
<script type="text/javascript" src="<?php echo URL;?>js/bootstrap.min.js"></script>
 
<!--  JQUERY-UI (only sortable and datepicker is needed) -->
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/jquery-ui.min.css">
<script type="text/javascript" src="<?php echo URL;?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/jquery.ui.touch-punch.min.js"></script>
  
<!--  PAGINATION plugin -->
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/jquery.bs_pagination.min.css">
<script type="text/javascript" src="<?php echo URL;?>js/jquery.bs_pagination.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/localization.en.min.js"></script>
 
<!--  FILTERS plugin --> 
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/jquery.jui_filter_rules.bs.css">
<script type="text/javascript" src="<?php echo URL;?>js/jquery.jui_filter_rules.js"></script>
<!--  required from filters plugin -->
<script type="text/javascript" src="<?php echo URL;?>js/moment.min.js"></script>
 
<!--  DATAGRID plugin -->
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/jquery.bs_grid.min.css">
<script type="text/javascript" src="<?php echo URL;?>js/jquery.bs_grid.min.js"></script>
<!--  Just create a div and give it an ID -->
 
<div id="demo_grid1"></div>
<script>
$(function() {
 
    $("#demo_grid1").bs_grid({
 
        ajaxFetchDataURL: "ajax_fetch_page_data.php",
        row_primary_key: "customer_id",
 
        columns: [
            {field: "customer_id", header: "Code", visible: "no"},
            {field: "lastname", header: "Lastname"},
            {field: "firstname", header: "Firstname"},
            {field: "email", header: "Email", visible: "no", "sortable": "no"},
            {field: "gender", header: "Gender"},
            {field: "date_updated", header: "Date updated"}
        ],
 
        sorting: [
            {sortingName: "Code", field: "customer_id", order: "none"},
            {sortingName: "Lastname", field: "lastname", order: "ascending"},
            {sortingName: "Firstname", field: "firstname", order: "ascending"},
            {sortingName: "Date updated", field: "date_updated", order: "none"}
        ],
 
        filterOptions: {
            filters: [
                {
                    filterName: "Lastname", "filterType": "text", field: "lastname", filterLabel: "Last name",
                    excluded_operators: ["in", "not_in"],
                    filter_interface: [
                        {
                            filter_element: "input",
                            filter_element_attributes: {"type": "text"}
                        }
                    ]
                },
                {
                    filterName: "Gender", "filterType": "number", "numberType": "integer", field: "lk_genders_id", filterLabel: "Gender",
                    excluded_operators: ["equal", "not_equal", "less", "less_or_equal", "greater", "greater_or_equal"],
                    filter_interface: [
                        {
                            filter_element: "input",
                            filter_element_attributes: {type: "checkbox"}
                        }
                    ],
                    lookup_values: [
                        {lk_option: "Male", lk_value: "1"},
                        {lk_option: "Female", lk_value: "2", lk_selected: "yes"}
                    ]
                },
                {
                    filterName: "DateUpdated", "filterType": "date", field: "date_updated", filterLabel: "Datetime updated",
                    excluded_operators: ["in", "not_in"],
                    filter_interface: [
                        {
                            filter_element: "input",
                            filter_element_attributes: {
                                type: "text",
                                title: "Set the date and time using format: dd/mm/yyyy hh:mm:ss"
                            },
                            filter_widget: "datetimepicker",
                            filter_widget_properties: {
                                dateFormat: "dd/mm/yy",
                                timeFormat: "HH:mm:ss",
                                changeMonth: true,
                                changeYear: true,
                                showSecond: true
                            }
                        }
                    ],
                    validate_dateformat: ["DD/MM/YYYY HH:mm:ss"],
                    filter_value_conversion: {
                        function_name: "local_datetime_to_UTC_timestamp",
                        args: [
                            {"filter_value": "yes"},
                            {"value": "DD/MM/YYYY HH:mm:ss"}
                        ]
                    }
                }
            ]
        }
    });
 
});
</script>
<script>
/**
 * Convert local timezone date string to UTC timestamp
 *
 * Alternative syntax using jquery (instead of moment.js):
 *     var date = $.datepicker.parseDateTime(dateformat, timeformat, date_str);
 *
 * @see http://stackoverflow.com/questions/948532/how-do-you-convert-a-javascript-date-to-utc
 * @param {String} date_str
 * @param {String} dateformat
 * @return {String}
 */
function local_datetime_to_UTC_timestamp(date_str, dateformat) {
 
    // avoid date overflow in user input (moment("14/14/2005", "DD/MM/YYYY") => Tue Feb 14 2006)
    if(moment(date_str, dateformat).isValid() == false) {
        throw new Error("Invalid date");
    }
 
    // parse date string using given dateformat and create a javascript date object
    var date = moment(date_str, dateformat).toDate();
 
    // use javascript getUTC* functions to conv ert to UTC
    return  date.getUTCFullYear() +
        PadDigits(date.getUTCMonth() + 1, 2) +
        PadDigits(date.getUTCDate(), 2) +
        PadDigits(date.getUTCHours(), 2) +
        PadDigits(date.getUTCMinutes(), 2) +
        PadDigits(date.getUTCSeconds(), 2);
 
}
 
/**
 * Add leading zeros
 * @param {Number} n
 * @param {Number} totalDigits
 * @return {String}
 */
function PadDigits(n, totalDigits) {
    n = n.toString();
    var pd = '';
    if(totalDigits > n.length) {
        for(i = 0; i < (totalDigits - n.length); i++) {
            pd += '0';
        }
    }
    return pd + n.toString();
}
</script>
<?php
require_once 'dacapo.class.php'; // simple database wrapper
require_once 'jui_filter_rules.php';
require_once 'bs_grid.php';
$dataPoints1='[';
$cus12=mssql_query("SELECT UPPER(REPLACE(a.name,'_',' ')) as allup,upper(substring(REPLACE(a.name,'_',' '), 1, 1)) + substring(REPLACE(a.name,'_',' '),
2,LEN(a.name)) as firstup,a.name FROM sys.columns a
join field_configure s on a.name=s.name WHERE object_id = OBJECT_ID('dbo.employee_master') and a.name  in 
(select name from field_configure) order by s.order_by");
		while($rs=mssql_fetch_array($cus12))
		{
			$fidnam[]=$rs['name'];
		}
		
			$fidnam[]="Branch_of_Education";
			//$fidnam[]="type_of_education";
			$fidnam[]="University";
			//$fidnam[]="Graduation";
			$allname1=implode(",",$fidnam);
			$allname=$allname1.",Graduation";
$u1=mssql_query("select *,m.id as did from employee_master m join employee_details d on m.employee_id=d.emp_id
 where m.Department in('$dep')");
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
			$dataPoints1.=',"'.$fidnam[$s].'":"'.date("d-m-Y",strtotime($c[$fidnam[$s++]])).'"';
		}
		else
		{
			$dataPoints1.=',"'.$fidnam[$s].'":"'.$c[$fidnam[$s++]].'"';
		}
		
	}
	$dataPoints1.=',"Graduation":"<a href=' . "viewdou.php?id=".$c['did']."&sterm=University&key=".$c['Graduation'].'>'.$c['Graduation'].'</a>"';
	$dataPoints1.=',"view":"<a href=' . "doucuments.php?id=".$c['did'].'>All Document</a>"';
	$dataPoints1.='}';
	$s=0;
}
$dataPoints1.=']';
$data=$dataPoints1;
?>