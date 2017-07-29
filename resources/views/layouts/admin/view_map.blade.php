@extends('layouts.dashboard')
@section('section')
<style>
#legend {
    background: rgba(255, 255, 255, 0.8) none repeat scroll 0 0;
    border: 2px solid #f3f3f3;
    font-family: Arial,sans-serif;
    margin: 10px;
    padding: 10px;
}
.page-header {
    border-bottom: none !important;
    margin: 0px 0 20px;
    padding-bottom: 9px;
}
#map {
        height: 400px;
        width: 100%;
       }

.info_container  p{
  font-size: 14px;
}

.info_container  p:first-child {
  font-size: 20px !important;
}

.info_container .fa{
  padding: 5px 10px;
}
.info_container .fa.success {
  color:#00cc00;
}
.info_container .fa.error {
  color:#cc0000;
}
.info_container img
{
    float:right;
    width:35%;
    border-radius: 50%;
}
</style>
<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            @section ('pane2_panel_title', 'Map View')
            @section ('pane2_panel_icon', 'fa-map-marker float_right')
            @section ('pane2_panel_body')
                    <!-- /.panel -->
<div id="map"></div>
<div id="legend" style="z-index: 0; position: absolute; bottom: 127px; right: 10px;">
    <div><img src="{{ url("assets/images/maps/red.png") }}"> Offline Drivers</div>
    <div><img src="{{ url("assets/images/maps/green.png") }}"> Online Drivers</div>
    <div><img src="{{ url("assets/images/maps/gold.png") }}">Awaiting Verfication</div>
</div>

            <!-- /.panel-body -->

<script>
var map;
var redimage;

var greenimage;
var goldimage;
var bounds = new google.maps.LatLngBounds();
var infowindow = new google.maps.InfoWindow();    

function Mappage() {
     map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: {lat: -33.9, lng: 151.2}
    });
    }
    Mappage();
</script>           
            <!-- /.panel -->
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'pane2','icon'=>'pane2', 'class'=>'sd'))
        </div>
        <!-- /.col-lg-8 -->
       <!-- /.col-lg-4 -->
            
@stop
