@extends('layouts.dashboard')
@section('page_heading','Add Service')
@section('section')
<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
        <form  id="edit_service" method="post" action="{{ url("admin/edit_service") }}"  enctype="multipart/form-data">
        <div class="col-lg-8">

            @section ('pane2_panel_title', '')
            @section ('pane2_panel_body')
                    <!-- /.panel -->

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $category->id }}">    
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Service Name</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="category_name" value="{{ $category->category_name }}" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Price per km</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="price_km" value="{{ $category->price_km }}" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Price per minute</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="price_minute" value="{{ $category->price_minute }}" autocomplete="off" /></div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Max size</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="max_size" value="{{ $category->max_size }}" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12 col-sm-12 col-xs-12 item_settings">Price fare</div>
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="text" class="text_box"  name="price_fare" value="{{ $category->price_fare }}" autocomplete="off" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-12  col-sm-12 col-xs-12"><input type="submit" class="btn_custom button btn_blue"  name="submit" value="Update Service" /></div>
            </div>
        

            <!-- /.panel-body -->
           
            <!-- /.panel -->
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'pane2','class'=>'sd'))
        </div>


        <div class="col-lg-4">
            @section ('pane1_panel_title', 'Service Logo')
            @section ('pane1_panel_body')
                <div class="o_site_logo">
                    <img src="{{ url("storage/app/images/category/".$category->id."/".$category->logo) }}" onerror="this.src='{{ url("assets/images/no.png") }}'"/>
                </div>
                <input type="file" class="text_box"  name="logo"  />
            
                
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane1','class'=>'ds'))

            @section ('pane3_panel_title', 'Service Marker')
            @section ('pane3_panel_body')
                <div class="o_site_icon">
                    <img src="{{ url("storage/app/images/category/".$category->id."/".$category->marker) }}" onerror="this.src='{{ url("assets/images/no.png") }}'"/>
                </div>
                        <!-- /.panel-body -->
              <input type="file" class="text_box"  name="marker"  />
            
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane3' ,'class'=>'ds'))
              
        </div>
        </form>
            
@stop
