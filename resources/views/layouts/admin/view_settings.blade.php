@extends('layouts.dashboard')
@section('page_heading','Site Settings')
@section('section')

            <!-- /.row -->
            <div class="col-sm-12">
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                
                @section ('pane2_panel_title', 'General')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Name</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Email</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_email" value="" /></div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Status</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><label data-value="1"  class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>
</label>
  <label class="site_status success">Site is working :)</label>
</div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Copyright content</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="copyright" value="" /></div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Playstore Link</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="playstore_link" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Appstore Link</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="appstore_link" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Contact Number</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Contact Email</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings"></div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="submit" class="btn_custom button btn_blue"  name="submit" value="Update settings" /></div>
                </div>


                        <!-- /.panel-body -->
                   
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    @section ('pane1_panel_title', 'Site Logo')
                    @section ('pane1_panel_body')
                        <div class="o_site_logo">
                            <img src="{{ url("assets/images/logo.png") }}" onerror="this.src='{{ url("assets/images/no.png") }}'"/>
                        </div>
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane1'))

                    @section ('pane3_panel_title', 'Site Icon')
                    @section ('pane3_panel_body')
                     <div class="o_site_icon">
                            <img src="{{ url("assets/images/logo.png") }}" onerror="this.src='{{ url("assets/images/no.png") }}'"/>
                        </div>
                        <!-- /.panel-body -->
                  
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane3'))


                    @section ('pane4_panel_title', 'Site Colors')
                    @section ('pane4_panel_body')
                        <!-- /.panel-body -->
                  
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane4'))
                      
                </div>

                <!-- /.col-lg-4 -->
            
@stop
