@extends('layouts.dashboard')
@section('page_heading','Add Users')
@section('section')


<div class="col-sm-12">            <!-- /.row -->
  <div class="row">
    <div class="col-lg-6 col-md-offset-3">
      <div class="panel panel-default panel-custom add_form">
       <div class="row">
        <form  id="add_user" class="form-horizontal home-login-form" role="form" method="POST"  name="login" action="{{ url("admin/rider_signup") }} ">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="role" value="1">
          <div class="row">
            <div class="input-field col s12">
              <input id="icon_prefix" type="text" value="" name="firstname" class="validate">
              <label for="icon_prefix">First Name</label>
            </div>
            <div class="input-field col s12">
              <input id="lastname" type="text" name="lastname" value="" class="validate">
              <label for="lastname">Last Name</label>
            </div>
            <div class="input-field col s12">
                <select name="countrycode">
                  <option value="" disabled >Choose your option</option>
                  <?php
                  foreach ($country_code as $key => $value) {
                   ?>
                  <option  <?php if($value->isd=="91") echo "selected"; ?> value="{{ $value->isd }}" class="right" data-icon="<?php echo url('assets/images/flags/'.strtolower($value->iso) .'.png'); ?>" ><?php echo $value->name. " - +".$value->isd; ?></option>
                   <?php } ?>
                </select>
            </div>
            <div class="input-field col s12">

              <input id="phone" type="tel" value="" name="phone" class="validate">
              <label for="phone">Phone</label>
            </div>
            <div class="input-field col s12">
              <input id="email" type="email" value="" name="email" class="validate">
              <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
              <input id="password" type="password" name="password" value="" class="validate">
              <label for="password">Password</label>
            </div>
            <div class="input-field col s12">
              <input id="city" type="text" name="city" value="" class="validate">
              <label for="city">City</label>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
            </button>
        
          </div>
      </form>
    </div>
      </div>
    </div>
  </div>
</div>          
@stop
