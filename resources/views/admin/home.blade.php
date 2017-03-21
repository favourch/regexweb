@extends('layouts.app')

@section('content')

    @include('sidebars.admin')

    <main class="mn-inner">
        <div class="card" >
            <div class="card-content">
                <span class="card-title" style="text-align: left">Last login : {{Auth::user()->lastLogin}}</span><br>


                <div class="row">
                    <div id="coursesInfo" class="col s3 m3 l3" style="color:white">
                        <div class="card-panel teal">
                            <span class="card-title">{{$courseCount}}</span> <br>
                            <span class="header-text">Courses</span><br>
                            <small style="display:none;">20 unassigned</small>
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

        <div class="row">
            <div class="col s12 m4 l4">

                <div class="card adminHomeBottom">
                    <h3 class="flow-text ">SIET</h3>
                    <ul class="collection">
                        <li class="collection-item">
                            {{count($sietStudents)}} Students
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card adminHomeBottom">

                    <h3 class="flow-text">SBL</h3>
                    <ul class="collection">
                        <li class="collection-item">
                            {{count($sblStudents)}} Students
                        </li>


                    </ul>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card adminHomeBottom">

                    <h3 class="flow-text">FAS</h3>
                    <ul class="collection">
                        <li class="collection-item">
                            {{count($fasStudents)}} Students
                        </li>

                    </ul>
                </div>
            </div>
        </div>
                {{--<div class="card">--}}
                    {{--<div class="card-image waves-effect waves-block waves-light">--}}
                        {{--<img id="newsImage1" class="activator" src="">--}}
                    {{--</div>--}}
                    {{--<div class="card-content">--}}
                        {{--<span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>--}}
                        {{--<p><a target="_blank" href="#" id="newsLink1">Read More</a></p>--}}
                    {{--</div>--}}
                    {{--<div class="card-reveal">--}}
                        {{--<span class="card-title grey-text text-darken-4" id="newsTitle1">{{$item->title}}<i class="material-icons right">close</i></span>--}}
                        {{--<p id="newsContent1">{{$item->title}}</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}



    </main>

@endsection