<?php
if(isset($users))
{
  $edit=$users->id;
  $page_heading="Edit Driver";
  $name=$users->name;
  $countrycode=$users->countrycode;
  $phone=$users->phone;
  $email=$users->email;
  $password=$users->password;
  $city=$users->city; 
  $lat=$users->lat; 
  $lang=$users->lang; 
}
else
{
  $edit=0;
  $page_heading="Add Driver";
  $name="";
  $countrycode="91";
  $phone="";
  $email="";
  $password="";
  $city="";
  $lat="";
  $lang="";
}

?>

@extends('layouts.dashboard')
@section('page_heading',$page_heading)
@section('section')


<div class="col-sm-12">            <!-- /.row -->
  <div class="row">
    <div class="col-lg-6 col-md-offset-3">
      <div class="panel panel-default panel-custom add_form">
       <div class="row">
        <form  id="add_driver" class="material_form form-horizontal home-login-form" role="form" method="POST"  name="login" action="{{ url("admin/signup") }} ">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="role" value="2">
        <input type="hidden" name="edit" value="{{ $edit }}">
          <div class="row">
            
            <div class="input-field col s12">
              <input id="lastname" type="text" name="name" value="{{ $name }}" class="validate {{ $errors->has('name') ? 'has-error' :'' }}" autocomplete="off">
              <label for="lastname">Name</label>
            </div>
            <div class="input-field col s12">
                <select name="countrycode">
                  <option value="" disabled >Choose your option</option>
                  <?php
                  foreach ($country_code as $key => $value) {
                   ?>
                  <option  <?php if($value->isd==$countrycode) echo "selected"; ?> value="{{ $value->isd }}" class="right" data-icon="<?php echo url('assets/images/flags/'.strtolower($value->iso) .'.png'); ?>" ><?php echo $value->name. " - +".$value->isd; ?></option>
                   <?php } ?>
                </select>
            </div>
            <div class="input-field col s12">

              <input id="phone" type="tel" value="{{ $phone }}" name="phone" class="validate" autocomplete="off">
              <label for="phone">Phone</label>
            </div>
            <div class="input-field col s12">
              <input id="email" type="email" value="{{ $email }}" name="email" class="validate" autocomplete="off">
              <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
              <input id="password" type="text" name="password" value="{{ $password }}" class="validate" autocomplete="off">
              <label for="password">Password</label>
            </div>
            <div class="input-field col s12">
              <input type="hidden" id="driver_lat" name="lat" value="{{ $lat }}" />
              <input type="hidden" id="driver_long" name="lang" value="{{ $lang }}" />
              <input id="city" type="text" name="city" value="{{ $city }}" class="validate" autocomplete="off">

            </div>

            <button class="btn waves-effect waves-light" type="submit" >Submit
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
