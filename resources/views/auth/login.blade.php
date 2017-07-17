@extends('app')
@section('content')
<link rel="stylesheet" href="{{ url('assets/stylesheets/material_form_style.css') }}">
<link rel="stylesheet" href="{{ url('assets/stylesheets/custom.css') }}">
<link rel="stylesheet" href="{{ url('assets/stylesheets/app.css') }}">
<link href="https://fonts.googleapis.com/css?family=Oleo+Script|Quicksand" rel="stylesheet"> 
<style>

 img.login-logo{
    background: #3f51b5;
    width: 80px;
    border-radius: 50%;
}
   .title_login
   {
   font-family: 'Oleo Script', cursive;
   font-size: 50px;
   color:#333;
   }
   .panel-default
   {
   box-shadow:0 0 10px #ccc;
   }
.home-login-form label
{
   font-weight:normal;
}

</style>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-8 col-md-offset-2">
         <center>
            <h1 class="title_login">trippy</h1>
            <img class="login-logo" src="{{ url("assets/images/logo-white.png") }}" width="20%" />
         </center>
         <center>
            <h3 class="admin-text">Admin Panel</h3>
         </center>
      </div>
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
         <div class="panel panel-default">
            <div class="panel-body">
               @if (count($errors) > 0)
               <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif

               <form class="form-horizontal home-login-form" role="form" method="POST" action="{{ url("auth/login") }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     <div class="col-md-12">
                        <input type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                        <label>Username</label>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-12">
                        <input type="password"><span class="highlight"></span><span class="bar"></span>
                        <label>Password</label>
                     </div>
                  </div>
                  <div class="form-group form-footer">
                     <div class="col-md-12">
                        <button type="submit" class="btn_custom button btn_blue">
                           Login
                           <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                        </button>
                     </div>
			</div>
			<a href="#" class="fgt-pwd">Forgot Password?</a>
                  
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="{{ url("assets/js/material.js") }}"></script>
@endsection
