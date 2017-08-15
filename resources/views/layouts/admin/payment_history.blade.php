@extends('layouts.dashboard')
@section('page_heading','Payment History')
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
            <th>Transaction id</th>
            <th>From</th>
            <th>To</th>
            <th>Total Amount</th>
            <th>Payment mode</th>
            <th>Status</th>
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
  .res_table td:nth-of-type(2):before { content: "Transaction ID";}
  .res_table td:nth-of-type(3):before { content: "From";}
  .res_table td:nth-of-type(4):before { content: "To";}
  .res_table td:nth-of-type(5):before { content: "Total Amount";}
  .res_table td:nth-of-type(6):before { content: "Payment mode";}
  .res_table td:nth-of-type(7):before { content: "Status";}
  .res_table td:nth-of-type(8):before { content: "Action";}
} 

</style>

</div>

</div>

@stop
