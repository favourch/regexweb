<!DOCTYPE html>
<html lang="en">
<head>


    <!-- Title -->
    <title>REGEX PORTAL | REGENT UNIVERSITY COLLEGE OF SCIENCE AND TECHNOLOGY </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Toby Okeke" />
    <meta name="csrf" content="{{csrf_token()}}">


    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{url('assets/plugins/materialize/css/materialize.min.css')}}"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{url('assets/plugins/material-preloader/css/materialPreloader.min.css')}}" rel="stylesheet">


    <link href="{{url('assets/libs/jquery.scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/plugins/dropzone/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/plugins/dropzone/basic.min.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{url('assets/css/regex.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>


    <!-- Javascripts -->
    <script src="{{url('assets/plugins/jquery/jquery-2.2.0.min.js')}}"></script>

    <script src="{{url('assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{url('assets/plugins/materialize/js/materialize.min.js')}}"></script>
    <script src="{{url('assets/plugins/material-preloader/js/materialPreloader.min.js')}}"></script>
    <script src="{{url('assets/plugins/jquery-blockui/jquery.blockui.js')}}"></script>
    <script src="{{url('assets/js/regex.min.js')}}"></script>
    <script src="{{url('assets/js/custom.js')}}"></script>


    <!-- charts -->


    <!-- Load c3.css -->
    <link href="{{url('chart/c3.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Load d3.js and c3.js -->
    <script src="{{url('chart/d3.min.js')}}"></script>
    <script src="{{url('chart/c3.min.js')}}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>
<body>
<div class="loader-bg"></div>
<div class="loader">
    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-spinner-teal lighten-1">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
<div class="mn-content fixed-sidebar">
    <header class="mn-header navbar-fixed">
        <nav class="regent">
            <div class="nav-wrapper row">
                <section class="material-design-hamburger navigation-toggle">
                    <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                        <span class="material-design-hamburger__layer"></span>
                    </a>
                </section>
                <div class="header-title col m3 ">
                    <a href="{{url('/')}}">
                        <img class="logo" src="{{url('assets/images/logo.png')}}" style="height:50px;">
                        <span class="logoText hide-on-med-and-down">REGEX LECTURER PORTAL</span>
                    </a>
                </div>
                <ul class="right col s9 m3 nav-right-menu">
                    <li><img src="{{url('assets/images/english.png')}}"></li>
                    <li><img src="{{url('assets/images/russia.png')}}"></li>
                    <!--<li><a href="javascript:void(0)" data-activates="chat-sidebar" class="chat-button show-on-large"><i class="material-icons">more_vert</i></a></li>-->
                    <li class="hide-on-small-and-down"><a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right show-on-large"><i class="material-icons">notifications_none</i><span class="badge">4</span></a></li>
                    <li class="hidemobile">

                        <a href="{{url('logout')}}" class="waves-effect waves-light btn m-b-xs" style="background-color:#0d47a1;">Logout</a>

                    </li>
                    <li class="hide-on-med-and-up"><a href="javascript:void(0)" class="search-toggle"><i class="material-icons">search</i></a></li>

                </ul>

                <ul id="dropdown1" class="dropdown-content notifications-dropdown">
                    <li class="notificatoins-dropdown-container">
                        <ul>
                            <li class="notification-drop-title">Today</li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle cyan"><i class="material-icons">done</i></div>
                                        <div class="notification-text"><p><b>Alan Grey</b> uploaded new thing</p><span>7 min ago</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle deep-purple"><i class="material-icons">cached</i></div>
                                        <div class="notification-text"><p><b>Tom</b> updated status</p><span>14 min ago</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle red"><i class="material-icons">delete</i></div>
                                        <div class="notification-text"><p><b>Amily Lee</b> deleted account</p><span>28 min ago</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle cyan"><i class="material-icons">person_add</i></div>
                                        <div class="notification-text"><p><b>Tom Simpson</b> registered</p><span>2 hrs ago</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle green"><i class="material-icons">file_upload</i></div>
                                        <div class="notification-text"><p>Finished uploading files</p><span>4 hrs ago</span></div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-drop-title">Yestarday</li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle green"><i class="material-icons">security</i></div>
                                        <div class="notification-text"><p>Security issues fixed</p><span>16 hrs ago</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle indigo"><i class="material-icons">file_download</i></div>
                                        <div class="notification-text"><p>Finished downloading files</p><span>22 hrs ago</span></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <div class="notification">
                                        <div class="notification-icon circle cyan"><i class="material-icons">code</i></div>
                                        <div class="notification-text"><p>Code changes were saved</p><span>1 day ago</span></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    @yield('content')


    <div class="fixed-action-btn horizontal">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
            <li><a href="{{url('lecturers')}}" class="btn-floating regent"><i class="material-icons">home</i></a></li>
            <li><a href="{{url('lecturers/upload')}}" class="btn-floating green"><i class="material-icons">publish</i></a></li>
            <li><a class="btn-floating regent1"><i class="material-icons">feedback</i></a></li>
        </ul>
    </div>

</div>
<div class="left-sidebar-hover"></div>





</body>
</html>

