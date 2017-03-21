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
                    <span class="semcodeSidebar">{{Auth::user()->role}}</span>
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


                <li class="divider"></li>

                <li class="no-padding">
                    <a href="{{url('/lecturers')}}" class="waves-effect waves-grey"><i class="material-icons fixAlign">padlock</i>Switch to Lecturer </a>
                </li>

                <li class="divider"></li>

                <li class="no-padding">
                    <a class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Logout</a>
                </li>
            </ul>
        </div>
        <ul id="sidebar" class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
            <li class="no-padding"><a href="{{url('/admins')}}" class="collapsible-header waves-effect waves-grey active"><i class="material-icons circle regent sideicon">home</i>Home</a></li>
            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/approve-results')}}"><i class="material-icons circle regent1 sideicon ">feedback</i> Result Approvals</a>
            </li>
            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/messages')}}"> <i class="material-icons circle teal sideicon">email</i>Messages</a>

            </li>
            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/add-students')}}"> <i class="material-icons circle teal sideicon">email</i>Add Students</a>
            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/add-courses')}}"> <i class="material-icons circle green sideicon">file_upload</i>Add Courses</a>
            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/assign-courses')}}"> <i class="material-icons circle green sideicon">file_upload</i>Assign Courses</a>
            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/view-courses')}}"> <i class="material-icons circle green sideicon">file_upload</i>View Courses</a>
            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/view-transcript')}}"> <i class="material-icons circle green sideicon">file_upload</i>View Transcript</a>
            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey" href="{{url('/hods/view-reports')}}"> <i class="material-icons circle green sideicon">file_upload</i>View Reports</a>
            </li>

        </ul>
        <div class="footer" align="center">
            <p class="copyright"><img src="{{url('assets/images/logo.png')}}" style="height: 120px"></p>
            <span>&copy; 2016</span> <br>
            <a href="#">Privacy</a> &amp; <a href="#">Terms</a>
        </div>
    </div>
</aside>