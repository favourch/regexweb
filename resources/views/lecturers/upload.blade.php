@extends('layouts.app')

@section('content')

    @include('sidebars.lecturers')

    <div class="mn-content fixed-sidebar">

        <main class="mn-inner">
            <div class="card upload" >
                <div class="card-content">
                    <span class="card-title">RESULT UPLOAD FORM</span><br>
                    <a class="right" href="{{url('/samples/result-upload-sample.xlsx')}}">Download sample here</a> <br>
                    <div class="row" style="text-align: center">

                        <div class="select-wrapper">
                            <span class="caret">▼</span>
                            <select id="level">
                                <option value="" disabled="" selected="">Select the level:</option>
                                <option>400</option>
                                <option>300</option>
                                <option>200</option>
                                <option>100</option>
                                <option>PRE-UNIVERSITY</option>
                            </select>
                        </div>

                        <div class="select-wrapper">
                            <span class="caret">▼</span>
                            <select name="semester" id="semester">
                                <option value="" disabled="" selected="">Select the semester:</option>
                                <option value="1">SEMESTER 1</option>
                                <option value="2">SEMESTER 2</option>
                            </select>
                        </div>


                        <div class="select-wrapper">
                            <span class="caret">▼</span>
                            <select  id="courses">
                            </select>
                        </div>

                    </div>

                    <span class="card-title">UPLOAD FILE</span><br>

                    <div class="card-content" id="uploadHelp">
                        <form method="post" enctype="multipart/form-data" action="{{url('/lecturers/upload')}}" class="dropzone">
                            {{csrf_field()}}
                            <input type="hidden" name="cid" id="hiddenCid">
                            <div class="fallback">
                                <input name="file" type="file" />
                            </div>
                        </form>

                        <br>

                    </div>

                </div>
            </div>
        </main>

        <div class="page-footer">
            <div class="footer-grid container">
                <div class="footer-l white">&nbsp;</div>
                <div class="footer-grid-l white">

                </div>
                <div class="footer-r white">&nbsp;</div>
                <div class="footer-grid-r white">
                    <div class="fixed-action-btn horizontal">
                        <a class="btn-floating btn-large red">
                            <i class="large material-icons">mode_edit</i>
                        </a>
                        <ul>
                            <li><a class="btn-floating regent"><i class="material-icons">home</i></a></li>
                            <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
                            <li><a class="btn-floating regent1"><i class="material-icons">feedback</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="left-sidebar-hover"></div>


    <script src="{{url('assets/plugins/dropzone/dropzone.min.js')}}"></script>
    <script src="{{url('assets/plugins/dropzone/dropzone-amd-module.min.js')}}"></script>



@endsection