@extends('layouts.app')

@section('content')

    @if(Auth::user()->role == "Dean")
        @include('sidebars.dean')
    @endif

    @if(Auth::user()->role == "Lecturer")
        @include('sidebars.lecturers')
    @endif

    @if(Auth::user()->role == "Admin")
        @include('sidebars.admin')
    @endif

    @if(Auth::user()->role == "HOD")
        @include('sidebars.hod')
    @endif

    <div class="mn-content valign-wrapper">
        <main class="mn-inner container ">
            <div class="valign">
                <div class="row">

                    <div class="col s12 m6 l6 offset-l2" >
                        @if( Session::has('success') )
                            <div class="success"  align="center">{{Session::get('success')}}</div>
                        @endif

                            @if( Session::has('error') )
                                <div class="error" align="center">{{Session::get('error')}}</div>
                            @endif

                            <div class="card white darken-1">
                            <div class="card-content z-depth-5 ">
                                <span class="card-title"><img src="assets/images/logo.png" style="height: 100px;"></span>
                                <span class="card-title teal-text">REGEX PORTAL</span>
                                <span class="card-title">Password change</span>
                                <div class="row">
                                    <form class="col s12" role="form" method="POST" action="{{ url('/change-password') }}">
                                        {{ csrf_field() }}

                                        <div class="input-field s12">
                                            <label for="oldpassword" class="col-md-4 control-label">Old Password</label>

                                            <input id="oldpassword" type="password" class="form-control" name="oldpassword" required>

                                        </div>

                                        <div class="input-field s12">
                                            <label for="password" class="col-md-4 control-label">Password</label>

                                            <input id="password" type="password" class="form-control" name="password" required>


                                        </div>


                                        <div class="input-field s12">
                                            <label for="confirmpassword" class="col-md-4 control-label">Confirm Password</label>

                                            <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" required>

                                        </div>

                                        <br>
                                        <div class="col s12 right-align m-t-sm">
                                            <button type="submit" class="btn btn-primary">
                                                Change
                                            </button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>


@endsection


