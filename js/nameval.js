function nameval(r,s,t,u,v)
{
	r=r.replace("+", "positive");
	r=r.replace("-", "negative");
	$.ajax
			({
				type: "GET",
				url: "../js/nameval.php",
				data: "val=" + r + "&table=" + t + "&colname=" + u,		 
				success: function(data)
				{
					if(data==1)
					{
						alert(v+" Already exit");
						$("#"+s).val("");
					}
					
   				}
			});
}