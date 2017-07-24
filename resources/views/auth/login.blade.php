@extends('app')
@section('content')
<link rel="stylesheet" href="{{ url('assets/stylesheets/material_form_style.css') }}">
<link rel="stylesheet" href="{{ url('assets/stylesheets/custom.css') }}">
<link rel="stylesheet" href="{{ url('assets/stylesheets/app.css') }}">
  <link rel="stylesheet" href="{{ url("assets/stylesheets/bootstrap.min.css") }}" />
<link href="https://fonts.googleapis.com/css?family=Oleo+Script|Quicksand" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<style>

.preloader {
   background-image: url('{{ url("assets/images/350.gif") }}');
   background-position: center center;
   background-repeat: no-repeat;
   background-size: 30px auto;
   font-size: 0;
}
#error-note {
    background: #cf5757 none repeat scroll 0 0;
    border-radius: 3px;
    color: #fff;
    margin: 10px 0;
    padding: 5px;
}

#error-note-reset {
    background: #cf5757 none repeat scroll 0 0;
    border-radius: 3px;
    color: #fff;
    margin: 10px 20px;
    padding: 5px 15px;
    
}
.reset-success
{
    background: #00cc00 none repeat scroll 0 0 !important;
}

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
#error-note li
{
   background: #cc0000 none repeat scroll 0 0;
    border-radius: 2px;
    box-shadow: 0 0 2px #aa0000;
    color: white;
    font-family: quicksand;
    list-style: outside none none;
    margin: 10px 0;
    padding: 5px;
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
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3" id="toggle">
         <div id="error-note" style="display:none"></div>
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

               <form id="myform" class="form-horizontal home-login-form" role="form" method="POST"  name="login" action="login">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     <div class="col-md-12">
                        <input id="username" name="username" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                        <label class="material">Username</label>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-12">
                        <input id="password" name="password" type="password"><span class="highlight"></span><span class="bar"></span>
                        <label class="material">Password</label>
                     </div>
                  </div>
                  <div class="form-group form-footer">
                     <div class="col-md-12">
                        <button type="button" id="loginbtn" class="btn_custom button btn_blue">
                           Login
                           <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                        </button>
                     </div>
			</div>
			<a href="#" class="fgt-pwd" type="button" id="mymodal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Forgot Password?</a>
                  
               </form>
             </div>
         </div>
      </div>
   </div>
</div>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="{{ url("assets/scripts/bootstrap.min.js") }}" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ url("assets/js/material.js") }}"></script>
<script>
var seconds = 5; // seconds for HTML
var foo; // variable for clearInterval() function

function reset_redirect() {
    document.location.href = "{{ url("admin/login") }}";
}

function updateSecs() {
    document.getElementById("seconds").innerHTML = seconds;
    seconds--;
    if (seconds == -1) {
        clearInterval(foo);
        reset_redirect();
    }
}

function countdownTimer() {
    foo = setInterval(function () {
        updateSecs()
    }, 1000);
}


$(document).ready(function(){
   $("#loginbtn").click(function(){
      var username = $('#username').val();
      var password = $('#password').val();
      if(username=="")
      {
          
         $('#error-note').empty().append("Username is required");
         $('#error-note').show();
      }
      else if(password=="")
      {
          
         $('#error-note').empty().append("Password required");
         $('#error-note').show();
      }
      else
      {
         $("#loginbtn").addClass("preloader");
         document.getElementById("loginbtn").disabled = true;
         var data = 'username='+ username +'password='+ password;
         var url="{{ url('checklogin') }}";
         $.ajax(
         {
            type:"POST",
            cache:false,
            url: url, 
            data : {
               "_token": "{{ csrf_token() }}",
               "username":username,
               "password":password
            },
            success: function(result){
               if(result.trim()=="success")
               {
                  window.location.href = "{{ url('admin') }}";
               }
               else
               {
                   
                  $('#error-note').empty().append("Invalid username or password");
                  $('#error-note').show();
                  $("#loginbtn").removeClass("preloader");
                  document.getElementById("loginbtn").disabled = false;
               }
            }
         });
      }
   });

  $("#resetbtn").click(function(){
      var email = $('#email').val();
      if(email=="")
      {
          
         $('#error-note-reset').empty().append("email is required");
         $('#error-note-reset').show();
      }
      else if(password=="")
      {
          
         $('#error-note').empty().append("Password required");
         $('#error-note').show();
      }
      else
      {
         $("#resetbtn").addClass("preloader");
         document.getElementById("resetbtn").disabled = true;
         var url="{{ url('resetadmin') }}";
         $.ajax(
         {
            type:"POST",
            cache:false,
            url: url, 
            data : {
               "_token": "{{ csrf_token() }}",
               "email":email,
               "role":3
            },
            success: function(result){
               if(result.trim()=="success")
               {
                  $('#error-note-reset').empty().append("Reset password mail is succesfully sent to your email.");
                  $('#error-note-reset').addClass("reset-success");
                  $('#error-note-reset').show();
                  $('#timer').show();
                  $("#resetbtn").removeClass("preloader");
                  document.getElementById("resetbtn").disabled = false;
                  countdownTimer();
               }
               else
               {
                  var sitename="<?php echo site_name(); ?>";
                  $('#error-note-reset').empty().append(":( you're not in "+sitename);
                  $('#error-note-reset').show();
                  $("#resetbtn").removeClass("preloader");
                  document.getElementById("resetbtn").disabled = false;
               }
            }
         });
      }
   });

});

</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
      </div>
      <div class="modal-body">
        <div id="error-note-reset" style="display:none"></div>
               <form  class="form-horizontal home-login-form" role="form" method="POST"  name="login" action="login">
                  <div class="form-group">
                     <div class="col-md-12">
                        <input id="email" name="email" type="text" autocomplete='off'><span class="highlight"></span><span class="bar"></span>
                        <label class="material">Email</label>
                     </div>
                  </div>
                  <div class="form-group form-footer">
                     <div class="col-md-12">
                        <button type="button" id="resetbtn" class="btn_custom button btn_blue">
                           Reset Password
                           <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                        </button>
                     </div>
                  </div>
               </form>
     </div>
      <div class="modal-footer">
<p style="display:none" id="timer">You should be automatically redirected in <span id="seconds">5</span> seconds.
</p>  </div>
    </div> 
@endsection
