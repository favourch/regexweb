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