@extends('layouts.app')

@section('content')

    @include('sidebars.dean')


    <div class="row">

        <div class="col s12 m10 right">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="#unassigned">Unassigned</a></li>
                <li class="tab"><a href="#assigned">Assigned</a></li>

            </ul>
        </div>

        @if(isset($status))
            @if( $status == "Course added successfully!")
                <div class="col m10 right success card-panel green" align="center">{{$status}}</div>
            @else
                <div class="col m10 right error card-panel red" align="center">{{$status}}</div>
            @endif
        @endif
    </div>



    <div id="unassigned" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card" >
                <div class="card-content assign" >
                    <span class="card-title">Unassigned Courses</span><br>

                    <table>
                        <tr>
                            <td>Name</td>
                            <td>Credit Hours</td>
                            <td>Semester</td>
                            <td>Level</td>
                        </tr>

                        @foreach($unassigned as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->creditHours}}</td>
                                <td>{{$item->semester}}</td>
                                <td>{{$item->level}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </main>


    </div>
    <div id="assigned" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card upload" >
                <div class="card-content">

                    <span class="card-title">ASSIGNED COURSES</span><br>

                    <table>
                        <tr>
                            <td>Name</td>
                            <td>Lecturer</td>
                            <td>Credit Hours</td>
                            <td>Semester</td>
                            <td>Level</td>
                        </tr>

                        @foreach($assigned as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->Lecturer->name}}</td>

                                <td>{{$item->creditHours}}</td>
                                <td>{{$item->semester}}</td>
                                <td>{{$item->level}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </main>

    </div>

    <div class="left-sidebar-hover"></div>


    <script src="{{url('assets/plugins/dropzone/dropzone.min.js')}}"></script>
    <script src="{{url('assets/plugins/dropzone/dropzone-amd-module.min.js')}}"></script>


@endsection