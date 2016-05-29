<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Brand Solutions</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="/dist/css/customcss.css">
<link rel="stylesheet" href="/dist/css/wickedpicker.css">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="
https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.0/fullcalendar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />





    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|

<body class="hold-transition skin-blue sidebar-mini">-->
<body class="hold-transition skin-blue layout-boxed">



<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo" style="padding-top: 5px">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <img src="/dist/img/logoklein.png" width="170" height="45" />
          <!--   <span class="logo-mini"><b>B</b>S</span>
            logo for regular state and mobile devices
            <span class="logo-lg"><b>Brand</b>Solutions</span> -->
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">


                    

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!--<img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><i class="fa fa-user"></i> {{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                                <p>
                                    {{ Auth::user()->name }}<br/>
                                     - <br/>
                                    {{ Auth::user()->email}}

                                   <!--  <small></small> -->
                                </p>
                            </li>
                            <!-- Menu Body -->
                          <!--   <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li> -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('account') }}" class="btn btn-default btn-flat">Profiel</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('logout' )}}" class="btn btn-default btn-flat">Uitloggen</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel" style="height:40px;">

               
                
                    <p> Hallo <b>{{ Auth::user()->name  }}</b><br/></p>

                
            </div>

            <!-- search form (Optional) -->
           
                   
                @if (Auth::user()->hasRole('admin'))
            {!! Form::open(['url' => 'search' , 'class' => 'sidebar-form'] )  !!}
           
                <div class="input-group">
                {!! Form::text('searchfield', null, array('required', 'class'=>'form-control', 'placeholder'=>'Werknemer zoeken')) !!}
                <span class="input-group-btn">
             
                
                  <button type="submit" name="" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
                </div>
            {!! Form::close() !!}
            @endif
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">Menu</li>
                <!-- Optionally, you can add icons to the links  ACTIEVE LINK: class="active" -->

                <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> <span>Overzicht</span></a></li>
                <li><a href="{{ url('planning') }}"><i class="fa fa-calendar"></i> <span>Planning</span></a></li>
                 <li><a href="{{ url('loon') }}"><i class="fa fa-money"></i> <span>Loon</span></a></li>
                  <li><a href="{{ url('trainingsmodules') }}"><i class="fa fa-graduation-cap"></i> <span>Trainingsmodules</span></a></li>
                 <li><a href="{{ url('account') }}"><i class="fa fa-gear"></i> <span>Instellingen</span></a></li>
          
                @if (Auth::user()->hasRole('admin'))
                <li class="treeview">
                    <a href=""><i class="fa fa-user"></i> <span>Admin Panel</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('register')}}"><i class="fa fa-plus"></i> Werknemer Toevoegen</a></li>
                        <li></i><a href="{{ url('jobs/create') }}"><i class="fa fa-plus"></i> Werkdag Toevoegen</a></li>
                        <li></i><a href="{{ url('bonus/create') }}"><i class="fa fa-plus"></i> Bonus Toevoegen</a></li>
                        <li></i><a href="{{ url('questions/create') }}"><i class="fa fa-plus"></i> Vraag Toevoegen</a></li>
                          <li></i><a href="{{ url('tests/create') }}"><i class="fa fa-plus"></i> Trainingsmodule Toevoegen</a></li>
                        <li></i><a href="{{ url('werknemers') }}"><i class="fa fa-list"></i> Overzicht Werknemers</a></li>
                        <li></i><a href="{{ url('jobs') }}"><i class="fa fa-list"></i> Overzicht Werkdagen</a></li>
                        <li></i><a href="{{ url('bonus') }}"><i class="fa fa-list"></i> Overzicht Bonussen</a></li>
                         <li></i><a href="{{ url('questions') }}"><i class="fa fa-list"></i> Overzicht Vragen</a></li>
                          <li></i><a href="{{ url('tests') }}"><i class="fa fa-list"></i> Overzicht Trainingsmodules</a></li>
                    </ul>
                </li>
                @endif
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @yield('pageheader')

        <!-- Main content -->
        <section class="content">
            
            @yield('content')



        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
  

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<!-- Bootstrap 3.3.5 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="/dist/js/app.min.js"></script>
<script src="/js/all.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script src="/dist/js/wickedpicker.js"></script>



<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<script src="dist/js/nl.js"></script>
@include('flash')


@yield('footer')




<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>