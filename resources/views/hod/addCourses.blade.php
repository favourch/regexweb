@extends('layouts.app')

@section('content')

    @include('sidebars.hod')


    <div class="row">

        <div class="col m10 right">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="#singleUpload">Single Course</a></li>
                <li class="tab"><a href="#bulkUpload">Bulk Upload Courses</a></li>

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



    <div id="singleUpload" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card upload" >
                <div class="card-content">
                    <span class="card-title">Add a Course</span><br>

                    <form method="post" action="{{url('hods/add-courses')}}">

                        {{csrf_field()}}

                        <input type="hidden" name="did" value="{{Auth::user()->did}}">

                        <div class="input-field col s6">
                            <input  id="name" name="name" type="text" class="validate">
                            <label for="name">Course Name</label>
                        </div>


                        <div class="input-field col s6">
                            <input  id="code" name="code" type="text" class="validate">
                            <label for="code">Course Code</label>
                        </div>

                        <div class="input-field col s6">

                            <input id="creditHours" name="creditHours" type="text" class="validate">
                            <label for="creditHours">Credit Hours</label>
                        </div>


                            <div class="select-wrapper">
                                <span class="caret">▼</span>
                                <select id="level" name="level">
                                    <option value="" disabled="" selected="">Select the level:</option>
                                    <option>400</option>
                                    <option>300</option>
                                    <option>200</option>
                                    <option>100</option>
                                    <option value="PRE">PRE-UNIVERSITY</option>
                                </select>
                            </div>

                        <div class="select-wrapper">
                            <span class="caret">▼</span>
                            <select name="semester" id="semester">
                                <option value="" disabled="" selected="">Select the semester:</option>
                                <option value="1">SEMESTER 1</option>
                                <option value="2">SEMESTER 2</option>
                            </select>
                        </div>



                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>


                        <button class="btn waves-effect waves-light red" type="reset" name="action">Clear
                            <i class="material-icons right">clear</i>
                        </button>

                    </form>

                </div>
            </div>
        </main>


    </div>
    <div id="bulkUpload" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card upload" >
                <div class="card-content">

                    <span class="card-title">BULK COURSE UPLOAD FORM</span><br>
                    <a class="right" href="{{url('/samples/add-course-sample.xlsx')}}">Download sample here</a> <br>

                    <span class="card-title">UPLOAD FILE</span><br>

                    <div class="card-content" id="uploadHelp">
                        <form method="post" enctype="multipart/form-data" action="{{url('/hods/bulk-add-courses')}}" class="dropzone">
                            {{csrf_field()}}
                            <input type="hidden" name="did" value="{{Auth::user()->did}}">
                            <div class="fallback">
                                <input name="file" type="file" />
                            </div>
                        </form>

                        <br>

                    </div>

                </div>
            </div>
        </main>

    </div>

    <div class="left-sidebar-hover"></div>


    <script src="{{url('assets/plugins/dropzone/dropzone.min.js')}}"></script>
    <script src="{{url('assets/plugins/dropzone/dropzone-amd-module.min.js')}}"></script>



@endsection