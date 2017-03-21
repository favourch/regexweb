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


    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{url('assets/plugins/materialize/css/materialize.min.css')}}"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{url('assets/plugins/material-preloader/css/materialPreloader.min.css')}}" rel="stylesheet">


    <link href="{{url('assets/libs/jquery.scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{url('assets/css/regex.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>


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
                <div class="header-title col s3">
                    <a href="{{url('/')}}">
                    <img class="logo" src="{{url('assets/images/logo.png')}}" style="height:50px;">
                    <span class="logoText">REGEX LECTURER PORTAL</span>
                    </a>
                </div>
                <ul class="right col s9 m3 nav-right-menu">
                    <li><img src="{{url('assets/images/english.png')}}"></li>
                    <li><img src="{{url('assets/images/russia.png')}}"></li>
                    <!--<li><a href="javascript:void(0)" data-activates="chat-sidebar" class="chat-button show-on-large"><i class="material-icons">more_vert</i></a></li>-->


                </ul>

            </div>
        </nav>
    </header>


    @yield('content')

</div>


<!-- Javascripts -->
<script src="{{url('assets/plugins/jquery/jquery-2.2.0.min.js')}}"></script>
<script src="{{url('assets/plugins/materialize/js/materialize.min.js')}}"></script>
<script src="{{url('assets/plugins/material-preloader/js/materialPreloader.min.js')}}"></script>
<script src="{{url('assets/plugins/jquery-blockui/jquery.blockui.js')}}"></script>
<script src="{{url('assets/js/regex.min.js')}}"></script>
<script src="{{url('assets/js/custom.js')}}"></script>

<script src="assets/libs/jquery.scrollbar/jquery.scrollbar.min.js"></script>



</body>
</html>

