<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>{{ site_settings()->site_name }} - Admin Panel</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<link rel="icon" href="{{ url("storage/app/images/".site_settings()->site_icon) }}">
	<link rel="stylesheet" href="{{ url("assets/stylesheets/styles.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/bootstrap.min.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/themify-icons.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/font-awesome.min.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/jquery.jscrollpane.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/waves.min.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/core.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/font-awesome.min.css") }}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/custom.css")}}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/dropdown.css")}}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/animate.css")}}" />
	<link rel="stylesheet" href="{{ url("assets/stylesheets/jquery.dataTables.min.css")}}" />
	<link href="https://fonts.googleapis.com/css?family=Oleo+Script|Quicksand" rel="stylesheet"> 
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css">
	<link rel="stylesheet" href="{{ url('assets/stylesheets/material_form_style.css') }}">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

@extends('layouts.dynamic_css')
</head>
<body class="fixed-sidebar fixed-header content-appear skin-default">
	@yield('body')
	@include('flash::message')
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<script src="{{ url("assets/scripts/jquery-1.12.3.min.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/bootstrap.min.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/jscolor.min.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/js/material.js") }}" type="text/javascript"></script>

	<script src="{{ url("assets/scripts/detectmobilebrowser.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/jquery.mousewheel.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/mwheelIntent.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/jquery.jscrollpane.min.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/jquery.fullscreen-min.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/waves.min.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/app.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/jquery.dataTables.min.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/demo.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/rating.js") }}" type="text/javascript"></script>
	<script src="{{ url("assets/scripts/admin_custom.js") }}" type="text/javascript"></script>
	<script type="text/javascript">
            $('.rating').rating();
        </script>
        		<script src="{{ url("assets/scripts/dropdown.js") }}" type="text/javascript"></script>
</body>
</html>


        

