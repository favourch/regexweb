@extends('layouts.auth')

@section('content')

    <div class="mn-content valign-wrapper">
        <main class="mn-inner container ">
            <div class="valign">
                <div class="row">

                    <div class="col s12 m6 l6 offset-l2" >
                        <div class="card white darken-1">
                            <div class="card-content z-depth-5 ">
                                <span class="card-title"><img src="{{url('assets/images/logo.png')}}" style="height: 100px;"></span>
                                <span class="card-title teal-text">REGEX PORTAL</span>
                                <span class="card-title">Password Reset</span>
                                <div class="row">

                                    @if (session('status'))
                                        <div class="green">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div align="center">

                                                <button type="submit" class="btn btn-primary">
                                                    Send Password Reset Link
                                                </button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>


    @endsection

