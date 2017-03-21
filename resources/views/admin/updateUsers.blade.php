@extends('layouts.app')

@section('content')

    @include('sidebars.admin')

    <div class="row">

        <div class="col m10 right">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="#students">Students</a></li>
                <li class="tab"><a href="#lecturers">Lecturers</a></li>
                <li class="tab"><a href="#search">Search</a> </li>

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


    <div id="students" class="mn-content fixed-sidebar">

        <main class="mn-inner">
        <div  class="card upload" >
            <div class="card-content">


                <div class="select-wrapper">
                    <label>Level:</label>

                    <select id="level">
                        <option value="" disabled="" selected="">Select the level:</option>
                        <option>400</option>
                        <option>300</option>
                        <option>200</option>
                        <option>100</option>
                        <option>PRE-UNIVERSITY</option>
                    </select>
                </div>


                <div class="select-wrapper">
                    <label>Programme:</label>
                    {{--<span class="caret">▼</span>--}}
                    <select id="level">
                        <option value="" disabled="" selected="">Select the programme:</option>
                        <option>ISS</option>
                        <option>ENGINEERING</option>
                    </select>
                </div>


                 <br><br>

                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Surname</th>
                        <th>Other Names</th>
                        <th>Gender</th>
                        <th>Nationality</th>
                        <th>Level</th>
                        <th>Programme</th>
                        <th></th>

                    </tr>
                    @foreach($students as $item)
                        <tr>
                            <td>{{$item->studentid}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->othernames}}</td>
                            <td>{{$item->gender}}</td>
                            <td>{{$item->nationality}}</td>
                            <td>{{$item->level}}</td>
                            <td>{{$item->Programme->progname}}</td>
                            <td>
                                <a class="btn waves-effect waves-light modal-trigger" href="#modal1" >Update
                                    <i class="material-icons right">send</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </main>


    </div>

    <div id="lecturers" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card upload" >
                <div class="card-content">
                    <div class="select-wrapper">
                        <label>Faculty:</label>

                        <select id="faculty">
                            <option value="" disabled="" selected="">Select the faculty:</option>
                            <option>SIET</option>
                            <option>SBL</option>
                            <option>THEOLOGY</option>
                        </select>
                    </div>
                    <div class="select-wrapper">
                        <label>Department:</label>

                        <select id="department">
                            <option value="" disabled="" selected="">Select the Dept:</option>
                            <option>INFORMATICS</option>
                            <option>ENGINEERING</option>
                        </select>
                    </div>
                    <div class="select-wrapper">
                        <label>Role:</label>

                        <select id="role">
                            <option value="" disabled="" selected="">Select the role:</option>
                            <option>HOD</option>
                            <option>Dean</option>
                            <option>Lecturer</option>
                            <option>Admin</option>
                        </select>
                    </div>

                    <br><br>

                    <table>
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Qualification</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                            <th></th>

                        </tr>
                        @foreach($lecturers as $item)
                            <tr>
                                <td>{{$item->staffid}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->qualification}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->role}}</td>
                                <td>
                                    <a class="btn waves-effect waves-light modal-trigger" href="#modal1" >Update
                                        <i class="material-icons right">send</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </main>


    </div>

    <div id="search" class="mn-content fixed-sidebar">
        <main class="mn-inner">
            <div  class="card adminSearch" >
                <div class="card-content">

                    <div class="input-field col s6">
                        <i class="material-icons prefix">search</i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Search term</label>
                    </div>

                    <p>
                        <input type="checkbox" id="studentsCheckBox" checked="checked" />
                        <label for="studentsCheckBox">Students</label>
                        &nbsp; &nbsp;
                        <input type="checkbox" id="lecturersCheckBox" checked="checked" />
                        <label for="lecturersCheckBox">Lecturers</label>



                    </p>

                    <br><br>

                    <table>
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Qualification</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                            <th></th>

                        </tr>
                        @foreach($lecturers as $item)
                            <tr>
                                <td>{{$item->staffid}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->qualification}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->role}}</td>
                                <td>
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Update
                                        <i class="material-icons right">send</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>




@endsection