@extends('layouts.app')

@section('content')

    @include('sidebars.lecturers')
    <main class="mn-inner">
        <div  class="card upload" >
            <div class="card-content">
                <span class="card-title">STUDENT FILTER</span>

                <div class="select-wrapper">
                    <label>By Course:</label>

                    <select id="level">
                        <option value="" disabled="" selected="">Select a course:</option>
                        <option>400</option>
                        <option>300</option>
                        <option>200</option>
                        <option>100</option>
                        <option>PRE-UNIVERSITY</option>
                    </select>
                </div>

                <br><br>

                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Attendance</th>
                        <th>Midsem</th>
                        <th>CA</th>
                        <th>Exam Score</th>
                        <th>Total Grade</th>

                    </tr>
                    @foreach($results as $item)
                        <tr>
                            <td>{{$item->Student->studentid}}</td>
                            <td>{{$item->attendance}}</td>
                            <td>{{$item->midsem}}</td>
                            <td>{{$item->ca}}</td>
                            <td>{{$item->examscore}}</td>
                            <td>{{$item->totalgrade}}</td>
                            <td>
                                <button class="btn waves-effect waves-light" type="submit" name="action">Edit
                                    <i class="material-icons right">send</i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </main>

@endsection