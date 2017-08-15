@extends('layouts.dashboard')
@section('page_heading','Peak Hour Pricing')
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

         <a class="floatbtn floating-button waves-effect waves-light add_peak" href="#"  data-toggle="modal" data-target="#add_peak_popup"><span class="plus">+</span>
            <img class="edit" src="{{ url('assets/images/add.png') }}">
            </a>
<table id="user_listing" class="display res_table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Days</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
$days = [
  0 => 'Sunday',
  1 => 'Monday',
  2 => 'Tuesday',
  3 => 'Wednesday',
  4 => 'Thursday',
  5 => 'Friday',
  6 => 'Saturday'
];
foreach($surge as $peaks)
{
?>
    <tr id="peaks_{{ $peaks->id }}" data-start="{{ $peaks->start_time }}" data-end="{{ $peaks->end_time }}" data-days="{{ $peaks->days }}" 
      data-type="{{ $peaks->type }}" data-amount="{{ $peaks->amount }}" data-category="{{ $peaks->category }}" >
        <td>{{ $peaks->id }}</td>
        <td>{{ $peaks->category }}</td>
        <td>{{ $peaks->start_time }}</td>
        <td>{{ $peaks->end_time }}</td>
        <td>{{ strtr(implode(',',explode(',',$peaks->days)),$days) }}</td>
        <td>{{ $peaks->type }}</td>
        <td>{{ $peaks->amount }}</td>
        <td>
            <a href="#" data-toggle="modal" data-id="{{ $peaks->id }}" data-target="#add_peak_popup" class="view_edit_peak"><label class="uedit"><i class="fa fa-edit" aria-hidden="true"></i></label></a>
            <a href="delete_peak/{{ $peaks->id }}"><label class="udelete"><i class="fa fa-trash" aria-hidden="true"></i></label></a>
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
  .res_table td:nth-of-type(2):before { content: "Category";}
  .res_table td:nth-of-type(3):before { content: "Start time";}
  .res_table td:nth-of-type(4):before { content: "End time";}
  .res_table td:nth-of-type(5):before { content: "Days";}
  .res_table td:nth-of-type(6):before { content: "Type";}
  .res_table td:nth-of-type(7):before { content: "Amount";}
  .res_table td:nth-of-type(8):before { content: "Action";}
} 

</style>

</div>

</div>



  <!-- Modal -->
  <div class="modal fade" id="add_peak_popup" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Peak Hour Pricing</h4>
        </div>
        <form  name="addpeak">
          <input type="hidden" id="edity" value="no">
          <input type="hidden" id="peak_id" value="">
        <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                <div class="col-md-12 col-sm-12 cp_nopad material_form add_form">
                  <div class="input-field cp_label1">
                    <select class="icons" id="category">
                      <option value="" disabled selected >Choose your Category</option>
                      @foreach($category as $cat)
                      <option value="{{ $cat->category_name }}" class="left circle" data-icon="<?php echo url('storage/app/images/category/'.$cat->id.'/'.$cat->logo); ?>">{{ $cat->category_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 cp_nopad">
                  <label class="cp_label">
                    <input type="checkbox" class="filled-in weekdays" id="monday" name="days[]" value="1" />
                    <label for="monday">Mon</label>
                  </label>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 cp_nopad">
                  <label class="cp_label">
                    <input type="checkbox" class="filled-in weekdays" id="tuesday" name="days[]" value="2"/>
                    <label for="tuesday">Tue</label>
                  </label>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 cp_nopad">
                  <label class="cp_label">
                    <input type="checkbox" class="filled-in weekdays" id="wednesday" name="days[]" value="3"/>
                    <label for="wednesday">Wed</label>
                  </label>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 cp_nopad">
                  <label class="cp_label">
                    <input type="checkbox" class="filled-in weekdays" id="thursday"  name="days[]" value="4"  />
                    <label for="thursday">Thu</label>
                  </label>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4 cp_nopad">
                  <label class="cp_label">
                    <input type="checkbox" class="filled-in weekdays" id="friday" name="days[]" value="5" />
                    <label for="friday">Fri</label>
                  </label>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4 cp_nopad">
                  <label class="cp_label">
                    <input type="checkbox" class="filled-in weekends" id="saturday"   name="days[]" value="6" />
                    <label for="saturday">Sat</label>
                  </label>
                </div>
                <div class="col-md-4 col-sm-4  col-xs-4 cp_nopad">
                  <label class="cp_label">
                    <input type="checkbox" class="filled-in weekends" id="sunday"  class="weekends" name="days[]" value="0"/>
                    <label for="sunday">Sun</label>
                  </label>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-6 cp_nopad">
                  <div class="input-group clockpicker">
                    <input type="text" class="form-control" placeholder="Start time" id="start_peak" value="00:00">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 cp_nopad">
                  <div class="input-group clockpicker">
                    <input type="text" class="form-control" placeholder="End time" id="end_peak" value="00:00">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                    </span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 cp_nopad">
                  <label class="cp_label">
                    <input name="ptype" type="radio" id="ptype_price" value="Amount" checked/>
                    <label for="ptype_price">Amount</label>
                  </label>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-6 cp_nopad">
                  <label class="cp_label">
                    <input name="ptype" type="radio" id="ptype_per" value="Percentage" />
                    <label for="ptype_per">Percentage</label>
                  </label>
                </div>
                <div class="col-md-4 col-sm-4 cp_nopad">
                  <div class="input-group">
                    <input type="text" class="form-control" id="price" placeholder="Price or percentage" value="" name="price">
                    <span class="input-group-addon price_tag">
                      $
                    </span>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="add_peak">submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="close_peak">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>

@stop
