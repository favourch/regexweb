@extends('layouts.app')

@section('content')

    @include('sidebars.dean')
    <div class="row">
    <div class="col s12 m10 l10 offset-l2 offset-m2">

        @if(!isset($student) || !isset($transcript))

            <div class="col m8 l8 white offset-l2 offset-m2" style="margin-top: 20%">
            <label for="studentid">Please enter student ID :</label>
            <input type="text" id="studentid">
            <a class="btn" id="getTransButton">View Transcript</a>
            <a class="btn green" id="downloadPDF">Download PDF</a>

            </div>
            <script>
                $(document).ready(function () {
                    var getTransButton = $('#getTransButton');
                    var downloadPDF = $('#downloadPDF');
                    getTransButton.on('click', function () {
                        var sid = $('#studentid').val();

                        if(sid != "")
                        window.location = "{{url('deans/')}}/" + sid ;
                    });

                    downloadPDF.on('click', function () {
                        var sid = $('#studentid').val();

                        if(sid != "")
                            window.location =  "{{url('deans/download/')}}/" + sid ;
                    });
                })
            </script>
            @endif
    </div>
    </div>
@endsection