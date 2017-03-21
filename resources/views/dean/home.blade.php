@extends('layouts.app')

@section('content')

    @include('sidebars.dean')

    <main class="mn-inner">
        <div class="card" >
            <div class="card-content">
                <span class="card-title" style="text-align: left">Last login : {{Auth::user()->lastLogin}}</span><br>
                <span class="card-title">FACULTY STATS</span>

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

        <div class="row">
            <div class="col s12 m4 l4">

                <div class="card adminHomeBottom">
                    <h3 class="flow-text ">Recently Uploaded Courses</h3>
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <img src="images/yuna.jpg" alt="" class="circle">
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle">folder</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle green">insert_chart</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle red">play_arrow</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card adminHomeBottom">

                    <h3 class="flow-text">Recently Assigned Courses</h3>
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <img src="images/yuna.jpg" alt="" class="circle">
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle">folder</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle green">insert_chart</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle red">play_arrow</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <div class="card adminHomeBottom">

                    <h3 class="flow-text">Recently Added Lecturers</h3>
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <img src="images/yuna.jpg" alt="" class="circle">
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle">folder</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle green">insert_chart</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle red">play_arrow</i>
                            <span class="title">Title</span>
                            <p>First Line <br>
                                Second Line
                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>



    </main>

@endsection