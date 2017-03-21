@extends('layouts.app')

@section('content')

    @include('sidebars.admin')

    <main class="mn-inner">
        <div class="card" >
            <div class="card-content">
                <span class="card-title" style="text-align: left">Last login : {{Auth::user()->lastLogin}}</span><br>

                <h3 class="header-text" style="text-align: center">ROLL SEMESTER</h3><br>
                <p class="small" style="text-align: center">Please drag a list of ID numbers of students who should progress to the next level</p>
                <div class="row">

                    <div class="col s12 m12 l12" style="color:white">

                        <div class="card-content" id="uploadHelp">
                            <form method="post" enctype="multipart/form-data" action="{{url('/admins/roll-semester')}}" class="dropzone">
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

            </div>
        </div>


    </main>



    <script src="{{url('assets/plugins/dropzone/dropzone.min.js')}}"></script>
    <script src="{{url('assets/plugins/dropzone/dropzone-amd-module.min.js')}}"></script>


@endsection