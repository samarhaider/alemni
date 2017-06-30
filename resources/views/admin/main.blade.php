<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />
    <link rel="icon" href="/neon/images/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title or 'Dashboard' }} / {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{url('neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="'{{url('neon/css/font-icons/font-awesome/css/font-awesome.min.css')}}'">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{url('neon/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/neon-forms.css')}}">
    
    @stack('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{url('neon/css/custom.css')}}">

    <script src="{{url('neon/js/jquery-1.11.3.min.js')}}"></script>

    <!--[if lt IE 9]><script src="/neon/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="page-body" data-url="http://forssah.dev">
    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <div class="sidebar-menu fixed">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="{{url('users')}}">
                            Alemni
                        </a>
                    </div>
                    <!-- logo collapse icon -->
                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>          
                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                </header>
                <ul id="main-menu" class="main-menu">
                    <li class="{{ Request::segment(1) == 'users' ? 'active' : null }}">
                        <a href="{{url('users')}}">
                            <i class="entypo-users"></i>
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) == 'tuitions' ? 'active' : null }}">
                        <a href="{{url('tuitions')}}">
                            <i class="entypo-database"></i>
                            <span class="title">Tuitions</span>
                        </a>
                    </li>
                    <li class="{{ Request::segment(1) == 'khair' ? 'active' : null }}">
                        <a href="{{url('khairs')}}">
                            <i class="entypo-credit-card"></i>
                            <span class="title">Khair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content">  
            <div class="row">
                <!-- Profile Info and Notifications -->
                <div class="col-md-6 col-sm-8 clearfix">
                </div>
                <!-- Raw Links -->
                <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                    <ul class="list-inline links-list pull-right">
                        <li>
                            <a href="{{ url('/admin/logout') }}" title="Logout" 
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                               Logout<i class="entypo-logout right"></i>
                            </a>

                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            @yield('content')
        </div>
    </div>
    <!-- Bottom scripts (common) -->
    <script src="{{url('neon/js/gsap/TweenMax.min.js')}}"></script>
    <script src="{{url('neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
    <script src="{{url('neon/js/bootstrap.js')}}"></script>
    
    <script src="{{url('neon/js/joinable.js')}}"></script>
    <script src="{{url('neon/js/resizeable.js')}}"></script>
    <script src="{{url('neon/js/neon-api.js')}}"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <!-- Imported scripts on this page -->
    @stack('scripts')
    <!-- JavaScripts initializations and stuff -->
    <script src="{{url('neon/js/neon-custom.js')}}"></script>
    <script src="{{url('neon/js/fileinput.js')}}"></script>
</body>
</html>