@extends('layouts.plane')
@section('body')
    <style>
    body
    {
    	background: #f1f1f1;
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
	        <div class="demo-title col-lg-8 col-md-offset-2">Oops!</div>
	      	<div class="demo-content col-lg-8 col-md-offset-2">
	        	<div class="demo-crumbs mdl-color-text--grey-500">
<h2>We can't seem to find the page you're looking for.</h2>
<br><p><b>Error code : 404	</b></p>
<br><center>
<a href="{{ url("admin") }}" class="btn waves-effect waves-light">Take me Home</a>
</center>
	      		</div>
	       	</div>
	    </div>
      </main>
    </div>
@stop