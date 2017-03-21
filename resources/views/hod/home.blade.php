@extends('layouts.app')

@section('content')

    @include('sidebars.hod')

    <main class="mn-inner">
        <div class="card" >
            <div class="card-content">
                <span class="card-title" style="text-align: left">Last login : {{Auth::user()->lastLogin}}</span><br>
                <span class="card-title">DEPARTMENTAL STATS</span>

                <div class="row">
                    <div id="coursesInfo" class="col s3 m3 l3" style="color:white">
                        <div class="card-panel teal">
                            <span class="card-title">{{$courseCount}}</span> <br>
                            <span class="header-text">Courses</span><br>
                        </div>
                    </div>

                    <div class="col s3 m3 l3" style="color:white">
                        <div class="card-panel regent">
                            <span class="card-title">{{$studentCount}}</span> <br>
                            <span class="header-text">Students</span> <br>
                            <small style="display:none;">20 unassigned</small>
                        </div>
                    </div>
                    <div class="col s3 m3 l3" style="color:white">
                        <div class="card-panel regent1">
                            <span class="card-title">{{$lecturerCount}}</span> <br>
                            <span class="header-text">Lecturers</span> <br>
                            <small style="display:none;">20 unassigned</small>
                        </div>
                    </div>
                    <div class="col s3 m3 l3" style="color:white">
                        <div class="card-panel green">
                            <span class="card-title">{{$resultsCount}}</span> <br>
                            <span class="header-text">Results Uploaded</span> <br>
                            <small style="display:none;">20 unassigned</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- cards -->
        <div class="row">
            @foreach($news as $item)

                <div class="col s12 m4 l4">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img id="newsImage1" class="activator" src="{{$item->image}}">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">{{$item->title}}<i class="material-icons right">more_vert</i></span>
                            <p><a target="_blank" href="http://regent.edu.gh{{$item->link}}" id="newsLink1">Read More</a></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4" id="newsTitle1">{{$item->title}}<i class="material-icons right">close</i></span>
                            <p id="newsContent1">{{$item->title}}</p>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        <!-- end cards -->




    </main>

@endsection