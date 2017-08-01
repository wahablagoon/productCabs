@extends('layouts.dashboard')
@section('page_heading','Add Service')
@section('section')
<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
        <div class="col-lg-6 col-md-offset-3 ">
            @section ('pane2_panel_title', '')
            @section ('pane2_panel_body')
                    <!-- /.panel -->
        <form  id="add_service" method="post" action="{{ url("admin/add_service") }}"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">    
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Service Name</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="category_name" value="" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Price per km</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="price_km" value="" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Price per minute</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="price_minute" value="" autocomplete="off" /></div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Max size</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="max_size" value="" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Price fare</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="price_fare" value="" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Logo</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="file" class="text_box"  name="marker"  /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Marker</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="file" class="text_box"  name="logo"  /></div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="submit" class="btn_custom button btn_blue"  name="submit" value="Add Service" /></div>
            </div>
        </form>

            <!-- /.panel-body -->
           
            <!-- /.panel -->
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'pane2','class'=>'sd'))
        </div>
            
@stop
