@extends('layouts.app')

@section('content')

    @include('sidebars.hod')

    <style>
        #chart,#details{
            position: fixed !important;
        }
        #details{
            margin-top: 320px;
            width:50%;

        }
    </style>
    <div class="row">

        <div class="col s12 m10 l10 offset-l2 offset-m2">


            <div class="col s12 m4 l4">
                <ul class="collection">

                    @foreach($courses as $course)
                        <li class="collection-item" data-cid="{{$course->cid}}">{{$course->name}} | Semester {{$course->semester}}</li>

                    @endforeach
                </ul>

            </div>
            <div class="col s12 m8 l8">
                <div id="chart" ></div>

                <div id="details">
                    <div class="col s12 m9 l9">
                        <p id="passed"></p>
                        <p id="failed"></p>
                        <p id="lecturer"></p>
                        <p id="totalStudents"></p>
                    </div>

                    <div class="col s12 m3 l3">
                        <p id="as"></p>
                        <p id="bs"></p>
                        <p id="cs"></p>
                        <p id="ds"></p>
                        <p id="fs"></p>
                    </div>

                </div>

                <a class="btn"  href="{{url('/hods/result-report')}}" style="position: absolute; bottom:10px; right:450px;">View Lecturer Reports</a>
                <a class="btn green" href="{{url('/hods/download-result-report')}}" style="position: absolute; bottom:10px; right:150px;">Download Lecturer Reports</a>
            </div>





            <script>
                $(document).ready(function () {
                    var collectionitem = $('.collection-item');
                    var cid;
                    collectionitem.on('click', function () {
                        collectionitem.each(function(){
                            $(this).removeClass('active');
                        });

                       cid = $(this).data('cid');
                        getStat(cid);
                       $(this).addClass('active');
                    });



                    function getStat(cid){
                        console.log('starting getstat');
                        var url = "{{url('/hods/get-stats/')}}/" + cid;

                        console.log(url);
                        $.ajax({
                            url:url ,
                            method: "get",
                            success: function (response) {
                                var data = JSON.parse(response);
                                var chart = c3.generate({
                                    bindto: '#chart',
                                    data: {
                                        columns: [
                                                data.scores
                                        ]
                                    }
                                });
                                var as = 0;
                                var bs = 0;
                                var cs = 0;
                                var ds = 0;
                                var fs =0;
                                var percentFailed = (data.failed.length / (data.scores.length - 1) ) * 100;
                                var percentPassed = (data.passed.length / (data.scores.length - 1) ) * 100;
                                $('#failed').text(percentFailed + "% failed");
                                $('#passed').text(percentPassed + "% passed");
                                $('#lecturer').text("Lecturer: " + data.lecturer);
                                if(data.photo != null)
                                $('#lecturer').append("<br><img style='width:100px;border-radius:10px;' src='" + data.photo + "'>" );
                                $('#totalStudents').text(data.scores.length -1 + " total students");

                                for(var i =1; i<data.scores.length; i++ ){

                                    if(data.scores[i] < 40) fs++;
                                    else if(data.scores[i] >= 40 && data.scores[i] < 50 ) ds++;
                                    else if(data.scores[i] >= 50 && data.scores[i] < 60 ) cs++;
                                    else if(data.scores[i] >= 60 && data.scores[i] < 70 ) bs++;
                                    else if(data.scores[i] > 70) as++;
                                }


                                $('#as').text('A : ' + as);
                                $('#bs').text('B : ' + bs);
                                $('#cs').text('C : ' + cs);
                                $('#ds').text('D : ' + ds);
                                $('#fs').text('F : ' + fs);

                            },
                            error: function (response) {

                                console.log(response);
                            }
                        });
                    }
                });

            </script>
        </div>
    </div>
@endsection