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
                            <a href="{{ url("admin/dashboard") }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
                                <span class="s-text">Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="menu-title">Members</li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <span class="s-text">Users</span>
                            </a>
                            <ul>
                                <li><a href="{{ url("admin/user") }}">List Users</a></li>
                                <li><a href="{{ url("admin/user/create") }}">Add New User</a></li>
                            </ul>
                        </li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="fa fa-taxi" aria-hidden="true"></i></span>
                                <span class="s-text">Providers</span>
                            </a>
                            <ul>
                                <li><a href="{{ url("admin/provider") }}">List Providers</a></li>
                                <li><a href="{{ url("admin/provider/create") }}">Add New Provider</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url("admin/dashboard") }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                <span class="s-text">Ride Later</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url("admin/dashboard") }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-line-chart" aria-hidden="true"></i></span>
                                <span class="s-text">Peak Hour pricing</span>
                            </a>
                        </li>

                        

                        <li class="menu-title">Accounts</li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="fa fa-area-chart" aria-hidden="true"></i></span>
                                <span class="s-text">Statements</span>
                            </a>
                            <ul>
                                <li><a href="{{ url("admin/statement") }}">Overall Ride Statments</a></li>
                                <li><a href="{{ url("admin/statement/provider") }}">Provider Statement</a></li>
                                <li><a href="{{ url("admin/statement/today") }}">Daily Statement</a></li>
                                <li><a href="{{ url("admin/statement/monthly") }}">Monthly Statement</a></li>
                                <li><a href="{{ url("admin/statement/yearly") }}">Yearly Statement</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Details</li>
                        <li>
                            <a href="{{ url("admin/map") }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                <span class="s-text">Map</span>
                            </a>
                        </li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="fa fa-star" aria-hidden="true"></i></span>
                                <span class="s-text">Ratings &amp; Reviews</span>
                            </a>
                            <ul>
                                <li><a href="{{ url("admin/review/user") }}">User Ratings</a></li>
                                <li><a href="{{ url("admin/review/provider") }}">Provider Ratings</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Requests</li>
                        <li>
                            <a href="{{ url("admin/requests") }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-history" aria-hidden="true"></i></span>
                                <span class="s-text">Request History</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url("admin/scheduled") }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                <span class="s-text">Scheduled Rides</span>
                            </a>
                        </li>
                        <li class="menu-title">General</li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="fa fa-car" aria-hidden="true"></i></span>
                                <span class="s-text">Service Types</span>
                            </a>
                            <ul>
                                <li><a href="{{ url("admin/service") }}">List Service Types</a></li>
                                <li><a href="{{ url("admin/service/create") }}">Add New Service Type</a></li>
                            </ul>
                        </li>
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                                <span class="s-text">Documents</span>
                            </a>
                            <ul>
                                <li><a href="{{ url("admin/document") }}">List Documents</a></li>
                                <li><a href="{{ url("admin/document/create") }}">Add New Document</a></li>
                            </ul>
                        </li>
                        
                        <li class="with-sub">
                            <a href="#" class="waves-effect  waves-light">
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                                <span class="s-icon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                                <span class="s-text">Promocodes</span>
                            </a>
                            <ul>
                                <li><a href="{{ url("admin/promocode") }}">List Promocodes</a></li>
                                <li><a href="{{ url("admin/promocode/create") }}">Add New Promocode</a></li>
                            </ul>
                        </li>
                        
                        <li class="menu-title">Payment Details</li>
                        <li>
                            <a href="{{ url("admin/payment") }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                <span class="s-text">Payment History</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url("admin/settings/payment") }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                <span class="s-text">Payment Settings</span>
                            </a>
                        </li>
                        <li class="menu-title">Settings</li>
                        <li>
                            <a href="{{ url("admin/settings") }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="fa fa-cog" aria-hidden="true"></i></span>
                                <span class="s-text">Site Settings</span>
                            </a>
                        </li>
                        
                        <li class="menu-title">Others</li>
                        <li>
                            <a href="{{ url("admin/privacy") }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <span class="s-text">Privacy Policy</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url("admin/help") }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></span>
                                <span class="s-text">Help</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url("translations") }}" class="waves-effect waves-light">
                                <span class="s-icon"><i class="fa fa-language" aria-hidden="true"></i></span>
                                <span class="s-text">Translations</span>
                            </a>
                        </li>
                        <li class="menu-title">Account</li>
                        <li>
                            <a href="{{ url("admin/profile") }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-user"></i></span>
                                <span class="s-text">Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url("admin/password") }}" class="waves-effect  waves-light">
                                <span class="s-icon"><i class="ti-exchange-vertical"></i></span>
                                <span class="s-text">Change Password</span>
                            </a>
                        </li>
                        <li class="compact-hide">
                            <a href="{{ url("logout") }}">
                                <span class="s-icon"><i class="fa fa-power-off" aria-hidden="true"></i></span>
                                <span class="s-text">Logout</span>
                            </a>
                            
                            <form id="logout-form" action="{{ url("admin/logout") }}" method="POST" style="display: none;">
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
                        <a class="navbar-brand" href="{{ url("admin/dashboard") }}">
                            <div class="logo" style="display:none;background: url({{ url('storage/app/images/'.site_settings()->site_logo) }}) no-repeat;"></div>
                            <div class="logo_title" style="font-family: Oleo Script; padding: 5px; font-size: 32px;">
                                {{ site_settings()->site_name }}
                            </div>
                        </a>
                        <div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
                            <span class="hamburger"></span>
                        </div>
   <!--                      <div class="toggle-button-second dark float-xs-right hidden-md-up">
                                <a href=" {{ url('logout') }} "  aria-expanded="false">
                                        <span class="s-icon"><i class="fa fa-power-off" aria-hidden="true"></i></span>
                                </a>

                        </div> -->
                        <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse2">
                            <span class="more"></span>
                        </div>
                        <ul class="dropdown-menu" id="collapse2" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                                    <li><a href="#"><span class="s-icon"><i class="fa fa-lock" aria-hidden="true"></i></span>Change password</a></li>
                                    <li><a href=" {{ url('logout') }} "><span class="s-icon"><i class="fa fa-power-off" aria-hidden="true"></i></span>Logout</a></li>
                        </ul>

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
                         <ul class="nav navbar-nav float-md">
                            <li class="nav-item  hidden-sm-down" style="font-family: Oleo Script; padding: 5px; font-size: 32px;">
                                {{ site_settings()->site_name }}
                            </li>
                        </ul>
                        <ul class="nav navbar-nav float-md-right">
                            <li class="dropdown nav-item  hidden-sm-down">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="avatar box-32">
                                        <img src="{{url('assets/images/avatar.png')}}" alt="">
                                            </span>
                                </a>
                                <ul class="dropdown-menu" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                                    <li><a href="#"><span class="s-icon"><i class="fa fa-lock" aria-hidden="true"></i></span>Change password</a></li>
                                    <li><a href=" {{ url('logout') }} "><span class="s-icon"><i class="fa fa-power-off" aria-hidden="true"></i></span>Logout</a></li>
                                </ul>

                            </li>

                        </ul>
                        <ul class="nav navbar-nav float-md-right">
                            <li class="dropdown nav-item  hidden-sm-down">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="avatar box-32">
<i class="fa fa-bell bell_notify"  aria-hidden="true"></i>
                                            </span>
                                </a>
                                <ul class=" dropdown-menu" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-comment fa-fw"></i> New Comment
                                            
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                                            
                                        </a>
                                     </li>
                                    <li>
                                       <a href="#" class="list-group-item1">
                                            <i class="fa fa-tasks fa-fw"></i> New Task
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-group-item1">
                                            <i class="fa fa-money fa-fw"></i> Payment Received

                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                                    </li>
                                </ul>

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

