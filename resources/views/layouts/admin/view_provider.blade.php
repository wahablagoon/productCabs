@extends('layouts.dashboard')
@section('page_heading','Provider')
@section('section')
<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
<div class="search-form">
              <div class="form-group-search has-feedback">
              <input type="user_search" class="form-control" name="search" id="search" placeholder="">
                <span class="glyphicon glyphicon-search form-control-feedback plus"></span>
            </div>
          </div>
         <div class="panel panel-default panel-custom">
 <a class="floatbtn floating-button waves-effect waves-light" href="{{ url("admin/driver/create") }}"><span class="plus">+</span>
            <img class="edit" src="{{ url('assets/images/add.png') }}">
            </a>
<table id="user_listing" class="display res_table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Wallet</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
$user=DB::table('member')->where('role',2)->get();
foreach($user as $users)
{
?>
    <tr>
        <td>{{ $users->id }}</td>
        <td>{{ $users->firstname }}</td>
        <td>{{ $users->lastname }}</td>
        <td>{{ $users->email }}</td>
        <td>{{ $users->phone }}</td>
        <td>{{ $users->wallet }}</td>
        <td><label class="uhistory"><i class="fa fa-history" aria-hidden="true"></i>History</label>
            <label class="uedit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</label>
            <label class="udelete"><i class="fa fa-trash" aria-hidden="true"></i>Delete</label>
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
            
<div class="fixed-action-btn horizontal click-to-toggle spin-close relative-action-btn float_right">
    <a class="btn-floating btn-large red tooltipped" data-tooltip="Export users">
<i class="fa fa-cloud-download" aria-hidden="true"></i>
    </a>
    <ul>
      <li><a class="btn-floating yellow darken-1 tooltipped " data-tooltip="Excel"><i class="material-icons">format_quote</i></a></li>
      <li><a class="btn-floating green"><i class="material-icons tooltipped " data-tooltip="Pdf">publish</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons tooltipped " data-tooltip="Print" >attach_file</i></a></li>
    </ul>
</div>   


@stop
