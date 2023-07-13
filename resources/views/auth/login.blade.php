@extends('layout.auth')
@section('title')
Login
@endsection
@section('custom-style')
<style>
    .custom-border {
        border: 1px solid blue !important;
    }

    .custom-text-color--dark-blue {
        color: #00005c !important;
    }

    .custom-text-color--white {
        color: #ffffff !important;
    }

    .custom-background-color--dark-blue {
        background-color: #00005c !important;
    }

    .custom-background-color--white {
        background-color: #ffffff !important;
    }

    .custom-border-color--dark-blue {
        border-color: #00005c !important;
    }

    .custom-border-color--white {
        border-color: #ffffff !important;
    }
</style>
@endsection


@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="d-none d-md-block col-md-12 text-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{asset('img/logokonek.png')}}" alt="Logo" style="width: 15rem;">
            </a>
        </div>
        <div class="col-md-12 text-center  " >
            <h2 class="my-4 my-md-0 custom-text-color--dark-blue"><b>WMS IVORY</b></h2>
        </div>
        <div class="col-md-4">
            <div class="card custom-border">
                <div class="card-body">
                    <form method="POST" action="{{ route('doLogin') }}" id="form-login">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col-12 mb-2 text-center">
                                <p>Enter your Username and Password</p>
                            </div>
                            <div class="col-12 mb-2">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remember" >
                                    <label class="form-check-label" for="remember">
                                        Remember me on this computer
                                    </label>
                                  </div>
                            </div>
                            <div class="col-12 mb-2 text-end">
                                <button type="submit" id="btn_login" name="btn_login" class="btn custom-background-color--dark-blue custom-border-color--dark-blue custom-text-color--white">
                                    <b>LOGIN</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center" >
            <p>Forgot your password? <a href="{{ route('showFormResetPassword') }}">Click Here</a> </p>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="application/javascript">
    $(document).ready(function () {

    });
</script>
@endsection
