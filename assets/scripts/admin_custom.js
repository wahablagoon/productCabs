$(document).ready(function(){

//autocomplete for driver city field
driver_city_autocomplete = new google.maps.places.Autocomplete((document.getElementById('city')),
            {types: ['geocode']});
driver_city_autocomplete.addListener('place_changed', fillInAddress);

function fillInAddress()
{
  var place = driver_city_autocomplete.getPlace();
  $("#driver_lat").val(place.geometry.location.lat());
  $("#driver_long").val(place.geometry.location.lng());

}

var map;
var redimage;

var greenimage;
var goldimage;
var bounds = new google.maps.LatLngBounds();
var infowindow = new google.maps.InfoWindow();    
function map()
{
     map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: {lat: -33.9, lng: 151.2}
    });
  $.ajax(
    {
    type: "POST",
    dataType: "json",
    url: APP_URL+"/getMap",
    data: { name: "mappage" },
    success: function(data) 
    { 
      redimage = APP_URL+"/assets/images/maps/red.png";
      goldimage = APP_URL+"/assets/images/maps/gold.png";
      greenimage = APP_URL+"/assets/images/maps/green.png";
      for(var ml=0;ml<data.length;ml++)
      {
        var mapimage;
        if(data[ml].status=="0")
        {
          mapimage=goldimage;
        }
        else
        {
          if(data[ml].online_status=="0")
          {
            mapimage=redimage;
          }
          else
          {
            mapimage=greenimage;
          } 
        }
        var latLng = new google.maps.LatLng(data[ml].lat, data[ml].long);
              marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: mapimage,
            title: data[ml].firstname,
              });
              google.maps.event.addListener(marker, 'click', (function(marker, ml) {
            return function() {
              infowindow.setContent(data[ml].infowindow);
              infowindow.open(map, marker);
            }
          })(marker, ml));
              bounds.extend(marker.position);
      }
      map.fitBounds(bounds);
    }
    });
}
if(window.location.href.indexOf("map") > -1) {
map();
    }


	$('.material_form  select').material_select();
	$('#btn-main').on('touchstart click', function() 
	{
  		if ($(this).hasClass('active')) 
  		{
    		$(this).removeClass('active');         
    		$(this).addClass('reverse-animation');
  		} 
  		else 
  		{
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
            name: {
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
            name: {
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

    $("#add_service").validate({
        rules: {
            category_name: {
                required: true
            },
            price_km: {
                required: true
            },
            price_minute: {
				required: true
			},
			max_size: {
				required: true
			},
			price_fare: {
                required: true
            },
            logo:"required",
            marker:"required"
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

	$("#edit_service").validate({
        rules: {
            category_name: {
                required: true
            },
            price_km: {
                required: true
            },
            price_minute: {
				required: true
			},
			max_size: {
				required: true
			},
			price_fare: {
                required: true
            }
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