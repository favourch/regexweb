@extends('layouts.app')

@section('content')
<?php use Illuminate\Support\Facades\Input; ?>
    @include('sidebars.lecturers')
    <main class="mn-inner">
        <div  class="card upload" >
            <div class="card-content">

                <span class="card-title">
                     @if(Input::has("level"))
                        {{Input::get("level")}} Level Students<br>
                    @endif
                    STUDENT FILTER
                </span>

                <div class="select-wrapper">
                    <label>By Level:</label>

                    <select id="level">
                        <option value="" disabled="" selected="">Select a level:</option>
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
                            {{--<td>--}}
                                {{--<button class="btn waves-effect waves-light" type="submit" name="action">Edit--}}
                                    {{--<i class="material-icons right">send</i>--}}
                                {{--</button>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function(){
            var level = $('#level');
            level.on('change',function(){
                window.location = "<?php echo url('/lecturers/view-results')?>" + "?level="+ level.val();
            });

        })
    </script>

@endsection