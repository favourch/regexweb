<!doctype html>
<html>
<head>

</head>
<body>
<style>


    .level h5.title{
        margin-right: 220px;
        margin-left:40px;
    }

    .level h5{
        display: inline;
        margin-left:25px;
        text-decoration: underline;

    }
    .header{
        margin:0 10%;
    }

    span.courseName{
        float: left;
        margin-right:80px;
        width: 60%;
    }
    span.creditHours{
        float:left;
        margin-right: 50px;
    }


    body{
        color:black !important;
        background-color: #fff;
    }


    table h3{
        text-align: center;
    }


    ul{
        list-style-type: none;
    }



    p{
        font-size: 24px;
    }
    img{
        height:100px;
        float:right;
    }
    hr{
        border:3px solid #800000;
    }










</style>
<div >
    <div>

        <div class="header">

            <hr>
            <p>
                <img src="{{url('assets/images/logo.png')}}">
                Name - {{$student->othernames}}, {{$student->surname}}<br>
                Level - {{$student->level}} <br>
                Programme - {{$student->Programme->progname}} <br>
                CWA - {{$transcript['cwa']}}%
            </p>

            <hr>
        </div>
        @foreach($transcript as $key => $item)
            @foreach($transcript as $nextKey => $nextItem)

                @if($key == "1001" && $nextKey == "1002" && !empty($item))
                    <table class="level" align="center">
                        <tr>
                            @if($key == "1001" || $key == "1002")
                                <th colspan="2" align="center" >LEVEL 100</th>
                            @endif
                        </tr>

                        <tr>
                            <td>
                                <div class="col s12 m6 l6 sem1">
                                    @if($key == "1001")
                                        <h3 class="flow-text ">FIRST SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($item as $result)
                                                <li class="collection-item">
                                                            <span class="courseName">
                                                                {{$result['name']}}
                                                            </span>
                                                            <span class="creditHours">
                                                                {{$result['creditHours']}}
                                                            </span>
                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li><br>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="col s12 m6 l6 sem2 ">
                                    @if($nextKey == "1002")
                                        <h3 class="flow-text ">SECOND SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($nextItem as $result)
                                                <li class="collection-item">
                                                                <span class="courseName">
                                                                    {{$result['name']}}
                                                                </span>
                                                                <span class="creditHours">
                                                                    {{$result['creditHours']}}
                                                                </span>

                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li><br>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>

                @endif

                @if($key == "2001" && $nextKey == "2002" && !empty($item))
                    <table class="level" align="center">
                        <tr>
                            @if($key == "2001" || $key == "2002")
                                <th colspan="2" class="flow-text ">LEVEL 200</th>
                            @endif
                        </tr>

                        <tr>
                            <td>
                                <div class="col s12 m6 l6 sem1">
                                    @if($key == "2001")
                                        <h3 class="flow-text ">FIRST SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($item as $result)
                                                <li class="collection-item">
                                                        <span class="courseName">
                                                            {{$result['name']}}
                                                        </span>
                                                        <span class="creditHours">
                                                            {{$result['creditHours']}}
                                                        </span>
                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="col s12 m6 l6 sem2 ">
                                    @if($nextKey == "2002")
                                        <h3 class="flow-text ">SECOND SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($nextItem as $result)
                                                <li class="collection-item">
                                                            <span class="courseName">
                                                                {{$result['name']}}
                                                            </span>
                                                            <span class="creditHours">
                                                                {{$result['creditHours']}}
                                                            </span>

                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>

                @endif

                @if($key == "3001" && $nextKey == "3002" && !empty($item))
                    <table class="level" align="center">
                        <tr>
                            @if($key == "3001" || $key == "3002")
                                <th colspan="2" class="flow-text ">LEVEL 300</th>
                            @endif
                        </tr>

                        <tr>
                            <td>
                                <div class="col s12 m6 l6 sem1">
                                    @if($key == "3001")
                                        <h3 class="flow-text ">FIRST SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($item as $result)
                                                <li class="collection-item">
                                                        <span class="courseName">
                                                            {{$result['name']}}
                                                        </span>
                                                        <span class="creditHours">
                                                            {{$result['creditHours']}}
                                                        </span>
                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="col s12 m6 l6 sem2 ">
                                    @if($nextKey == "3002")
                                        <h3 class="flow-text ">SECOND SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($nextItem as $result)
                                                <li class="collection-item">
                                                            <span class="courseName">
                                                                {{$result['name']}}
                                                            </span>
                                                            <span class="creditHours">
                                                                {{$result['creditHours']}}
                                                            </span>

                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>

                @endif

                @if($key == "4001" && $nextKey == "4002" && !empty($item))
                    <table class="level" align="center">
                        <tr>
                            @if($key == "4001" || $key == "4002")
                                <th colspan="2" class="flow-text ">LEVEL 100</th>
                            @endif
                        </tr>

                        <tr>
                            <td>
                                <div class="col s12 m6 l6 sem1">
                                    @if($key == "4001")
                                        <h3 class="flow-text ">FIRST SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($item as $result)
                                                <li class="collection-item">
                                                        <span class="courseName">
                                                            {{$result['name']}}
                                                        </span>
                                                        <span class="creditHours">
                                                            {{$result['creditHours']}}
                                                        </span>
                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="col s12 m6 l6 sem2 ">
                                    @if($nextKey == "4002")
                                        <h3 class="flow-text ">SECOND SEMESTER</h3>
                                        <h5 class="title">Course Title</h5> <h5>Cr.</h5><h5>Mark</h5>
                                        <ul class="collection">
                                            @foreach($nextItem as $result)
                                                <li class="collection-item">
                                                            <span class="courseName">
                                                                {{$result['name']}}
                                                            </span>
                                                            <span class="creditHours">
                                                                {{$result['creditHours']}}
                                                            </span>

                                                    <a  class="secondary-content">{{$result['totalgrade']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>

                @endif

            @endforeach
        @endforeach

    </div>
</div>
</body>
</html>