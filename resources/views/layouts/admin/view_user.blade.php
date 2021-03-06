@extends('layouts.dashboard')
@section('page_heading','Users')
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

         <a class="floatbtn floating-button waves-effect waves-light" href="{{ url("admin/passenger/create") }}"><span class="plus">+</span>
            <img class="edit" src="{{ url('assets/images/add.png') }}">
            </a>
<table id="user_listing" class="display res_table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Wallet</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($user as $users)
{
?>
    <tr>
        <td>{{ $users->name }}</td>
        <td>{{ $users->email }}</td>
        <td>{{ $users->phone }}</td>
        <td>{{ $users->wallet }}</td>
        <td><label class="uhistory"><i class="fa fa-history" aria-hidden="true"></i></label>
            <a href="edit_user/{{ $users->id }}/1"><label class="uedit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></label></a>
            <a href="delete_user/{{ $users->id }}/1"><label class="udelete"><i class="fa fa-trash" aria-hidden="true"></i></label></a>
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
  .res_table td:nth-of-type(1):before { content: "Name";}
  .res_table td:nth-of-type(2):before { content: "Email";}
  .res_table td:nth-of-type(3):before { content: "Phone";}
  .res_table td:nth-of-type(4):before { content: "Wallet";}
  .res_table td:nth-of-type(5):before { content: "Action";}
} 

</style>

</div>

</div>
<!-- <div class="fixed-action-btn horizontal click-to-toggle spin-close relative-action-btn float_right">
    <a class="btn-floating btn-large red tooltipped" data-tooltip="Export users">
<i class="fa fa-cloud-download" aria-hidden="true"></i>
    </a>
    <ul>
      <li><a href="{{ url('admin/export/1/xls/Passenger details') }}" class="btn-floating yellow darken-1 tooltipped " data-tooltip="Excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
</a></li>
      <li><a href="{{ url('admin/export/1/pdf/Passenger details') }}" class="btn-floating green tooltipped " data-tooltip="PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a></li>
      <li><a href="{{ url('admin/export/1/csv/Passenger details') }}" class="btn-floating blue tooltipped " data-tooltip="CSV"><i class="fa fa-file" aria-hidden="true"></i></a></li>
    </ul>
</div>   
 -->



@stop
