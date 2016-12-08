<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="" />
    <link rel="shortcut icon" href="javascript:;" type="image/png">
    <title>Fitroute - Admin Dashboard</title>
    
    <!--easy pie chart-->
    <link href="{{URL::to('/')}}/backend/js/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />

    <!--vector maps -->
    <link rel="stylesheet" href="{{URL::to('/')}}/backend/js/vector-map/jquery-jvectormap-1.1.1.css">

    <!--right slidebar-->
    <link href="{{URL::to('/')}}/backend/css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="{{URL::to('/')}}/backend/js/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{URL::to('/')}}/backend/js/toastr-master/toastr.css" rel="stylesheet" type="text/css" />

    <!--dropzone-->
    <link href="{{URL::to('/')}}/backend/css/dropzone.css" rel="stylesheet">

    <!--jquery-ui-->
    <link href="{{URL::to('/')}}/backend/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />

    <!--iCheck-->
    <link href="{{URL::to('/')}}/backend/js/icheck/skins/all.css" rel="stylesheet">

    <link href="{{URL::to('/')}}/backend/css/owl.carousel.css" rel="stylesheet">
    
    <!--bootstrap-fileinput-master-->
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/backend/js/bootstrap-fileinput-master/css/fileinput.css" />

    <!--Select2-->
    <link href="{{URL::to('backend/css/select2.css')}}" rel="stylesheet">
    <link href="{{URL::to('backend/css/select2-bootstrap.css')}}" rel="stylesheet">

    <!--bootstrap picker-->
    <link rel="stylesheet" type="text/css" href="{{URL::to('backend/js/bootstrap-datepicker/css/datepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::to('backend/js/bootstrap-timepicker/compiled/timepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::to('backend/js/bootstrap-colorpicker/css/colorpicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::to('backend/js/bootstrap-daterangepicker/daterangepicker-bs3.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::to('backend/js/bootstrap-datetimepicker/css/datetimepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::to('backend/js/bootstrap-timepicker/compiled/timepicker.css')}}"/>

    <!--  summernote -->
    <link href="{{URL::to('backend/js/summernote/dist/summernote.css')}}" rel="stylesheet">

    <!--bootstrap-fileinput-master-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('backend/js/bootstrap-fileinput-master/css/fileinput.css')}}" />
    
    <!--common style-->
    <link href="{{URL::to('/')}}/backend/css/style.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/backend/css/style-responsive.css" rel="stylesheet">

    <!--iCheck-->
    <link href="{{URL::to('/')}}/backend/js/icheck/skins/all.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{URL::to('/')}}/backend/js/html5shiv.js"></script>
    <script src="{{URL::to('/')}}/backend/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="{{URL::to('/')}}/admin">
                    <img src="{{URL::to('/')}}/backend/img/logo-icon.png" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">Fitroute</span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li @if (Request::is('admin')) class="active" @endif><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <li class="menu-list<?php echo (Request::segment(2) == 'users') ? ' active' : ''; ?>">
                        <a href=""><i class="fa fa-users"></i>  <span>Users</span></a>
                        <ul class="child-list">
                            <li <?php echo (Request::is('users')) ? ' class="active"' : ''; ?>><a href="{{URL::to('/')}}/users"> All Users</a></li>
                            <li <?php echo (Request::is('users/admin')) ? ' class="active"' : ''; ?>><a href="{{URL::to('/')}}/users/admin"> All Admins</a></li>
                        </ul>
                    </li>
                    <li class="menu-list<?php echo (Request::segment(2) == 'categories') ? ' active' : ''; ?>">
                        <a href=""><i class="fa fa-users"></i>  <span>Categories</span></a>
                        <ul class="child-list">
                            <!--<li <?php echo (Request::is('categories/create')) ? ' class="active"' : ''; ?>><a href="{{URL::to('/')}}/categories/create">New Category</a></li> -->
                            <li <?php echo (Request::is('categories')) ? ' class="active"' : ''; ?>><a href="{{URL::to('categories')}}">All Categories</a></li>
                        </ul>
                    </li>
                    <li class="menu-list<?php echo (Request::segment(2) == 'subcategories') ? ' active' : ''; ?>">
                        <a href=""><i class="fa fa-users"></i>  <span>Subcategories</span></a>
                        <ul class="child-list">
                            <li <?php echo (Request::is('subcategories/create')) ? ' class="active"' : ''; ?>><a href="{{URL::to('/')}}/subcategories/create">New Subcategory</a></li>
                            <li <?php echo (Request::is('subcategories')) ? ' class="active"' : ''; ?>><a href="{{URL::to('subcategories')}}">All subcategories</a></li>
                        </ul>
                    </li>
                    <li class="menu-list<?php echo (Request::segment(2) == 'places') ? ' active' : ''; ?>">
                        <a href=""><i class="fa fa-users"></i>  <span>Places</span></a>
                        <ul class="child-list">
                            <li <?php echo (Request::is('places/create')) ? ' class="active"' : ''; ?>><a href="{{URL::to('/')}}/places/create"> New Place</a></li>
                            <li <?php echo (Request::is('places')) ? ' class="active"' : ''; ?>><a href="{{URL::to('places')}}"> All Places</a></li>
                        </ul>
                    </li>

                </ul>
                <!--sidebar nav end-->
            </div>
        </div>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content">
            <!-- header section start-->
            <div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="{{ URL::to('/') }}" target="_blank">
                        <span class="brand-name">Fitroute</span>
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="{{ URL::to('/') }}" target="_blank">
                        <img src="{{URL::to('/backend/img/logo-icon.png')}}" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <div class="notification-wrap">

                    <!--right notification start-->
                    <div class="right-notification">
                        <ul class="notification-menu">
                            <li>
                                <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    @if( Auth::user()->image )
                                    <img src="{{ Auth::user()->getImage() }}" alt="{{Auth::user()->name}}">
                                    @endif
                                    {{ Auth::user()->name }}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                    <li><a href="{{ URL::to('/users/'.Auth::user()->id.'/edit') }}">  Profile</a></li>
                                    <li><a href="{{ url('signout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--right notification end-->
                </div>

            </div>
            <!-- header section end-->
            @yield('content')

        </div>
        <!-- body content end-->
    </section>

    <!-- Placed js at the end of the document so the pages load faster -->
    <script src="{{URL::to('/')}}/backend/js/jquery-1.10.2.min.js"></script>

    <!--jquery-ui-->
    <script src="{{URL::to('/')}}/backend/js/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

    <script src="{{URL::to('/')}}/backend/js/jquery-migrate.js"></script>
    <script src="{{URL::to('/')}}/backend/js/bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/backend/js/modernizr.min.js"></script>

    <!--Nice Scroll-->
    <script src="{{URL::to('/')}}/backend/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!--right slidebar-->
    <script src="{{URL::to('/')}}/backend/js/slidebars.min.js"></script>

    <!--switchery-->
    <script src="{{URL::to('/')}}/backend/js/switchery/switchery.min.js"></script>
    <script src="{{URL::to('/')}}/backend/js/switchery/switchery-init.js"></script>

    <!--Sparkline Chart-->
    <script src="{{URL::to('/')}}/backend/js/sparkline/jquery.sparkline.js"></script>
    <script src="{{URL::to('/')}}/backend/js/sparkline/sparkline-init.js"></script>

    <!--vectormap-->
    <script src="{{URL::to('/')}}/backend/js/vector-map/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{URL::to('/')}}/backend/js/vector-map/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{URL::to('/')}}/backend/js/dashboard-vmap-init.js"></script>

    <!--Icheck-->
    <script src="{{URL::to('/')}}/backend/js/icheck/skins/icheck.min.js"></script>
    <script src="{{URL::to('/')}}/backend/js/todo-init.js"></script>

    <!--jquery countTo-->
    <script src="{{URL::to('/')}}/backend/js/jquery-countTo/jquery.countTo.js"  type="text/javascript"></script>

    <!--owl carousel-->
    <script src="{{URL::to('/')}}/backend/js/owl.carousel.js"></script>

    <!-- validate -->
    <script type="text/javascript" src="{{URL::to('/')}}/backend/js/jquery.validate.min.js"></script>

    <!--bootstrap-fileinput-master-->
    <script type="text/javascript" src="{{URL::to('/')}}/backend/js/bootstrap-fileinput-master/js/fileinput.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/backend/js/file-input-init.js"></script>

    <!--select2-->
    <script type="text/javascript" src="{{URL::to('/')}}/backend/js/select2.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/backend/js/select2-init.js"></script>

    <!--bootstrap picker-->
    <script type="text/javascript" src="{{URL::to('backend/js/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('backend/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('backend/js/bootstrap-daterangepicker/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('backend/js/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('backend/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('backend/js/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('backend/js/picker-init.js')}}"></script>
    <!--Icheck-->
    <script src="{{URL::to('backend/js/icheck/skins/icheck.min.js')}}"></script>
    <!--icheck init-->
    <script src="{{URL::to('backend/js/icheck-init.js')}}"></script>
    <!--dropzone-->
    <script src="{{URL::to('/')}}/backend/js/dropzone.js"></script>
    <!--summernote-->
    <script src="{{URL::to('backend/js/summernote/dist/summernote.min.js')}}"></script>
    <script src="{{URL::to('/')}}/backend/js/toastr-master/toastr.js"></script>
    <script src="{{URL::to('/')}}/backend/js/toastr-init.js"></script>
    <!--common scripts for all pages-->
    <script src="{{URL::to('backend/js/scripts.js')}}"></script>


    @yield('scripts')
</body>
</html>
