$(document).ready(function(){
$('#expired').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d',
    autoclose: true
});

$("#ptype_per").click(function(){
$(".price_tag").html("%");
})
$("#ptype_price").click(function(){
$(".price_tag").html("$");
})


$("#close_promo").click(function(){
  var frm = document.getElementsByName('addpromo')[0];
  frm.reset();
  $('input[type=checkbox]').prop('checked', false);
})
$(".add_promo").click(function(){
  var frm = document.getElementsByName('addpromo')[0];
  frm.reset();
  $('input[type=checkbox]').prop('checked', false);
  $("#edity").val("no");
})

$(".view_edit_promo").click(function(){
  $("#edity").val("yes");
  var id=$(this).attr("data-id");
  $("#promo_id").val(id);
  var pid="#promo_"+id;
  $("#price").val($(pid).attr("data-amount"));
    $("#code").val($(pid).attr("data-code"));
  $("#expired").val($(pid).attr("data-expired"));
  if($(pid).attr("data-status")=="1")
  {
  $('input:checkbox[name="status"]').prop('checked', true);  
  } 
  else
  {
    $('input:checkbox[name="status"]').prop('checked', false);
  }
  
 
})

$("#add_promo").click(function(){

  var price=$("#price").val();
  var edit=$("#edity").val();
  var pid=$("#promo_id").val();
  var code=$("#code").val();
  var expired=$("#expired").val();
  var status=$(".switch").attr("data-value");
  var type=$('input[name="ptype"]:checked').val();
  if(status === undefined)
  {
    status=0;
  }

  if(code=="" || code==null)
  {
    Materialize.toast('Please enter promo !', 4000)
  }
  else if(expired=="")
  {
    Materialize.toast('Please select Expired date !', 4000)
  }
  else if(price=="" || parseInt(price)<=0)
  {
    Materialize.toast('Please enter price !', 4000)  
  }
  else
  {
    $('#add_promo').addClass('disabled');
    $.ajax({
      type: "POST",
      dataType: "json",
      url: APP_URL+"/addPromo",
      data: {id:pid,edit:edit,code: code,expired: expired,price: price,status:status,type:type},
      success: function(output){
        if(output[0].stats=="fail")
        {
          $('#add_promo').removeClass('disabled');
          Materialize.toast(output[0].errors, 4000)
        }
        else
        {
          var frm = document.getElementsByName('addpromo')[0];
          frm.reset();
          location.reload(); 
        }
      }
    });
  }
  
})


if(window.location.href.indexOf("surge") > -1) {

var input_start_peak = $('#start_peak').clockpicker({
  placement: 'bottom',
  align: 'left',
  autoclose: true,
  twelvehour:true,
  'default': 'now'
});

var input_end_peak = $('#end_peak').clockpicker({
  placement: 'bottom',
  align: 'left',
  autoclose: true,
  twelvehour:true,
  'default': 'now'
});

$("#close_peak").click(function(){
  var frm = document.getElementsByName('addpeak')[0];
  frm.reset();
  $('input[type=checkbox]').prop('checked', false);
})
$(".add_peak").click(function(){
  var frm = document.getElementsByName('addpeak')[0];
  frm.reset();
  $('input[type=checkbox]').prop('checked', false);
$("#edity").val("no");
})

$(".view_edit_peak").click(function(){
$("#edity").val("yes");
  var id=$(this).attr("data-id");
  $("#peak_id").val(id);
  var pid="#peaks_"+id;
  $("#price").val($(pid).attr("data-amount"));
  $("#start_peak").val($(pid).attr("data-start"));
  $("#end_peak").val($(pid).attr("data-end"));
$("#category").val($(pid).attr("data-category"));
$('#category').material_select();
  if(!$('input:radio[name="ptype"][value="' + $(pid).attr("data-type") + '"]').is(':checked'))
    $('input:radio[name="ptype"][value="' + $(pid).attr("data-type") + '"]').prop('checked', true);

  var res = $(pid).attr("data-days").split(","); 
  $('input[type=checkbox]').prop('checked', false);
  $(res).each(function(key, value){
    if(!$('input:checkbox[name="days[]"][value="' + value + '"]').is(':checked'))
      $('input:checkbox[name="days[]"][value="' + value + '"]').prop('checked', true);
  })
 
})

$("#add_peak").click(function(){
  var price=$("#price").val();
  var edit=$("#edity").val();
  var pid=$("#peak_id").val();
  var start_peak=$("#start_peak").val();
  var end_peak=$("#end_peak").val();
  var category=$("#category").val();
  var daystotal=$("#add_peak_popup").find('input[name="days[]"]:checked').length;
  var days = $("#add_peak_popup").find('input[name="days[]"]:checked').map(function() {return this.value;}).get().join(',');
  var type=$('input[name="ptype"]:checked').val();
 
  if(daystotal=="0")
  {
    Materialize.toast('Please select any  one days !', 4000)
  }
  else if(category=="" || category==null)
  {
    Materialize.toast('Please select category !', 4000)
  }
  else if(start_peak=="00:00")
  {
    Materialize.toast('Please select Start time !', 4000)
  }
  else if(end_peak=="00:00")
  {
    Materialize.toast('Please select End time !', 4000)
  }
  else if(price=="" || parseInt(price)<=0)
  {
    Materialize.toast('Please enter price !', 4000)  
  }
  else
  {
    $('#add_peak').addClass('disabled');
    $.ajax({
      type: "POST",
      dataType: "json",
      url: APP_URL+"/addPeak",
      data: {id:pid,edit:edit,category: category,start_peak: start_peak,end_peak: end_peak,price: price,days:days,type:type},
      success: function(output){
        if(output[0].stats=="fail")
        {
          $('#add_peak').removeClass('disabled');
          Materialize.toast(output[0].errors, 4000)
        }
        else
        {
          var frm = document.getElementsByName('addpeak')[0];
          frm.reset();
          location.reload(); 
        }
      }
    });
  }
  
})


}

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