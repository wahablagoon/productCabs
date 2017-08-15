<?php
$today="Today Statement - ". date("d - M - Y");
?>
@extends('layouts.dashboard')
@section('page_heading',$today)
@section('section')
            <div class="row">
<div class="col-sm-12">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-rocket fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">0</div>
                                    <div>Total Rides</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-line-chart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">0</div>
                                    <div>Revenue</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-times fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">0</div>
                                    <div>Cancelled rides!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">0</div>
                                    <div>Completed rides</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
            </div>

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
            <th>Booking id</th>
            <th>Picked up</th>
            <th>Dropped</th>
            <th>Details</th>
            <th>Commission</th>
            <th>Date</th>
            <th>Status</th>
            <th>Earned</th>
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

  .res_table td:nth-of-type(1):before { content: "Booking id" ; }
  .res_table td:nth-of-type(2):before { content: "Picked up";}
  .res_table td:nth-of-type(3):before { content: "Dropped";}
  .res_table td:nth-of-type(4):before { content: "Details";}
  .res_table td:nth-of-type(5):before { content: "Commission";}
  .res_table td:nth-of-type(6):before { content: "Date";}
  .res_table td:nth-of-type(7):before { content: "Status";}
  .res_table td:nth-of-type(8):before { content: "Earned";}
} 

</style>

</div>

</div>

@stop
