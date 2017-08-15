@extends('layouts.dashboard')
@section('page_heading','Passenger reviews')
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

<table id="user_listing" class="display res_table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Request id</th>
            <th>Passenger</th>
            <th>Driver</th>
            <th>Ratings</th>
            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<style>
.res_table td {
word-break: break-all;
}

@media only screen and (min-width: 320px) and (max-width: 980px)  {

  .res_table td:nth-of-type(1):before { content: "Id" ; }
  .res_table td:nth-of-type(2):before { content: "Request id";}
  .res_table td:nth-of-type(3):before { content: "Passenger";}
  .res_table td:nth-of-type(4):before { content: "Driver";}
  .res_table td:nth-of-type(5):before { content: "Ratings";}
  .res_table td:nth-of-type(6):before { content: "Comments";}
} 

</style>

</div>

</div>

@stop
