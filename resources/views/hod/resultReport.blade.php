<!doctype html>
<html>
<head>

    <title>View Lecturer Result Statistics</title>

</head>
<body>
<style>






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
        margin:0 10% 50px 10%;
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
        text-align: center;
    }
    img{
        height:100px;
        margin-top:0;

    }
    hr{
        border:3px solid #800000;
    }
    table{
        border:1px solid black;
    }




    td.course{
        padding: 5px 20px;
        text-align: justify !important;
    }

    td{
        padding:10px;
    }





</style>
<div >
    <div>

        <div align="center">
            <img src="{{url('assets/images/logo.png')}}">
        </div>
        <div class="header">

            <hr >

            <p>
                Regent University College of Science and Technology

            </p>

            <hr>

        </div>
        @foreach($data as $lecturer)
            <p class="lecName">

               Lecturer Name - {{$lecturer['name']}}<br>
            </p>

        <table align="center">
            <tr>
                <th>Course Name</th>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>F</th>
                <th>Total</th>
                <th>Pass %</th>
                <th>Fail %</th>
            </tr>

            @foreach($lecturer['courses'] as $course)
            <tr>
                <td class="course">{{$course['name']}}</td>
                <td>{{$course['as']}}</td>
                <td>{{$course['bs']}}</td>
                <td>{{$course['cs']}}</td>
                <td>{{$course['ds']}}</td>
                <td>{{$course['fs']}}</td>
                <td></td>
                <td>{{$course['passed']}}</td>
                <td>{{$course['failed']}}</td>
            </tr>

            @endforeach

        </table>
        @endforeach

    </div>
</div>
</body>
</html>