@extends('layouts.dashboard')
@section('page_heading','Site Settings')
@section('section')

            <!-- /.row -->
            <div class="col-sm-12">
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                
                @section ('pane2_panel_title', 'General')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Name</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Email</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_email" value="" /></div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Status</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><label class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>

</label>
  <label>Site is working :)</label>
</div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Copyright content</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="copyright" value="" /></div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Playstore Link</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="playstore_link" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Appstore Link</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="appstore_link" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Contact Number</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Contact Email</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="" /></div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 list_settings">
					<div class="col-md-4 col-sm-4 col-xs-12 item_settings">Site Name</div>
					<div class="col-md-8  col-sm-8 col-xs-12"><input type="text" class="text_box"  name="site_name" value="" /></div>
                </div>


                        <!-- /.panel-body -->
                   
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    @section ('cchart11_panel_title','Line Chart')
                    @section ('cchart11_panel_body')
                    @include('widgets.charts.clinechart')
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'cchart11'))

                    @section ('pane1_panel_title', 'Notifications Panel')
                    @section ('pane1_panel_body')
                     
                        
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Payment Received
                                    <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        
                        <!-- /.panel-body -->
                  
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane1'))
                      
                    
                    <!-- /.panel -->
                    @section ('pane3_panel_title', 'Chat')
                    @section ('pane3_panel_body')
                         <div class="btn-group pull-right margin-inverse-top">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>      
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                            </small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane3'))
                </div>

                <!-- /.col-lg-4 -->
            
@stop
