@extends('layouts.dashboard')
@section('page_heading','Service Types')
@section('section')

<div class="row">
<div class="col-sm-12">
        <div class="col-lg-12">
          <div class="search-form">
              <div class="form-group-search has-feedback">
              <input type="user_search" class="form-control" name="search" id="search" placeholder="">
                <span class="glyphicon glyphicon-search form-control-feedback plus"></span>
            </div>
          </div>
         <div class="panel panel-default panel-custom">

         <a class="floatbtn floating-button waves-effect waves-light" href="{{ url("admin/service/create") }}"><span class="plus">+</span>
            <img class="edit" src="{{ url('assets/images/add.png') }}">
            </a>
<table id="user_listing" class="display res_table">
    <thead>
        <tr>
            <th>Service name</th>
            <th>Price <br>per <br>km</th>
            <th>Price <br>per <br>minute</th>
            <th>Capacity</th>
            <th>Logo</th>
            <th>Marker</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($services as $service)
{
?>
    <tr>
        <td>{{ $service->category_name }}</td>
        <td>{{ $service->price_km }}</td>
        <td>{{ $service->price_minute }}</td>
        <td>{{ $service->max_size }}</td>
        <td><img  class="materialboxed" width="50px" height="40px" onerror="this.src='{{ url("assets/images/no.png") }}'" src="{{ url("storage/app/images/category/$service->id/$service->logo") }}"></img></td>
        <td><img  class="materialboxed" width="30px" height="30px" onerror="this.src='{{ url("assets/images/no.png") }}'" src="{{ url("storage/app/images/category/$service->id/$service->marker") }}"></img></td>
        <td>
            <a href="{{ url("admin/service/edit/$service->id") }}"><label class="uedit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></label></a>
            <a href="{{ url("admin/delete_service/$service->id") }}"><label class="udelete"><i class="fa fa-trash" aria-hidden="true"></i></label></a>
        </td>
    </tr>
<?php
}
?>
    </tbody>
</table>
<style>
.res_table td {
word-break: break-all;
}

@media only screen and (min-width: 320px) and (max-width: 980px)  {

  .res_table td:nth-of-type(1):before { content: "Id" ; }
  .res_table td:nth-of-type(2):before { content: "Firstname";}
  .res_table td:nth-of-type(3):before { content: "Lastname";}
  .res_table td:nth-of-type(4):before { content: "Email";}
  .res_table td:nth-of-type(5):before { content: "Mobile";}
  .res_table td:nth-of-type(6):before { content: "Wallet";}
  .res_table td:nth-of-type(7):before { content: "Action";}
} 

</style>

</div>

</div>




@stop
