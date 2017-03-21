@extends('layouts.app')

@section('content')

    @include('sidebars.dean')

    <div class="row">
        <div class="col s12 m10 l10 offset-l2 offset-m2">

            @if( Session::has('success') )
                <div class="success" style="margin-top: 10px;"  align="center">{{Session::get('success')}}</div>
            @endif

            @if( Session::has('error') )
                <div class="error" style="margin-top: 10px" align="center">{{Session::get('error')}}</div>
            @endif

                <style>
                    #preview img{
                        height: 150px;
                    }
                </style>

                <div align="center" class="col m8 l8 white offset-l2 offset-m2" style="margin-top: 20%">
                    <div align="center" id="preview"></div>
                    <form method="post" enctype="multipart/form-data" action="{{url('/change-profile-pic')}}">
                        {{csrf_field()}}
                    <span  for="photo">Please select photo to upload :</span><br>
                    <input class="input-field" id="photo" type="file" onchange="readURL(this);" name="photo">
                    <button type="submit" class="btn" >Upload</button>
                    </form>

                </div>


        </div>
    </div>

    <script>

        function readURL(input) {

            for(i=0; i< input.files.length; i++) {


                if (input.files && input.files[i]) {


                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#preview').html('<img src ="' + e.target.result + '">');
                    };

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

    </script>
@endsection