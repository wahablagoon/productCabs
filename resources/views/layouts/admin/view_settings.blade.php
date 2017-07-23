@extends('layouts.dashboard')
@section('page_heading','Site Settings')
@section('section')
<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            @section ('pane2_panel_title', 'General')
            @section ('pane2_panel_body')
                    <!-- /.panel -->
        <form  method="post" action="{{ url("admin/site_settings") }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">    
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Name</div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="{{ site_settings()->site_name }}" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Email</div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_email" value="{{ site_settings()->site_email }}" /></div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Status</div>
				<div class="col-md-8  col-sm-8 col-xs-12">
                    <?php
                    $status=site_settings()->site_status;
                    if($status==1)
                    {
                        $checked="checked";
                    ?>
                    <label class="site_status success">Site is working :)</label>
                    <?php
                    }
                    else
                    {
                        $checked="";
                    ?>
                    <label class="site_status error">Site is on Maintanence..</label>
                    <?php
                    }
                    ?>
                    <label data-value="{{ site_settings()->site_status }}"  class="switch">
                        <input type="checkbox"  <?php echo $checked; ?> >
                        <span class="slider round"></span>
                    </label>
                       <input type="hidden" id="site_status"  name="site_status"  value="{{ site_settings()->site_status }}">

                </div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Copyright content</div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="copyright" value="{{ site_settings()->site_copyright }}" /></div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Playstore Link</div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="playstore_link" value="{{ site_settings()->site_playstore_link }}" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Appstore Link</div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="appstore_link" value="{{ site_settings()->site_appstore_link }}" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Contact Number</div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="contact_number" value="{{ site_settings()->site_company_phone }}" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Contact Email</div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="contact_email" value="{{ site_settings()->site_company_email }}" /></div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
                <div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site currency</div>
                <div class="col-md-8  col-sm-8 col-xs-12">
                    <select class="selectpicker" name="currency">
                      
                      <option>INR</option>
                      
                    </select>
                </div>
            </div>


            <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
				<div class="col-md-4 col-sm-4 col-xs-12 item_settings"></div>
				<div class="col-md-8  col-sm-8 col-xs-12"><input type="submit" class="btn_custom button btn_blue"  name="submit" value="Update settings" /></div>
            </div>
        </form>

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
                    <img src="{{ url("storage/app/images/".site_settings()->site_logo) }}" onerror="this.src='{{ url("assets/images/no.png") }}'"/>
                </div>
                <form class="n_site_logo" method="post" id="ul" enctype="multipart/form-data" action="{{ url("admin/upload_logo") }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="file-upload">
                        <label for="upload_logo" class="file-upload__label btn_custom button btn_blue">Upload Logo</label>
                        <input id="upload_logo" class="file-upload__input" type="file" name="file-upload">
                    </div>
                </form>
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane1'))

            @section ('pane3_panel_title', 'Site Icon')
            @section ('pane3_panel_body')
                <div class="o_site_icon">
                    <img src="{{ url("storage/app/images/".site_settings()->site_icon) }}" onerror="this.src='{{ url("assets/images/no.png") }}'"/>
                </div>
                <form class="n_site_icon" id="ui" method="post" enctype="multipart/form-data" action="{{ url("admin/upload_icon") }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="file-upload">
                        <label for="upload_icon" class="file-upload__label btn_custom button btn_blue">Upload Icon</label>
                        <input id="upload_icon" class="file-upload__input" type="file" name="file-upload">
                    </div>
                </form>
                        <!-- /.panel-body -->
                  
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane3'))


            @section ('pane4_panel_title', 'Site Colors')
            @section ('pane4_panel_body')
                        <!-- /.panel-body -->
            <input id="site_color" class="jscolor" value="{{ site_settings()->site_theme_color }}">
            <meta name="_token" content="{{ csrf_token() }}">
            <input type="button" id="update_color" class="btn_custom button btn_blue"  name="submit" value="Update color" />
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane4'))
              
        </div>
       <!-- /.col-lg-4 -->
            
@stop
