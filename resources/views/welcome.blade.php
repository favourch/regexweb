@extends('layouts.app')

@section('content')



<div id="form" align="center">
    <img src="img/regentlogo.fw.png" alt="regentlogo" style="width:128px;height:128px;">
    <br>

    <form method="post" enctype="multipart/form-data" action="{{url('/upload')}}">
        {{csrf_field()}}
        <label>File:</label>
        <input type="file" name="uploadedfile" /><br /> <br>

        <input type="submit" value="upload" name="submit">
    </form> <br> <br>

    <button><a href="login.html">Logout</a></button>
</div> <!-- end alignment div -->

@endsection