@extends('layouts.dashboard')
@section('page_heading','Add Provider')
@section('section')
<div class="col-sm-12">            <!-- /.row -->
  <div class="row">
    <div class="col-lg-6 col-md-offset-3">
      <div class="panel panel-default panel-custom">
       
        <form  class="form-horizontal home-login-form" role="form" method="POST"  name="login" action="{{ url("admin/provider_signup") }} ">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="role" value="2">
          <div class="form-group">
             <div class="col-md-12">
                <input id="firstname" name="firstname" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                <label class="material">First name</label>
             </div>
          </div>
          <div class="form-group">
             <div class="col-md-12">
                <input id="lastname" name="lastname" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                <label class="material">Last name</label>
             </div>
          </div>
          <div class="form-group">
             <div class="col-md-12">
                <input id="email" name="email" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                <label class="material">Email</label>
             </div>
          </div>
          <div class="form-group">
             <div class="col-md-12">
                <input id="cc" name="countrycode" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                <label class="material">Country Code</label>
             </div>
          </div>
          <div class="form-group">
             <div class="col-md-12">
                <input id="phone" name="phone" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                <label class="material">Phone</label>
             </div>
          </div>
          <div class="form-group">
             <div class="col-md-12">
                <input id="city" name="city" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                <label class="material">City</label>
             </div>
          </div>

          <div class="form-group form-footer">
             <div class="col-md-12">
                <button type="submit" id="resetbtn" class="btn_custom button btn_blue">
                   Submit
                   <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                </button>
             </div>
          </div>
      </form>

      </div>
    </div>
  </div>
</div>          
@stop
