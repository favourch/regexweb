<?php use Carbon\Carbon; ?>
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



    <script>
        function hide(item){
            var itemJquery = $(item);
            itemJquery.css('display','none !important');
        }
    </script>
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

                    @if(\Illuminate\Support\Facades\Input::get('translate') == true)
                    <div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div>
                    <script type='text/javascript'>setTimeout(function(){var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=False&ui=true&settings=Manual&from=';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); },0);</script>

                    @endif
                    <li><img  onclick="window.location = window.location + '?translate=true'"  src="{{url('assets/images/english.png')}}"></li>
                    <li><img onclick="window.location = window.location + '?translate=true'"   src="{{url('assets/images/russia.png')}}"></li>


                    <li class="hide-on-small-and-down">
                        <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right ">
                            <i class="material-icons">notifications_none</i>
                            @if(Session::has('pending'))

                                @if( count(Session::get('pending')) > 0)
                                <span class="badge">{{count(Session::get('pending'))}}</span>
                                @endif
                            @endif
                        </a>
                    </li>

                    <li class="hidemobile">

                        <a href="{{url('logout')}}" class="waves-effect waves-light btn m-b-xs" style="background-color:#0d47a1;">Logout</a>

                    </li>


                </ul>

                <ul id="dropdown1" class="dropdown-content notifications-dropdown">
                    <li class="notificatoins-dropdown-container">
                        <ul>

                            @if(Auth::user()->role == "Dean" || Auth::user()->role == "HOD")
                            <li class="notification-drop-title">Pending Approval</li>
                            @endif

                            @if(Session::has('pending'))

                            @foreach(Session::get('pending') as $item)
                            <li>
                                <a href="{{url('/') . "/" . strtolower( Auth::user()->role ) . "s/approve-results" }}">
                                    <div class="notification">
                                        <div class="notification-icon circle cyan"><i class="material-icons">done</i></div>
                                        <div class="notification-text">
                                            <p><b>
                                                    {{$item->Lecturer->name}}
                                                </b> uploaded results <br>
                                                <span style="color:#333; margin-left:-1px;">{{$item->Course->name}}</span>
                                            </p>
                                            <span>{{ Carbon::createFromFormat("Y-m-d H:i:s",$item->created_at)->diffForHumans()}}</span></div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            @endif

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
            <li><a href="{{url('lecturers')}}"
                   data-position="top" data-delay="50" data-tooltip="Go to Home Page"
                   class="btn-floating tooltipped regent"><i class="material-icons">home</i></a></li>
            <li><a href="{{url('/lecturers/messages')}}"
                   data-position="top" data-delay="50" data-tooltip="View Messages"
                   class="btn-floating tooltipped teal"> <i class="material-icons circle teal">email</i></a></li>
            <li><a href="{{url('/lecturers/responses')}}"
                   data-position="top" data-delay="50" data-tooltip="View Comments"
                   class="btn-floating tooltipped regent1"><i class="material-icons circle regent1">feedback</i></a></li>
            <li><a href="{{url('lecturers/upload')}}"
                   data-position="top" data-delay="50" data-tooltip="Upload Results"
                   class="btn-floating tooltipped green"><i class="material-icons">publish</i></a></li>

            @if(Auth::user()->role == "HOD")
                <li><a href="{{url('hods')}}"
                       data-position="top" data-delay="50" data-tooltip="Switch to HOD"
                       class="btn-floating tooltipped green"><i class="material-icons">supervisor_account</i></a></li>
            @endif
            @if(Auth::user()->role == "Dean")
                <li><a href="{{url('deans')}}"
                        data-position="top" data-delay="50" data-tooltip="Switch to Dean"
                       class="btn-floating tooltipped green"><i class="material-icons">supervisor_account</i></a></li>
            @endif

        </ul>
    </div>

</div>
<div class="left-sidebar-hover"></div>



</body>
</html>

