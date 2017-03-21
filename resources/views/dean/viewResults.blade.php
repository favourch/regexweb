@extends('layouts.app')

@section('content')

    <style>
        body{
            background-color: white !important;
        }
    </style>

     <table class="striped" style="margin-top: 10px;">
         <tr style="background-color: #800000;">
             <td>Student ID</td>
             <td>Attendance</td>
             <td>Mid-sem</td>
             <td>CA</td>
             <td>Exam Score</td>
         </tr>

         @foreach($results as $item)

             <tr>
                 <td>{{$item->Student->studentid}}</td>
                 <td>{{$item->attendance}}</td>
                 <td>{{$item->midsem}}</td>
                 <td>{{$item->ca}}</td>
                 <td>{{$item->examscore}}</td>
             </tr>
         @endforeach
     </table>

@endsection