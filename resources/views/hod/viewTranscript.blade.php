@extends('layouts.app')

@section('content')

    @include('sidebars.hod')
    <div class="row">
    <div class="col s12 m10 l10 offset-l2 offset-m2">

        @if(!isset($student) || !isset($transcript))

            <div class="col m8 l8 white offset-l2 offset-m2" style="margin-top: 20%">
            <label for="studentid">Please enter student ID :</label>
            <input type="text" id="studentid">
            <a class="btn" id="getTransButton">Get Transcript</a>

            </div>
            <script>
                $(document).ready(function () {
                    var getTransButton = $('#getTransButton');
                    getTransButton.on('click', function () {
                        var sid = $('#studentid').val();

                        if(sid != "")
                        window.location = "{{url('hods/')}}/" + sid;
                    })
                })
            </script>
        @else
            <p class="flow-text">
                Name - {{$student->othernames}}, {{$student->surname}}<br>
                Level - {{$student->level}} <br>
                Programme - {{$student->Programme->progname}}
            </p>

            @foreach($transcript as $key => $item)
            @foreach($transcript as $nextKey => $nextItem)

                @if($key == "1001" && $nextKey == "1002")
                <div class="row">
                    @if($key == "1001" || $key == "1002")
                    <h3 class="flow-text ">LEVEL 100</h3>
                    @endif

                    <div class="col s12 m6 l6">
                        @if($key == "1001")
                            <h3 class="flow-text ">FIRST SEMESTER</h3>
                            <ul class="collection">
                                @foreach($item as $result)
                                <li class="collection-item">
                                    <span>
                                        {{$result['name']}}
                                    </span>
                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                </li>
                                @endforeach
                            </ul>

                        @endif
                    </div>
                    <div class="col s12 m6 l6">
                        @if($nextKey == "1002")
                            <h3 class="flow-text ">SECOND SEMESTER</h3>
                            <ul class="collection">
                                @foreach($nextItem as $result)
                                    <li class="collection-item">
                                    <span>
                                        {{$result['name']}}
                                    </span>
                                        <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                    </li>
                                @endforeach
                            </ul>

                        @endif
                    </div>
                </div>

                @endif


                @if($key == "2001" && $nextKey == "2002")
                <div class="row">

                        @if($key == "2001" || $key == "2002")
                            <h3 class="flow-text ">LEVEL 200</h3>
                        @endif

                        <div class="col s12 m6 l6">
                            @if($key == "2001")
                                <h3 class="flow-text ">FIRST SEMESTER</h3>
                                <ul class="collection">
                                    @foreach($item as $result)
                                        <li class="collection-item">
                                        <span>
                                            {{$result['name']}}
                                        </span>
                                            <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            @endif
                        </div>
                        <div class="col s12 m6 l6">
                            @if($nextKey == "2002")
                                <h3 class="flow-text ">SECOND SEMESTER</h3>
                                <ul class="collection">
                                    @foreach($nextItem as $result)
                                        <li class="collection-item">
                                        <span>
                                            {{$result['name']}}
                                        </span>
                                            <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            @endif
                        </div>

                </div>
                @endif

                @if($key == "3001" && $nextKey == "3002")
                <div class="row">


                        @if($key == "3001" || $key == "3002")
                            <h3 class="flow-text ">LEVEL 300</h3>
                        @endif

                        <div class="col s12 m6 l6">
                            @if($key == "3001")
                                <h3 class="flow-text ">FIRST SEMESTER</h3>
                                <ul class="collection">
                                    @foreach($item as $result)
                                        <li class="collection-item">
                                        <span>
                                            {{$result['name']}}
                                        </span>
                                            <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            @endif
                        </div>
                        <div class="col s12 m6 l6">
                        @if($nextKey == "3002")
                            <h3 class="flow-text ">SECOND SEMESTER</h3>
                            <ul class="collection">
                                @foreach($nextItem as $result)
                                    <li class="collection-item">
                                    <span>
                                        {{$result['name']}}
                                    </span>
                                        <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                    </li>
                                @endforeach
                            </ul>

                        @endif
                    </div>

                </div>
                @endif


                @if($key == "4001" && $nextKey == "4002")
                <div class="row">

                        @if($key == "4001" || $key == "4002")
                            <h3 class="flow-text ">LEVEL 400</h3>
                        @endif

                        <div class="col s12 m6 l6">
                            @if($key == "4001")
                                <h3 class="flow-text ">FIRST SEMESTER</h3>
                                <ul class="collection">
                                    @foreach($item as $result)
                                        <li class="collection-item">
                                        <span>
                                            {{$result['name']}}
                                        </span>
                                            <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            @endif
                        </div>
                        <div class="col s12 m6 l6">
                        @if($nextKey == "4002")
                            <h3 class="flow-text ">SECOND SEMESTER</h3>
                            <ul class="collection">
                                @foreach($nextItem as $result)
                                    <li class="collection-item">
                                    <span>
                                        {{$result['name']}}
                                    </span>
                                        <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                    </li>
                                @endforeach
                            </ul>

                        @endif
                    </div>

                </div>
                @endif

            @endforeach
            @endforeach

            @endif
    </div>
    </div>
@endsection