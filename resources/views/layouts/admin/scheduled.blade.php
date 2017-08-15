@extends('layouts.dashboard')
@section('page_heading','Scheduled Rides')
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
            <th>Booking id</th>
            <th>Passenger</th>
            <th>Driver</th>
            <th>Date</th>
            <th>Status</th>
            <th>Pay mode</th>
            <th>Pay status</th>
            <th>Action</th>
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
  .res_table td:nth-of-type(2):before { content: "Booking id";}
  .res_table td:nth-of-type(3):before { content: "Passenger";}
  .res_table td:nth-of-type(4):before { content: "Driver";}
  .res_table td:nth-of-type(5):before { content: "Date";}
  .res_table td:nth-of-type(6):before { content: "Status";}
  .res_table td:nth-of-type(7):before { content: "Pay mode";}
  .res_table td:nth-of-type(8):before { content: "Pay status";}
  .res_table td:nth-of-type(9):before { content: "Action";}
} 

</style>

</div>

</div>

@stop
