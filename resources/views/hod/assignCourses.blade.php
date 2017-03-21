@extends('layouts.app')

@section('content')

    @include('sidebars.hod')


    <div class="row">

        <div class="col s12 m10 right">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="#list">List</a></li>
                <li class="tab"><a href="#search">Search</a></li>

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



    <div id="list" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card" >
                <div class="card-content assign" >
                    <span class="card-title">Assign Lecturers</span><br>

                    <div class="row">
                        <div class="col m6">
                            <ul class="collection">


                                @foreach($lecturers as $item)
                                <li class="collection-item" data-lid="{{$item->lid}}">
                                    <span class="title">{{$item->name}}</span>
                                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="col m6 static">

                            <div class="input-field col s12">
                                <select id="courses" multiple name="courses[]">
                                    <option value="" disabled selected>Choose your option</option>

                                    @foreach($courses as $item)
                                    <option value="{{$item->cid}}">{{$item->name}}</option>
                                    @endforeach

                                </select>
                                <label>Materialize Multiple Select</label>
                            </div>

                            <a id="assignButton" class="waves-effect waves-light btn"><i class="material-icons right">cloud</i>Assign</a>

                        </div>


                    </div>

                </div>
            </div>
        </main>


    </div>
    <div id="search" class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div  class="card upload" >
                <div class="card-content">

                    <span class="card-title">BULK COURSE UPLOAD FORM</span><br>
                    <a class="right" href="#">Download sample here</a> <br>

                    <span class="card-title">UPLOAD FILE</span><br>

                    <div class="card-content" id="uploadHelp">
                        <form method="post" enctype="multipart/form-data" action="{{url('/admins/bulk-add-courses')}}" class="dropzone">
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

    <script>
        $(document).ready(function(){

            $('#assignButton').addClass('disabled');

            var lid, error;
            var courseIDs;

            $('.collection-item').on('click',function(){

                lid = $(this).data('lid');
                courseIDs = $('#courses').val();

                $('#assignButton').removeClass('disabled');

                $('.collection-item').removeClass('selectedCollection');
                $(this).addClass('selectedCollection');

            });

            $('#assignButton').on('click',function(){

                courseIDs = $('#courses').val();


                $('#assignButton').addClass('disabled');

                for(i=0; i < courseIDs.length; i++){
                    var currentID = courseIDs[i];
                    $.ajax({
                        cid: currentID,
                        url: baseUrl + "/hods/assign-courses",
                        method: "post",
                        data: {'lid': lid, 'cid' : courseIDs[i], '_token': '{{csrf_token()}}'},
                        success: function(){


                            var optionSelector = "#courses option[value='" + this.cid + "']";

                            $(optionSelector).remove();

                            $('select').material_select();

                            $('#assignButton').removeClass('disabled');

                        },
                        error: function(response){
                            $('#assignButton').removeClass('disabled');
                            error = true;

                            console.log('error');
                            console.log(response);
                        }
                    });
                }

                if(error)  Materialize.toast("Sorry an error occurred. Try again.", 3000 );
                    else   Materialize.toast("Course Assignment Successful", 3000 );
            });


        });

    </script>

@endsection