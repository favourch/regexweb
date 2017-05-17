@extends('layouts.app')

@section('content')

    @include('sidebars.hod')


    <div class="row">

        <div class="col m10 right">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="#singleUpload">Single Upload</a></li>
                <li class="tab"><a href="#bulkUpload">Bulk Upload</a></li>

            </ul>
        </div>

        @if(isset($status))
            @if( $status == "Student added successfully!")
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
                    <span class="card-title">Add a Student</span><br>

                    <form method="post" action="{{url('hods/add-students')}}">

                        {{csrf_field()}}

                        <div class="input-field col s6">
                            <input  id="indexNumber" required name="indexNumber" type="text" pattern="[0-9]{8}"  maxlength="8" class="validate">
                            <label for="indexNumber" data-error="ID number must be eight digits" data-success="Valid">Index Number</label>
                        </div>


                        <div class="input-field col s6">
                            <input  id="surname" required name="surname" pattern="[a-zA-Z]+" type="text" class="validate">
                            <label for="surname" data-success="Valid">Surname</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="othernames" required name="othernames" type="text" class="validate">
                            <label for="othernames">Other Names</label>
                        </div>

                        <div class="input-field col s6">
                            <input  id="society" required name="society" type="text" class="validate">
                            <label for="society">Society</label>
                        </div>

                        <div class="input-field col s6">
                            <input id="email" required name="email" type="text" class="validate">
                            <label for="email">Email</label>
                        </div>

                        <div class="input-field col s6">
                            <input  id="nationality" required name="nationality" type="text" class="validate">
                            <label for="nationality">Nationality</label>
                        </div>

                        <div class="input-field col s6">
                            <input id="phone" required name="phone" type="text" class="validate">
                            <label for="phone">Phone</label>
                        </div>


                        <div class="row" style="text-align: center">

                            <div class="select-wrapper">
                                <span class="caret">▼</span>
                                <select id="programme" required name="programme">
                                    <option value="" disabled="" selected="">SELECT PROGRAMME:</option>
                                    @foreach($programmes as $item)
                                    <option value="{{$item->progid}}">{{$item->progname}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="select-wrapper">
                                <span class="caret">▼</span>
                                <select id="level" name="level" required>
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
                                <select id="session" name="session" required>
                                    <option value="" disabled="" selected="">Select the session:</option>
                                    <option>MORNING</option>
                                    <option>EVENING</option>
                                    <option>WEEKEND</option>
                                </select>
                            </div>

                            <div class="select-wrapper">
                                <span class="caret">▼</span>
                                <select name="gender" id="gender" required>
                                    <option value="" disabled="" selected="">Select the Gender:</option>
                                    <option value="1">MALE</option>
                                    <option value="2">FEMALE</option>
                                </select>
                            </div>

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

                    <span class="card-title">BULK STUDENT UPLOAD FORM</span><br>
                    <a class="right" href="{{url('/samples/add-students-sample.xlsx')}}">Download sample here</a> <br>

                    <span class="card-title">UPLOAD FILE</span><br>

                    <div class="card-content" id="uploadHelp">
                        <form method="post" enctype="multipart/form-data" action="{{url('/hods/bulk-add-students')}}" class="dropzone">
                            {{csrf_field()}}
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