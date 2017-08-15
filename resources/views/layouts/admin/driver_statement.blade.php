@extends('layouts.dashboard')
@section('page_heading','Driver Statement')
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
            <th>Driver name</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Total rides</th>
            <th>Total Earnings</th>
            <th>Commission</th>
            <th>Joined at</th>
            <th>Details</th>
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

  .res_table td:nth-of-type(1):before { content: "Driver name" ; }
  .res_table td:nth-of-type(2):before { content: "Mobile";}
  .res_table td:nth-of-type(3):before { content: "Status";}
  .res_table td:nth-of-type(4):before { content: "Total rides";}
  .res_table td:nth-of-type(5):before { content: "Total Earnings";}
  .res_table td:nth-of-type(6):before { content: "Commission";}
  .res_table td:nth-of-type(7):before { content: "Joined at";}
  .res_table td:nth-of-type(8):before { content: "Details";}
} 

</style>

</div>

</div>

@stop
