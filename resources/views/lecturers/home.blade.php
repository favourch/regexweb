@extends('layouts.app')

@section('content')

@include('sidebars.lecturers')

    <main class="mn-inner">
        <div class="card" >
            <div class="card-content">
                <span class="card-title" style="text-align: left">Last login : {{Auth::user()->lastLogin}}</span><br>
                <div class="row">
                    <div class="col s3 m3 l3" style="color:white">
                        <div class="card-panel teal">
                            <i class="material-icons">home</i>
                            <span class="card-title">5</span>
                            <span class="header-text">Courses Assigned</span>
                        </div>
                    </div>
                    <div class="col s3 m3 l3" style="color:white">
                        <div class="card-panel regent">
                            <i class="material-icons">email</i>
                            <span class="card-title">3</span>
                            <span class="header-text">Messages</span>
                        </div>
                    </div>
                    <div class="col s3 m3 l3" style="color:white">
                        <div class="card-panel regent1">
                            <i class="material-icons">feedback</i>
                            <span class="card-title">18</span>
                            <span class="header-text">Responses</span>
                        </div>
                    </div>
                    <div class="col s3 m3 l3" style="color:white">
                        <div class="card-panel green">
                            <i class="material-icons">file_upload</i>
                            <span class="card-title">{{Auth::user()->resultsUploaded}}</span>
                            <span class="header-text">Results Uploaded</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </main>

@endsection