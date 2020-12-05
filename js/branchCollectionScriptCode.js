
	<script type="text/javascript" src="/COMMUTATION/js/bootstrap-datetimepicker.min.js"></script>  <!--date picker-->
    <script type="text/javascript" src="/COMMUTATION/js/bootstrap-datetimepicker.pt-BR.js"></script>  <!--date picker-->
	
	<script src="/COMMUTATION/js/jQuery.json-2.4.min.js"></script> <!--this is used to convert table to json array-->
	
<script>

/* date picker */
	

						
				
	 $('#datetimepicker').datetimepicker({
						format: "dd-MM-yyyy"
						});


	   $(document).ready( function () {
									
						$('#box-header').hide();
					$('#branchCollection').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "/COMMUTATION/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );
} );



  	function transferAmount()
		{
			
			
						var TableData;
						TableData = storeTblValues()
						TableData = $.toJSON(TableData);

								function storeTblValues()
									{
    									var TableData = new Array();

    												$('#branchCollection tr').each(function(row, tr){
        												TableData[row]={
														"regular amount" : $(tr).find('td:eq(3)').text()
														, "overdue amount" : $(tr).find('td:eq(4)').text()
            											, "branch id" : $(tr).find('td:eq(7)').text()
            											, "demand amount" :$(tr).find('td:eq(5)').text()
														, "collection amount" :$(tr).find('td:eq(6)').text()
        																}    
    												}); 
    									TableData.shift();  // first row will be empty - so remove
    									return TableData;
	
	
									}

							 $('#dc').html('<br><div style="text-align: center;"><img src="/UCO/images/loader.gif"></div>');
							
							 $.ajax({
    							type: "POST",
    							url: "/UCO/demandCollection/collection/processBranchCollection.php",
    							data: "pTableData=" + TableData+"&date="+ date + "&demand_month_no=" +demand_month_no ,
		 
    							success: function(msg){
        								// return value stored in msg variable
									if(msg==1)
										{
											alert("Branch Amount is not equal to collection entered amount");
										}
										else
										{
									
											/* This is used to redirect same page */
											
												$('#box-body').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
												$.post('/UCO/demandCollection/collection/branchCollection.php',function(data) {
														$('#box-body').html(data);
														});
											
										}
   													 }
								});
				
	
	
		}
		
		
	/* should allow only numbe*/
	
	$(".groupOfTexbox").bind('keypress', function (evt) {
     evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;										
	});	
		/* This is used to convert two decimal point value (1500.536 equal to 1500.54)*/
		
	
	
  </script>
 
 
