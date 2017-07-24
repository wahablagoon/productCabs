$(document).ready(function(){
	var user_listing_table = $('#user_listing').DataTable({
    "bLengthChange": false,
    "bInfo": false,
});
	 $('#search').on('keyup',function(){
    user_listing_table.search($(this).val()).draw() ;
});
	
	$( "#user_listing_filter" ).append('<span class="glyphicon glyphicon-search form-control-feedback"></span>');

	$(".switch").change(function(){
		var val=$(this).attr("data-value");
		if(val==1)
		{
			$(this).attr("data-value","0");
			$("#site_status").attr("value","0");
			$(".site_status").removeClass("success");
			$(".site_status").addClass("error");
			$(".site_status").html("Site is on Maintanence..");
		}
		else
		{
			$(this).attr("data-value","1");
			$("#site_status").attr("value","1");
			$(".site_status").addClass("success");
			$(".site_status").removeClass("error");
			$(".site_status").html("Site is working :) ");
		}
	})

	$("#upload_logo").change(function() {
		$("#ul").submit();
    });
	$("#upload_icon").change(function() {
		$("#ui").submit();
    });

	$("#update_color").click(function(){
		var url="set_sitecolor";
	    var color=$("#site_color").val();
	    $.ajax(
	         {
	            type:"POST",
	            cache:false,
	            url: url, 
	            data : {
	               "_token": $('meta[name="_token"]').attr('content'),
	               "color":color
	            },
	            success: function(result){
	                  window.location.href = "settings";
	            }
	        });
	})

})