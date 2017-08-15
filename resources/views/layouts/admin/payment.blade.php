@extends('layouts.dashboard')
@section('page_heading','Payment Settings')
@section('section')
<style>
.material_form .switch label input[type=checkbox]:checked+.lever:after {
    background-color: #fff !important;
    left: 24px
}
.material_form .switch label input[type=checkbox]:checked+.lever {
    background-color: #fff !important;
}
.paypal .panel
{
    background-color: #005ea6;
}
.stripe .panel
{
    background-color: #5533FF;
}
.cash .panel
{
    background-color: #3E70C9;
}
.panel i
{
    color:#fff;
}
.item_settings,.panel-title
{
    color:#fff;
}
.text_box
{
    border: none;
    border-radius: 3px;
}
.cp_label1 label
{
    color:#fff;
}
</style>
<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
    <form  method="post" action="{{ url("admin/api_settings") }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">    
        <div class="col-lg-12 stripe">
            @section ('pane2_panel_title', 'Stripe')
            @section ('pane2_panel_icon', ' fa-3x fa-cc-stripe float_right')
            @section ('pane2_panel_body')
            <div class="col-md-12 col-sm-12 col-xs-12 cp_nopad material_form add_form">
              <div class="input-field cp_label1">
                <div class="switch" style="width:100%">
                  <label>
                    Inactive
                    <input type="checkbox" name="status" id="status">
                    <span class="lever"></span>
                    Active
                  </label>
                </div>
              </div>
            </div>

            <div class="list_settings">
                <div class="item_settings">Secret</div>
                <div class=""><input type="text" class="text_box"  name="GOOGLE_API_KEY" value="" /></div>
            </div>
            <div class="list_settings">
                <div class="item_settings">Key</div>
                <div class=""><input type="text" class="text_box"  name="GOOGLE_PROJECT_ID" value="" /></div>
            </div>
            <!-- /.panel-body -->
           
            <!-- /.panel -->
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'pane2', 'icon' => 'pane2','class'=>'sd'))
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-12 paypal">
            @section ('pane1_panel_title', 'Paypal')
            @section ('pane1_panel_icon', 'fa-3x fa-cc-paypal float_right')
            @section ('pane1_panel_body')
            <div class="col-md-12 col-sm-12 col-xs-12 cp_nopad material_form add_form">
              <div class="input-field cp_label1">
                <div class="switch" style="width:100%">
                  <label>
                    Inactive
                    <input type="checkbox" name="status" id="status">
                    <span class="lever"></span>
                    Active
                  </label>
                </div>
              </div>
            </div>
            <div class="list_settings">
                <div class="item_settings">Secret</div>
                <div class=""><input type="text" class="text_box"  name="GOOGLE_API_KEY" value="" /></div>
            </div>
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane1','icon' =>'pane1','class'=>'sd' ))
        </div>

        <div class="col-lg-12 cash">
            @section ('pane3_panel_title', 'Cash Payments')
            @section ('pane3_panel_icon', 'fa-3x fa-money float_right')
            @section ('pane3_panel_body')
            <div class="col-md-12 col-sm-12 col-xs-12 cp_nopad material_form add_form">
              <div class="input-field cp_label1">
                <div class="switch" style="width:100%">
                  <label>
                    Inactive
                    <input type="checkbox" name="status" id="status">
                    <span class="lever"></span>
                    Active
                  </label>
                </div>
              </div>
            </div>
            @endsection
            @include('widgets.panel', array('header'=>true, 'as'=>'pane3','icon' =>'pane3','class'=>'sd' ))
        </div>
</form>
       <!-- /.col-lg-4 -->
            
@stop
