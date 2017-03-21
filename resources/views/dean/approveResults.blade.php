@extends('layouts.app')

@section('content')

    @include('sidebars.dean')


    <div class="row">

        <div class="col s12 m10 right">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="#pending">Pending</a></li>
                <li class="tab"><a href="#approved">Approved</a></li>
                <li class="tab"><a href="#rejected">Rejected</a></li>

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



    <div id="pending" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card" >
                <div class="card-content assign" >
                    <span class="card-title">PENDING RESULTS</span><br>

                    <table>
                        <tr>
                            <td>Course Name</td>
                            <td>Lecturer Name</td>
                            <td>View Results</td>
                            <td>Download Results</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($pending as $item)
                            <tr>
                                <td>{{$item->Course->name}}</td>
                                <td>{{$item->Course->Lecturer->name}}</td>
                                <td><a target="_blank" href="{{url('deans/view-results/' . $item->batchNumber)}}" class="waves-effect waves-light btn m-b-xs" style="background-color:#009688;">View</a></td>
                                <td>   <a href="{{$item->downloadUrl}}" class="waves-effect waves-light btn m-b-xs" style="background-color:#CBA56D;">Download</a></td>
                                <td>   <a data-batchNumber="{{$item->batchNumber}}"   class="approveButton waves-effect waves-light btn m-b-xs green" >Approve</a></td>
                                <td>    <a data-batchNumber="{{$item->batchNumber}}"  class="rejectButton waves-effect waves-light btn m-b-xs red" style="background-color:#0d47a1;">Reject</a></td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </main>


    </div>
    <div id="approved" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card upload" >
                <div class="card-content">

                    <span class="card-title">APPROVED RESULTS</span><br>

                    <table>
                        <tr>
                            <td>Course Name</td>
                            <td>Lecturer Name</td>
                            <td>Credit Hours</td>
                            <td>Semester</td>
                            <td>Level</td>
                        </tr>


                        @foreach($approved as $item)
                            <tr>
                                <td>{{$item->Course->name}}</td>
                                <td>{{$item->Course->Lecturer->name}}</td>
                                <td>{{$item->Course->creditHours}}</td>
                                <td>{{$item->Course->semester}}</td>
                                <td>{{$item->Course->level}}</td>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </main>

    </div>
    <div id="rejected" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card upload" >
                <div class="card-content">

                    <span class="card-title">REJECTED RESULTS</span><br>

                    <table>
                        <tr>
                            <td>Course Name</td>
                            <td>Lecturer Name</td>
                            <td>Credit Hours</td>
                            <td>Semester</td>
                            <td>Level</td>
                        </tr>


                        @foreach($rejected as $item)
                            <tr>
                                <td>{{$item->Course->name}}</td>
                                <td>{{$item->Course->Lecturer->name}}</td>
                                <td>{{$item->Course->creditHours}}</td>
                                <td>{{$item->Course->semester}}</td>
                                <td>{{$item->Course->level}}</td>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </main>

    </div>


    <div class="left-sidebar-hover"></div>


    <script>
        $(document).ready(function(){

            var rejectButtons = $('.rejectButton');
            var approveButtons = $('.approveButton');

            approveButtons.on('click',function(){

                var self = $(this);

                $.ajax({
                    url: baseUrl + "/deans/approve/" + self.data('batchnumber') ,
                    method: "post",
                    data: { '_token': '{{csrf_token()}}'},
                    success: function () {

                        for(var i =0; i < rejectButtons.length; i++){


                            if(self.data("batchnumber") == rejectButtons[i].dataset.batchnumber){
                                rejectButtons[i].remove();
                                self.addClass('disabled');
                                self.text('APPROVED');


                            }
                        }

                        Materialize.toast("Result Approval Successful", 3000 );

                    },
                    error: function(){
                        Materialize.toast("Sorry an error occurred. Try Again.", 3000 );
                    }
                });

            });

            rejectButtons.on('click',function(){

                var self = $(this);

                $.ajax({
                    url: baseUrl + "/deans/reject/" + $(this).data('batchnumber') ,
                    method: "post",
                    data: { '_token': '{{csrf_token()}}'},
                    success: function () {
                        for(var i =0; i < rejectButtons.length; i++){


                            console.log(this.innerHTML);


                            if(self.data("batchnumber") == rejectButtons[i].dataset.batchnumber){
                                approveButtons[i].remove();
                                self.addClass('disabled');
                                self.text('REJECTED');


                            }
                        }

                        Materialize.toast("Result Rejection Successful", 3000 );

                    },
                    error: function(){
                        Materialize.toast("Sorry an error occurred. Try Again.", 3000 );
                    }
                });


            });
        });
    </script>


@endsection