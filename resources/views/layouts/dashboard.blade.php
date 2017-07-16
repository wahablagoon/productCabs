@extends('layouts.plane')

@section('body')
 <div id="wrapper" class="">

        <!-- Navigation -->
        

        
        <div class="wrapper">
            <div class="preloader"></div>
            <div class="site-overlay"></div>
            
            <div class="site-sidebar">
                <div class="custom-scroll custom-scroll-light">
                    <ul class="sidebar-menu">
                        <li class="menu-title">Admin Dashboard</li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/dashboard" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-anchor"></i></span>
                                <span class="s-text">Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="menu-title">Members</li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="ti-user"></i></span>
                                <span class="s-text">Users</span>
                            </a>
                            <ul>
                                <li><a href="http://localhost/Hari/trippy/admin/user">List Users</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/user/create">Add New User</a></li>
                            </ul>
                        </li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="ti-car"></i></span>
                                <span class="s-text">Providers</span>
                            </a>
                            <ul>
                                <li><a href="http://localhost/Hari/trippy/admin/provider">List Providers</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/provider/create">Add New Provider</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/dashboard" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-alarm-clock"></i></span>
                                <span class="s-text">Ride Later</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/dashboard" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-stats-up"></i></span>
                                <span class="s-text">Peak Hour pricing</span>
                            </a>
                        </li>

                        

                        <li class="menu-title">Accounts</li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="ti-crown"></i></span>
                                <span class="s-text">Statements</span>
                            </a>
                            <ul>
                                <li><a href="http://localhost/Hari/trippy/admin/statement">Overall Ride Statments</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/statement/provider">Provider Statement</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/statement/today">Daily Statement</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/statement/monthly">Monthly Statement</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/statement/yearly">Yearly Statement</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Details</li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/map" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-map-alt"></i></span>
                                <span class="s-text">Map</span>
                            </a>
                        </li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="ti-view-grid"></i></span>
                                <span class="s-text">Ratings &amp; Reviews</span>
                            </a>
                            <ul>
                                <li><a href="http://localhost/Hari/trippy/admin/review/user">User Ratings</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/review/provider">Provider Ratings</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Requests</li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/requests" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-infinite"></i></span>
                                <span class="s-text">Request History</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/scheduled" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-palette"></i></span>
                                <span class="s-text">Scheduled Rides</span>
                            </a>
                        </li>
                        <li class="menu-title">General</li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="ti-view-grid"></i></span>
                                <span class="s-text">Service Types</span>
                            </a>
                            <ul>
                                <li><a href="http://localhost/Hari/trippy/admin/service">List Service Types</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/service/create">Add New Service Type</a></li>
                            </ul>
                        </li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="ti-layout-tab"></i></span>
                                <span class="s-text">Documents</span>
                            </a>
                            <ul>
                                <li><a href="http://localhost/Hari/trippy/admin/document">List Documents</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/document/create">Add New Document</a></li>
                            </ul>
                        </li>
                        
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="ti-layout-tab"></i></span>
                                <span class="s-text">Promocodes</span>
                            </a>
                            <ul>
                                <li><a href="http://localhost/Hari/trippy/admin/promocode">List Promocodes</a></li>
                                <li><a href="http://localhost/Hari/trippy/admin/promocode/create">Add New Promocode</a></li>
                            </ul>
                        </li>
                        
                        <li class="menu-title">Payment Details</li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/payment" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-infinite"></i></span>
                                <span class="s-text">Payment History</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/settings/payment" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-money"></i></span>
                                <span class="s-text">Payment Settings</span>
                            </a>
                        </li>
                        <li class="menu-title">Settings</li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/settings" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-settings"></i></span>
                                <span class="s-text">Site Settings</span>
                            </a>
                        </li>
                        
                        <li class="menu-title">Others</li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/privacy" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-help"></i></span>
                                <span class="s-text">Privacy Policy</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/help" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-help"></i></span>
                                <span class="s-text">Help</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/Hari/trippy/translations" class="waves-effect waves-light">
                                <span class="s-icon"><i class="ti-smallcap"></i></span>
                                <span class="s-text">Translations</span>
                            </a>
                        </li>
                        <li class="menu-title">Account</li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/profile" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-user"></i></span>
                                <span class="s-text">Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/Hari/trippy/admin/password" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-exchange-vertical"></i></span>
                                <span class="s-text">Change Password</span>
                            </a>
                        </li>
                        <li class="compact-hide">
                            <a href="http://localhost/Hari/trippy/admin/logout"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="s-icon"><i class="ti-power-off"></i></span>
                                <span class="s-text">Logout</span>
                            </a>
                            
                            <form id="logout-form" action="http://localhost/Hari/trippy/admin/logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="V7eGUn0ZoWZIhJl2zFfHJqRI8RqJIHQYIvbIXG0V">
                                    </form>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <!-- Header -->
            <div class="site-header">
                <nav class="navbar navbar-light">
                    <div class="navbar-left">
                        <a class="navbar-brand" href="http://localhost/Hari/trippy/admin/dashboard">
                            <div class="logo" style="background: url({{ url('assets/images/logo.png') }}) no-repeat;"></div>
                        </a>
                        <div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
                            <span class="hamburger"></span>
                        </div>
                        <div class="toggle-button-second dark float-xs-right hidden-md-up">
                            <i class="ti-arrow-left"></i>
                        </div>
                        <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
                            <span class="more"></span>
                        </div>
                    </div>
                    <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1" style="display:none">
                        <div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
                            <span class="hamburger"></span>
                        </div>
                        
                        <ul class="nav navbar-nav">
                            <li class="nav-item hidden-sm-down">
                                <a class="nav-link toggle-fullscreen" href="#">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        
                        <ul class="nav navbar-nav float-md-right">
                            <li class="nav-item dropdown hidden-sm-down">
                                <a href="#" data-toggle="dropdown" aria-expanded="false">
                                    <span class="avatar box-32">
                                        <img src="{{url('assets/images/avatar.png')}}" alt="">
                                            </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right animated fadeInUp">
                                    <a class="dropdown-item" href="http://localhost/Hari/trippy/admin/profile">
                                        <i class="ti-user mr-0-5"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="http://localhost/Hari/trippy/admin/password">
                                        <i class="ti-settings mr-0-5"></i> Change Password
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="http://localhost/Hari/trippy/admin/help"><i class="ti-help mr-0-5"></i> Help</a>
                                    <a class="dropdown-item" href="http://localhost/Hari/trippy/admin/logout"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="ti-power-off mr-0-5"></i> Sign out</a>
                                </div>
                            </li>
                        </ul>
                        
                    </div>
                </nav>
            </div>    
        
        <div id="" class="site-content body_container">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
</div>
@stop

