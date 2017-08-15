@extends('layouts.dashboard')
@section('page_heading','Promocode')
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

         <a class="floatbtn floating-button waves-effect waves-light add_promo" href="#"  data-toggle="modal" data-target="#add_promo_popup"><span class="plus">+</span>
            <img class="edit" src="{{ url('assets/images/add.png') }}">
            </a>
<table id="user_listing" class="display res_table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Coupon</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Expired on</th>
            <th>status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
$status_list = [
  0 => 'In active',
  1 => 'Active'
];
foreach($coupon as $promo)
{
?>
    <tr id="promo_{{ $promo->id }}" data-expired="{{ $promo->expired_in }}"  data-code="{{ $promo->code }}" 
      data-type="{{ $promo->type }}" data-amount="{{ $promo->amount }}" data-status="{{ $promo->status }}" >
        <td>{{ $promo->id }}</td>
        <td>{{ $promo->code }}</td>
        <td>{{ $promo->type }}</td>
        <td>{{ $promo->amount }}</td>
        <td>{{ $promo->expired_in }}</td>
        <td>{{ strtr($promo->status,$status_list) }}</td>
        <td>
            <a href="#" data-toggle="modal" data-id="{{ $promo->id }}" data-target="#add_promo_popup" class="view_edit_promo"><label class="uedit"><i class="fa fa-edit" aria-hidden="true"></i></label></a>
            <a href="delete_promo/{{ $promo->id }}"><label class="udelete"><i class="fa fa-trash" aria-hidden="true"></i></label></a>
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
  .res_table td:nth-of-type(2):before { content: "Code";}
  .res_table td:nth-of-type(3):before { content: "Type";}
  .res_table td:nth-of-type(4):before { content: "Amount";}
  .res_table td:nth-of-type(5):before { content: "Expired in";}
  .res_table td:nth-of-type(6):before { content: "Status";}
  .res_table td:nth-of-type(7):before { content: "Action";}
} 

</style>

</div>

</div>



  <!-- Modal -->
  <div class="modal fade" id="add_promo_popup" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Promo code</h4>
        </div>
        <form  name="addpromo">
          <input type="hidden" id="edity" value="no">
          <input type="hidden" id="promo_id" value="">
        <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 cp_nopad material_form add_form">
                  <div class="input-field cp_label1">
                    <div class="switch" style="width:100%">
                      <label>
                        Inactive
                        <input type="checkbox" name="status" id="status">
                        <span class="lever"></span>
                        Active
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 cp_nopad">
                  <div class="input-group">
                    <input type="text" class="form-control" id="code" value="" name="code">
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>


                <div class="col-md-6 col-sm-6 col-xs-6 col-xs-12 cp_nopad">
                  <div class="input-group date" data-provide="datepicker">
                      <input type="text" class="form-control" id="expired">
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 col-xs-12 cp_nopad">
                  <label class="cp_label">
                    <input name="ptype" type="radio" id="ptype_price" value="Amount" checked/>
                    <label for="ptype_price">Amount</label>
                  </label>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-6  col-xs-12 cp_nopad">
                  <label class="cp_label">
                    <input name="ptype" type="radio" id="ptype_per" value="Percentage" />
                    <label for="ptype_per">Percentage</label>
                  </label>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 cp_nopad">
                  <div class="input-group">
                    <input type="text" class="form-control" id="price" value="" name="price">
                    <span class="input-group-addon price_tag">
                      $
                    </span>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="add_promo">submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="close_promo">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<style>
.cp_nopad
{
  margin: 5px 0;
}
</style>
@stop
