<aside id="slide-out" class="side-nav white fixed">
    <div class="side-nav-wrapper">
        <div class="sidebar-profile">
            <div class="sidebar-profile-image">
                <img src="{{Auth::user()->photo ? : url('assets/images/profile-image.png')}}" class="circle" alt="">
            </div>

            <div class="sidebar-profile-info">
                <a href="javascript:void(0);" class="account-settings-link">

                    <span>{{Auth::user()->name}}<i class="material-icons right">arrow_drop_down</i></span>
                    <p>{{Auth::user()->Dept->name}}</p>
                </a>
            </div>
        </div>
        <div class="sidebar-account-settings">
            <ul>
                <li class="no-padding">
                    <a href="{{url('/change-password')}}" class="waves-effect waves-grey"><i class="material-icons fixAlign">padlock</i>Change Password </a>
                </li>
                <li class="no-padding">
                    <a href="{{url('/change-profile-pic')}}" class="waves-effect waves-grey"><i class="material-icons fixAlign">padlock</i>Change Profile Pic </a>
                </li>

                @if(Auth::user()->role == "HOD")
                <li class="divider"></li>

                <li class="no-padding">
                    <a href="{{url('/hods')}}" class="waves-effect waves-grey"><i class="material-icons fixAlign">padlock</i>Switch to HOD </a>
                </li>

                @endif

                @if(Auth::user()->role == "Dean")
                    <li class="divider"></li>

                    <li class="no-padding">
                        <a href="{{url('/deans')}}" class="waves-effect waves-grey"><i class="material-icons fixAlign">padlock</i>Switch to Dean </a>
                    </li>

                @endif

                <li class="divider"></li>

                <li class="no-padding">
                    <a class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Logout</a>
                </li>
            </ul>
        </div>
        <ul id="sidebar" class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
            <li class="no-padding"><a href="{{url('/lecturers')}}" class="collapsible-header waves-effect waves-grey active"><i class="material-icons circle regent sideicon">home</i>Home</a></li>
            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/lecturers/responses')}}"><i class="material-icons circle regent1 sideicon ">feedback</i> COMMENTS <span class="new badge">18</span></a>

            </li>
            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/lecturers/messages')}}"> <i class="material-icons circle teal sideicon">email</i>Messages</a>

            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/lecturers/upload')}}"> <i class="material-icons circle green sideicon">file_upload</i>Upload Results</a>

            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/lecturers/view-results')}}"> <i class="material-icons circle green sideicon">file_upload</i>View / Edit Results</a>

            </li>


        </ul>
        <div class="footer" align="center">
            <p class="copyright"><img src="{{url('assets/images/logo.png')}}" style="height: 120px"></p>
            <span>&copy; 2016</span> <br>
            <a href="#">Privacy</a> &amp; <a href="#">Terms</a>
        </div>
    </div>
</aside>