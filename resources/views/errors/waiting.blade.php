@extends('layouts.plane')
@section('body')
    <style>
    body
    {
    	background: #f1f1f1;
    }
    a
    {
      line-height: 35px !important;
    }
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>

    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      	
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
	        <div class="demo-title col-lg-8 col-md-offset-2">{{ $wait_page }}</div>
	      	<div class="demo-content col-lg-8 col-md-offset-2">
	        	<div class="demo-crumbs mdl-color-text--grey-500">
<h4>{{ $wait_title}}</h4>
<p>{{ $wait_message }}</p>
<br>
<p>{{ $contact }}</p>

<br>
<center>
<a href="{{ url("admin") }}" class="btn waves-effect waves-light">Take me Home</a>
</center>
	      		</div>
	       	</div>
	    </div>
      </main>
    </div>
@stop