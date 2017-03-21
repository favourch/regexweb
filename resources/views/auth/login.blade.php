@extends('layouts.auth')

@section('content')

    <div class="mn-content valign-wrapper">
        <main class="mn-inner container ">
            <div class="valign">
                <div class="row">

                    <div class="col s12 m6 l6 offset-l2" >
                        <div class="card white darken-1">
                            <div class="card-content z-depth-5 ">
                                <span class="card-title"><img src="assets/images/logo.png" style="height: 100px;"></span>
                                <span class="card-title teal-text">REGEX PORTAL</span>
                                <span class="card-title">Sign In</span>
                                <div class="row login">
                                    <form class="col s12" role="form" method="POST" action="{{ url('/login') }}">
                                        {{ csrf_field() }}

                                        @if ($errors->has('staffid'))
                                            <div class="error" align="center">
                                                <strong>{{ $errors->first('staffid') }}</strong>
                                            </div>
                                        @endif

                                        <div class="input-field s12 {{ $errors->has('staffid') ? ' has-error' : '' }}">

                                            <label for="staffid">Staff ID</label>
                                            <input id="staffid" type="text" class="validate" name="staffid" value="{{ old('staffid') }}" required autofocus>

                                        </div>

                                        @if ($errors->has('password'))
                                            <span class="error">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                        <div class="input-field s12  {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Password</label>

                                            <input id="password" type="password" class="form-control" name="password" required>


                                        </div>

                                        <div class="input-field s12 ">
                                            <div class="col-md-6 col-md-offset-4">
                                                <input type="checkbox" id="remember" name="remember" />
                                                <label for="remember">Remember Me</label>
                                            </div>
                                        </div>

                                        <div class="input-field s12 ">
                                            <div class="col-md-8 col-md-offset-4">

                                                <a href="{{ url('/password/reset') }}" style="color:black">
                                                    Forgot Your Password?
                                                </a>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="col s12 right-align m-t-sm">
                                            <button type="submit" class="btn btn-primary">
                                                Login
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


