@extends('layouts.dashboard')
@section('page_heading','Users')
@section('section')
<div class="col-sm-12">            <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
         <div class="panel panel-default panel-custom">
<a class="floatbtn waves-effect waves-light" href="{{ url("admin/user/create") }}"><i class="fa fa-plus"></i></a>

<div class="search-form">
    <div class="form-group has-feedback">
    <input type="text" class="form-control" name="search" id="search" placeholder="">
      <span class="glyphicon glyphicon-search form-control-feedback"></span>
  </div>
</div>
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
$user=DB::table('member')->where('role',1)->get();
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
            
@stop
