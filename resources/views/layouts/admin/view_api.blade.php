@extends('layouts.dashboard')
@section('page_heading','API Settings')
@section('section')

<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
    <form  method="post" action="{{ url("admin/api_settings") }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">    
        <div class="col-lg-6">
            @section ('pane2_panel_title', 'Google')
            @section ('pane2_panel_icon', 'fa-google float_right')
            @section ('pane2_panel_body')
            <div class="list_settings">
                <div class="item_settings">Google Api</div>
                <div class=""><input type="text" class="text_box"  name="GOOGLE_API_KEY" value="{{ $GOOGLE_API_KEY }}" /></div>
            </div>
            <div class="list_settings">
                <div class="item_settings">Google Project id</div>
                <div class=""><input type="text" class="text_box"  name="GOOGLE_PROJECT_ID" value="{{ $GOOGLE_PROJECT_ID }}" /></div>
            </div>
            <div class="list_settings">
                <div class="item_settings">Google Client id</div>
                <div class=""><input type="text" class="text_box"  name="GOOGLE_CLIENT_ID" value="{{ $GOOGLE_CLIENT_ID }}" /></div>
            </div>

            <!-- /.panel-body -->
           
            <!-- /.panel -->
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'pane2', 'icon' => 'pane2'))
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-6">
            @section ('pane1_panel_title', 'Firebase')
            @section ('pane1_panel_icon', 'fa-fire float_right')
            @section ('pane1_panel_body')

            <div class="list_settings">
                <div class="item_settings">Firebase Secret</div>
                <div class=""><input type="text" class="text_box"  name="f_SECRET" value="{{ $f_SECRET }}" /></div>
            </div>
            <div class="list_settings">
                <div class="item_settings">Firebase UID</div>
                <div class=""><input type="text" class="text_box"  name="f_UID" value="{{ $f_UID }}" /></div>
            </div>
            <div class="list_settings">
                <div class="item_settings">Firebase URL</div>
                <div class=""><input type="text" class="text_box"  name="f_URL" value="{{ $f_URL }}" /></div>
            </div>

            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane1','icon' =>'pane1' ))
        </div>
         <div class="col-lg-12">
            @section ('pane3_panel_title','Facebook')
            @section ('pane3_panel_icon', 'fa-facebook float_right')
            @section ('pane3_panel_body')
                                    <!-- /.panel-body -->
                    <!-- /.panel -->
            <div class="list_settings">
                <div class="item_settings">Facebook Api</div>
                <div class=""><input type="text" class="text_box"  name="FB_API" value="{{ $FB_API }}" /></div>
            </div>
            <div class="list_settings">
                <div class="item_settings">Facebook Secret</div>
                <div class=""><input type="text" class="text_box"  name="FB_SECRET" value="{{ $FB_SECRET }}" /></div>
            </div>



            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane3' ,'icon'=>'pane3'))
        </div>
        <div class="col-lg-12">
        <div class="col-md-4 col-xs-12 col-sm-12 list_settings">
        <input type="submit" class="btn_custom button btn_blue"  name="submit" value="Update settings" />
        </div>
        </div>
</form>
       <!-- /.col-lg-4 -->
            
@stop
