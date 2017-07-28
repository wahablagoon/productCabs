$(document).ready(function(){
	$('.material_form  select').material_select();
	$('#btn-main').on('touchstart click', function() {
  if ($(this).hasClass('active')) {
    $(this).removeClass('active');         $(this).addClass('reverse-animation');
  } else {
    $(this).removeClass('reverse-animation');
    $(this).addClass('active');
  }
  
  return false;
});

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

	 $("#add_user").validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            phone: {
				required: true,
				numeric: true
			},
			email: {
				required: true,
				email: true
			},
			password: {
                required: true
            },
            city:"required",
            countrycode:"required"
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
     

	 $("#add_driver").validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            phone: {
				required: true,
				numeric: true
			},
			email: {
				required: true,
				email: true
			},
			password: {
                required: true
            },
            city:"required",
            countrycode:"required"
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
 
})